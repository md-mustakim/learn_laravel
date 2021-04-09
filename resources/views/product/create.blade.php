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
                    <form action="{{route('product.store')}}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="category" class="col-form-label col-sm-4">Category</label>
                            <div class="col-sm-8">
                                <select name="category" id="category" class="form-control">
                                    @foreach($category as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @error('category')
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
                        <div class="d-flex justify-content-center">
                            <div class="">
                                <button class="btn btn-secondary form-control">Save <i class="fa fa-save"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
