<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) //: Response
    {

        // dd($request->all());
        $auth_index_name = env('AUTH_PHONE_SUPPORT') ? 'email_or_phone' : 'email';
        if (filter_var($request[$auth_index_name], FILTER_VALIDATE_EMAIL)) {

            // dd('in email');
            $fixed_country_code = env('FIXED_COUNTRY_CODE');
            $request->validate([
                'name' => ['required', 'string', 'max:255'],

                'country_code' => $fixed_country_code != '' ? 'nullable' : 'required',

                $auth_index_name => 'required|lowercase|email|max:255|unique:users,email',

                'password' => ['required', 'confirmed', 'min:6'],
            ]);

            $country_code = $fixed_country_code ?? $request->country_code;

            $user = new User;
            $user->name = $request->name;
            $user->country_code = $country_code;
            $user->signup_by = 'both';
            $user->notify_by = 'both';
            $user->phone = $request->phone;
            $user->email = $request[$auth_index_name];
            $user->password = Hash::make($request->password);
            $user->save();

            // dd('completed');

        } else {

            dd('in phone');
            $fixed_country_code = env('FIXED_COUNTRY_CODE');
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'country_code' => $fixed_country_code != '' ? 'nullable' : 'required',
                $auth_index_name => [
                    'required',
                    'regex:/^[0-9]+$/',
                    Rule::unique('users', 'phone')->where(function ($query) {
                        return $query->where('country_code', $fixed_country_code ?? request('country_code'));
                    }),
                ],
                'otp' => ['required', 'integer'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);


            $country_code = $fixed_country_code ?? $request->country_code;


            // $check_otp_query = DB::table('phone_otps')->where([
            //     'country_code'=>$country_code,
            //     'phone' => $request[$auth_index_name], 
            //     'otp' => $request->otp, 
            //     'type' => 'signup'
            // ]);


            // $check_otp =$check_otp_query->first();

            // if ($check_otp!='') 
            // {
            //     $check_otp_query->delete();
            // }
            // else
            // {
            //     return apiResponse($result=false,$message="Invalid OTP",$data=null,$code=201);
            // }


            $user = new User;
            $user->name = $request->name;
            $user->country_code = $country_code;
            $user->signup_by = 'phone';
            $user->notify_by = 'phone';
            $user->phone = $request[$auth_index_name];
            $user->password = null;
            $user->save();
        }

        // event(new Registered($user));

        Auth::login($user);

        // dd('here afte');
        return redirect('/')->with('frontend_success', 'Registered Successfully!');

        // return apiResponse($result=true,$message="Registration Successfull",$data=null,$code=201);
    }
}
