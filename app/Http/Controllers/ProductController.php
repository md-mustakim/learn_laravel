<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Rating;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
        $data = Product::all();
        return view('welcome', ['products' => $data, 'category' => Category::all()]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:products',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $attributes['image'] = $imageName;

        Product::create($attributes);
        return redirect()->route('product.index')->with('message', 'Create Success');
    }


    public function show(Product $product)
    {
        if ($product->rating()->count('*') > 0)
        {
            $productRating = $product->rating();
            $totalRatingCount =  $productRating->sum('score');
            $ratingCalculate = $totalRatingCount / $productRating->count('*');
            if (gettype($ratingCalculate) === 'integer'){
                $rating = $ratingCalculate;
                $fraction = false;
            }else{
                $rating = number_format($ratingCalculate, 1);
                $fraction = true;
            }
            $currentUserId = Auth::id();
            $checkIfRating = $product->rating()->where('user_id', '=', $currentUserId)->count('*');
            if ($checkIfRating > 0){
                $ratingStatus = true;
            }else{
                $ratingStatus = false;
            }




            $ratingData = array(
                'count' => $productRating->count('*'),
                'rating' => $rating,
                'fraction' => $fraction,
                'status' => $ratingStatus
            );
        }else{

            $ratingData = array(
                'count' => 0,
                'rating' => 0,
                'fraction' => false,
                'status' => false
            );
        }

        return view('product.show', ['productData' => $product, 'rating' => (object)$ratingData]);
    }


    public function edit(Product $product)
    {
        return view('product.edit', ['productData' => $product, 'categories' => Category::all()]);
    }


    public function update(Request $request, Product $product)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'details' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png'
        ]);

   if ($request->hasFile('image')){
            if(file_exists(public_path('images/'. $product->image))){
                File::delete(public_path('images/'.$product->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $attributes['image'] = $imageName;
        }

        $product->update($attributes);
        return redirect()->route('product.index')->with('message', 'Update Success');
    }


    /**
     * @throws Exception
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->rating()->count('*')){
            Rating::where('product_id', '=', $product->id)->delete();
        }
        if (file_exists(public_path('images/'. $product->image))){
            File::delete(public_path('images/'.$product->image));
        }
        $product->delete();
        return redirect()->route('product.index')->with('message', 'Delete Success');
    }


}
