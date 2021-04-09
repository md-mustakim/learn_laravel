@extends('layouts.app')
@section('title')
    Show Product
    {{--    how show title with product name--}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            @if(!empty($productData))
                <div class="card">
                    <div class="card-header">
                        <div class="h2 py-3 px-2 bg-light border-bottom">Product Details</div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product.update', $productData->id)}}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-2 my-3">
                                    <label for="name" class="font-weight-bold h5">
                                        Name
                                    </label>
                                </div>
                                <div class="col-md-10 my-3">
                                    <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror form-control" value="{{ $productData->name }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="details" class="font-weight-bold h5">Details</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" id="details" class="form-control @error('details') is-invalid @enderror" name="details" value="{{ $productData->details }}">
                                    @error('details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 d-flex my-3 justify-content-center">
                                    <button type="submit" name="submit" class="btn btn-success" id="submit">Update</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{route('product.index')}}" title="Go Back" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> </a>
                    </div>
                </div>


            @endif
        </div>
    </div>
@endsection
