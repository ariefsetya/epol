@extends('layouts.app')

@section('content')
<div class="">
    <h2>Laporan Produk
    <a class="btn btn-primary float-right" href="{{route('product.export_excel')}}">Export</a></h2>
    <table class="table for_datatables">
    	<thead>
    		<tr>
	    		<th>Code</th>
	    		<th>Yes</th>
                <th>No</th>
                <th>Abstain</th>
                <th>Vote</th>
                <th>Visitor</th>
                <th>Action</th>
	    	</tr>
    	</thead>
    	<tbody>
    		@foreach($summary as $key)
            <?php $yes = sizeof(\App\ProductResponse::where('product_id',$key->id)->where('response_id',1)->get());
            $no = sizeof(\App\ProductResponse::where('product_id',$key->id)->where('response_id',0)->get());
            $visitor = sizeof(\App\Presence::where('product_id',$key->id)->groupBy('uuid')->get()); ?>
            @if($visitor > 0)
    			<tr>
    				<td>{{$key->code}}</td>
                    <td>{{$yes}}</td>
                    <td>{{$no}}</td>
                    <td>{{$visitor-($yes+$no)}}</td>
                    <td>{{$yes+$no}}</td>
                    <td>{{$visitor}}</td>
                    <td>@if($yes>0 or $no>0)<a href="{{route('product.chart',[$key->id])}}" class="btn btn-primary">Chart</a>@endif</td>
    			</tr>
    		@endif
            @endforeach
    	</tbody>
    </table>
</div>
@endsection
