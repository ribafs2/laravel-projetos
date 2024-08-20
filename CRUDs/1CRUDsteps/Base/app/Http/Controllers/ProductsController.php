<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(5);
      
        return view('products.index',compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {        
        $requestData = $request->all();        
        Product::create($requestData);

        return redirect('products');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {        
        $requestData = $request->all();        
        $product = Product::findOrFail($id);
        $product->update($requestData);

        return redirect('products');
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('products');
    }
}
