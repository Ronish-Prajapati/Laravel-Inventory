<?php

namespace App\Http\Controllers\Auth;
use App\Models\Supplier;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\ServiceProvider\RouteServiceProvider;
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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => 'required|in:Customer,Supplier',
            'phone'=>['required'],
            'address'=> ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
       $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type' => $data['user_type'],
            'phone'=>$data['phone'],
            'address'=>$data['address'],


        ]);

        if ($user->user_type === 'Customer') {
            $user->assignRole('Customer');
            Customer::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);
        } elseif ($user->user_type === 'Supplier') {
            $user->assignRole('Supplier');
            Supplier::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);
        }
        
       
        
        // Trigger the registered event
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        // Redirect to the home page or dashboard
        return redirect('/dashboard');
    }

}
