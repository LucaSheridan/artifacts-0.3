<?php

namespace App\Http\Controllers\Auth;

use App\Site;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterTeacherController extends Controller
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
     * Show teacher registration form.
     *
     * @param  array  $data
     * @return User
     */

    protected function showRegistrationForm()
    {
        // get information to populate the Sites selction dropdown.

        $sites = Site::all()->pluck('name','id');

        return view('auth.registerTeacher')->with('sites', $sites);
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
            'selectExistingSite' => 'required_without:createNewSite',
            'createNewSite' => 'required_without:selectExistingSite',
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
           
            // Set user role to Teacher
        
            $user->roles()->attach('2');

            // Check for data from dropdown menu.
        
            if(! is_null($data['selectExistingSite']) )
            
            {
                $site = $data['selectExistingSite'];

                // Attach site from dropdown menu
                
                $user->sites()->attach($site);
            }

            else

            {
                // Create new site
                
                $site = New Site;
                
                // Set new site name
                
                $site->name = $data['createNewSite'];
                $site->save();

                // Attach user to site
                
                $user->sites()->attach($site->id);

            }

            return $user;
    }

}
