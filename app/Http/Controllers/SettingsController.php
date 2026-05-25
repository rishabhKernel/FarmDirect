<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    /**
     * Show the settings page.
     */
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.settings', compact('user'));
    }

    /**
     * Update profile information (name, email, phone, bio, city, language).
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'bio'       => 'nullable|string|max:500',
            'city'      => 'nullable|string|max:100',
            'farm_name' => 'nullable|string|max:255',
            'language'  => 'nullable|string|in:en,hi,pa,te,ta,mr,bn',
            'profile_picture' => 'nullable|image|max:2048',
            'upi_id'    => 'nullable|string|max:255',
        ]);

        $user->fill(collect($validated)->except('profile_picture')->toArray());

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('farmer.settings')->with('success', 'Profile updated successfully!');
    }

    /**
     * Update notification preferences.
     */
    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        $user->email_notifications = $request->boolean('email_notifications');
        $user->sms_notifications   = $request->boolean('sms_notifications');
        $user->bid_alerts          = $request->boolean('bid_alerts');
        $user->price_alerts        = $request->boolean('price_alerts');
        $user->dark_mode           = $request->boolean('dark_mode');
        $user->save();

        return redirect()->route('farmer.settings', ['tab' => 'notifications'])
                         ->with('success', 'Notification preferences saved!');
    }

    /**
     * Add a bank account.
     */
    public function addBank(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'ifsc_code' => 'required|string|max:20',
        ]);

        $accounts = $user->bank_accounts ?? [];
        $accounts[] = [
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'is_primary' => empty($accounts)
        ];
        
        $user->bank_accounts = $accounts;
        $user->save();

        return redirect()->route('farmer.settings', ['tab' => 'payment'])
                         ->with('success', 'Bank account added successfully!');
    }
    
    /**
     * Update a bank account.
     */
    public function updateBank(Request $request, $index)
    {
        $user = Auth::user();
        $accounts = $user->bank_accounts ?? [];
        
        if (!isset($accounts[$index])) {
            return back()->with('error', 'Bank account not found.');
        }
        
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'ifsc_code' => 'required|string|max:20',
        ]);
        
        $accounts[$index]['bank_name'] = $request->bank_name;
        $accounts[$index]['account_number'] = $request->account_number;
        $accounts[$index]['ifsc_code'] = $request->ifsc_code;
        
        $user->bank_accounts = $accounts;
        $user->save();
        
        return redirect()->route('farmer.settings', ['tab' => 'payment'])
                         ->with('success', 'Bank account updated successfully!');
    }

    /**
     * Add a payment card.
     */
    public function addCard(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'card_number' => 'required|string|max:19',
            'expiry_date' => 'required|string|max:5',
        ]);

        $cards = $user->cards ?? [];
        $cards[] = [
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'card_type' => str_starts_with($request->card_number, '4') ? 'VISA' : 'MASTERCARD'
        ];
        
        $user->cards = $cards;
        $user->save();

        return redirect()->route('farmer.settings', ['tab' => 'payment'])
                         ->with('success', 'Payment card added successfully!');
    }

    /**
     * Update security settings (password + 2FA toggle).
     */
    public function updateSecurity(Request $request)
    {
        $user = Auth::user();

        // Handle 2FA toggle (standalone action)
        if ($request->has('toggle_2fa')) {
            $user->two_factor_enabled = !$user->two_factor_enabled;
            $user->save();
            $msg = $user->two_factor_enabled ? 'Two-factor authentication enabled.' : 'Two-factor authentication disabled.';
            return redirect()->route('farmer.settings', ['tab' => 'security'])->with('success', $msg);
        }

        // Handle password change
        $request->validate([
            'current_password' => 'required|string',
            'password'         => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.'])
                         ->with('tab', 'security');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('farmer.settings', ['tab' => 'security'])
                         ->with('success', 'Password changed successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'confirm_delete' => 'required|in:DELETE',
        ]);

        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Your account has been permanently deleted.');
    }
}
