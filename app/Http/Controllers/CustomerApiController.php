<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
class CustomerApiController extends Controller
{
    //
    public function customer_store(Request $request)
    {
        // return $request->all();
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'mobile' => ['required', 'string',  'max:255', 'unique:'.Customers::class,'regex:/^[6-9]\d{9}$/'],
            'password' => 'required|string|min:4',
            'gender'=> 'required|string'
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
            DB::transaction(function () use ($request,&$customers, &$token) {
                $customers = new Customers();
                $customers->name = $request->name;
                $customers->email = $request->email;
                $customers->mobile = $request->mobile;
                $customers->password = $request->password;
                $customers->gender=$request->gender;
                $customers->save();

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'gender'=>$request->gender,
                    'user_rol_id' => 5,
                    'store_id' => -1,
                ]);    
                  // Generate authentication token
            $token = $user->createToken('api_token')->plainTextToken;    
            });

            if (!$customers) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $customers,
                'token' => $token, // Return the generated token
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create store: ' . $e->getMessage(),
            ], 500); // 500 is the HTTP status code for Internal Server Error
        }
    }

}
