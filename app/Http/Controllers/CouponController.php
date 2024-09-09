<?php

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.   

     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.   

     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $validatedData  = $request->validate([
                    'code' => 'nullable|string',
                    'name' => 'nullable|string',
                    'amount' => 'required|numeric|min:0',
                    'point' => 'required|integer|min:0',
                ]);

                Coupon::create($validatedData);
            });

            return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create coupon. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view('coupons.show', compact('coupon'));
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