<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Lib;
use Illuminate\Http\Request;

class LibsController extends Controller
{

	// Detectar IP de quem acessa
    private function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
     }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }else{  
      $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  

//echo 'User Real IP Address - '.getIPAddress();
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
            $libs = Lib::where('title', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $libs = Lib::latest()->paginate($perPage);
        }

        return view('libs.index', compact('libs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
    	if($this->getIPAddress()=='127.0.0.1'){
	        return view('libs.create');
        }else{
	        return redirect('libs');
        }
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
        
        Lib::create($requestData);

        return redirect('libs')->with('flash_message', 'Lib added!');
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
        $lib = Lib::findOrFail($id);

        return view('libs.show', compact('lib'));
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
        $lib = Lib::findOrFail($id);

        return view('libs.edit', compact('lib'));
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
        
        $lib = Lib::findOrFail($id);
        $lib->update($requestData);

        return redirect('libs')->with('flash_message', 'Lib updated!');
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
        Lib::destroy($id);

        return redirect('libs')->with('flash_message', 'Lib deleted!');
    }
}
