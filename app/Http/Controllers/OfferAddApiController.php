<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\OfferAdditionalImage;
use App\Models\Favorite;
use App\Models\OfferView;
use Carbon\Carbon;
use DB;
class OfferAddApiController extends Controller
{
    //
    public function all_list(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','image','end_date','offer_categories_id','store_id')->with('offercategories','store')->paginate(50);
            // ->Running()
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
    public function all_list_latest(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','image','end_date','offer_categories_id','store_id')->with('offercategories','store')
            ->District($request->district)->City($request->city_id)->orderBy('id','DESC')->paginate(50);
            // ->Running()
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
    
    public function district_list(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','image','end_date','offer_categories_id','store_id')->with('offercategories','store')
            ->District($request->district)->paginate(50);
            // ->Running()
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
    public function store_list(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','image','end_date','offer_categories_id','store_id')->with('offercategories','store')
            ->where('store_id',$request->store_id)->paginate(50);
            // ->Running()
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
    public function city_district_list(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','image','end_date','offer_categories_id','store_id')->with('offercategories','store')
            ->District($request->district)->where('city_id',$request->city_id)->paginate(50);
            // ->Running()
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
    public function categories_list(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','short_description','highlight_title','image')->with('offercategories')
            ->District($request->district)->Category($request->category)->paginate(50);
            // ->Running()
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
    public function sub_categories_list(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','short_description','highlight_title','image')->with('offercategories')
            ->Running()->District($request->district)->SubCategory($request->subcategory)->paginate(50);
    
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
    public function offer_categories_list(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','image','end_date','offer_categories_id','store_id')->with('offercategories','store')
            ->District($request->district)->OfferCategory($request->offercategory)->paginate(50);
            // ->Running()
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
     public function search_list(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id', 'code', 'title', 'image','end_date','offer_categories_id','store_id')
            ->with('offercategories','store')
            // ->Running()
            ->District($request->district)
            ->where('tags', 'like', '%' . $request->value . '%')
            ->paginate(50);
    
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
    public function offer_near_you(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','image','end_date','offer_categories_id','store_id')->with('offercategories','store')->Running()->paginate(50);
    
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
    public function offer_trending(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','image','end_date','offer_categories_id','store_id')->with('offercategories','store')->Running()->paginate(50);
    
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
    public function offer_expiring_soon(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::select('id','code','title','image','end_date','offer_categories_id','store_id')->with('offercategories','store')->Running()->paginate(50);
    
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
    public function offer_single_view(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Offer::with('offercategories','store')->find($request->id);
            $offerAdditionalImage=OfferAdditionalImage::where('offers_id',$request->id)->get();
            // Check if data exists
            if (!$results) {
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
                'data' => $results,
                'offerAdditionalImage'=>$offerAdditionalImage
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
    public function offer_like(Request $request)
    {
        // return $request->all();
        // Validation

        try {
            DB::transaction(function () use ($request,&$offer) {
                $offer = Offer::find($request->id);
                $offer->offer_like=$offer->offer_like+1;
                $offer->save();  
            });

            if (!$offer) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $offer->offer_like,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create store: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for Internal Server Error
        }
    }
    public function offer_deslike(Request $request)
    {
        // return $request->all();
        // Validation

        try {
            DB::transaction(function () use ($request,&$offer) {
                $offer = Offer::find($request->id);
                $offer->offer_deslike=$offer->offer_deslike+1;
                $offer->save();  
            });

            if (!$offer) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $offer->offer_deslike,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create store: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for Internal Server Error
        }
    }
    
    public function offer_add_view(Request $request)
    {
        // return $request->all();
        // Validation
        $validator = Validator::make($request->all(), [
            'offer_id' => 'required|exists:offers,id',
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
        try {
            DB::transaction(function () use ($request,&$offerView) {
                $offerView = new OfferView;
                $offerView->offer_id=$request->offer_id;
                $offerView->user_id=$request->user_id;
                $offerView->in_date=now();
                $offerView->save();  
            });

            if (!$offerView) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $offerView,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create store: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for Internal Server Error
        }
    }
    public function offer_add_favorite(Request $request)
    {
        // return $request->all();
        // Validation
        $validator = Validator::make($request->all(), [
            'offer_id' => 'required|exists:offers,id',
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
        try {
            DB::transaction(function () use ($request,&$favorite) {
                $favorite = new Favorite;
                $favorite->offer_id=$request->offer_id;
                $favorite->user_id=$request->user_id;
                $favorite->save();  
            });

            if (!$favorite) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $favorite,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create store: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for Internal Server Error
        }
    }
    public function offer_get_favorite(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Favorite::with('offer','user')->where('user_id',$request->user_id)->paginate(50);
    
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
