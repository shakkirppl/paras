<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductSku;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helper\File;
class ProductCreateApiController extends Controller
{
    //
    use File;
    public function categories(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Categories::Active()->get();
    
            // Check if data exists
            if ($results->isEmpty()) {
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
                'data' => $results
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
    public function sub_categories(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = SubCategories::Active()->where('categories_id',$request->categories_id)->get();
    
            // Check if data exists
            if ($results->isEmpty()) {
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
                'data' => $results
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

    public function brands(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Brand::Active()->get();
    
            // Check if data exists
            if ($results->isEmpty()) {
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
                'data' => $results
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

    public function color_attributes(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = ProductAttribute::where('type','type')->get();
    
            // Check if data exists
            if ($results->isEmpty()) {
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
                'data' => $results
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

    public function size_attributes(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = ProductAttribute::where('type','size')->get();
    
            // Check if data exists
            if ($results->isEmpty()) {
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
                'data' => $results
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
    public function store(Request $request)
    {
        // return $request->all();
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
            'sub_categories_id' => 'required|exists:sub_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'store_id' => 'required|exists:stores,id',
            'user_id' => 'required|exists:users,id',
           
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
            $path = 'uploads/offer';
            $image = $this->file($file,$path,150,150);
        }else{$image='defalut.jpg';}
        try {
            DB::transaction(function () use ($request,$image,&$offer) {
                $store = Store::find($request->store_id);
                $code = $store->code . rand(10000, 99999) . now()->format('m') . Offer::count() + 1;

                $offer = new Offer();
                $offer->code = $code;
                $offer->title = $request->title;
                $offer->short_description = $request->short_description;
                $offer->highlight_title = $request->highlight_title;
                $offer->categories_id = $request->categories_id;
                $offer->image = $image; // Handle file uploads if necessary
                $offer->sub_categories_id = $request->sub_categories_id;
                $offer->offer_categories_id = $request->offer_categories_id;
                $offer->applicable_on = $request->applicable_on;
                $offer->descount_percentage = 0;
                $offer->in_date = Carbon::now()->toDateString(); // Use correct date format
                $offer->description = $request->description;
                $offer->start_date = Carbon::createFromFormat('m/d/Y', $request->start_date)->format('Y-m-d'); // Convert to YYYY-MM-DD
                $offer->end_date = Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d'); // Convert to YYYY-MM-DD
                $offer->store_id = $request->store_id;
                $offer->user_id = $request->user_id;
                $offer->district_id = $store->district_id;
                $offer->latitude = $store->latitude;
                $offer->longitude = $store->longitude;
                $offer->store_subscription_end_date = $store->store_subscription_end_date;
                $offer->status = 'inactive';
                $offer->verified='no';
                $offer->save();
               
                foreach ($request->input('tags_id')  as $key => $val) {
                $offer_tag = Offer::find($offer->id);
                $offer_tag->tags = $offer_tag->tags .','. $request->input('tags_name')[$key];
                $offer_tag->save();
                }
            });

            if (!$offer) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $offer,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create store: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for Internal Server Error
        }
    }
}
