@extends('layouts.theme')

@section('title')
    Create Product |
@endsection

@section('content')
    <div class="row m-0 p-0">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header card-header-danger">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="h5 font-weight-bold">
                            Add Product
                        </div>
                        <a href="{{route('product.index')}}" class="card-title h4" title="Product List">
                            <i class="fa fa-list-alt"></i>
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
                                        <option value="">Select Category</option>
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
                                <input type="text"
                                       class="form-control @error('details') is-invalid @enderror"
                                       id="details"
                                       name="details"
                                       onkeyup="myFun(this)"

                                       value="{{ old('details') }}">
                                @error('details')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="image" class="col-form-label col-sm-4">Product Image</label>
                            <div class="col-sm-4">
                                <input type="file"
                                       class="form-check @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       onchange="PreviewImage(this)">
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <img src="{{ asset('siteImage/download.png') }}"
                                     alt="" id="previewImg"
                                     accept="image/x-png,image/gif,image/jpeg"
                                     style="width: 100px; height: 100px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="">
                                @if(count($categories) > 0)
                                    <button class="btn btn-danger form-check-input">Save <i class="fa fa-save"></i> </button>
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

@push('js')
    <script>
        function myFun(){
            let a = document.getElementById('details');
            console.log(a);
        }
        function PreviewImage(input){
            let file = $("input[type=file]").get(0).files[0];

            if(file){
                let reader = new FileReader();

                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
