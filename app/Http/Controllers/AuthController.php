<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $isExistedUser = User::where('username',$username)->first();
        if($isExistedUser)
        {
            if(strcmp($isExistedUser->password,$password) == 0)
            {
                Cookie::queue(Cookie::make('id',$isExistedUser->id));
                return redirect()->route('product.show');
            }
            return redirect()->back()->with('status','Wrong username/password')->withInput();
        }
        else{
            return redirect()->back()->with('status','Wrong username/password');
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
//            return redirect()->back()->with('status','Register successfully');
            Cookie::queue(Cookie::make('id',$user->id));
            return redirect()->route('product.show');
        }

    }
}
