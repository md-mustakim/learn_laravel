<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
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
        $data = Product::all();
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

        $productModel = new Product();
        $productModel->name = $request->name;
        $productModel->details = $request->details;
        $productModel->category_id = $request->category_id;
        $productModel->image = $imageName;
        $productModel->save();
        return redirect()->route('product.index')->with('message', 'Create Success');
    }


    public function show(Product $product)
    {
        $productShowData = Product::findOrFail($product->id);
        return view('product.show', ['productData' => $productShowData]);
    }


    public function edit(Product $product)
    {
        return view('product.edit', ['productData' => $product, 'categories' => Category::all()]);
    }


    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:products,name,'.$product->id,
            'details' => 'required'
        ]);
        $productModel = Product::findOrFail($product->id);
        $productModel->name = $request->name;
        $productModel->details = $request->details;
        $productModel->save();
        return redirect()->route('product.index')->with('message', 'Update Success');
    }


    public function destroy(Product $product): RedirectResponse
    {
        $productModel = product::findOrFail($product->id);
        unlink(public_path('images/'.$productModel->image)); // delete file also
        $productModel->delete();
        return redirect()->route('product.index')->with('message', 'Delete Success');
    }
}
