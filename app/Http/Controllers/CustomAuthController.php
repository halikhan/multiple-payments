<?php
namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function index()
    {
        // dd('Your payment');
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function stripemenuMenu()
    {
        if(Auth::check()){
            return view('stripemenu');
        }

        // return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function paypalMenu()
    {
        if(Auth::check()){
            return view('paypalmenue');
        }

        // return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function paypalsinglepaymentMenu()
    {
        if(Auth::check()){
            return view('singlepaypalpaymentmenue');
        }

        // return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function paypalPlansMenu()
    {
        if(Auth::check()){
            return view('paypalplanspayment');
        }

        // return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
    public function logOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
