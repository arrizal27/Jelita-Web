<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Kreait\Firebase\Auth as FirebaseAuth;
// use Kreait\Firebase\Exception\FirebaseException;
// use Illuminate\Validation\ValidationException;


use Auth;
use App\User;

class AuthController extends Controller
{
    //
    // use AuthenticatesUsers;
    protected $auth;
    protected $redirect = RouteServiceProvider::HOME;

    public function _const(FirebaseAuth $auth)
    {
        # code...
        $this->middleware('guest')->except('logout');
        $this->auth = $auth;
    }

    // function login 
    public function getlogin(){

        return view('login');
        
    }

    // function login yang kepake
    public function postlogin(Request $request) 
    {
    	if (!\Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    		return redirect()->back();
    	}

    	return redirect()->route('dashboard');
    }

    // jika mau ada register 
    public function getRegister()
    {
    	return view('register');
    }
    public function logout()
    {
        \Auth::logout();

    	return redirect()->route('login');
    }
    public function login(Request $request, $provider)
    {
        # code...
        try{
            $signIn = $this->auth->signInWithEmailPW($request['email'], $request['password']);
            $user = new User($signIn->data());
            $result = Auth::login($user);

            return redirect($this->redirectPath());
       } catch (FirebaseException $e) {

          throw ValidationException::withMessages([$this->username() => [trans('auth.failed')],]);

       }
    }
    public function username()
    {

        return 'email';
    
    }
    public function handleCall(Request $request, $provider)
    {
        $TokenId = $request->input('tokenid', '');
        try{
            $verivtoken = $this->auth->verifyIdToken($socialTokenId);
            $user = new User();
            $user->displayName = $verifiedIdToken->getClaim('name');
            $user->email = $verifiedIdToken->getClaim('email');
            $user->localId = $verifiedIdToken->getClaim('user_id');
            Auth::login($user);
            return redirect($this->redirectPath());
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('login');
         } catch (InvalidToken $e) {
            return redirect()->route('login');
         }
    }
}
