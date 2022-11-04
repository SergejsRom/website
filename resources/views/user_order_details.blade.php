@extends('layouts.main')

@section('content')
</div>
	<section class="cart container  py-5" style="margin-bottom: 80px">
		<div class="container mt-2">
			<h4>Order # {{$order_id}}</h4>
		</div>

		<table class="pt-5">
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Cost</th>
				<th>Quantity</th>
				<th>Date</th>
			</tr>				
				 @foreach($details_array as $detail)			 
					<tr>
						<td>
				    		<div>
				    			<img style="width: 100px; height: 100px" 
				    			src="{{asset('images/'.$detail->product_image)}}">
				    		</div>
				    	</td>
				 
						<td>
							<div class="product-info">
								<div>
									<p>{{ $detail->product_name }}</p>
									<small><span></span></small>
									<br>
								</div>
							</div>
						</td>

						<td>
							<p>${{$detail->product_price}}
							</p>
							
						</td>

						<td>
							<p >
							   {{$detail->product_quantity}}
							</p>
							
						</td>

						<td>
							<span class="product-price">{{$detail->order_date }}</span>
						</td>
					</tr>					
					@endforeach
		</table>
	</section>
@endsection