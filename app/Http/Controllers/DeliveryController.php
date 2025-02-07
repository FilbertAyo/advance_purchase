<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function allDelivery(){

        $application = Application::orderBy('id', 'desc')->where('status','active')->get();

        // $user = User::where('userType', 0)->get();
        // $items = Item::all();
        return view('delivery.all',compact('application'));
    }
    public function deliveryUpdate(Request $request, $id)
    {

        $application = Application::findOrFail($id);

        // Update the serial number
        $application->delivery_status = 'delivered';
        $application->save();

        return redirect()->route('application.show', $id)->with('success', 'Application Delivery Status of this application updated successfully.');
    }

    public function delivered()
    {
        $application = Application::orderBy('id', 'desc')->where('status', 'active')->where('delivery_status','delivered')->get();

        // $user = User::where('userType', 0)->get();
        // $items = Item::all();
        return view('delivery.delivered', compact('application'));
    }
    public function deliveryPending()
    {
        $application = Application::orderBy('id', 'desc')->where('status', 'active')->where('delivery_status','Not Delivered')->get();

        // $user = User::where('userType', 0)->get();
        // $items = Item::all();
        return view('delivery.pending', compact('application'));
    }


}
