@extends('layouts.main')

@section('content')
   </div>
<section class="cart container mt-2 my-3 py-5">
    <div class="container text-center">
        <h4>Your profile</h4>
        <p>{{ Auth::user()->name }}</p>
        <p>{{ Auth::user()->email }}</p>
        <p>{{ Auth::user()->id }}</p>

        <form action="{{route('logout')}}" method="post">
        @csrf
        <button type="submit" class="btn checkout-btn">Logout</button>
        </form>
        <div>
            <a href="{{ route('user_orders') }}" class="btn btn-danger">My orders</a>
        </div>
    </div>  
</section>


@endsection


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}
