@extends('layouts.app')
@section('title')
Create Category
@endsection

@section('content')
    <div class="row m-0 p-0">
        <div class="col-md-8 mx-auto">
            <div class="row m-0 p-0">
                <div class="col-md-6">
                   <div class="card">
                       <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="h3">
                                Create Category
                            </div>
                           <a href="{{route('product.create')}}" class="">Create Product</a>
                       </div>
                       <div class="card-body">
                            @if(Session::has('message'))
                            <p class="alert alert-success text-uppercase"> {{Session::get('message')}} </p>
                            @endif

                           <form action="{{route('category.store')}}" method="POST">
                               @csrf
                                <div class="my-2">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                                    @error('name')
                                    <p class="alert-danger alert">{{$message}}</p>
                                    @enderror
                                </div>
                               <div class="my-3">
                                   <label for="details">Details</label>
                                   <input type="text" name="details" id="details" class="form-control @error('details') is-invalid @enderror" value="{{old('details')}}">
                                   @error('details')
                                   <p class="alert-danger alert">{{$message}}</p>
                                   @enderror
                               </div>

                               <div class="d-flex justify-content-center mt-3">
                                   <button type="submit" class="btn btn-success">Crate <i class="fa fa-save"></i></button>
                               </div>

                           </form>
                       </div>
                   </div>
                </div>
                <div class="col-md-6 border-left">
                    @if(count($categories)> 0)
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td title="{{$category->details}}">{{$category->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h5 class="alert-danger alert">No category found</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
