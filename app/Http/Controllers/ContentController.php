<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Drugstore, Medicine, Content};
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
 //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drugstore_id = Drugstore::find($id);
        $medicines = Medicine::all();

        return view('addmedicine',['drugstore_id'=> $drugstore_id, 'medicines'=> $medicines]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
     
        Content::create([
            'medicine_id'=>$request->medicine_id ,
            'drugstore_id'=>$id,
            'user_id'=>Auth::user()->id,
            'price'=> $request->price,
            'priceforml'=> (($request->price)/($request->amount)),
            'take_amount'=> 0,
            'amount'=> $request->amount,
            'validity_date'=> $request->validity_date

        ]);

        
   
        return redirect()->back()->with('message','Lek dodany do apteczki pomyślnie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::find($id);
        $content->user_id = Auth::user()->id;
        $content->delete();

        
        return redirect()->back()->with('message','Lek został zutylizowany');
    }

    public function showContent($id)
    {
        $drugstore_id = Drugstore::find($id);
        $contents = Content::where('drugstore_id', $id)->paginate(3);
   
        return view('index',compact('contents','drugstore_id'));
    }

    public function takeMedicine(Request $request, $id)
    {
        $content = Content::find($id);
        if($request->amount < $content->amount)
        {
            $content->amount =  ($content->amount) - ($request->amount) ; 
            $content->take_amount = $request->amount;
            $content->user_id = Auth::user()->id;
            $content->save();
            return redirect()->back()->with('message','Lek z apteczki został pobrany w ilości '.$request->amount. ' gram' );
        }
        else
        {
            return redirect()->back()->with('alert-message','Brak żądanej ilości w apteczce, maksymalnie możesz pobrać ' .$content->amount. ' gram' );
        }


        //dd($content->amount);
       
        //return($content);
       
    }
}
