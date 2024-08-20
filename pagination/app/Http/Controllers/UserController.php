<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
  
class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::paginate(5);  
        return view('users', compact('users'));
    }
}
