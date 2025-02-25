<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferCategory;
use App\Models\OfferDetails;
use App\Models\OfferAdds;
use App\Models\AddTags;
use App\Models\Store;
use App\Models\Coupens;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\OfferAdditionalImage;
use Illuminate\Support\Str;
use App\Helper\File;
class OfferApiController extends Controller
{
    //
    use File;

    
    public function offer_store(Request $request)
    {
        // Validate Request
        $validator = Validator::make($request->all(), [
            'offer_categories_id' => 'required|exists:offer_categories,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'start_date' => 'required|date_format:d-m-Y',
            'end_date' => 'required|date_format:d-m-Y',
            'user_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:stores,id',
            'image' => 'required|array', // Ensure 'image' is an array
            'image.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate each image
        ]);
    
        // Check Validation Failure
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Failed',
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Wrap in a Transaction
        DB::beginTransaction();
        try {
            $store = Store::findOrFail($request->store_id);
            
             // Auto Generate Offer Code (AD001, AD002, ...)
        $lastOffer = Offer::latest('id')->first();
        $lastNumber = $lastOffer ? intval(substr($lastOffer->code, 2)) : 0;
        $newCode = 'AD' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

            // Upload First Image
            $path = 'uploads/offer/';
            $image = 'default.jpg';
            if ($request->hasFile('image')) {
                $photo = $request->file('image');
                $image = $this->file($photo[0], $path, 300, 300);
            }
    
            // Create Offer
            $newOffer = Offer::create([
                'code' => $newCode ?? null,
                'title' => $request->title,
                'offer_categories_id' => $request->offer_categories_id,
                'start_date' => Carbon\Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d'),
                'end_date' => Carbon\Carbon::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d'),
                'in_date' => $request->in_date ? Carbon\Carbon::createFromFormat('d-m-Y', $request->in_date)->format('Y-m-d H:i:s') : now(),
                'district_id' => $store->district_id,
                'store_subscription_end_date' => $store->subscription_end_date,
                'user_id' => $request->user_id,
                'store_id' => $request->store_id,
                'image' => $image,
                'short_description' => null,
                'highlight_title' => null,
                'categories_id' => 0,
                'sub_categories_id' => 0,
                'descount_percentage' => 0,
                'description' => null,
                'tags' => null,
                'latitude' => null,
                'longitude' => null,
                'offer_like' => 0,
                'offer_deslike' => 0,
                'no_of_use' => 0,
                'views' => 0,
                'hot_deal' => 0,
                'trending' => 0,
                'promote' => 0,
                'applicable_on' => null,
            ]);
    
            // Save Additional Images
            foreach ($photo as $photos) {
                $mimage = $this->file($photos, $path, 300, 300);
                OfferAdditionalImage::create([
                    'offers_id' => $newOffer->id,
                    'store_id' => $request->store_id,
                    'image' => $mimage
                ]);
            }
    
            DB::commit(); // Commit Transaction
    
            return response()->json([
                'status' => 'success',
                'message' => 'Offer created successfully',
                'data' => $newOffer
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on Error
    
            return response()->json([
                'status' => 'error',
                'message' => [$e->getMessage()],
            ], 500);
        }
    }
    

    public function offer_adds_section1(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = OfferAdds::select('id','image')->where('offer_adds_type','Section_1')->where('status','active')->get();
    
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
    public function offer_adds_section2(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = OfferAdds::select('id','image')->where('offer_adds_type','Section_2')->where('status','active')->get();
    
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
    public function offer_adds_section3(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = OfferAdds::select('id','image')->where('offer_adds_type','Section_3')->where('status','active')->get();
    
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
    public function offer_adds_section4(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = OfferAdds::select('id','image')->where('offer_adds_type','Section_2')->where('status','active')->get();
    
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
    public function offer_adds_section5(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = OfferAdds::select('id','image')->where('offer_adds_type','Section_2')->where('status','active')->get();
    
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
