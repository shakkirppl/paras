<?php
namespace App\Http\Controllers;

use App\Models\StoreClassifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StoreClassificationsController extends Controller
{
    /**
     * Display a listing of the store classifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeClassifications = StoreClassifications::paginate(10); // Paginate results
        return view('store-classifications.index', compact('storeClassifications'));
    }

    /**
     * Show the form for creating a new store classification.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store-classifications.create');
    }

    /**
     * Store a newly created store classification in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'code' => 'nullable|string|max:255|unique:store_classifications,code',
            'name' => 'nullable|string|max:255',
            'square_feet' => 'nullable|string|max:255',
            'no_of_staff' => 'nullable|string|max:255',
            'minimum_sales' => 'required|numeric',
            'maximum_sales' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request) {
                $storeClassification = new StoreClassifications();
                $storeClassification->code = $request->code;
                $storeClassification->name = $request->name;
                $storeClassification->square_feet = $request->square_feet;
                $storeClassification->no_of_staff = $request->no_of_staff;
                $storeClassification->minimum_sales = $request->minimum_sales;
                $storeClassification->maximum_sales = $request->maximum_sales;
                $storeClassification->save();
            });

            return redirect()->route('store-classifications.index')->with('success', 'Store classification created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create store classification: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified store classification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storeClassification = StoreClassifications::findOrFail($id);
        return view('store-classifications.edit', compact('storeClassification'));
    }

    /**
     * Update the specified store classification in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'code' => 'nullable|string|max:255|unique:store_classifications,code,' . $id,
            'name' => 'nullable|string|max:255',
            'square_feet' => 'nullable|string|max:255',
            'no_of_staff' => 'nullable|string|max:255',
            'minimum_sales' => 'required|numeric',
            'maximum_sales' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request, $id) {
                $storeClassification = StoreClassifications::findOrFail($id);
                $storeClassification->code = $request->code;
                $storeClassification->name = $request->name;
                $storeClassification->square_feet = $request->square_feet;
                $storeClassification->no_of_staff = $request->no_of_staff;
                $storeClassification->minimum_sales = $request->minimum_sales;
                $storeClassification->maximum_sales = $request->maximum_sales;
                $storeClassification->save();
            });

            return redirect()->route('store-classifications.index')->with('success', 'Store classification updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update store classification: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified store classification from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $storeClassification = StoreClassifications::findOrFail($id);
                $storeClassification->delete();
            });

            return redirect()->route('store-classifications.index')->with('success', 'Store classification deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete store classification: ' . $e->getMessage());
        }
    }
}
