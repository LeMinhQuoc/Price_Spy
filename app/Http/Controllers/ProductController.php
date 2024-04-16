<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all();
   
    return view('home_page', compact('products'));
}
public function addform()
{
    return view('home_page',['is_add'=>true]);
}
public function products()
{
    $product_detail = Product::all();
    return view('home_page',compact('product_detail'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'barcode' => 'required|max:255',
        'sku' => 'required|max:255'
    ]);
    $currentTimestamp = now(); 
    $validatedData['created_at'] = $currentTimestamp;
    $validatedData['updated_at'] = $currentTimestamp;

    $product = Product::create($validatedData);
    return redirect('/products')->with('success', 'Sản phẩm đã được lưu.');
}
public function update(Request $request, Product $product)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'barcode' => 'required|max:255',
        'sku' => 'required|max:255',     
    ]);

    $product->update($validatedData);
    return redirect('/products')->with('success', 'Sản phẩm đã được cập nhật.');
}


public function destroy(Product $product)
{
    $product->delete();
    return redirect('/products')->with('success', 'Sản phẩm đã được xóa.');
}
    
}
