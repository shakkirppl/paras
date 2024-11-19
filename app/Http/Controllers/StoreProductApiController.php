<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\ProductImage;
class StoreProductApiController extends Controller
{
    //
    public function store_category_products_list(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->where('store_id',$request->store_id)->where('category_id',$request->category_id)->get();
           
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
    public function store_subcategory_products_list(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->where('store_id',$request->store_id)->where('sub_category_id',$request->sub_category_id)->get();
           
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
    public function store_products_section1(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase') ->where('store_id',$request->store_id)->get();
           
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
    public function store_products_section2(Request $request)
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
    public function store_products_section3(Request $request)
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
    public function store_products_section4(Request $request)
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
  
    
    
}
