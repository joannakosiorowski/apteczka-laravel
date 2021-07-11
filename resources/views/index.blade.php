@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> 
                    Zawartość apteczki {{$drugstore_id->name}} 
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
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa leku</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Data ważności</th>
                        <th scope="col">Akcje</th>
                        <th scope="col"></th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($contents as $key=>$content)
          
                      <tr>
                       
                        <td scope="row">{{$key+1}}</td>
                        <td>{{$content->medicine->name}}</td>
                        <td>{{$content->price}}</td>
                        <td>{{$content->amount}}</td>
                        <td>{{$content->validity_date}}</td>
                        @if($content->validity_date <= now())
                        
                          <td>
                            <button type="button" class="btn btn-secondary disabled" data-toggle="tooltip" data-placement="top" title="Lek przeterminowany">
                             Pobierz lek
                            </button>
                         </td>
                        
                         @else 
                         
                          <td>
                            <button data-toggle="modal" data-target="#exampleModal{{$content->id}}" class="btn btn-primary">Pobierz lek </button>
                         </td>
                         
                         @endif

                      <td>
                        <form action="{{route('content.destroy',[$content->id])}}" method="POST">@csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Zutylizuj lek </button>
                          
                      </form>
                    </td>
     
                      </tr>
                      @include('takemedicinemodal') 
                      @endforeach
                    
                    </tbody>
                  </table>
             {{$contents->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
