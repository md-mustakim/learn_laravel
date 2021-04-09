@extends('layouts.app')
@section('title')
    Welcome
@endsection
@section('content')
    <div class="">
       <div class="row">
           <div class="col-md-8 mx-auto">
            <div class="px-3 d-flex border-bottom justify-content-between align-items-center">
                <div class="h3 font-weight-bold">{{__('product.product')}}</div>
                @auth
                    <a href="{{route('product.create')}}" class="btn btn-primary" title="Create New Product"><i class="fa fa-plus"></i></a>
                @endauth
            </div>
               @if(Session::has('message'))
                   <p class="font-weight-bold alert-success alert">
                       {{ Session::get('message') }}
                   </p>
               @endif

               <div class="d-flex align-content-start flex-wrap">
                   @if(count($productData) > 0)
                       @foreach($productData as $data)
                           <div class="card mx-3 my-3" style="width: 282px; max-height: 500px">
                               <img src="{{asset('images/product/nokia.jpg')}}" alt="Image" class="card-img-top">
                               <div class="card-body">
                                   <div class="card-title d-flex justify-content-between">
                                       <div class="font-weight-bold h5">
                                           <a href="{{route('product.show', $data->id)}}" class="text-decoration-none">{{ $data->name }}</a>
                                       </div>
                                       @auth
                                           <a href="{{route('product.edit', $data->id)}}" class="Edit Product"><i class="fa fa-edit"></i></a>
                                       @endauth
                                   </div>
                                   <p class="card-text"><b>Category: </b> {{ $category[$data->category] }}</p>
                                   <p class="card-text">{{ $data->details }}</p>
                                   <p class="card-text">
                                       Rating:
                                        <i class="fa fa-star text-success"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                   </p>
                                   <div class="d-flex justify-content-between mt-auto">
                                       <a href="#" class="btn btn-primary" title="{{__('product.cartPlus')}}"><i class="fa fa-shopping-cart"></i></a>
                                       <a href="#" class="btn btn-success" title="{{__('product.buyNow')}}"><i class="fa fa-store"></i></a>
                                       @auth
                                           <form onsubmit="return confirm('Are You Sure, Delete this Product?')" action="{{route('product.destroy', $data->id)}}" method="POST">
                                               @csrf
                                               @method('DELETE')
                                               <button type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> </button>
                                           </form>
                                       @endauth
                                   </div>
                               </div>
                           </div>
                       @endforeach
                   @else
                        <p class="text-center font-weight-bold m-3">{{__('product.noProductFound')}}</p>
                   @endif
               </div>
           </div>
       </div>
    </div>
@endsection
