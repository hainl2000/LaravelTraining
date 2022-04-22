<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    //
    public function auth(AuthRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        switch ($request->input('submit-auth-form')){
            case 'login':
                return $this->postLogin($username,$password);
            case 'register':
                return $this->postRegister($username,$password);
            default:
                echo "wrong form";
        }
    }

    public function postLogin($username,$password)
    {
//        $isExistedUser = User::where('username',$username)->first();
//        if($isExistedUser)
//        {
//            if(strcmp($isExistedUser->password,$password) == 0)
//            {
//                Cookie::queue(Cookie::make('id',$isExistedUser->id));
//                return redirect()->route('product.show');
//            }
//            return redirect()->back()->with('status','Wrong username/password')->withInput();
//        }
//        else{
//            return redirect()->back()->with('status','Wrong username/password');
//        }
        if(Auth::attempt(array('username' => $username, 'password' => $password)))
        {
            return redirect()->route('product.show');
        }
        else{
            return redirect()->back()->with('status','Wrong username/password')->withInput();
        }
    }

    public function postRegister($username, $password)
    {
        $user = User::where('username',$username)->first();
        if($user)
        {
            return redirect()->back()->with('status','Username is existed');
        }
        else{
            $newUser = new User();
            $newUser->username = $username;
            $newUser->password = $password;
            $newUser->save();
            event(new Registered($newUser));
            auth()->login($newUser);

            return redirect('/email/verify');
//            Cookie::queue(Cookie::make('id',$newUser->id));
//            return redirect()->route('product.show');
        }

    }
}
