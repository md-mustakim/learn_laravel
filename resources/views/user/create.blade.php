@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create User</div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <p class="{{ Session::get('class') }}">
                                {{ Session::get('message') }}
                            </p>
                            @endif
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="my-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                                @error('name')
                                    <p class="m-0 p-0 text-danger fw-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-2">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}">
                                @error('email')
                                <p class="m-0 p-0 text-danger fw-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-2">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" >
                                @error('password')
                                <p class="m-0 p-0 text-danger fw-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-2">
                                <label for="password_confirmation">Retype Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" >
                            </div>
                            <div class="d-flex justify-content-center my-3">
                                <button type="submit" class="btn btn-secondary">Create <i class="fa fa-save"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        User List
                    </div>
                    <div class="card-body">
                        @if(count($users) > 0)
                            <table class="table table-sm">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Are You sure ?')" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="alert alert-info">No User Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
