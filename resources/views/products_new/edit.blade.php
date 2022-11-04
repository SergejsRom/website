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
    </div>

    <form action="{{ route('products_new.update', $product) }}" method="post">
        @method('put')
        @csrf
        Name:
        <input class="form-control m-1" type="text" name="name" value="{{ $product->name }}">
        Price:
        <input class="form-control m-1" type="text" name="price" value="{{ $product->price }}">
        Description:
        <input class="form-control m-1" type="text" name="description" value="{{ $product->description }}">
        Quantity:
        <input class="form-control m-1" type="text" name="quantity" value="{{ $product->quantity }}">
        Category:
        <input class="form-control m-1" type="text" name="category" value="{{ $product->category }}">
        Type:
        <input class="form-control m-1" type="text" name="type" value="{{ $product->type }}">
        Image:
        <input class="form-control m-1" type="text" name="image" value="{{ $product->image }}">

        <button type="submit" class="btn btn-dark m-2">Save</button>

    </form>

    <div class="filters-content">
      <div class="row grid">

       

      </div>
    </div>
  </div>
</section>


    
@endsection