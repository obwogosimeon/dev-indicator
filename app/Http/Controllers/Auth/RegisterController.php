<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AccountCreated;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Client;

use App\Organization;
use DB;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        // $messages = [
        //     'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
        //     'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        // ];


        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'account_type' => 'required|string|max:255',
            // 'ruser' => 'required',
            // 'kobouser' => 'required',
            // 'jupyteruser' => 'required',
            'domain_name' => '',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => '',
            'rawpassword' => '',
            'role' => 'required|in:admin',
            // 'g-recaptcha-response' => 'required|captcha'
        ]);


    }


    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    protected function create(array $data)
    {
        $access_code = mt_rand(100000000,999999999);
        $exactpassd = $this->generateRandomString();

        $nextId = Organization::orderBy('id', 'desc')->first()->id + 1;

        if (Organization::where('email', '=', $data['email'])->orWhere('domain_name', '=', $data['domain_name'])->exists()) {
            toastr()->addSuccess('Organization Already Exist!')
            ->positionClass('toast-top-center');
            return back()->with('message', 'Organization Already Exist!');

            } else {

        $user =  User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'account_type' => $data['account_type'],
            'domain_name' => $data['domain_name'],
            'email' => $data['email'],
            'organization_id' => $nextId,
            'password' => Hash::make($exactpassd),
            'rawpassword' => $exactpassd,
        ]);

        if($data['organization_name'] != ''){
            $user->assignRole($data['role']);
        }

           $user->notify(new AccountCreated($user));

            $organization = new Organization();
            $organization->access_code = $access_code;
            $organization->email = $data['email'];
            $organization->organization_name = $data['organization_name'];
            $organization->domain_name = $data['domain_name'];
            $organization->status = '02';
            $organization->organization_level = 'Parent';
            $organization->save();


        }
        toastr()
              ->persistent()
              ->closeButton()
              ->positionClass('toast-top-center')
              ->addSuccess('Organization has been registered successfully. Kindly check your email address for login credentials!');
        return $user;
    }
}
