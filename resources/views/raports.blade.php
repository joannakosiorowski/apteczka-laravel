@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> 
        <h1>Wybierz apteczkę i okres czasu za jaki chcesz zobaczyć raport</h1>
                 </div>
                <div class="card-body">
                  @if(Session::has('message'))
                  <div class="alert bg-success alert-success text-white" role="alert">
                      {{Session::get('message')}}
                  </div>
                @endif
                <label for="name">Wybierz apteczkę:</label>
                <form action="{{ route('show.logreport')}}" method="get" >
                    @csrf

                    <div class="form-group">
                            <select name="drugstore" class="form-control">
                                @foreach($drugstores as $drugstore)
                                <option value={{$drugstore->id}}>{{$drugstore->name}}</option>
                                @endforeach
                             </select>
                    </div>
                    <div class="form-group">
                      <label for="name">Pokaż raporty od dnia: </label>
                      <input type="text" class="form-control datetimepicker-input" id="datepicker" name="fromdate" value="{{ old('fromdate')}}" data-toggle="datetimepicker" data-target="#datepicker"  >
                    </div>
                    <div class="form-group">
                        <label for="name">do dnia: </label>
                        <input type="text" class="form-control datetimepicker-input" id="datepicker2"  name="uptodate" value="{{ old('uptodate')}}" data-toggle="datetimepicker" data-target="#datepicker2" >
                      </div>
                    <button type="submit" class="btn btn-primary">Pokaż raport</button>

                </form>
                <h1>Koszty utylizacji</h1>
                <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa leku</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Koszt utylizacji</th>
                        <th scope="col">Data</th>
        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $key =>  $record )
                        <tr>
                            
                            
                            @if($record->action == "Deleted")
    
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$record->medicine->name}}</td>
                                <td>{{$record->amount}}</td>
                                <td>{{($record->amount)*($record->priceforml)}} pln</td>
                                <td>{{$record->created_at}}</td>
                                <td></td>
                            @endif
    
    
                        </tr>
                        @endforeach
                    </tbody>
    
                  </table>
          

              <h1>Koszty wydanych leków </h1>
              <table class="table table-striped mt-2">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa leku</th>
                    <th scope="col">Ilość pobrana</th>
                    <th scope="col">Koszt wydanego leku</th>
                    <th scope="col">Data</th>
    
                  </tr>
                </thead>
                <tbody>
                    @foreach($records as $key =>  $record )
                    <tr>
                        
                        
                        @if($record->action == "Updated")

                            <th scope="row">{{$key+1}}</th>
                            <td>{{$record->medicine->name}}</td>
                            <td>{{$record->take_amount}}</td>
                            <td>{{($record->take_amount)*($record->priceforml)}} pln</td>
                            <td>{{$record->created_at}}</td>
                        @endif


                    </tr>
                    @endforeach
                </tbody>

              </table>
              <h1>Koszty zakupu leków</h1>
              <table class="table table-striped mt-2">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa leku</th>
                    <th scope="col">Ilość</th>
                    <th scope="col">Koszt zakupu</th>
                    <th scope="col">Data</th>
    
                  </tr>
                </thead>
                <tbody>
                    @foreach($records as $key =>  $record )
                    <tr>
                        @if($record->action == "Inserted")
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$record->medicine->name}}</td>
                            <td>{{$record->amount}}</td>
                            <td>{{$record->price}} pln</td>
                            <td>{{$record->created_at}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>

              </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
