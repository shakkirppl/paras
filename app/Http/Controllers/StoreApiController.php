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

class StoreApiController extends Controller
{
    //
    public function api_store(Request $request)
    {
        // return $request->all();
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'store_types_id' => 'required|exists:store_types,id',
            'store_classifications_id' => 'required|exists:store_classifications,id',
            'user_id' => 'required|exists:users,id',
            'district_id' => 'required|exists:districts,id',
            'address' => 'nullable|string',
            'latitude' => 'nullable|string',
            'admin_user_name' => 'nullable|string|max:255',
            'password' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            // Return a JSON response with detailed validation errors
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors() // This will include the details of which fields failed
            ], 422);
        }
        if( $file = $request->file('image') ) {
            $path = 'uploads/store';
            $image = $this->file($file,$path,150,150);
        }else{$image='defalut.jpg';}
        try {
            DB::transaction(function () use ($request,$image,&$store) {
                $storeType = StoreTypes::find($request->store_types_id);
                $code = $storeType->code . rand(100000, 999999) . now()->format('m') . Store::count() + 1;

                $store = new Store();
                $store->code = $code;
                $store->name = $request->name;
                $store->store_types_id = $request->store_types_id;
                $store->store_classifications_id = $request->store_classifications_id;
                $store->district_id = $request->district_id;
                $store->logo = $image; // Handle file uploads if necessary
                $store->email = $request->email;
                $store->contact_no = $request->contact_no;
                $store->whatsapp_no = $request->whatsapp_no;
                $store->address = $request->address;
                $store->town = $request->town;
                $store->landmark = $request->landmark;
                $store->latitude = $request->latitude;
                $store->longitude = $request->longitude;
                $store->admin_user_name = $request->admin_user_name;
                $store->password = $request->password;
                $store->description = $request->description;
                $store->user_id = $request->user_id;
                $store->status = 'inactive';
                $store->register_status='pending';
                $store->save();

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->admin_user_name,
                    'password' => Hash::make($request->password),
                    'user_rol_id' => 4,
                    'store_id' => $store->id,
                ]);        
            });

            if (!$store) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $store,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create store: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for Internal Server Error
        }
    }

    public function approved()
    {
        try {
            // Fetch stores that are complete and active
            $stores = Store::Complete()->Active()->get();
    
            // Check if data exists
            if ($stores->isEmpty()) {
                // Return 'no data found' response if the collection is empty
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
    
            // Return data if it exists
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $stores
            ], 200);
    
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function pending()
    {
        try {
            // Fetch stores that are complete and active
            $stores = Store::InActive()->Pending()->get();
    
            // Check if data exists
            if ($stores->isEmpty()) {
                // Return 'no data found' response if the collection is empty
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
    
            // Return data if it exists
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $stores
            ], 200);
    
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function terminated()
    {
        try {
            // Fetch stores that are complete and active
            $stores = Store::InActive()->Complete()->get();
    
            // Check if data exists
            if ($stores->isEmpty()) {
                // Return 'no data found' response if the collection is empty
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
    
            // Return data if it exists
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $stores
            ], 200);
    
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function rejected()
    {
        try {
            // Fetch stores that are complete and active
            $stores = Store::InActive()->Rejected()->get();
    
            // Check if data exists
            if ($stores->isEmpty()) {
                // Return 'no data found' response if the collection is empty
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
    
            // Return data if it exists
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $stores
            ], 200);
    
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
}
