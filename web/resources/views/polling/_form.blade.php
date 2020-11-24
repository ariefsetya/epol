{{csrf_field()}}
  <input type="hidden" name="event_id" value="{{Session::get('event_id')}}">
  <div class="form-group">
    <label for="polling_type_id">Tipe Polling</label>
    <select class="form-control" required name="polling_type_id" id="polling_type_id">
        @foreach($polling_type as $key)
            <option value="{{$key->id}}"  {{(($polling->polling_type_id ?? 0)==$key->id)?"selected":""}} >{{$key->name}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="name">Nama</label>
    <input type="text" class="form-control" required name="name" id="name" placeholder="Nama" value="{{$polling->name ?? ''}}">
  </div>
  <div class="form-group">
    <label for="finish_message">Pesan Selesai</label>
    <input type="text" class="form-control" required name="finish_message" id="finish_message" placeholder="Pesan Selesai" value="{{$polling->finish_message ?? ''}}">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>