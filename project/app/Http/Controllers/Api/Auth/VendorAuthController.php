<?php

namespace App\Http\Controllers\Api\Auth;

use App\{
    Models\User,
    Models\Generalsetting
};

use App\{
    Http\Controllers\Controller,
    Http\Resources\UserResource
};

use Illuminate\Http\Request;
use Validator;
use Twilio\Rest\Client;
class VendorAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','verify_otp']]);
        $this->middleware('setapi');
    }

    public function register(Request $request)
    {
      try{
        $rules = [
            'first_name'     => 'required',
            'email'        => 'required|email|unique:users',
            'phone'        => 'required',
            'shop_name'        => 'required',
            'country'        => 'required',
            'vendor'        => 'required',
            'password'        => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }

        $gs = Generalsetting::first();

        $user = new User;
        $user->name = $request->first_name;
        $user->l_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->shop_name = $request->shop_name;
        $user->website = $request->website;
        $user->hear_from = $request->hear_from;
        $user->country = $request->country;


        $user->mobile_varification_status = '0';

        if(!empty($request->vendor))
        {
              $user->is_vendor = 2;

        }else{
            $user->is_vendor = 1;
        }
        $user->admin_approval =  1;
        $user->email_verified = 'no';
        $token = md5(time().$request->first_name.$request->email);
        $user->verification_link = $token;
        $user->affilate_code = md5($request->name.$request->email);
        $user->mobile_varification_code = rand(100000,999999);
        $user->mobile_varification_status = 0;
        $user->email_verified = 'Yes';
        $this->send_message( $user->phone, $user->mobile_varification_code);
        $user->save();
        auth()->login($user);

        return response()->json(['status' => true, 'data' => new UserResource($user), 'error' => []]);
      }
      catch(\Exception $e){
        return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
      }
    }

    private function send_message($reciever_number,$vcode)
    {
    	$message = "OptaZoom verification code: ".$vcode;
      	// $recipients = '+923099481244';
       	$account_sid = getenv("TWILIO_SID");

        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
       // dd($client);
          try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_NUMBER");


            $client = new Client($account_sid, $auth_token);
           $clientt =  $client->messages->create($reciever_number, [
                'from' => $twilio_number,
                'body' => $message]);


        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
        // $msg = $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }

    public function verify_otp(Request $request)
    {

    	$id = $request->get('id');
    	$gs = Generalsetting::findOrFail(1);
    		$user = User::find($id);
			$otp_number = $request->get('first').$request->get('second').$request->get('third').$request->get('fourth').$request->get('fifth').$request->get('sixth');
            $token = $user->verification_link;
            $mobile_verification_code = $user->mobile_varification_code;
			if($otp_number == $mobile_verification_code )
			{


				$user->mobile_varification_status = 1;
				$user->mobile_varification_code = '';
				$user->update();
                return response()->json(['status' => true, 'data' => new UserResource($user), 'error' => []]);
                exit;


                return response()->json(['status' => true, 'data' => [], 'error' => ['message' => 'Otp not correct']]);
				 exit;

			}else{
				return response()->json(['message'=>'error']);
				 exit;
			}


    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
      try{
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
          return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "Email / password didn't match."]]);
        }

        if(auth()->user()->email_verified == 'No')
        {
          auth()->logout();
          return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Your Email is not Verified!']]);
        }

        if(auth()->user()->ban == 1)
        {
          auth()->logout();
          return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Your Account Has Been Banned.']]);
        }

        if(auth()->user()->is_vendor == 0)
        {
          auth()->logout();
          return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'You don\'t have the permission to access this section.']]);
        }

        return response()->json(['status' => true, 'data' => ['token' => $token, 'user' => new UserResource(auth()->user())], 'error' => []]);
      }
      catch(\Exception $e){
        return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
      }
    }

}
