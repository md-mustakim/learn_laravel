@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 90vh">
        <div class="border p-5" style="width: 500px">
            <div class="h3 py-2">User Login</div>
            @if(Session::has('message'))
                <p class="alert alert-danger">{{Session::get('message')}}</p>
                @endif
            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                <div class="py-2">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                    <p class="fw-bold m-0 text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="py-2">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <p class="fw-bold m-0 text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex justify-content-center align-items-center py-3">
                    <button type="submit" class="btn btn-secondary"> Login <i class="fa fa-sign-in"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
