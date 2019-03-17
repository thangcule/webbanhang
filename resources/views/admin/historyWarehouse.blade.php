@extends('admin.master')
@section('content')
    <section class="content-header">
	</section>
	<section class="content">
	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-tags"></i> History receipt</h3>
		</div>
		<div class="box-body">
			<table  class="data_table table table-bordered table-hover">	
				<thead>
				<tr>
					<th>Id</th>
					<th>Product</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Date</th>
				</tr>
				</thead>
				<tbody>
				@foreach($allReceipts as $receipt)
					<tr>
						<td>{{$receipt->id}}</td>
						<td>{{$receipt->getProductName()->name}}</td>
						<td>{{$receipt->price}}</td>
						<td>{{$receipt->quantity}}</td>
						<td>{{$receipt->created_at}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>	
    </section>
@stop