<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductSku;
use App\Models\ProductImages;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helper\File;
use Intervention\Image\Facades\Image;
class ProductCreateApiController extends Controller
{
    //
    use File;
    public function categories(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Categories::Active()->get();
    
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
    public function sub_categories(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = SubCategories::Active()->where('categories_id',$request->categories_id)->get();
    
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

    public function brands(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = Brand::Active()->get();
    
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

    public function color_attributes(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = ProductAttribute::where('type','type')->get();
    
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

    public function size_attributes(Request $request)
    {
        try {
            // Fetch stores that are complete and active
            $results = ProductAttribute::where('type','size')->get();
    
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
    public function store(Request $request)
    {
        // return $request->all();
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'store_id' => 'required|exists:stores,id',
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
        if( $file = $request->file('image') ) {
            $path = 'uploads/products';
            $image = $this->file($file,$path,600,600);
        }else{$image='defalut.jpg';}
        try {
            DB::transaction(function () use ($request,$image,&$product) {
                $store = Store::find($request->store_id);
                $code = $store->code . rand(100000, 999999) . Product::count() + 1;

                $item_slug = preg_replace('~[^\pL\d]+~u', '-',$request->name);  
                $item_slug = iconv('utf-8', 'us-ascii//TRANSLIT', $item_slug);  
                $item_slug = preg_replace('~[^-\w]+~', '', $item_slug);
                $item_slug = trim($item_slug, '-');  
                $item_slug = preg_replace('~-+~', '-', $item_slug);  
                $item_slug = strtolower($item_slug);
                $itemcode = $code . rand(100000, 999999);
                $item_slug=$item_slug.$itemcode;
                
                $product = new Product();
                $product->product_code = $code;
                $product->name = $request->name;
                $product->product_slug=$item_slug;
                $product->description = $request->description;
                $product->brand_id = $request->brand_id;
                $product->category_id = $request->category_id;
                $product->sub_category_id = $request->sub_category_id;
                $product->store_id = $request->store_id;
                $product->user_id = $request->user_id;
                $product->productBaseUnitID=0;
                $product->save();
            });

            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $product,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create store: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for Internal Server Error
        }
    }
    public function productUnitStore(Request $request)
    {
        //    return $request->all();
        // Validation
        $validator = Validator::make($request->all(), [
            // 'product_id' => 'required|exists: products,id',
           'price' => 'required|numeric|min:0',
            'offer_price' => 'nullable|numeric|lt:price|min:0',
            'user_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:stores,id',   
            'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',// 2MB max file size
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

            // DB::transaction(function () use ($request,&$productSku) {
               

                // Check if a similar entry already exists for size and color attributes
$existingSku = ProductSku::where('product_id', $request->product_id)
->where('size_attributes_id', $request->size_attributes_id ?? 0)
->where('color_attributes_id', $request->color_attributes_id ?? 0)
->first();
// if ($request->hasFile('product_image')) {
//     $photos = $request->file('product_image'); // Array of images
//     $firstImage = ''; // To track the first image
//     foreach ($photos as $index => $photo) {
//         // Unique file name
//         $image = time() . '_' . $index . '.' . $photo->getClientOriginalExtension(); 
//         $destinationPath = 'uploads/products';
        
//         // Resize the image to 720x422
//         $thumb_img = Image::make($photo->getRealPath())->resize(720, 422);
//         $thumb_img->save($destinationPath . '/' . $image, 80);
        
//         // Store the first image to the ProductSku table
//         if ($index === 0) {
//             $firstImage = $image;
//         }

//         // Optionally, you can save all images to the ProductImages table if needed
//     }
// } else {
//     // Default image if no image is uploaded
//     $firstImage = 'default.jpg';
// }
if (!$existingSku) {
    // Handle auto-increment logic for productUnitID, if necessary
    $lastProductSku = ProductSku::latest()->first();
    $code = $lastProductSku ? $lastProductSku->productUnitID + 1 : 1;
    
    $productSku = new ProductSku();
    $productSku->productUnitID = $code;
    $productSku->product_id = $request->product_id;
    $productSku->size_attributes_id = $request->size_attributes_id ?? 0; // Add 0 if not provided
    $productSku->color_attributes_id = $request->color_attributes_id ?? 0; // Add 0 if not provided
    $productSku->sku = $request->sku;
    $productSku->price = $request->price;

    // Calculate offer price and discount percentage if not provided
    if ($request->offer_price && $request->price > $request->offer_price) {
        $productSku->offer_price = $request->offer_price;
        $productSku->descount_percentage = (($request->price - $request->offer_price) / $request->price) * 100;
    } else {
        $productSku->offer_price = $request->price; // No discount
        $productSku->descount_percentage = 0;
    }

    // Handle base unit logic
    $existingProductSkus = ProductSku::where('product_id', $request->product_id)->exists();

    // If no existing entries, set base_unit to 'yes', otherwise 'no'
    $productSku->base_unit = $existingProductSkus ? 'no' : 'yes';
    $productSku->store_id = $request->store_id;
    $productSku->user_id = $request->user_id;
    $productSku->save();

    // Update the product based on the SKU and unit settings
    $product = Product::find($request->product_id);
    if ($product) {
        if ($product->multi_unit === 'no') {
            $product->productBaseUnitID = $productSku->productUnitID;
        }
        $product->process_complete = 'yes';
        $product->save();
    }
  
    if ($request->hasFile('product_image')) {
        $photos = $request->file('product_image'); 
    $i = 0;
    foreach ($photos as $index => $photo) {
       
        $i++;
        $randomId = rand(1, 99999); // Generate a random ID
        $imageName = $randomId . $i . time() . '.' . $photo->getClientOriginalExtension();
        $destinationPath = 'uploads/products';

        // Resize the image to 720x422
        $thumb_img = Image::make($photo->getRealPath())->resize(720, 422);
        $thumb_img->save($destinationPath . '/' . $imageName, 80);
       
        if ($index === 0) {
            $firstImage = $imageName;
            $master=ProductSku::find($productSku->id);
            $master->image=$firstImage;
            $master->save();
           
           
        }
        $productImages = new ProductImages();
        $productImages->productUnitID = $productSku->productUnitID;
        $productImages->product_id = $request->product_id;
        $productImages->image = $imageName;
        $productImages->save();
    }
}
  
    
} else {
    // Handle case if SKU already exists (optional logic for duplicates)
    return response()->json(['error' => 'Duplicate SKU entry'], 409);
}

            // });

            if (!$productSku) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => $productSku,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create store: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for Internal Server Error
        }
    }
    
}
