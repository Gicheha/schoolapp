<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Overrides the authenticated method
     *
     */
    public function authenticated(Request $request, $user)
    {
        if($user->status == false){
            auth()->logout();
            return back()->with("warning", "you need to confirm your account. We have sent you an activation code on your email account");
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     *
     * Redirect the User to the Google Authentication Page
     *
     * @return \Illuminate\Http\Response
     */

    public function redirectToProvider(){
        return Socialite::driver('google')->redirect();
    }

    /***
     * Obtain User Information from Google
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(){
        try{
            $user = Socialite::driver('google')->user();
        }catch(\Exception $e){
            return redirect('home');
        }

        //Check for Existing Users
        $existingUser = User::where('email',$user->email)->first();

        if ($existingUser){
            //log them in
            auth()->login($existingUser, true);
        }else{
            //Create new user
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->role            = "Student";
            $newUser->password        = $newUser->name;
            $newUser->save();
            auth()->login($newUser, true);
        }

        return redirect()->to('/home');
    }

}
