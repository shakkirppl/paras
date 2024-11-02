<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\ProductImage;
class CategoryApiController extends Controller
{
    //
  
    public function home_products_section1(Request $request)
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
    public function home_products_section2(Request $request)
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
    public function home_products_section3(Request $request)
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
    public function home_products_section4(Request $request)
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
  
    public function upto_40_products(Request $request)
    { 
       try {
           $results = Product::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
           ->with('category','subCategory','brand','skusBase')->where('category_id',$request->category_id)->where('offer_adds_id',10)->get();
           
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
           ->with('category','subCategory','brand','skusBase')->where('category_id',$request->category_id)->where('offer_adds_id',11)->get();
           
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
           ->with('category','subCategory','brand','skusBase')->where('category_id',$request->category_id)->where('offer_adds_id',12)->get();
           
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
