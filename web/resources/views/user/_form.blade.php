{{csrf_field()}}
  <input type="hidden" name="user_type_id" value="2">
  <input type="hidden" name="event_id" value="{{Session::get('event_id')}}">
  <div class="form-group">
    <label for="reg_number">Nomor Induk</label>
    <input type="text" class="form-control" required name="reg_number" id="reg_number" placeholder="Nomor Induk" value="{{$user->reg_number ?? ''}}">
  </div>
  <div class="form-group">
    <label for="name">Nama</label>
    <input type="text" class="form-control" required name="name" id="name" placeholder="Nama" value="{{$user->name ?? ''}}">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" required name="email" id="email" placeholder="Email" value="{{$user->email ?? ''}}">
  </div>
  <div class="form-group">
    <label for="country_id">Kode Negara</label>
    <select class="form-control" required name="country_id" id="country_id">
        @foreach($country as $key)
            <option value="{{$key->id}}" {{($user->country_id ?? 100)==$key->id?"selected":""}} >+{{$key->phonecode." (".$key->nicename.")"}}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="phone">No. HP</label>
    <input type="text" class="form-control" required name="phone" id="phone" placeholder="No. HP" value="{{$user->phone ?? ''}}">
  </div>
  <div class="form-group">
    <label for="company">Perusahaan</label>
    <input type="text" class="form-control" name="company" id="company" placeholder="Perusahaan" value="{{$user->company ?? ''}}">
  </div>
  <div class="form-group">
    <label for="custom_field_1">Custom Field 1</label>
    <input type="text" class="form-control" name="custom_field_1" id="custom_field_1" placeholder="Custom Field 1" value="{{$user->custom_field_1 ?? ''}}">
  </div>
  <div class="form-group">
    <label for="custom_field_2">Custom Field 2</label>
    <input type="text" class="form-control" name="custom_field_2" id="custom_field_2" placeholder="Custom Field 2" value="{{$user->custom_field_2 ?? ''}}">
  </div>
  <div class="form-group">
    <label for="custom_field_3">Custom Field 3</label>
    <input type="text" class="form-control" name="custom_field_3" id="custom_field_3" placeholder="Custom Field 3" value="{{$user->custom_field_3 ?? ''}}">
  </div>
  @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
  <h4>RSVP</h4>
  <hr>
  <div class="form-group">
    <label for="seat_number">Nomor Meja</label>
    <input type="text" class="form-control" required name="seat_number" id="seat_number" placeholder="Nomor Meja" value="{{$user->rsvp->seat_number ?? ''}}">
  </div>
  <div class="form-group">
    <label for="guest_qty">Konfirmasi Jumlah Tamu</label>
    <input type="text" class="form-control" required name="guest_qty" id="guest_qty" placeholder="Konfirmasi Jumlah Tamu" value="{{$user->rsvp->guest_qty ?? ''}}">
  </div>
  <div class="form-group">
    <label for="session_invitation">Sesi Undangan</label>
    <input type="text" class="form-control" required name="session_invitation" id="session_invitation" placeholder="Sesi Undangan" value="{{$user->rsvp->session_invitation ?? ''}}">
  </div>
  <div class="form-group">
    <label for="event_time">Jam</label>
    <input type="text" class="form-control" required name="event_time" id="event_time" placeholder="Jam" value="{{$user->rsvp->event_time ?? ''}}">
  </div>
  @endif
  <br>
  <button type="submit" class="button primary">Submit</button>