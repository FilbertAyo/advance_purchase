<?php

namespace App\Http\Controllers;

use App\Exports\StatementsExport;
use App\Models\Advance;
use App\Models\Application;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function statements(){

        $statements = Advance::with('application')->where('added_amount', '>', 0)->get();

        return view('reports.statement',compact('statements'));

    }
    public function outstanding(){

        $outstanding = Application::where('outstanding', '>', 0)->get();

        return view('reports.outstanding',compact('outstanding'));

    }

    public function paid(){

        $outstanding = Application::where('outstanding', 0)->get();

        return view('reports.paid',compact('outstanding'));

    }

    public function invoice(string $id){

        $application = Application::with('user.profile')->findOrFail($id);

        //retrive the records of advance from the database
        $advances = Advance::where('application_id', $application->id)->get();

        return view('reports.invoice', compact('application', 'advances'));

    }
  
}
