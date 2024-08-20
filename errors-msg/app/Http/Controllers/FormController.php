<?php 
namespace App\Http\Controllers;
      
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
     
class FormController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('createUser');
    }
          
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'password' => 'required|min:5',
                'email' => 'required|email|unique:users'
            ], [
                'name.required' => 'O campo nome é obrigatório.',
                'password.required' => 'Password field is required.',
                'email.required' => 'Email field is required.',
                'email.email' => 'Email field must be email address.'
            ]);
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
              
        return back()->with('success', 'User created successfully.');
    }
}
