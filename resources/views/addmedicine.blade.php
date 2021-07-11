@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">    
                    Dodaj lek do swojej apteczki <strong> {{ $drugstore_id->name}}</strong>
                 </div>
                 <div class="card-body">
                    @if(Session::has('message'))
                    <div class="alert bg-success alert-success text-white" role="alert">
                        {{Session::get('message')}}
                    </div>
                @endif
                 <form action="{{route('content.update', [$drugstore_id->id])}}" method="POST" >@csrf
                    @method('PUT')
                    <div class="form-group">
                        
                            <select name="medicine_id" class="form-control">
                                @foreach($medicines as $medicine)
                                <option value={{$medicine->id}}>{{$medicine->name}}</option>
                                @endforeach
                             </select>
                  
                    </div>
                    <div class="form-group">
                        <label for="price">Cena</label>
                        <input type="text" class="form-control" name="price"  />
                    </div>
                    <div class="form-group">
                        <label for="price">Ilość w gramach</label>
                        <input type="text" class="form-control" name="amount"  />
                    </div>
                    <div class="form-group">
                        <label for="price">Data ważności leku</label>
                        <input type="date" id="datepicker" class="form-control" name="validity_date"  />
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj lek do apteczki</button>
                  </form>

                  </div>

            </div>
        </div>
    </div>
</div>
@endsection
