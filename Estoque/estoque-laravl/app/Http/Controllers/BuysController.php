<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buy;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class BuysController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $buys = Buy::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $buys = Buy::latest()->paginate($perPage);
        }

        return view('buys.index', compact('buys'));
    }

    public function create()
    {
    	$products = Product::all();
        return view('buys.create', compact('products'));
    }

    public function store(Request $request)
    {        
        $requestData = $request->all();
        
		// Somar a compra nos inventories/estoques
		$inventories = new Inventory;
		$count = $inventories->count();

        // Para que consiga cadastrar as vendas no inventories, preciso inserir o registro atual, caso count=0
		if($count == 0){
			DB::table('inventories')->insert([
				'product_id' => $request->product_id,
				'quantity' => $request->quantity
			]);
		}

        $inventories = new Inventory;
        foreach($inventories::all() as $inventory){
	 		if($count >= 1){
	 			$inventory->product_id = $request->product_id;
	 			$inventory->quantity = $inventory->quantity + $request->quantity;
				$inventory->save();		
			}
		}

        //Inventory::create($requestData);
        Buy::create($requestData);

        return redirect('buys')->with('flash_message', 'Buy added!');
    }

    public function show($id)
    {
        $buy = Buy::findOrFail($id);
        return view('buys.show', compact('buy'));
    }

    public function edit($id)
    {
       	$products = Product::all();
        $buy = Buy::findOrFail($id);
        return view('buys.edit', compact('buy', 'products'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();        
        $buy = Buy::findOrFail($id);
        $buy->update($requestData);

        return redirect('buys')->with('flash_message', 'Buy updated!');
    }

    public function destroy($id)
    {
        Buy::destroy($id);
        return redirect('buys')->with('flash_message', 'Buy deleted!');
    }
}
