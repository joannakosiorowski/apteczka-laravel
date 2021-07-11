@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> 
                Użytkownicy apteczki: {{$drugstore->name}} 
                 </div>
                <div class="card-body">
                  @if(Session::has('message'))
                  <div class="alert bg-success alert-success text-white" role="alert">
                      {{Session::get('message')}}
                  </div>

              @endif
   
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">Użytkownicy</th>
                        <th scope="col">Akcja</th>


                      </tr>
                    </thead>
                    <tbody>
            
                            @foreach($users as $user)
                            
                            <tr> 
                              <td>{{$user->name}}</td>
                              <td>
                                <form action="{{route('destroy.user',['drugstore_id'=>$drugstore->id , 'user_id'=>$user->id])}}" method="post">@csrf
                     
                                    <button class="btn btn-danger">Usuń usera</button>
                                    
                                </form>
                                
                            </td>
                            </tr>
                    
                            @endforeach
                   
                    </tbody>
                  </table>
                  <form action="{{route('destroy.usergroup',['drugstore_id'=>$drugstore->id ])}}" method="post">@csrf
                     
                    <button class="btn btn-danger">Usuń grupę</button>
                    
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
