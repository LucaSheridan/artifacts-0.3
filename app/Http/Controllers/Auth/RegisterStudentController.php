<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterStudentController extends Controller
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
     * Show student registration form.
     *
     * @param  array  $data
     * @return User
     */

    protected function showRegistrationForm()
    {
        return view('auth.registerStudent');
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
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'code' => 'required|exists:sections,code',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        // Create new user 

            $user = new User;

            $user->firstName = $data['firstName'];
            $user->lastName = $data['lastName'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

             // Set user role to student

            $user->roles()->attach('1');

            // Check to see if section code is supplied

            if(! is_null($data['code']) )
            
            {
                
                $code = $data['code'];

                // Use code to look up section and site

                $section = Section::where('code', $code)->first();

                // Enroll student in section

                $user->sections()->attach($section->id);
                
                // Enroll student at site

                $user->sites()->attach($section->site_id);

            }

            else

            {
                // Probably should fire off an error here.   
            }

            return $user;
        }

}
