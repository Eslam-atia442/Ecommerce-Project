<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\services\VerificationServices;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

public  $sms_Services ;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VerificationServices $sms_Services)
    {
        $this->middleware('guest');
        $this-> sms_Services= $sms_Services ;
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
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        try {

            DB::beginTransaction();
            $verification = [];
            $user = User::create([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'password' => Hash::make($data['password']),
            ]);

            // send OTP SMS code
            // set/ generate new code
            $verification['user_id'] = $user->id;
            $verification_data =  $this->sms_Services->setVerificationCode($verification);
            $message = $this->sms_Services->getSMSVerifyMessageByAppName($verification_data -> code );
            //save this code in verifcation table
            //done
            //send code to user mobile by sms gateway   // note  there are no gateway credentails in config file

            # app(VictoryLinkSms::class) -> sendSms($user -> mobile,$message);

            DB::commit();
            return  $user;
            //send to user  mobile
        }catch(\Exception $ex){
            DB::rollback();
        }



    // اول حاجه نكريت رقم عشوائي
    // نسجله في الداتا بيز
    // نبعت رساله لرقم الموبيل




}
}
