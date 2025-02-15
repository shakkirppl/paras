<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\TempProduct;
use App\Models\Product;
use App\Models\TempProductSku;
use App\Models\TempProductImages;
use App\Models\ProductAttribute;
use App\Models\OfferAdds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\File;
use Intervention\Image\Facades\Image;
use DB;
class ProductController extends Controller
{
    use File;
     // Function to show the product creation form
     public function temp_products(Request $request)
     { 
        try {
            $results = TempProduct::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
            ->with('category','subCategory','brand','skusBase')->where('name', 'like','%'. $request->name . '%')->get();
            
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
     public function temp_category_products(Request $request)
     { 
        try {
            $results = TempProduct::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
            ->with('category','subCategory','brand','skusBase')->where('name', 'like','%'. $request->name . '%')->where('category_id',$request->category_id)->get();
            
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
     public function temp_subcategory_products(Request $request)
     { 
        try {
            $results = TempProduct::select('id','name','product_code','model','brand_id','category_id','sub_category_id')
            ->with('category','subCategory','brand','skusBase')->where('name', 'like','%'. $request->name . '%')->where('sub_category_id',$request->sub_category_id)->get();
            
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
     public function selected_temp_products(Request $request)
     { 
        
        try {
            $results = TempProduct::with('category','subCategory','brand','skusBase')->find($request->id);
            $skus=TempProductSku::with('size','color','images')->where('product_id',$results->id)->get();
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
     
     public function index(Request $request)
     { 
        $products=TempProduct::with('category','subCategory','brand')->get();
         return view('products.index', compact('products'));
     }
    // Function to show the product creation form
    public function create(Request $request)
    {
        // Fetch Brands and Categories for dropdowns
        $brands = Brand::orderBy('name', 'asc')->get(); 
        $categories = Categories::orderBy('name', 'asc')->get();

        $color = ProductAttribute::where('type','color')->orderBy('value', 'asc')->get(); 
        $size = ProductAttribute::where('type','size')->orderBy('value', 'asc')->get(); 
    
        return view('products.create', compact('brands', 'categories','color','size'));
    }

    // Function to store the product
    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'single_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,jfif,svg|max:2048',
         
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
        DB::transaction(function () use ($request) {
            $code = 'PRD' . rand(100000, 999999) . TempProduct::count() + 1;

            $item_slug = preg_replace('~[^\pL\d]+~u', '-',$request->name);  
            $item_slug = iconv('utf-8', 'us-ascii//TRANSLIT', $item_slug);  
            $item_slug = preg_replace('~[^-\w]+~', '', $item_slug);
            $item_slug = trim($item_slug, '-');  
            $item_slug = preg_replace('~-+~', '-', $item_slug);  
            $item_slug = strtolower($item_slug);
            $item_slug=$item_slug.$code;

        $product = TempProduct::create([
            'name' => $request->name,
            'product_code' => $code,
            'product_slug' => $item_slug,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id,
            'description' => $request->description,
            'summary' => $request->summary,
            'model' => $request->model,
            
        ]);

        if ($request->hasFile('single_image')) {
            $file = $request->file('single_image');
            $path = 'uploads/products';
            $singleImageName = $this->file($file,$path,150,150);
        }
        $productSku = TempProductSku::create([
            'product_id' => $product->id,
            'size_attributes_id' => $request->size_attributes_id,
            'color_attributes_id' => $request->color_attributes_id,
            'sku' => $request->sku,
            'image' => $singleImageName,
            'base_unit' => 'Yes',
        ]);
        TempProductImages::create([
            'product_id' => $product->id,
            'product_sku_id'=>$productSku->id,
            'image' => $singleImageName,
        ]);
         // Handle multiple images
    $multipleImages = [];
    if ($request->hasFile('multiple_images')) {
        foreach ($request->file('multiple_images') as $image) {
            $file =  $image;
            $path = 'uploads/products';
            $imageName = $this->file($file,$path,150,150);
            $multipleImages[] = $imageName;
        }
    }

    foreach ($multipleImages as $img) {
        TempProductImages::create([
            'product_id' => $product->id,
            'product_sku_id'=>$productSku->id,
            'image' => $img,
        ]);
    }
    }); 
        // Additional SKU Creation Logic

        return back()->with('success', 'Product Created Successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }

    public function storeSku(Request $request)
    {
        //  return $request->all();
        $validator = Validator::make($request->all(), [
            // 'sku' => 'required|string|unique:temp_product_skus,sku',
            'product_id' => 'required|exists:temp_products,id',
            'size_attributes_id' => 'required',
            'color_attributes_id' => 'required',
            // 'single_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,jfif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::transaction(function () use ($request) {
            if($request->if_image){
        if ($request->hasFile('single_image')) {
            $file = $request->file('single_image');
            $path = 'uploads/products';
            $singleImageName = $this->file($file,$path,150,150);
        }
        }
        else{
            $products=TempProductSku::where('base_unit','Yes')->where('product_id',$request->product_id)->first();
            $singleImageName = $products->image;
        }
        $productSku = TempProductSku::create([
            'product_id' => $request->product_id,
            'size_attributes_id' => $request->size_attributes_id,
            'color_attributes_id' => $request->color_attributes_id,
            'sku' => $request->sku,
            'image' => $singleImageName,
            'base_unit' => 'No',
        ]);
        TempProductImages::create([
            'product_id' => $request->product_id,
            'product_sku_id'=>$productSku->id,
            'image' => $singleImageName,
        ]);
         // Handle multiple images
    $multipleImages = [];
    if ($request->hasFile('multiple_images')) {
        foreach ($request->file('multiple_images') as $image) {
            $file =  $image;
            $path = 'uploads/products';
            $imageName = $this->file($file,$path,150,150);
            $multipleImages[] = $imageName;
        }
    }

    foreach ($multipleImages as $img) {
        TempProductImages::create([
            'product_id' => $request->product_id,
            'product_sku_id'=>$productSku->id,
            'image' => $img,
        ]);
    }
}); 
        // Handle Images
        return back()->with('success', 'Product Created Successfully');
    }
    public function updateImages(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:temp_product_skus,id',
        ]);
        if ($request->hasFile('single_image')) {
            $request->validate([
                'single_image' => 'image|mimes:jpeg,png,jpg,gif,webp,jfif,svg|max:2048',
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::transaction(function () use ($request) {
            $productSku = TempProductSku::find($request->product_id);
        if ($request->hasFile('single_image')) {
            $file = $request->file('single_image');
            $path = 'uploads/products';
            $singleImageName = $this->file($file,$path,150,150);
            $productSku->image=$singleImageName;
            $productSku->save();
            TempProductImages::create([
                'product_id' => $productSku->product_id,
                'product_sku_id'=>$productSku->id,
                'image' => $singleImageName,
            ]);
        }
       
      
         // Handle multiple images
    $multipleImages = [];
    if ($request->hasFile('multiple_images')) {
        foreach ($request->file('multiple_images') as $image) {
            $file =  $image;
            $path = 'uploads/products';
            $imageName = $this->file($file,$path,150,150);
            $multipleImages[] = $imageName;
        }
    }

    foreach ($multipleImages as $img) {
        TempProductImages::create([
            'product_id' => $productSku->product_id,
            'product_sku_id'=>$productSku->id,
            'image' => $img,
        ]);
    }
}); 
        // Handle Images
        return back()->with('success', 'Product Created Successfully');
    }
    
    private function storeImages(Request $request, Product $product, ProductSku $productSku)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                ProductImage::create([
                    'productUnitID' => $productSku->productUnitID,
                    'product_id' => $product->id,
                    'image' => $image->store('products', 'public'),
                ]);
            }
        }
    }
    public function show($id)
    {
        $products=TempProduct::find($id);
        $productSku = TempProductSku::with(['color', 'size'])->where('product_id', $id)->get();
        return view('products.view', compact('products','productSku'));
    }
    public function image($id)
    {
        $productSku = TempProductSku::find($id);
        $productImage=TempProductImages::where('product_sku_id',$id)->get();
        return view('products.addon-images', compact('productSku','productImage'));
    }
    public function deleteImage($id)
    {
       
        $productImage=TempProductImages::find($id);
        $productImage->delete();
        return back();
    }
    public function deleteMainImage($id)
    {
       
        $productImage=TempProductImages::find($id);
        $productImage->delete();
        return back();
    }
    
    public function addon($id)
    {
        $products=TempProduct::find($id);
        $color = ProductAttribute::where('type','color')->orderBy('value', 'asc')->get(); 
        $size = ProductAttribute::where('type','size')->orderBy('value', 'asc')->get(); 
        return view('products.addon', compact('products','color','size'));
    }
    public function destroySku($id) 
    {
        try {
            // Find the SKU record by its ID
            $tempProductSku = TempProductSku::findOrFail($id);
    
            // Wrap in a transaction to ensure atomicity
            DB::transaction(function () use ($tempProductSku) {
                $tempProductSku->delete();
            }); 
    
            return back()->with('success', 'SKU deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete SKU: ' . $e->getMessage());
        }
    }
    
    public function updateProduct(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
           'product_id' => 'required|exists:temp_products,id',
         
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
        DB::transaction(function () use ($request) {
    
            $product = TempProduct::find($request->product_id);
            $item_slug = preg_replace('~[^\pL\d]+~u', '-',$request->name);  
            $item_slug = iconv('utf-8', 'us-ascii//TRANSLIT', $item_slug);  
            $item_slug = preg_replace('~[^-\w]+~', '', $item_slug);
            $item_slug = trim($item_slug, '-');  
            $item_slug = preg_replace('~-+~', '-', $item_slug);  
            $item_slug = strtolower($item_slug);
            $item_slug=$item_slug.$product->product_code;

            $product->name = $request->name;
            $product->product_slug = $item_slug;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->subcategory_id;
            $product->description = $request->description;
            $product->summary = $request->summary;
            $product->model = $request->model;
            $product->save();
    }); 
        // Additional SKU Creation Logic

        return back()->with('success', 'Product Updated Successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }

    /**
     * Show the form for editing the specified resource.   

     */
    public function edit($id)
    {
        $brands = Brand::all(); 
        $categories = Categories::all();
        $products=TempProduct::find($id);
        $subCategories = SubCategories::where('categories_id',$products->category_id)->get();
        
       
        return view('products.edit', compact('products','brands','categories','subCategories'));
    }

    public function getSubCategories(Request $request)
{
    $subCategories = SubCategories::where('categories_id', $request->category_id)->get();
    return response()->json(['subcategories' => $subCategories]);
}

public function getProductsBySubCategory(Request $request)
{
    $masterId=$request->master_id;
    $OfferAdds=OfferAdds::find($masterId);
    $products = Product::where('sub_category_id', $request->sub_category_id)->where('store_id',$OfferAdds->store_id)->get();
    $html = view('offer-adds.product-list', compact('products','OfferAdds'))->render();
    return response()->json(['html' => $html]);
}


}
