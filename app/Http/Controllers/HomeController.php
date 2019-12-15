<?php

namespace App\Http\Controllers;

use App\Category;
use App\Pick;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pickForm()
    {
        $picks = Pick::where('user_id', Auth::id())->get();
        $categories = Category::with('nominees')->get();
        return view('pick-form', [
            'picks' => $picks,
            'categories' => $categories
        ]);
    }

    public function pick(Request $request)
    {
        $params = $request->only(['category_id', 'nominee_id']);
        $pick = Pick::where('category_id', $params['category_id'])->where('user_id', Auth::id())->first();
        if (!$pick){
            $pick = new Pick;
        }
        $pick->category_id = $params['category_id'];
        $pick->user_id = Auth::id();
        $pick->nominee_id = $params['nominee_id'];
        $pick->save();
        return '';
    }

    public function listUsers()
    {
        return view('list-users', [
            'users' => User::with('picks')->get(),
        ]);
    }
}
