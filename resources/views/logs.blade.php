@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> 
                    Zawartość apteczki: NAZWA {{$drugstore->name}} 
                 </div>
                <div class="card-body">
                  @if(Session::has('message'))
                  <div class="alert bg-success alert-success text-white" role="alert">
                      {{Session::get('message')}}
                  </div>

              @endif
              <h1>Leki wydane do użycia</h1>
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa leku</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Data ważności</th>
                        <th scope="col">Ilość wydana</th>
                        <th scope="col">Użytkownik</th>
                        <th scope="col">Data i godzina wydania</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($logs as $key=>$log)
                      @if($log->action=="Updated")
                      <tr> 
                        <td scope="row">{{$key+1}}</td>
                        <td>{{$log->medicine->name}}</td>
                        <td>{{$log->price}}</td>
                        <td>{{$log->validity_date}}</td>
                        <td>{{$log->take_amount}}</td>
                        <td>{{$log->user->name}}</td>
                        <td>{{$log->created_at}}</td>
            
              
                      </tr>
                  @endif
                      @endforeach
                    </tbody>
                  </table>

                  <h1>Utylizacje</h1>
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa leku</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Data ważności</th>
                        <th scope="col">Ilość zutylizowana</th>
                        <th scope="col">Użytkownik</th>
                        <th scope="col">Data i godzina utylizacji</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($logs as $key=>$log)
                      @if($log->action=="Deleted")
                      <tr> 
                        <td scope="row">{{$key+1}}</td>
                        <td>{{$log->medicine->name}}</td>
                        <td>{{$log->price}}</td>
                        <td>{{$log->validity_date}}</td>
                        <td>{{$log->amount}}</td>
                        <td>{{$log->user->name}}</td>
                        <td>{{$log->created_at}}</td>
                  
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>

                  <h1>Wprowadzone leki</h1>
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa leku</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Data ważności</th>
                        <th scope="col">Wprowadzona ilość leku</th>
                        <th scope="col">Użytkownik</th>
                        <th scope="col">Data i godzina wprowadzenia</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($logs as $key=>$log)
                      @if($log->action=="Inserted")
                      <tr> 
                        <td scope="row">{{$key+1}}</td>
                        <td>{{$log->medicine->name}}</td>
                        <td>{{$log->price}}</td>
                        <td>{{$log->validity_date}}</td>
                        <td>{{$log->amount}}</td>
                        <td>{{$log->user->name}}</td>
                        <td>{{$log->created_at}}</td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
