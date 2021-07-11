
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card " id="testMSG">
                <div class="card-header bg-danger"> 
                  <h3><strong>Przeterminowane leki</strong> (należy szybko zutylizować) </h3>
                </div>
                <div class="card-header bg-danger"> 
                    <span><i>Komunikat wyłączy się automatycznie po kilku sekundach</i><span>
                  </div>
                               
               
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nazwa apteczki</th>
                        <th>Lek</th>
                        <th>Ilość w apteczce</th>
                        <th>Data ważności</th>
                        <th>Akcje</th>

                      </tr>
                    </thead>
                    <tbody>
                        @foreach($drugstores as $drugstore)
                        @foreach($drugstore->contents as $content)
                        @if($content->validity_date <= now())
                        <tr>
                            <td>{{$drugstore->name}}</td>
                            <td>{{$content->medicine->name}}</td>
                            <td>{{$content->amount}}</td>
                            <td>{{$content->validity_date}}</td>
                            <td>
                                <form action="{{route('content.destroy',[$content->id])}}" method="POST">@csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><strong>Zutylizuj lek !!!</strong></button>
                                
                            </form>
                            </td>
                                
                        </tr>
                   
                   
           
                      @endif
                      @endforeach

                      @endforeach
                    </tbody>
                  </table>
             
           
                    
             
             </div>
        </div>

        <div class="card hidden">
            <div class="card-header bg-danger"> 
              <h3><strong>Następne leki mające najkrótszy termin ważności</strong></h3>
            </div>
                           
           
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nazwa apteczki</th>
                    <th>Lek</th>
                    <th>Ilość w apteczce</th>
                    <th>Data ważności</th>
                    <th>Akcje</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach($drugstores as $drugstore)
                    @foreach($drugstore->contents as $content)
                    
                  <tr>
                    <td>{{$drugstore->name}}</td>
                    <td>{{$content->medicine->name}}</td>
                    <td>{{$content->amount}}</td>
                    <td>{{$content->validity_date}}</td>
                    <td>
                        <form action="{{route('content.destroy',[$content->id])}}" method="POST">@csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger"><strong>Zutylizuj lek !!!</strong></button>
                          
                      </form>
                    </td>
                        
                  </tr>
           
           
                  @endforeach
                  @endforeach
                </tbody>
              </table>
         
       
                
         
         </div>
    </div>
    </div>
</div>

