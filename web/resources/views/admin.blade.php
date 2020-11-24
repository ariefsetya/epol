@extends('layout-single')

@section('content')
<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
	<div class="row">
		<div class="col-md-12"><h2>Selamat Datang, {{Auth::user()->name}}!</h2></div>
		<hr>
		<div class="col-md-6">
			<div class="card mb-3">
				<div class="card-header text-white bg-primary text-center">
					@if(\App\User::where('event_id',Session::get('event_id'))->where('user_type_id',2)->count() > 0)
					<h1>{{number_format(((sizeof(\App\Presence::where('user_id','>',0)->where('event_id',Session::get('event_id'))->groupBy('user_id')->get())-\App\User::where('event_id',Session::get('event_id'))->where('user_type_id',1)->count())/(\App\User::where('event_id',Session::get('event_id'))->where('user_type_id',2)->count()))*100,2)}}%</h1>
					@endif
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6 text-center">
							<div class="col-md-12">UNDANGAN</div>
							<div class="col-md-12"><h2><strong>{{\App\User::where('user_type_id',2)->where('event_id',Session::get('event_id'))->count()}}</strong></h2></div>
						</div>
						<div class="col-md-6 text-center">
							<div class="col-md-12">CHECK IN</div>
							<div class="col-md-12"><h2><strong>{{(sizeof(\App\Presence::where('user_id','>',0)->where('event_id',Session::get('event_id'))->groupBy('user_id')->get())-\App\User::where('event_id',Session::get('event_id'))->where('user_type_id',1)->count())}}</strong></h2></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card mb-3">
				<div class="card-header text-white bg-primary text-center">
					@if(\App\User::where('event_id',Session::get('event_id'))->where('user_type_id',2)->count() > 0)
					<h1>{{number_format(((sizeof(\App\Presence::where('user_id','>',0)->where('event_id',Session::get('event_id'))->groupBy('user_id')->get())-\App\User::where('event_id',Session::get('event_id'))->where('user_type_id',1)->count())/(\App\User::where('event_id',Session::get('event_id'))->where('user_type_id',2)->count()))*100,2)}}%</h1>
					@endif
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6 text-center">
							<div class="col-md-12">UNDANGAN</div>
							<div class="col-md-12"><h2><strong>{{\App\User::where('user_type_id',2)->where('event_id',Session::get('event_id'))->count()}}</strong></h2></div>
						</div>
						<div class="col-md-6 text-center">
							<div class="col-md-12">CHECK IN</div>
							<div class="col-md-12"><h2><strong>{{(sizeof(\App\Presence::where('user_id','>',0)->where('event_id',Session::get('event_id'))->groupBy('user_id')->get())-\App\User::where('event_id',Session::get('event_id'))->where('user_type_id',1)->count())}}</strong></h2></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
