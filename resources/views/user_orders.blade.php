@extends('layouts.main')

@section('content')
   </div>

	<section class="cart container py-5" style="margin-bottom: 80px">
		<div class="container mt-2">
			<h4>Your Orders</h4>
		</div>

		<table class="pt-5">
			<tr>
				<th>Order Id</th>
				<th>Info</th>
				<th>Cost</th>
				<th>Date</th>
				<th>Details</th>
			</tr>				
				 @foreach($user_orders as $user_order)
				   @if($user_order->status != 'not paid')
					<tr>
						<td>
				    		<div style="padding: 10px">{{$user_order->id}}</div>
				    	</td>
				 
						<td>
							<div class="product-info">
								<div>
									<p>{{ $user_order->name }}</p>
									<small><span></span>Address: {{ $user_order->address }}</small>
									<br>
								</div>
							</div>
						</td>

						<td>
							<p>${{$user_order->cost}}
								<span> - {{$user_order->status}}</span>
							</p>
							
						</td>

						<td>
							<span class="product-price">{{$user_order->date }}</span>
						</td>

						<td>							
							<a href="{{route('user_order_details',['id'=>$user_order->id])}}"
								class="btn btn-primary">Details</a>
						</td>
					</tr>
						@endif
					@endforeach
		</table>
	</section>
@endsection