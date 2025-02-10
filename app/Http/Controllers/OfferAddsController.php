<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfferAdds;
use App\Models\OfferAddsDetails;
use App\Models\Store;
use App\Models\Product;
use App\Models\OfferCategory;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\ProductAttribute;
use App\Models\AdditionalImage;
use Illuminate\Support\Facades\Validator;
use App\Helper\File;
use Intervention\Image\Facades\Image;
use DB;
class OfferAddsController extends Controller
{
    use File;
    //
    public function index()
    {
        $offerAdds = OfferAdds::with('category','store')->where('status','active')->get();
        return view('offer-adds.index', compact('offerAdds'));
    }

    /**
     * Show the form for creating a new resource.   

     */
    
    public function offer_adds_store(Request $request)
{
    $masterId = $request->master_id;
    $selectedProducts = $request->input('products', []);
    $offerAdds=OfferAdds::find($masterId);
    foreach ($selectedProducts as $productId) {
        $Product=Product::find($productId);
        $Product->offer_adds_id=$offerAdds->offer_categories_id;
        $Product->offer='yes';
        $Product->save();
        OfferAddsDetails::create([
            'master_id' => $masterId,
            'product_id' => $productId,
            
        ]);
    }

    return redirect()->back()->with('success', 'Products added successfully to the offer!');
}
    public function create()
    {
        $category=OfferCategory::get();
        $store=Store::get();
        return view('offer-adds.create', compact('category','store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        // Validate incoming request data
        $request->validate([
            'offer_categories_id' => 'required|exists:offer_categories,id',
            'store_id' => 'required|exists:stores,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Default image if no image provided
        $defaultImage = 'default.jpg';
    
        try {
            // Start the transaction
            DB::beginTransaction();
    
            // Handle image upload
            $image = $defaultImage;
            if ($file = $request->file('image')) {
                $path = 'uploads/offer-adds';
                $image = $this->file($file, $path, 150, 150); // Assuming `file` is a custom method for handling uploads
            }
    
            // Create a new instance of the model and save
            $offerAdd = OfferAdds::create([
                'offer_categories_id' => $request->offer_categories_id,
                'description' => $request->description,
                'store_id'=>$request->store_id,
                'image' => $image,
                'offer_adds_type'=>$request->offer_adds_type
            ]);
    
            if ($request->hasFile('additional_image')) {
                foreach ($request->file('additional_image') as $image) {
                    $path = 'uploads/offer-adds';
                    $imageName = $this->file($image, $path, 150, 150);
        
                    // Save to database if needed
                     $additionalImage=new AdditionalImage;
                     $additionalImage->offers_id=$offerAdd->id;
                     $additionalImage->store_id=$request->store_id;
                     $additionalImage->image=$imageName;
                     $additionalImage->save();
                }
            }
        
            // Debugging: Check if the record was created
            if (!$offerAdd) {
                throw new \Exception('Offer creation failed.');
            }
    
            // Commit the transaction
            DB::commit();
    
            // Redirect with success message
            return redirect()->route('offer-adds.index')->with('success', 'Offer created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
    
            // Log the exception for debugging
            \Log::error('Offer creation failed: ' . $e->getMessage());
    
            // Redirect back with error message and input data
            return redirect()->back()->with('error', 'Failed to create Offer: ' . $e->getMessage())->withInput();
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $offerAdds = OfferAdds::find($id);
        $OfferAddsDetails=OfferAddsDetails::with('product')->where('master_id',$id)->get();
        $additionalImage=AdditionalImage::where('offers_id',$id)->get();
        return view('offer-adds.view', compact('OfferAddsDetails','offerAdds','additionalImage'));
    }

    /**
     * Show the form for editing the specified resource.   

     */
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        try {
            DB::transaction(function () use ($request, $coupon) {
                $validatedData = $request->validate([
                    'code' => 'nullable|string',
                    'name' => 'nullable|string',
                    'amount' => 'required|numeric|min:0',
                    'point' => 'required|integer|min:0',
                ]);

                $coupon->update($validatedData);
            });

            return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update coupon. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        try {
            DB::transaction(function () use ($coupon) {
                $coupon->delete();
            });

            return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete coupon. Please try again.']);
        }
    }
}
