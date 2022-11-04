@extends('layouts.main')

@section('content')


</div>

<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2 class="m-5">
        Add to Menu
      </h2>
      <h6 style="color: red">
        This is visible for non logged and without specific role users for demonstration purpose
      </h6>
      <a class="btn btn-dark btn-lg m-2" href="{{ route('products_new.create') }}">ADD NEW product</a>
    </div>

    <div class="filters-content">
      <div class="row grid">

        @foreach ($products as $product)
            
        <div class="col-sm-6 col-lg-4 all pizza">
          <div class="box">
            <div>
              <div class="img-box">
                <img src="{{ asset('images/'.$product->image)}}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  <a href="{{ route('single_product', ['id'=>$product->id]) }}">{{$product->name}}</a>
                </h5>
                <p>
                  {{$product->description}}
                </p>
                <div class="options">
                  <h6>
                    {{$product->price}} EUR
                  </h6>
                  <a class="btn btn-secondary m-1" href="{{ route('products_new.edit', $product) }}">EDIT</a>
                  <form action="{{ route('products_new.destroy', $product) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger m-1" onclick="return confirm('Really???')">DELETE</button>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        
        </div>
        @endforeach

      </div>
    </div>
  </div>
</section>


    
@endsection