<?php
namespace App\Http\Controllers;

use App\Models\LuckyDraws;
use App\Models\LuckyDrawGiftes;
use App\Models\LuckyDrawImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class LuckyDrawGiftesController extends Controller
{
    public function create($luckyDrawId)
    {
        $luckyDraw = LuckyDraws::findOrFail($luckyDrawId);
        $luckyDrawGiftes=LuckyDrawGiftes::where('lucky_draws_id',$luckyDrawId)->get();
        $luckyDrawImages=LuckyDrawImages::where('lucky_draws_id',$luckyDrawId)->get();
        return view('lucky_draw_giftes.create', compact('luckyDraw','luckyDrawGiftes','luckyDrawImages'));
    }

    public function store(Request $request, $luckyDrawId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $luckyDraw = LuckyDraws::findOrFail($luckyDrawId);
        $luckyDraw->gifts()->create($request->all());

        return redirect()->route('lucky_draws.show', $luckyDrawId)
                         ->with('success', 'Gift added successfully.');
    }

    public function edit($lucky_draw, $gift)
{
    $luckyDraw = LuckyDraws::findOrFail($lucky_draw);
    $gift = LuckyDrawGiftes::findOrFail($gift);
    return view('lucky_draw_giftes.edit', compact('luckyDraw', 'gift'));
}

    public function update(Request $request,  $lucky_draw, $gift)
    {
    

        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        $gift = LuckyDrawGiftes::findOrFail($gift);
        $gift->update($request->all());
        return redirect()->route('lucky_draw_giftes.index', ['lucky_draw' => $lucky_draw])->with('success', 'Gift updated successfully.');
       
    }

    public function destroy($id)
    {
        $gift = LuckyDrawGiftes::findOrFail($id);
    $gift->delete();

        return back()->with('success', 'Gift deleted successfully.');
    }
}
