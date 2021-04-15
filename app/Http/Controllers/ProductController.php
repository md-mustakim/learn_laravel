<?php

namespace App\Http\Controllers;

use App\Category;
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
        return view('welcome', ['productData' => $data, 'category' => Category::all()]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:products',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $productModel = new product();
        $productModel->name = $request->name;
        $productModel->details = $request->details;
        $productModel->category_id = $request->category_id;
        $productModel->image = $imageName;
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
        unlink(public_path('images/'.$productModel->image)); // delete file also
        $productModel->delete();
        return redirect()->route('product.index')->with('message', 'Delete Success');
    }
}
