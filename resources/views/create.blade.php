@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 ">
  
          @include('components.message')

            <div class="card">

                <div class="card-header"> 
                  <h3>Jesteś zalogowany jako: <strong>{{Auth::user()->name}}<strong></h3>
                   
                 </div>
                 <div class="card-header"> 
                 
                    <h3>Stwórz nową apteczkę </h3>
                 </div>
                 <div class="card-body">
                  
                  @if(Session::has('message'))
                  <div class="alert bg-success alert-success text-white" role="alert">
                      {{Session::get('message')}}
                  </div>
                  @elseif(Session::has('alert-message'))
                  <div class="alert bg-warning  text-white" role="alert">
                    {{Session::get('alert-message')}}
                </div>
              @endif
                 <form action="{{ route('create.drugstore')}}" method="post" >@csrf
                    <div class="form-group">
                      <label for="name">Nazwa apteczki</label>
                      <input type="text" class="form-control" name="name"  />
                    </div>
                    <button type="submit" class="btn btn-primary">Stwórz nową apteczkę</button>
                  </form>
                  <h5 class="card-title mt-4">Moje apteczki</h5>
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa apteczki</th>
                        <th scope="col">Data utworzenia</th>
                        <th scope="col">Akcje</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse($drugstores as $key=>$drugstore)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>{{$drugstore->name}}</td>
                          <td>{{$drugstore->created_at}}</td>
                          <td>
                            <form action="{{route('content.showcontent',[$drugstore->id])}}" method="get">@csrf
                               
                                <button class="btn btn-success">Pokaż zawartość</button>
                                
                            </form>
                            
                            </td>

                          <td>
                              <form action="{{route('content.show',[$drugstore->id])}}" method="get">@csrf
                               
                                <button class="btn btn-success"> Dodaj nowe leki</button>
                                
                            </form>
                          </td>
                          <td>
                            <form action="{{route('logs',[$drugstore->id])}}" method="get">@csrf
                             
                              <button class="btn btn-secondary">Historia</button>
                              
                          </form>
                        </td>
                        <td>
                                
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$drugstore->id}}">
                                    Dodaj nowego usera
                                </button>

                            
                        </td>
                          <td>
                            <form action="{{route('destroy.drugstore',[$drugstore->id])}}" method="post">@csrf
                               
                                <button class="btn btn-danger">Usuń apteczkę</button>
                                
                            </form>
                            
                        </td>
                        <td>
                          <form action="{{route('groups',[$drugstore->id])}}" method="get">@csrf
                             
                              <button class="btn btn-primary">Users</button>
                              
                          </form>
                          
                      </td>
                        @include('addusermodal')
                        </tr>
                        @empty
                        <td>Nie masz jeszcze swoich apteczek</td>
                        @endforelse

                        
                  
                      </tbody>

                  </table>
                 
                  <h5 class="card-title mt-4">Apteczki do których zostałeś dodany</h5>
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa apteczki</th>
                        <th scope="col">Data utworzenia</th>
                        <th scope="col">Akcje</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
            

                        
                       

                        @forelse($userdrugstores as $key=>$userdrugstore)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>{{$userdrugstore->name}}</td>
                          <td>{{$userdrugstore->created_at}}</td>
                          <td>
                            <form action="{{route('content.showcontent',[$userdrugstore->id])}}" method="get">@csrf
                               
                                <button class="btn btn-success">Pokaż zawartość</button>
                                
                            </form>
                            </td>
                          <td>
                              <form action="{{route('content.show',[$userdrugstore->id])}}" method="get">@csrf
                               
                                <button class="btn btn-success"> Dodaj nowe leki</button>
                                
                            </form>
                          </td>
                          <td>
                            <form action="{{route('logs',[$userdrugstore->id])}}" method="get">@csrf
                             
                              <button class="btn btn-secondary">Historia</button>
                              
                          </form>
                        </td>
                        <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$userdrugstore->id}}">
                                    Dodaj nowego usera
                                </button>    
                        </td>
                          <td>
                            <form action="{{route('destroy.drugstore',[$userdrugstore->id])}}" method="post">@csrf
                               
                                <button class="btn btn-danger">Usuń apteczkę</button>
                                
                            </form>
                            
                        </td>
                        @include('addusermodal2')
                        </tr>
                        @empty
                   
                        @endforelse
                      </tbody>

                  </table>
              
                  </div>
            
            </div>
        </div>
    </div>


    
</div>
@endsection
