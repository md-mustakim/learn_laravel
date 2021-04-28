@extends('layouts.app')
@section('title')
    @if(count(array($productData)) > 0)
        {{ $productData->name }} |
        @endif
{{--    how show title with product name--}}
@endsection
@section('content')
    <div class="d-flex justify-content-center py-5">
        <div class="">
            @if(count(array($productData)) > 0)
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset('images/'.$productData->image)}}" alt="image" style="width: 500px; height: 300px;">
                    </div>
                    <div class="card-body my-2">
                        <div class="card-text">
                        Name:    <b>{{ $productData->name }}</b>
                        </div>
                        <div class="card-text my-2">
                           Details <b>{{ $productData->details }}</b>
                        </div>
                        <a href="{{route('product.index')}}" class="btn btn-secondary">Go Back</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
