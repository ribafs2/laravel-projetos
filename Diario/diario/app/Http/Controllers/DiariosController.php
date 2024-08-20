<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Diario;
use Illuminate\Http\Request;

class DiariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $diarios = Diario::where('dia', 'LIKE', "%$keyword%")
                ->orWhere('texto', 'LIKE', "%$keyword%")            
                ->latest()->paginate($perPage);
        } else {
            $diarios = Diario::latest()->paginate($perPage);
        }

        return view('diarios.index', compact('diarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('diarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {        
        $requestData = $request->all();
		try {
			Diario::create($requestData);
		} catch (\PDOException $e) {
			$existingkey = "Integrity constraint violation: 1062 Duplicate entry";
			if (strpos($e->getMessage(), $existingkey) !== FALSE) {
				return redirect('diarios')->with('danger','Este dia já foi cadastrado.');        		
			} else {
				throw $e;
			}
		}        

        return redirect('diarios')->with('success', 'Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $diario = Diario::findOrFail($id);

        return view('diarios.show', compact('diario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $diario = Diario::findOrFail($id);

        return view('diarios.edit', compact('diario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $diario = Diario::findOrFail($id);
        $diario->update($requestData);

        return redirect('diarios')->with('primary', 'Alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Diario::destroy($id);

        return redirect('diarios')->with('danger2', 'Excluído com sucesso!');
    }
}
