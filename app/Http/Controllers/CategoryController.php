<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategories;
use DB;
use App\Helper\File;
class CategoryController extends Controller
{
    //
    use File;
    public function index()
    {
        try {
            $category = Categories::get();
        return view('category.index',['category'=>$category]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
        return view('category.create');
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
                $path = 'uploads/category';
                $image = $this->file($file,$path,150,150);
            }else{$image='defalut.jpg';}
          
        DB::transaction(function () use ($request,$image) {
            Categories::create([
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
    public function edit(Categories $category) 
    {
  
        try {
            return view('category.edit', [
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request,Categories $category) {

        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
        ]);
        try {
            if( $file = $request->file('image') ) {
                $path = 'uploads/category';
                $image = $this->file($file,$path,150,150);
            }else{$image=$category->image;}
            DB::transaction(function () use ($request,$category,$image) {
                $request['image']=$image;
                $category->update($request->all());
        }); 
       return redirect()->route('category.index')->with('success','Category updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(Categories $category) 
    {
       
        try {
            DB::transaction(function () use ($category) {
            $category->delete();
        }); 
            return redirect()->route('category.index')->with('success','Category deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
    public function getSubCategories(Request $request)
{
    $subcategories = SubCategories::where('categories_id', $request->category_id)->get();

    return response()->json([
        'subcategories' => $subcategories
    ]);
}
}
