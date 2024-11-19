<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Store;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\ProductImage;

class HomeApiController extends Controller
{
    //
    public function categories(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Categories::with('subCategory')
            ->where('status', 'active') // Adjust based on your active status value
            ->orderBy('sort_order', 'DESC')
            ->get();
    
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
            $results = Store::select('id','name','logo')
            ->where('status', 'active') // Adjust based on your active status value
            ->orderBy('id', 'DESC')
            ->get();
    
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
    
    public function store_products_list(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->where('store_id',$request->store_id)->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function home_products_section1(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function home_products_section2(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function home_products_section3(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function home_products_section4(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function category_products(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->where('category_id',$request->category_id)->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function subcategory_products(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->where('sub_category_id',$request->sub_category_id)->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function selected_products(Request $request)
    { 
       
       try {
           $results = Product::with('category','subCategory','brand','skusBase')->find($request->id);
          return $skus=ProductSku::with('size','color','images')->where('product_id',$results->id)->get();
           if (is_null($results)) {
               // Return 'no data found' response if no result is found
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
               'attribute'=>$skus,
           ], 200);
       } catch (\Exception $e) {
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function searchProducts(Request $request)
    { 
        try {
            // Validate the request input
            $request->validate([
                'value' => 'required|string|max:255',
            ]);
    
            // Search for products with the specified value in the 'name' field
            $results = Product::select('id', 'name', 'product_code', 'model', 'brand_id', 'category_id', 'sub_category_id')
                ->with(['category', 'subCategory', 'brand', 'skusBase'])
                ->where('name', 'like', '%' . $request->value . '%')
                ->get();
    
            // Check if the results are empty and return an appropriate response
            if ($results->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No data found',
                    'data' => []
                ], 200);
            }
    
            // Return the retrieved data
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $results
            ], 200);
    
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function upto_40_products(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->where('offer_adds_id',10)->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function upto_50_products(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->where('offer_adds_id',11)->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    public function upto_60_products(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->where('offer_adds_id',12)->get();
           
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
           return response()->json([
               'status' => 'error',
               'message' => 'An error occurred',
               'error' => $e->getMessage()
           ], 500);
       }
    }
    
}
