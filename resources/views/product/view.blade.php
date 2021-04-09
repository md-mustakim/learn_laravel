@extends('layouts.app')


@section('content')
    <div class="d-flex justify-content-center my-5">
       <div class="w-50">
           <div class="d-flex justify-content-between align-items-center my-3">
               <h2>Product List</h2>
               <a href="{{route('product.create')}}" class="float-right"> <i class="fa fa-plus"></i></a>
           </div>
           @if(Session::has('message'))
               <p class="font-weight-bold alert-success alert">
                   {{ Session::get('message') }}
               </p>
           @endif


           @if(count($productData) > 0)
               <table class="table table-bordered">
                   <thead>
                   <tr>
                       <th>#</th>
                       <th>Name</th>
                       <th>Details</th>
                       <th>Action</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($productData as $data)
                       <tr>
                           <td>{{$data->id}}</td>
                           <td>{{$data->name}}</td>
                           <td>{{$data->details}}</td>
                           <td class="d-flex justify-content-center">
                               <a href="{{route('product.show', $data->id)}}" class="text-decoration-none btn btn-secondary mx-2" title="View Product">
                                   <i class="fa fa-eye"> </i>
                               </a>

                               <a href="{{route('product.edit', $data->id)}}" class="text-decoration-none btn btn-secondary mx-2" title="Edit Product">
                                   <i class="fa fa-edit"> </i>
                               </a>
                               <form action="{{route('product.destroy', $data->id)}}" method="post" onsubmit="return confirm('Do you really want to submit the form?');">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" title="Delete Product" class="btn btn-danger mx-2">
                                       <i class="fa fa-trash"> </i>
                                   </button>
                               </form>


                           </td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           @else
               <div class="alert alert-danger">No Product Found</div>
           @endif
       </div>
    </div>
@endsection
