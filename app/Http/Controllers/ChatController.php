<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = $request->input('message');
        $apiKey = env('OPENROUTER_API_KEY');
        
        $user = auth()->user();
        $cropsCount = \App\Models\Crop::where('user_id', $user->id)->count();
        $crops = \App\Models\Crop::where('user_id', $user->id)->get();
        $cropIds = $crops->pluck('id')->toArray();
        $bidsCount = \App\Models\Bid::whereIn('crop_id', $cropIds)->count();
        $pendingBids = \App\Models\Bid::whereIn('crop_id', $cropIds)->where('status', 'pending')->count();
        
        $systemPrompt = "You are FarmBot, the ultimate AI assistant for the FarmDirect platform. You assist farmers in managing their dashboard, crops, bids, and settings.
        
        Here are the features available in the Farmer Dashboard that you should guide users about:
        1. **Dashboard Overview**: Shows total revenue, active bids, total crops, and active negotiations.
        2. **Active Bids**: Farmers can view bids from buyers. They can Accept, Reject, or Negotiate (send a counter-offer).
        3. **My Crops**: Farmers can add new crops, edit details (price, quantity), and delete them.
        4. **Settings**:
           - **Profile**: Update name, email, phone, bio, and language.
           - **Payment Methods**: Add and edit bank accounts (we support top Indian banks like SBI, HDFC, ICICI).
           - **Notifications**: Toggle email/SMS alerts.
           - **Security**: Change password and delete account.
        5. **Notification Center**: View alerts, mark them as read, or delete them.
        
        Current User Context (You can use this to answer specific questions about the user's data):
        - Name: {$user->name}
        - Email: {$user->email}
        - Role: {$user->role}
        - Total Crops Listed: {$cropsCount}
        - Total Bids Received: {$bidsCount}
        - Pending Bids: {$pendingBids}
        
        You must ONLY answer questions related to FarmDirect, selling crops, payments, shipping, or farming in general. Keep your answers concise, professional, and friendly. If a user asks a question unrelated to the website or farming, politely decline to answer.";

        if (!$apiKey) {
            $reply = $this->getMockReply($message, $user, $cropsCount, $bidsCount, $pendingBids);
            return response()->json(['reply' => $reply]);
        }

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => 'http://localhost:8000',
                'X-Title' => 'FarmDirect',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'google/gemini-2.5-flash',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $message]
                ],
                'max_tokens' => 150
            ]);

            if ($response->successful()) {
                $reply = $response->json()['choices'][0]['message']['content'];
                return response()->json(['reply' => $reply]);
            } else {
                \Log::error("OpenRouter API failed: " . $response->body());
                $reply = $this->getMockReply($message, $user, $cropsCount, $bidsCount, $pendingBids);
                return response()->json(['reply' => $reply . " (OpenRouter Error, using demo mode)"]);
            }
        } catch (\Exception $e) {
            \Log::error("OpenRouter Exception: " . $e->getMessage());
            $reply = $this->getMockReply($message, $user, $cropsCount, $bidsCount, $pendingBids);
            return response()->json(['reply' => $reply]);
        }
    }

    private function getMockReply($message, $user, $cropsCount, $bidsCount, $pendingBids)
    {
        $reply = "I'm FarmBot! I'm currently running in demo mode. You can ask me about crops, bids, or platform features.";
        
        $msgLower = strtolower($message);
        if (str_contains($msgLower, 'hello') || str_contains($msgLower, 'hi')) {
            $reply = "Hello {$user->name}! How can I help you today with your crops or bids?";
        } elseif (str_contains($msgLower, 'crop')) {
            $reply = "You currently have {$cropsCount} crops listed. You can add more in the 'My Crops' section or check them in dashboard.";
        } elseif (str_contains($msgLower, 'bid')) {
            $reply = "You have received {$bidsCount} bids in total. {$pendingBids} are pending. You can manage them in the 'Active Bids' page.";
        } elseif (str_contains($msgLower, 'weather') || str_contains($msgLower, 'advice')) {
            $reply = "The weather is looking good for harvesting! Check the 'Agri Advice' widget for specific alerts based on your region.";
        } elseif (str_contains($msgLower, 'help')) {
            $reply = "I can help you navigate the dashboard, check your active bids, or manage your crop listings. What would you like to do?";
        }
        
        return $reply;
    }

    public function index()
    {
        $user = \Auth::user();
        // Fetch chats where user is a participant
        $chats = \App\Models\Chat::where('participants', $user->id)->get();
        
        // If no chats, create a mock chat for display
        if ($chats->isEmpty()) {
            $mockChat = \App\Models\Chat::create([
                'participants' => [$user->id, 'mock_buyer_id'],
                'product_id' => null
            ]);
            
            \App\Models\Message::create([
                'chat_id' => $mockChat->id,
                'sender_id' => 'mock_buyer_id',
                'content' => 'Hello! I am interested in your crops.',
                'is_read' => false
            ]);
            
            $chats = \App\Models\Chat::where('participants', $user->id)->get();
        }
        
        return view('dashboard.chat', compact('user', 'chats'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required',
            'content' => 'required|string',
        ]);

        $message = \App\Models\Message::create([
            'chat_id' => $request->chat_id,
            'sender_id' => \Auth::id(),
            'content' => $request->content,
            'is_read' => false
        ]);

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function getMessages($chat_id)
    {
        $messages = \App\Models\Message::where('chat_id', $chat_id)->orderBy('created_at', 'asc')->get();
        return response()->json(['messages' => $messages, 'user_id' => \Auth::id()]);
    }
}
