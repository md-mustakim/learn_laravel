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
                <div class=""></div>
                <table class="table table-bordered">
                   <tr>
                       <td> <b>Name:</b> </td>
                       <td>  {{ $productData->name }}</td>
                   </tr>
                   <tr>
                       <td> <b>Details:</b> </td>
                       <td>  {{ $productData->details }}</td>
                   </tr>
                </table>
            @endif
                <a href="{{route('product.index')}}">Go Back</a>
        </div>
    </div>
@endsection
