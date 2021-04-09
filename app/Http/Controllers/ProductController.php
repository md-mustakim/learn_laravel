<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
        $data = product::all();
        return view('welcome', ['productData' => $data, 'category' => $this->defaultCategory()]);
    }

    public function defaultCategory(): array{
        return array(
            '1' => 'I Phone',
            '2' => 'Samsung',
            '3' => 'Nokia',
            '4' => 'Oppo',
            '5' => 'Xaiomi',
            '6' => 'Realme'
        );
    }


    public function create()
    {
        return view('product.create', ['category' => $this->defaultCategory()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:products',
            'details' => 'required'
        ]);
        $productModel = new product();
        $productModel->name = $request->name;
        $productModel->details = $request->details;
        $productModel->category = $request->category;
        $productModel->save();
        return redirect()->route('product.index')->with('message', 'Create Success');
    }


    public function show(product $product)
    {
        $productShowData = product::findOrFail($product->id);
        return view('product.show', ['productData' => $productShowData]);
    }


    public function edit(product $product)
    {
        $productShowData = product::findOrFail($product->id);
        return view('product.edit', ['productData' => $productShowData]);
    }


    public function update(Request $request, product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:products,name,'.$product->id,
            'details' => 'required'
        ]);
        $productModel = product::findOrFail($product->id);
        $productModel->name = $request->name;
        $productModel->details = $request->details;
        $productModel->save();
        return redirect()->route('product.index')->with('message', 'Update Success');
    }


    public function destroy(product $product): RedirectResponse
    {
        $productModel = product::findOrFail($product->id);
        $productModel->delete();
        return redirect()->route('product.index')->with('message', 'Delete Success');
    }
}
