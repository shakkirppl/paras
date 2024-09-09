<?php
namespace App\Http\Controllers;

use App\Models\StoreTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StoreTypeController extends Controller
{
    /**
     * Display a listing of the store types.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeTypes = StoreTypes::paginate(10); // Paginate results
        return view('store-types.index', compact('storeTypes'));
    }

    /**
     * Show the form for creating a new store type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store-types.create');
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
            'code' => 'required|string|max:255|unique:store_types,code',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request) {
                $storeType = new StoreTypes();
                $storeType->code = $request->code;
                $storeType->name = $request->name;
                $storeType->save();
            });

            return redirect()->route('store-type.index')->with('success', 'Store type created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create store type: ' . $e->getMessage())->withInput();
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
        $storeType = StoreTypes::findOrFail($id);
        return view('store-types.edit', compact('storeType'));
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
            'code' => 'required|string|max:255|unique:store_types,code,' . $id,
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request, $id) {
                $storeType = StoreTypes::findOrFail($id);
                $storeType->code = $request->code;
                $storeType->name = $request->name;
                $storeType->save();
            });

            return redirect()->route('store-type.index')->with('success', 'Store type updated successfully');
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
                $storeType = StoreTypes::findOrFail($id);
                $storeType->delete();
            });

            return redirect()->route('store-type.index')->with('success', 'Store type deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete store type: ' . $e->getMessage());
        }
    }
}
