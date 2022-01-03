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
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use JWTAuth;
use App\Classes\GeniusMailer;
use Twilio\Rest\Client;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'logout','social_login','forgot','forgot_submit','verify_otp']]);
        $this->middleware('setapi');
    }

    public function register(Request $request)
    {
      try{
        $rules = [
            'first_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required'
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
        $user->work_phone = $request->work_phone;
        $user->company = $request->company;
        $user->hear_from = $request->hear_from;

        $user->password = bcrypt($request->password);
        $token = md5(time().$request->name.$request->email);
        $user->verification_link = $token;
        $user->affilate_code = md5($request->name.$request->email);
        $user->mobile_varification_code = rand(100000,999999);
        $user->mobile_varification_status = 0;
        $user->admin_approval = 1;

        $user->email_verified = 'Yes';


        // dd($user);
        $user->save();
        $this->send_message( $user->phone,$user->mobile_varification_code);
        // $token = auth()->login($user);

        return response()->json(['status' => true, 'data' => [ 'user' => new UserResource($user)], 'error' => []]);
      }
      catch(\Exception $e){
        return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
      }
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

        return response()->json(['status' => true, 'data' => ['token' => $token, 'user' => new UserResource(auth()->user())], 'error' => []]);
      }
      catch(\Exception $e){
        return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
      }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function social_login(Request $request)
    {
      try{
        $rules = [
            'name' => 'required',
            'email' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
        }

        $user = User::where('email','=',$request->email)->first();

        if(!$user){

                    $rules = [
                        'email' => 'email|unique:users'
                    ];

                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                      return response()->json(['status' => false, 'data' => [], 'error' => $validator->errors()]);
                    }

                   $user = new User;
                   $user->name = $request->name;
                   $user->email = $request->email;
                   $user->email_verified = 'Yes';
                   $user->affilate_code = md5($request->email);
                   $user->save();

                   $token = auth()->login($user);
                   return response()->json(['status' => true, 'data' => ['token' => $token], 'error' => []]);

        }

        $userToken = JWTAuth::fromUser($user);

        if($user->email_verified == 'No')
        {
          return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Your Email is not Verified!']]);
        }

        if($user->ban == 1)
        {
          return response()->json(['status' => false, 'data' => [], 'error' => ["message" => 'Your Account Has Been Banned.']]);
        }

        auth()->login($user);

        return response()->json(['status' => true, 'data' => ['token' => $userToken,  'user' => new UserResource(auth()->user())], 'error' => []]);

      }
      catch(\Exception $e){
        return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
      }
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
      try{
        return response()->json(['status' => true, 'data' => new UserResource(auth()->user()), 'error' => []]);
      }
      catch(\Exception $e){
        return response()->json(['status' => true, 'data' => [], 'error' => ['message' => $e->getMessage()]]);
      }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['status' => true, 'data' => ['message' => 'Successfully logged out.'], 'error' => []]);
    }

    public function sendVerificationCode(Request $request) {
      $gs = Generalsetting::first();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 300
        ]);
    }



   public function forgot(Request $request){
        $gs = Generalsetting::findOrFail(1);
       $user = User::where('email',$request->email)->first();
       if($user){

        $token = Str::random(6);

        $subject = "Reset Password Request";
        $msg = "Your Forgot Password Token: ".$token;
        $user->reset_token = $token;
        $user->update();

        if($gs->is_smtp == 1)
          {
              $data = [
                      'to' => $request->email,
                      'subject' => $subject,
                      'body' => $msg,
              ];

              $mailer = new GeniusMailer();
              $mailer->sendCustomMail($data);
          }
          else
          {
              $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
              mail($request->email,$subject,$msg,$headers);
          }

        return response()->json(['status' => true, 'data' => ['user_id' => $user->id,'reset_token' => $user->reset_token], 'error' => []]);

       }else{
            return response()->json(['status' => false, 'data' => [], 'error' => 'Account not found']);
       }

    }


    public function forgot_submit(Request $request){

        if($request->new_password != $request->confirm_password){
            return response()->json(['status' => false, 'data' => [], 'error' => 'New password & confirm password not match']);
        }

        $user = User::where('id',$request->user_id)->where('reset_token',$request->reset_token)->first();
        if($user){

           $password = Hash::make($request->new_password);
           $user->password = $password;
           $user->reset_token = null;
           $user->update();
           return response()->json(['status' => true, 'data' => ['message' => 'Password Changed Successfully'], 'error' => []]);

        }else{
            return response()->json(['status' => false, 'data' => [], 'error' => 'Something is wrong']);
        }
    }




}
