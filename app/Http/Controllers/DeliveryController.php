<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function delivery($filter = null)
    {
        $query = Application::orderBy('id', 'desc')
            ->where('status', 'active')
            ->where('outstanding', 0);

        if ($filter === 'delivered') {
            $query->where('delivery_status', 'delivered');
        } elseif ($filter === 'pending') {
            $query->where('delivery_status', 'Not Delivered');
        }

        $application = $query->get();

        return view('delivery.all', compact('application', 'filter'));
    }

    public function deliveryUpdate(Request $request, $id)
    {

        $application = Application::findOrFail($id);

        // Update the serial number
        $application->delivery_status = 'delivered';
        $application->save();

        return redirect()->route('application.show', $id)->with('success', 'Application Delivery Status of this application updated successfully.');
    }


}
