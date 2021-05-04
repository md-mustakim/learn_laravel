@extends('layouts.theme')

@section('content')
    <div class="container">
        <div class="row m-0 p-0">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="card-title h4 fw-bold">Create new Employee</div>
                        <div class="card-category"></div>
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
                            <button class="btn btn-primary btn-block" onclick="md.showNotification('top','right', 'Update success')">Bottom Right</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h3 class="card-title">Employees Stats</h3>
                        <p class="card-category">Total Employee {{ count($employees) }}</p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                            <th>ID</th>
                            <th>Name</th>
                            <th>PDF</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td> {{$employee->id}} </td>
                                    <td> {{$employee->name}} </td>
                                    <td>
                                        @if(strlen($employee->file) > 0)
                                            <a href="{{ route('employee.show', $employee->id) }}" target="_blank">View</a>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a onclick="deleteEmployee()">delete</a>
                                        <form id="deleteForm" onsubmit="return confirm('Are You sure?')" action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function deleteEmployee(){
            let deleteForm = document.getElementById('deleteForm');
            if (confirm('Are you sure?')){
                deleteForm.submit();
            }
        }
    </script>
@endpush
