
  <div class="modal fade" id="exampleModal{{$drugstore->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Dodaj nowego użytkownika do swojej apteczki</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('add.user',[$drugstore->id])}}" method="post">@csrf
          
                <div class="form-group">
                    <label for="email">Podaj adres email nowego usera</label>
                    <input type="text" class="form-control" name="email"  />
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


