<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\District;
use App\Models\Region;
use App\Models\Ward;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $city = City::all();

        return view('settings.address',compact('city'));
    }

    public function regions(){
        $city = City::all();
        $regions = Region::all();

        return view('settings.regions', compact('regions','city'));
    }

    public function wards(){
        $regions = Region::all();
        $wards = Ward::all();

        return view('settings.wards', compact('regions','wards'));
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
        City::create($request->all());
        return redirect()->back()->with('success', 'New city added successfully');
    }

    public function regionStore(Request $request){

        Region::create($request->all());
        return redirect()->back()->with('success', 'New region added successfully');
    }

    public function wardStore(Request $request){

        Ward::create($request->all());
        return redirect()->back()->with('success', 'New ward added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $city = City::find($id);
        $city->update($request->all());
        return redirect()->back()->with('success', 'City updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return redirect()->back()->with('success', 'City deleted successfully');
    }

    public function regionDestroy(string $id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect()->back()->with('success', 'Region deleted successfully');
    }
    public function wardDestroy(string $id){
        $ward = Ward::findOrFail($id);
        $ward->delete();
        return redirect()->back()->with('success', 'Ward deleted successfully');
    }
}
