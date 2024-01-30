<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view ('home', compact('products'))
        ->with('i', (request()->input('page',1)-1)*5);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();
        if($image = $request->file('image'))
        {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis').'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        Product::create($input);
        return redirect()->route('home')->with('Success', 'Product created successfully');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $input = $request->all();
        if($image = $request->file('image'))
        {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        else{
            unset($input['image']);
        }

        $product -> update($input);
        return redirect()->route('home')->with('Success', 'Product Updated successfully');
    }

    public function destroy(Product $product)
    {
        $product -> delete();
        return redirect()->route('home')->with('Success', 'Product Deleted successfully');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
}