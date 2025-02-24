<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\TempProduct;
use App\Models\TempProductSku;
use App\Models\TempProductImages;
use App\Models\ProductImages;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\File;
use Intervention\Image\Facades\Image;
use DB;

class StoreProductController extends Controller
{
    //
    public function add_new_product(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:temp_products,id',
            'product_sku_id.*' => 'required|exists:temp_product_skus,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
        // DB::transaction(function () use ($request,&$product) {
            $tempProduct=TempProduct::find($request->product_id);
            // $code = 'PRD' . rand(100000, 999999) . Product::count() + 1;
            $product = new Product();
            $product->product_code = $tempProduct->product_code;
            $product->name = $tempProduct->name;
            $product->product_slug=$tempProduct->product_slug;
            $product->description = $tempProduct->description;
            $product->brand_id = $tempProduct->brand_id;
            $product->category_id = $tempProduct->category_id;
            $product->sub_category_id = $tempProduct->sub_category_id;
            $product->store_id = $request->store_id;
            $product->user_id = $request->user_id;
            $product->productBaseUnitID=0;
            $product->save();
            foreach($request->input('product_sku_id') as $key=>$val)
            {
            $tempProductSku=TempProductSku::find($val);
            $lastProductSku = ProductSku::latest()->first();
            $code = $lastProductSku ? $lastProductSku->productUnitID + 1 : 1;
            $productSku = new ProductSku();
            $productSku->productUnitID = $code;
            $productSku->product_id = $product->id;
            $productSku->size_attributes_id = $tempProductSku->size_attributes_id ?? 0; // Add 0 if not provided
            $productSku->color_attributes_id = $tempProductSku->color_attributes_id ?? 0; // Add 0 if not provided
            $productSku->sku = $tempProductSku->sku;
            $price=$request->input('price')[$key];
            $offer_price=$request->input('offer_price')[$key];
            $productSku->price = $price;
            if ($offer_price && $price > $offer_price) {
                $productSku->offer_price = $offer_price;
                $productSku->descount_percentage = (($price - $offer_price) / $price) * 100;
            } else {
                $productSku->offer_price = $price; // No discount
                $productSku->descount_percentage = 0;
            }
            $productSku->base_unit = $request->input('base_unit')[$key];
            $productSku->image = $tempProductSku->image;
            $productSku->store_id = $request->store_id;
            $productSku->user_id = $request->user_id;
            $productSku->save();
            $tempProductImages=TempProductImages::where('product_sku_id',$tempProductSku->id)->where('product_id',$tempProduct->id)->get();
           foreach($tempProductImages as $productImage)
           {
            ProductImages::create([
                'product_id' => $product->id,
                'productUnitID'=>$productSku->id,
                'image' => $productImage->image,
            ]);
           }
            }
         // Handle multiple images

    // }); 
    if($product){ 
        return response()->json(['data'=>$product,'success'=>true,'messages'=>['Data Inserted']]);
    }
    else{
        return response()->json(['data'=>[],'success'=>false,'messages'=>['No data Inserted']]);
} 
        // Additional SKU Creation Logic

       
    } catch (\Exception $e) {
        return response()->json(['data'=>[],'success'=>false,'messages'=>['error']]);
      }    
    }

    public function storeSku(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'sku' => 'required|string|unique:temp_product_skus,sku',
            'product_id' => 'required|exists:temp_products,id',
            'size_attributes_id' => 'required',
            'color_attributes_id' => 'required',
            'single_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,jfif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::transaction(function () use ($request) {
        if ($request->hasFile('single_image')) {
            $file = $request->file('single_image');
            $path = 'uploads/products';
            $singleImageName = $this->file($file,$path,300,300);
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
            $imageName = $this->file($file,$path,300,300);
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
    }
}
