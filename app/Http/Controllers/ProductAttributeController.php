<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use DB;
class ProductAttributeController extends Controller
{
    //
    public function index()
    {
        try {
            $product_attributes = ProductAttribute::get();
        return view('product-attributes.index',['product_attributes'=>$product_attributes]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
        return view('product-attributes.create');
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'value' => 'required|string',
           
        ]);
        try {
     
        DB::transaction(function () use ($request) {
            ProductAttribute::create([
                'type' => $request->type,
                'value' => $request->value,
            ]);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(ProductAttribute $ProductAttribute) 
    {
  
        try {
            return view('product-attributes.edit', [
                'ProductAttribute' => $ProductAttribute
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request,ProductAttribute $ProductAttribute) {
        $request->validate([
            'type' => 'required|string',
            'value' => 'required|string',
        ]);
        try {
            DB::transaction(function () use ($request,$ProductAttribute) {
                $ProductAttribute->update([
                    'name' => $request->type,
                    'value' => $request->value,
                ]);
        }); 
       return redirect()->route('product-attributes.index')->with('success','Product Attributes updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(ProductAttribute $ProductAttribute) 
    {
       
        try {
            DB::transaction(function () use ($ProductAttribute) {
            $ProductAttribute->delete();
        }); 
            return redirect()->route('product-attributes.index')->with('success','Product Attributes deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
}
