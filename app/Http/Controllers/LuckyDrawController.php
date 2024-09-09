<?php
namespace App\Http\Controllers;

use App\Models\LuckyDraws;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LuckyDrawController extends Controller
{
    /**
     * Display a listing of the store types.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $luckyDraws = LuckyDraws::paginate(10); // Paginate results
        return view('lucky-draws.index', compact('luckyDraws'));
    }

    /**
     * Show the form for creating a new store type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lucky-draws.create');
    }

    /**
     * Store a newly created store type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:lucky_draws,code',
            'name' => 'required|string|max:255',
            'draw_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request) {
                $luckyDraws = new LuckyDraws();
                $luckyDraws->code = $request->code;
                $luckyDraws->name = $request->name;
                $luckyDraws->draw_date = $request->draw_date;
                $luckyDraws->save();
            });

            return redirect()->route('lucky-draws.index')->with('success', 'luckyDraws created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create luckyDraws: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified store type.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $luckyDraws = LuckyDraws::findOrFail($id);
        return view('lucky-draws.edit', compact('luckyDraws'));
    }

    /**
     * Update the specified store type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:lucky_draws,code,' . $id,
            'name' => 'required|string|max:255',
            'draw_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request, $id) {
                $luckyDraws = LuckyDraws::findOrFail($id);
                $luckyDraws->code = $request->code;
                $luckyDraws->name = $request->name;
                $luckyDraws->draw_date = $request->draw_date;
                $luckyDraws->save();
            });

            return redirect()->route('lucky-draws.index')->with('success', 'Store type updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update store type: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified store type from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $luckyDraws = LuckyDraws::findOrFail($id);
                $luckyDraws->delete();
            });

            return redirect()->route('lucky-draws.index')->with('success', 'Store type deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete store type: ' . $e->getMessage());
        }
    }
}
