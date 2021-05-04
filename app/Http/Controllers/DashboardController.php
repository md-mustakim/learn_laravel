<?php

namespace App\Http\Controllers;

use App\Category;
use App\Employee;
use App\Product;
use App\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $send = array(
            'categories' => Category::all(),
            'employees' => Employee::all(),
            'products' => Product::all(),
            'users' => User::all()
        );
        return view('Dashboard.index', $send);
    }
}
