<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferCategory;
use App\Models\OfferDetails;
use App\Models\Store;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\AddTags;
use App\Models\Coupens;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helper\File;
class OfferApiController extends Controller
{
    //
    use File;
    public function offer_store(Request $request)
    {
        // return $request->all();
        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
            'sub_categories_id' => 'required|exists:sub_categories,id',
            'offer_categories_id' => 'required|exists:offer_categories,id',
            'store_id' => 'required|exists:stores,id',
            'user_id' => 'required|exists:users,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',//|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000
            'description' => 'nullable|string',
            'start_date' => 'required|date',  // Required and must be a valid date
            'end_date' => 'required|date|after_or_equal:start_date', // Required, must be a valid date, and must be on or after start_date
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
    public function offer_all(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','short_description','highlight_title','image','applicable_on','in_date','description','start_date','end_date','status','verified')->with('categories','subcategories','offercategories')->Store($request->store_id)->paginate(50);
    
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
    public function offer_all_count(Request $request)
    {
        try {
            // Fetch count of stores that are complete and active for the given user
            $resultsCount = Offer::Store($request->store_id)->count();
            
            // Check if any stores exist
            if ($resultsCount === 0) {
                // Return 'no data found' response if no stores exist
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
            
            // Return count if stores exist
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $resultsCount
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
    
    public function offer_view(Request $request)
    {
        try {
            // Fetch the offer by its ID
            $result = Offer::find($request->id);  // Use 'id' instead of 'is'
            
            // Check if the data exists
            if (!$result) {
                // Return 'no data found' response if no result is found
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
    
            // Return the data if it exists
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $result
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
    public function offer_active(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','short_description','highlight_title','image','applicable_on','in_date','description','start_date','end_date','status','verified')->with('categories','subcategories','offercategories')->Store($request->store_id)->Active()->Verified()->paginate(50);
    
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
    public function offer_active_count(Request $request)
    {
        try {
            // Fetch count of stores that are complete and active for the given user
            $resultsCount = Offer::Store($request->store_id)->count();
            
            // Check if any stores exist
            if ($resultsCount === 0) {
                // Return 'no data found' response if no stores exist
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
            
            // Return count if stores exist
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $resultsCount
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
    public function offer_pending(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','short_description','highlight_title','image','applicable_on','in_date','description','start_date','end_date','status','verified')->with('categories','subcategories','offercategories')->Store($request->store_id)->Active()->NonVerified()->paginate(50);
    
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
    public function offer_pending_count(Request $request)
    {
        try {
            // Fetch count of stores that are complete and active for the given user
            $resultsCount = Offer::Store($request->store_id)->Active()->NonVerified()->count();
            
            // Check if any stores exist
            if ($resultsCount === 0) {
                // Return 'no data found' response if no stores exist
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
            
            // Return count if stores exist
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $resultsCount
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
    public function offer_rejected(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','short_description','highlight_title','image','applicable_on','in_date','description','start_date','end_date','status','verified')->with('categories','subcategories','offercategories')->Store($request->store_id)->Active()->Rejected()->paginate(50);
    
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
    public function offer_rejected_count(Request $request)
    {
        try {
            // Fetch count of stores that are complete and active for the given user
            $resultsCount = Offer::Store($request->store_id)->Active()->Rejected()->count();
            
            // Check if any stores exist
            if ($resultsCount === 0) {
                // Return 'no data found' response if no stores exist
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
            
            // Return count if stores exist
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $resultsCount
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
    public function offer_inactive(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','short_description','highlight_title','image','applicable_on','in_date','description','start_date','end_date','status','verified')->with('categories','subcategories','offercategories')->Store($request->store_id)->InActive()->paginate(50);
    
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
    public function offer_inactive_count(Request $request)
    {
        try {
            // Fetch count of stores that are complete and active for the given user
            $resultsCount = Offer::Store($request->store_id)->InActive()->count();
            
            // Check if any stores exist
            if ($resultsCount === 0) {
                // Return 'no data found' response if no stores exist
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
            
            // Return count if stores exist
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $resultsCount
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
    public function offer_categories(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = OfferCategory::Active()->get();
    
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
    public function tags(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = AddTags::get();
    
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
}
