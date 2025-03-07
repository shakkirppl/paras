<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Districts;
use App\Models\City;
use DB;

class CityController extends Controller
{
    //
    public function index()
    {
        try {
            $city = City::with('district')->get();
        return view('city.index',['city'=>$city]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
            $districts = Districts::get();
        return view('city.create',['district'=>$districts]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string',
        ]);
        try {
    
        DB::transaction(function () use ($request) {
        
            $city=new City;
            $city->name=$request->name;
            $city->distrct_id=$request->district_id;
            $city->save();
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(City $city) 
    {
  
        try {
            $districts = Districts::get();
            return view('city.edit', [
                'district' => $districts,
                'city'=>$city
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request, City $city)
    {
        // Validate request inputs
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
          
        ]);
    
        try {
            // Handle image upload if a new image is provided

            // Use a transaction to update the City safely
            DB::transaction(function () use ($request, $city) {
                // Explicitly set only the fields you want to update
                $city->update([
                    'distrct_id' => $request->district_id,
                    'name' => $request->name,
                   
                ]);
            });
    
            return redirect()->route('city.index')->with('success', 'City updated successfully');
        } catch (\Exception $e) {
            // Optionally log the exception for debugging purposes
            \Log::error('City update failed: ' . $e->getMessage());
    
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to update City: ' . $e->getMessage());
        }
    }
    
    public function destroy(City $city) 
    {
       
        try {
            DB::transaction(function () use ($city) {
            $city->delete();
        }); 
            return redirect()->route('city.index')->with('success','City deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
}
