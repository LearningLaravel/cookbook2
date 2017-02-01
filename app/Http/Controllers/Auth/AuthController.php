<?php
namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Socialite;
use Auth;
use Illuminate\Http\Request;
use Response;

class AuthController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    public function redirectToFacebook()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function getFacebookCallback()
    {
        $data = Socialite::with('facebook')->user();
        $user = User::where('email', $data->email)->first();
        if (!is_null($user)) {
            Auth::login($user);
            $user->name = $data->user['name'];
            $user->facebook_id = $data->user['id'];
            $user->save();
        } else {
            $user = User::where('facebook_id', $data->user['id'])->first();
            if (is_null($user)) {
                // Create a new user
                $user = new User();
                $user->name = $data->user['name'];
                $user->email = $data->email;
                $user->save();
            }
            Auth::login($user);
        }
        return redirect('/')->with('success', 'Successfully logged in!');
    }

    public function getRegister() {
        return view('auth/ajax_register');
    }

    public function postRegister(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:2',
            'password' => 'required|alphaNum|min:6|same:password_confirmation',
        ]);

        if ($validator->fails()) {
            $message = ['errors' => $validator->messages()->all()];
            $response = Response::json($message,202);
        } else {

            // Create a new user

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'facebook_id' => $request->email
            ]);
            $user->save();

            Auth::login($user);

            $message = ['success' => 'Thank you for joining us!', 'url' => '/', 'name' => $request->name];
            $response = Response::json($message,200);
        }
        return $response;
    }

}