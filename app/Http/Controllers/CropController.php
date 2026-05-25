<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CropController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string',
            'quantity' => 'required|numeric|min:15',
            'unit' => 'required|string|max:20',
            'price_per_unit' => 'required|numeric',
            'harvest_date' => 'required|date',
        ], [
            'quantity.min' => 'Minimum quantity for listing is 15kg. This is a bulk marketplace.'
        ]);

        $qualityUrl = null;

        // 2. Handle Farmer Quality Upload (Optional)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('crops', 'public');
            $qualityUrl = '/storage/' . $path;
        }

        Crop::create([
            'farmer_id' => Auth::id(),
            'name' => $request->name,
            'category' => $request->category ?? 'Uncategorized',
            'quantity' => (int) $request->quantity,
            'unit' => $request->unit,
            'price_per_unit' => (float) $request->price_per_unit,
            'harvest_date' => $request->harvest_date,
            'image_url' => $qualityUrl,
            'quality_image_url' => $qualityUrl,
            'status' => 'active',
            'is_organic' => $request->has('is_organic'),
        ]);

        return back()->with('success', 'Crop listed! Marketing visual set, and quality photo stored for buyers.');
    }

    public function update(Request $request, $id)
    {
        $crop = Crop::where('farmer_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'quantity' => 'required|numeric|min:15',
            'unit' => 'required|string|max:20',
            'price_per_unit' => 'required|numeric',
            'harvest_date' => 'required|date',
        ], [
            'quantity.min' => 'Minimum quantity for listing is 15kg. This is a bulk marketplace.'
        ]);

        // Handle Image Update
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('crops', 'public');
            $crop->update([
                'quality_image_url' => '/storage/' . $path,
                'image_url' => '/storage/' . $path
            ]);
        }

        $crop->update([
            'name' => $request->name,
            'category' => $request->category,
            'quantity' => (int) $request->quantity,
            'unit' => $request->unit,
            'price_per_unit' => (float) $request->price_per_unit,
            'harvest_date' => $request->harvest_date,
            'is_organic' => $request->has('is_organic'),
        ]);

        return back()->with('success', 'Listing updated successfully!');
    }

    public function destroy($id)
    {
        $crop = Crop::where('farmer_id', Auth::id())->findOrFail($id);
        $crop->delete();

        return back()->with('success', 'Listing removed successfully.');
    }
}
