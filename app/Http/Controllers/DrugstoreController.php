<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\{Drugstore, Content, User};
use Illuminate\Support\Facades\DB;
use App\Events\DrugstoreConfirmedEvent;

class DrugstoreController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        $newdrugstore = Drugstore::create([
            'name' => $request->name,
            'user_id'=> auth()->user()->id,
        ]);
       //event(new DrugstoreConfirmedEvent($newdrugstore));
        return redirect()->back()->with('message','Apteczka została utworzona');
        
    }

    public function show()
    {
    $drugstores = Drugstore::where('user_id',auth()->user()->id )->get();
    $user_id = Auth::user()->id;
    $user = User::find($user_id);

    $userdrugstores = $user->drugstores;


        return view('create', (['drugstores'=>$drugstores, 'userdrugstores'=>$userdrugstores]));
    }

    public function destroy($id)
    {
        $drugstore = Drugstore::find($id);
        $drugstore->delete();
        $content = Content::where('drugstore_id', $id);
        $content->delete();
        
        return redirect()->back()->with('message','Apteczka została usunięta pomyślnie');
    }

    public function addUser(Request $request, $id)
    {

        $drugstore = Drugstore::find($id);
       
        $user = User::where('email', $request->email)->first();
    
        //$user_id = $user->id;
        //$hasUser = $drugstore->users()->where('user_id',1)->get();
        
        if($user)
        {
            $hasUser = $drugstore->users()->where('user_id',$user->id)->first();
           // $ownerUser = $drugstore->user_id;
         
            if($hasUser==true || ($user->id == $drugstore->user_id) )
            {
                return redirect()->back()->with('alert-message','Wybrany użytkownik jest już przypisany do tej apteczki');
            }
            else {
                $drugstore->users()->attach($user);

                return redirect()->back()->with('message','Dodano nowego użytkownika do Twojej apteczki');
            }

        }
        else
        {
            return redirect()->back()->with('alert-message','Nie można dodać użytkownika do tej apteczki. Upewnij się czy dobrze wpisałeś (-aś)');
        }
          

    }

    public function showMsg()
    {
        $drugstores = Drugstore::where('user_id',auth()->user()->id )->get();

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $userdrugstores =  $user->drugstores;

      
       
        return view('components.message',compact('drugs','userdrugstores'));
           
    }

    public function users($id)
    {
        $drugstore = Drugstore::find($id);
        $users = $drugstore->users()->get();
        return view('users',compact('drugstore', 'users'));
    }

    
    public function destroyuser($drugstore_id, $user_id)
    {
        //Przy relacji wiele do wielu usuwa się poprzez detach() !!!
    

        $drugstore= Drugstore::find($drugstore_id);
        $drugstore->users()->detach($user_id);
        return redirect()->back()->with('message','Użytkownik został usunięty z Twojej apteczki');

    }

    public function destroyallusers($drugstore_id)
    {
        $drugstore= Drugstore::find($drugstore_id);
        $drugstore->users()->detach();
        return redirect()->back()->with('message','Użytkownik został usunięty z Twojej apteczki');
    }
}
