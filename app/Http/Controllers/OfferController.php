<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
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
class OfferController extends Controller
{
    use File;
    //
    public function index_active()
    {
        $offer = Offer::with('adstore')->where('status','active')->get();
        return view('offer.active', compact('offer'));
    }

    public function index_inactive()
    {
        $offer = Offer::with('adstore')->where('status','inactive')->get();
        return view('offer.inactive', compact('offer'));
    }

    public function to_active($id)
    {
        $offer = Offer::find($id);
        $offer->status='active';
        $offer->verified='yes';
        $offer->save();
        return back();
    }

    public function to_inactive($id)
    {
        $offer = Offer::find($id);
        $offer->status='inactive';
        $offer->save();
        return back();
    }

    public function to_delete($id)
    {
        $offer = Offer::find($id);
        $offer->delete();
        return back();
    }
 
}
