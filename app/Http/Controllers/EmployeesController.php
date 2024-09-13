<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staffs;
use App\Models\Districts;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class EmployeesController extends Controller
{
    //
     /**
     * Display a listing of the store types.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staffs::paginate(10); // Paginate results
        return view('employees.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new store type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts=Districts::get();
        return view('employees.create', compact('districts'));
    }

    /**
     * Store a newly created store type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:staffs,code',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:staffs,username',
            'password' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request) {
                $staffs = new Staffs();
                $staffs->code = $request->code;
                $staffs->name = $request->name;
                $staffs->address = $request->address;
                $staffs->email = $request->email;
                $staffs->contact_no = $request->contact_no;
                $staffs->whatsapp_no = $request->whatsapp_no;
                $staffs->username = $request->username;
                $staffs->password = $request->password;
                $staffs->description = $request->description;
                $staffs->date_of_joining = $request->date_of_joining;
                $staffs->districts_id = $request->districts_id;
                $staffs->user_rol_id = 3;
                $staffs->save();

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->username,
                    'password' => Hash::make($request->password),
                    'user_rol_id' => 3,
                ]);        


            });

            return redirect()->route('employees.index')->with('success', 'Employees created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Employees: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified store type.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staffs = Staffs::findOrFail($id);
        return view('employees.edit', compact('staffs'));
    }

    /**
     * Update the specified store type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:staffs,code,' . $id,
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Transaction with Try-Catch
        try {
            DB::transaction(function () use ($request, $id) {
                $staffs = Staffs::findOrFail($id);
                $staffs->name = $request->name;
                $staffs->address = $request->address;
                $staffs->email = $request->email;
                $staffs->staffs = $request->contact_no;
                $staffs->whatsapp_no = $request->whatsapp_no;
                $staffs->username = $request->username;
                $staffs->password = $request->password;
                $staffs->description = $request->description;
                $staffs->date_of_joining = $request->date_of_joining;
                $staffs->districts_id = $request->districts_id;
                $staffs->save();
            });

            return redirect()->route('employees.index')->with('success', 'Employees updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update employees: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified store type from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $staffs = Staffs::findOrFail($id);
                $staffs->delete();
            });

            return redirect()->route('employees.index')->with('success', 'Employees deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete employees: ' . $e->getMessage());
        }
    }
}
