<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('Employee.create', ['employees' => Employee::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'name' => 'required|unique:employees',
            'file' => 'nullable|mimes:pdf|max:10000'
        ]);

        if ($request->hasFile('file')){

            $fileName = 'employee_'. time() . '.pdf';
            $request->file->move(public_path('files'), $fileName);
            $attribute['file'] = 'files/'.$fileName;
            Employee::create($attribute);

            return redirect()->route('employee.create')->with('message', 'Employee Create Success');
        }
        $attribute['file'] = '';
        Employee::create($attribute);
        $request->session()->flash('message', 'Employee Create Success');
        $request->session()->flash('class', 'alert alert-success');
        return redirect()->route('employee.create');


    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return BinaryFileResponse
     */
    public function show(Employee $employee): BinaryFileResponse
    {
        return response()->file(public_path($employee->file));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Employee $employee
     * @return Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Employee $employee): RedirectResponse
    {
        if (file_exists(public_path($employee->file)))
        {
            File::delete(public_path($employee->file));
        }
        $employee->delete();
        $request->session()->flash('message', 'User has been Deleted.');
        $request->session()->flash('class', 'alert alert-danger');
        return redirect()->route('employee.create');
    }
}
