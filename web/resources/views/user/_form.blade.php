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
  <br>
  <button type="submit" class="button primary">Submit</button>