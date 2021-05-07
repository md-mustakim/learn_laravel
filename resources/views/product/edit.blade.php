@extends('layouts.theme')
@section('title')
    Show Product
    {{--    how show title with product name--}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            @if(!empty($productData))
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="h3 font-lora border-bottom card-title font-weight-bold">Edit Product</div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product.update', $productData->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-2 my-3">
                                    <label for="category" class="font-weight-bold h5">
                                        Category
                                    </label>
                                </div>
                                <div class="col-md-10 my-3">
                                    <select name="category_id" id="category" class="form-control">
                                        @foreach($categories as $category)
                                            @if($productData->category_id === $category->id)
                                            <option value="{{ $category->id }}" selected> {{ $category->name }} </option>
                                            @else
                                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

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
                                    <input type="text" id="details"
                                           class="form-control @error('details') is-invalid @enderror"
                                           name="details"
                                           value="{{ $productData->details }}">
                                    @error('details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-2 mt-3">
                                    <label for="image" class="font-weight-bold h5">Image</label>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input type="file"
                                           class="form-control-file @error('image') is-invalid @enderror"
                                           id="image"
                                           name="image"
                                           onchange="PreviewImage(this)"
                                           value="{{ old('image') }}">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-3">
                                    <img src="{{ asset('siteImage/download.png') }}"
                                         alt="" id="previewImg"
                                         accept="image/x-png,image/gif,image/jpeg"
                                         style="width: 200px; height: 200px;">
                                </div>
                                <div class="col-md-3 mt-3">
                                    @if(strlen($productData->image) > 0)
                                        <img src="{{ asset('images/'.$productData->image) }}"
                                             style="width: 200px; height: 200px;"
                                             alt="image">
                                    @else
                                        <img src="{{ asset('siteImage/download.png') }}"
                                             style="width: 200px; height: 200px;"
                                             alt="image">
                                    @endif
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

@push('js')
    <script>
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
