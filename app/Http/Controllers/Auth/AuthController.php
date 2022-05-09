<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;



class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        if (!Auth::check()) {
            return view('auth.registration');
        }
        return redirect('dashboard')->withSuccess('Ya estas registrado');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $remenbered = $request->filled('remember');

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $remenbered)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $check = $this->create($data);
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function postRegistrationManual(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $new = $this->create($data);
        return redirect("dashboard")->withSuccess('Usuario ', $new->name, ' agregado con exito');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */

    public function dashboard()
    {
        if (Auth::check()) {
            $usersdb = User::all();
            return view('dashboard', compact('usersdb'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)

    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function userDestroy($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        if (Auth::user()->id == $id) {
            return redirect('dashboard')->withSuccess('No puedes eliminarte a ti mismo');
        }
        $note = User::findOrFail($id);
        $note->delete();
        return redirect('dashboard');
    }
}
