<?php
//TODO
namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Termwind\render;

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

    public function register()
    {
        return Inertia::render('auth');
    }
    public function index()
    {
        return Inertia::render('Home');
    }

    public function profile()
    {
        $user = auth()->user();

        return Inertia::render('Profile/Profile', [
            'user' => new UserResource($user)
        ]);
    }

}
