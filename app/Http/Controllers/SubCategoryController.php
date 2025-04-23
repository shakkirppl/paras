<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\SubCategories;
use DB;
use App\Helper\File;
class SubCategoryController extends Controller
{
    //
    use File;
    public function index()
    {
        try {
            $subCategory = SubCategories::with('category')->get();
        return view('sub-category.index',['subCategory'=>$subCategory]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
            $category = Categories::Active()->get();
        return view('sub-category.create',['category'=>$category]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(Request $request)
    {
        $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'status' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);
        try {
    
            if( $file = $request->file('image') ) {
                $path = 'uploads/subcategory';
                $image = $this->file($file,$path,600,600);
            }else{$image='defalut.jpg';}
        DB::transaction(function () use ($request,$image) {
        
            SubCategories::create([
                'code' => $request->code,
                'name' => $request->name,
                'image' => $image,
                'status' => $request->status,
                'categories_id'=>$request->categories_id,
            ]);
   
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(SubCategories $subCategory) 
    {
  
        try {
            $category = Categories::Active()->get();
            return view('sub-category.edit', [
                'category' => $category,
                'subCategory'=>$subCategory
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request, SubCategories $subCategory)
    {
        // Validate request inputs
        $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048' // Add validation for image
        ]);
    
        try {
            // Handle image upload if a new image is provided
            if ($file = $request->file('image')) {
                $path = 'uploads/subcategory';
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Move the uploaded file to the specified directory
                $file->move(public_path($path), $imageName);
    
                // If you want to resize the image, you can use the intervention/image package here
                // Example for resizing (optional): \Image::make($file)->resize(150, 150)->save(public_path("$path/$imageName"));
    
                $image = $imageName;
            } else {
                // Use the existing image if no new image is uploaded
                $image = $subCategory->image;
            }

            // Use a transaction to update the category safely
            DB::transaction(function () use ($request, $subCategory, $image) {
                // Explicitly set only the fields you want to update
                $subCategory->update([
                    'categories_id' => $request->categories_id,
                    'name' => $request->name,
                    'status' => $request->status,
                    'image' => $image, // Updated or existing image
                ]);
            });
    
            return redirect()->route('sub-category.index')->with('success', 'Sub-category updated successfully');
        } catch (\Exception $e) {
            // Optionally log the exception for debugging purposes
            \Log::error('Sub-category update failed: ' . $e->getMessage());
    
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update sub-category: ' . $e->getMessage());
        }
    }
    
    public function destroy(SubCategories $subCategory) 
    {
       
        try {
            DB::transaction(function () use ($subCategory) {
            $subCategory->delete();
        }); 
            return redirect()->route('sub-category.index')->with('success','Category deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
}
