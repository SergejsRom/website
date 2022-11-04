@extends('layouts.main')

@section('content')


</div>

<section class="container mt-2 my-3 py-5">
    <div class="container mt-2 text-container">
        <h4>Thank you</h4>
        @if (Session::has('order_id') && Session::get('order_id') != null)
       
        <h4 class="my-5"><p>Your order ID:</p> {{ Session::get('order_id') }}</h4>

        <p>Estimated time: 45 min</p>
        @endif
    </div>
</section>


@endsection