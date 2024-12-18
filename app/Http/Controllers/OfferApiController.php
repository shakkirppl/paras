<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferCategory;
use App\Models\OfferDetails;
use App\Models\OfferAdds;
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
