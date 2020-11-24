{{csrf_field()}}
  <input type="hidden" name="event_id" value="{{Session::get('event_id')}}">
  <div class="form-group">
    <label for="polling_question_id">Pertanyaan</label>
    <select class="form-control" required name="polling_question_id" id="polling_question_id">
        @foreach($polling_question as $key)
            <option value="{{$key->id}}" {{($polling_answer->polling_question_id ?? '')==$key->id?"selected":""}} >{{$key->content}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="name">Isi</label>
    <input type="text" class="form-control" required name="content" id="content" placeholder="Isi" value="{{$polling_answer->content ?? ''}}">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>