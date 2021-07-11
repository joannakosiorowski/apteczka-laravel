<?php

namespace App\Http\Controllers;

use App\{Drugstore, Medicine, Content};
use Illuminate\Http\Request;


class ContentController extends Controller
{
    public function create($id)
    {
        $drugstore_id = Drugstore::find($id);
        $medicines = Medicine::all();
       
        return view('addmedicine',['drugstore_id'=> $drugstore_id, 'medicines'=> $medicines]);
   
    }

    public function addMedicine(Request $request, $id)
    {

        Content::create([
            'medicine_id'=>$request->medicine_id ,
            'drugstore_id'=>$id,
            'price'=> $request->price,
            'amount'=> $request->amount,
            'validity_date'=> $request->validity_date

        ]);
        
   
        return redirect()->back()->with('message','Lek dodany do apteczki pomyślnie');
    }
}
