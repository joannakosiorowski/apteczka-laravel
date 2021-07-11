<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Log,Drugstore};
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index($id)
    {
        $drugstore = Drugstore::find($id);
        $logs = Log::where('drugstore_id', $id)->get();
        return view('logs', compact('logs', 'drugstore'));
    }

 

    public function showReport(Request $request)
    {
        $request->flash(); 

        $user = auth()->user() ;

        $drugstores = $user->drugstores;

        $fromdate = $request->input('fromdate');
        $uptodate = $request->input('uptodate');
    if(!isset($fromdate)||!isset($uptodate))
    {
        $records = Log::where('drugstore_id',$request->drugstore)->where('created_at', $fromdate)->where('created_at', $uptodate)->get();
        return view('raports', compact( 'drugstores', 'records'));
    }
    else {
        $records = Log::where('drugstore_id',$request->drugstore)->where('created_at','>=', $fromdate)->where('created_at','<=', $uptodate)->get();
        return view('raports', compact( 'drugstores', 'records'));
    }
       
       
    }
}
