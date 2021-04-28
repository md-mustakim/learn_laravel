@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row m-0 p-0">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="h4 fw-bold">Create new Employee</span>
                    </div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <p class="{{Session::get('class')}} fw-bold">{{Session::get('message')}}</p>
                        @endif
                        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="name">Enter Employee Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name') <span class="fw-bold text-danger">{{ $message }}</span> @enderror
                            <label for="file">Upload PDF</label>
                            <input type="file" name="file" id="file" class="form-control-file">
                            @error('file') <span class="fw-bold text-danger">{{ $message }}</span> @enderror
                            <div class="d-flex justify-content-center my-3">
                                <button class="btn btn-primary">Submit <i class="fa fa-save"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Employee List
                    </div>
                    <div class="card-body">
                        @if(count($employees) > 0)
                        <table class="table table-sm">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>CV</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td> {{$employee->id}} </td>
                                    <td> {{$employee->name}} </td>
                                    <td><a href="{{ route('employee.show', $employee->id) }}" target="_blank">View</a> </td>
                                    <td>
                                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn p-0" title="Delete"> <i class="fa fa-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="alert alert-info">No Employee Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
