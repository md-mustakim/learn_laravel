@extends('layouts.app')

@section('title')
    Create Product |
@endsection

@section('content')
    <div class="row m-0 p-0">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="h5 font-weight-bold">
                            Register New Product
                        </div>
                        <a href="{{route('product.index')}}" class="btn btn-success">
                            <i class="fa fa-home"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-form-label col-sm-4">
                                <label for="category">Category</label>
                                <a href="{{route('category.create')}}" title="Create Category"><i class="fa fa-plus"></i></a>
                            </div>
                            <div class="col-sm-8">
                                @if(count($categories) > 0)
                                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="category" id="category" class="form-control" disabled required>
                                        <option value="">No Category Found</option>
                                    </select>
                                    <p class="alert alert-danger mt-1"> Please Create Category First <a
                                            href="{{route('category.create')}}">Click Here</a> To create Category </p>
                                @endif
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-form-label col-sm-4">Product Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="details" class="col-form-label col-sm-4">Product details</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('details') is-invalid @enderror" id="details" name="details" value="{{ old('details') }}">
                                @error('details')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="image" class="col-form-label col-sm-4">Product Image</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="">
                                @if(count($categories) > 0)
                                    <button class="btn btn-secondary form-control">Save <i class="fa fa-save"></i> </button>
                                @else
                                    <button class="btn btn-secondary form-control" disabled>Save <i class="fa fa-save"></i> </button>
                                    @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
