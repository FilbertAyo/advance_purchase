<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\City;
use App\Models\District;
use App\Models\Region;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10); // default to 10

        $query = User::where('status', 'active')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'customer');
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('userId', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate($perPage)->appends(['search' => $search, 'perPage' => $perPage]);

        return view('users.new_customer', compact('users', 'search', 'perPage'));
    }

    public function unverifiedCustomer()
    {
        $cities =  City::all();
        $districts = District::all();
        $wards = Ward::all();

        $user = User::where('status', 'inactive')->whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->with('profile')->with('profile.ward', 'profile.district', 'profile.city')->get();

        return view('users.unverified_customer', compact('user', 'cities', 'districts', 'wards'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        // Retrieve applications that belong to this user
        $applications = Application::where('customer_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('users.view_customer', compact('user', 'applications'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();
        return redirect()->route('customer.show', $id)->with('success', 'Customer registered and verified successfully.');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }
}
