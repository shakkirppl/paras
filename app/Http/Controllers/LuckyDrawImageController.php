<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LuckyDraws;
use App\Models\LuckyDrawImages;
use Illuminate\Support\Facades\Storage;

class LuckyDrawImageController extends Controller
{
    /**
     * Store a newly created image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LuckyDraws  $luckyDraw
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, LuckyDraws $luckyDraw)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file type and size
        ]);

        // Handle the uploaded file
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('lucky_draw_images', 'public'); // Store the image in the 'public' disk
        }

        // Create a new LuckyDrawImage record
        $luckyDrawImage = new LuckyDrawImages();
        $luckyDrawImage->lucky_draws_id = $luckyDraw->id;
        $luckyDrawImage->images = basename($imagePath); // Store only the file name
        $luckyDrawImage->save();

        // Redirect back with a success message
        return back()->with('success', 'Image added successfully.');
    }
    public function destroy(LuckyDraws $luckyDraw, LuckyDrawImages $image)
    {
        // Delete the image file from storage
        if (Storage::disk('public')->exists('lucky_draw_images/' . $image->file_name)) {
            Storage::disk('public')->delete('lucky_draw_images/' . $image->file_name);
        }

        // Delete the image record from the database
        $image->delete();

        // Redirect back with a success message
        return back()->with('success', 'Image deleted successfully.');
    }
}
