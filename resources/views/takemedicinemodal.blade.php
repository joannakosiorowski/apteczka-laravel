<div class="modal fade" id="exampleModal{{$content->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pobierz lek</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('content.takemedicine',[$content->id])}}" method="post">@csrf
 
            <strong>Lek:  {{$content->medicine->name}}</strong>
      
            <div class="form-group">
                <label for="amount">Podaj dawkę jaką chcesz pobrać</label>
                <input type="text" class="form-control" name="amount"  />
              </div>
              <div class="form-group">
                <input type="text" class="form-control hidden" value="{{$content->id}}" name="medicine_id"  />
              </div>
              <button type="submit" class="btn btn-primary">Zatwierdź</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
