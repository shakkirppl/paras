<?php
namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreTypes;
use App\Models\StoreClassifications;
use App\Models\Districts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class StoreController extends Controller
{
    /**
     * Display a listing of the stores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all(); // You may want to add pagination or filters here
        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $storeTypes = StoreTypes::all();
        $storeClassifications = StoreClassifications::all();
        $districts = Districts::all();
        return view('stores.create', compact('storeTypes', 'storeClassifications', 'districts'));
    }

    /**
     * Store a newly created store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'store_types_id' => 'required|exists:store_types,id',
            'store_classifications_id' => 'required|exists:store_classifications,id',
            'district_id' => 'required|exists:districts,id',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|string|max:15',
            'whatsapp_no' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'town' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'star_rating' => 'nullable|numeric|between:0,5',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'subscription_end_date' => 'nullable|date',
            'buffer_days' => 'nullable|integer',
            'admin_user_name' => 'nullable|string|max:255',
            'password' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request) {
                $storeType = StoreTypes::find($request->store_types_id);
                $code = $storeType->code . rand(100000, 999999) . now()->format('m') . Store::count() + 1;

                $store = new Store();
                $store->code = $code;
                $store->name = $request->name;
                $store->store_types_id = $request->store_types_id;
                $store->store_classifications_id = $request->store_classifications_id;
                $store->district_id = $request->district_id;
                $store->logo = $request->logo; // Handle file uploads if necessary
                $store->email = $request->email;
                $store->contact_no = $request->contact_no;
                $store->whatsapp_no = $request->whatsapp_no;
                $store->address = $request->address;
                $store->town = $request->town;
                $store->landmark = $request->landmark;
                $store->star_rating = $request->star_rating;
                $store->latitude = $request->latitude;
                $store->longitude = $request->longitude;
                $store->subscription_end_date = $request->subscription_end_date;
                $store->buffer_days = $request->buffer_days;
                $store->admin_user_name = $request->admin_user_name;
                $store->password = $request->password;
                $store->description = $request->description;
                $store->status = $request->status;
                $store->save();
            });

            return redirect()->route('stores.index')->with('success', 'Store created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create store: ' . $e->getMessage());
        }
    }
   
    
    /**
     * Show the form for editing the specified store.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $storeTypes = StoreTypes::all();
        $storeClassifications = StoreClassifications::all();
        $districts = Districts::all();
        return view('stores.edit', compact('store', 'storeTypes', 'storeClassifications', 'districts'));
    }

    /**
     * Update the specified store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'store_types_id' => 'required|exists:store_types,id',
            'store_classifications_id' => 'required|exists:store_classifications,id',
            'district_id' => 'required|exists:districts,id',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|string|max:15',
            'whatsapp_no' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'town' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'star_rating' => 'nullable|numeric|between:0,5',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'subscription_end_date' => 'nullable|date',
            'buffer_days' => 'nullable|integer',
            'admin_user_name' => 'nullable|string|max:255',
            'password' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request, $store) {
                $storeType = StoreTypes::find($request->store_types_id);
                $store->code = $store->code; // Assuming code is not updated
                $store->name = $request->name;
                $store->store_types_id = $request->store_types_id;
                $store->store_classifications_id = $request->store_classifications_id;
                $store->district_id = $request->district_id;
                $store->logo = $request->logo; // Handle file uploads if necessary
                $store->email = $request->email;
                $store->contact_no = $request->contact_no;
                $store->whatsapp_no = $request->whatsapp_no;
                $store->address = $request->address;
                $store->town = $request->town;
                $store->landmark = $request->landmark;
                $store->star_rating = $request->star_rating;
                $store->latitude = $request->latitude;
                $store->longitude = $request->longitude;
                $store->subscription_end_date = $request->subscription_end_date;
                $store->buffer_days = $request->buffer_days;
                $store->admin_user_name = $request->admin_user_name;
                $store->password = $request->password;
                $store->description = $request->description;
                $store->status = $request->status;
                $store->save();
            });

            return redirect()->route('stores.index')->with('success', 'Store updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update store: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified store from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        try {
            DB::transaction(function () use ($store) {
                $store->delete();
            });

            return redirect()->route('stores.index')->with('success', 'Store deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete store: ' . $e->getMessage());
        }
    }
   
}
