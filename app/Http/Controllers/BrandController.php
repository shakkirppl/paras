<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use DB;
use App\Helper\File;
class BrandController extends Controller
{
    //
    use File;
    public function index()
    {
        try {
            $brand = Brand::get();
        return view('brand.index',['brand'=>$brand]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
        return view('brand.create');
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);
        try {
     
            if( $file = $request->file('image') ) {
                $path = 'uploads/brand';
                $image = $this->file($file,$path,150,150);
            }else{$image='defalut.jpg';}
        DB::transaction(function () use ($request,$image) {
            Brand::create([
                'code' => $request->code,
                'name' => $request->name,
                'image' => $image,
                'status' => $request->status,
            ]);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(Brand $brand) 
    {
  
        try {
            return view('brand.edit', [
                'brand' => $brand
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request,Brand $brand) {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
        ]);
        try {
            if( $file = $request->file('image') ) {
                $path = 'uploads/brand';
                $image = $this->file($file,$path,150,150);
            }else{$image=$brand->image;}
            DB::transaction(function () use ($request,$brand,$image) {
                $brand->update([
                    'name' => $request->name,
                    'status' => $request->status,
                    'image' => $image, // Updated or existing image
                ]);
        }); 
       return redirect()->route('brand.index')->with('success','Brand updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(Brand $brand) 
    {
       
        try {
            DB::transaction(function () use ($brand) {
            $brand->delete();
        }); 
            return redirect()->route('brand.index')->with('success','Brand deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
}
