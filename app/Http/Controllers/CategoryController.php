<?php

namespace App\Http\Controllers;

use App\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    public function index()
    {
        return view('category.index');
    }


    public function create()
    {
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'details' => 'required'
        ]);
        $attribute = array(
            'name' => $request->input('name'),
            'details' => $request->input('details')
        );
        Category::create($attribute);
        return redirect()->route('category.create')->with('message', 'category crate success');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Request $request, Category $category): RedirectResponse
    {
       $category->delete();
       $request->session()->flash('message', 'Delete Success');
       return back();
    }
}
