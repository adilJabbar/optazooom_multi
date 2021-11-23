<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\Notification;
use Twilio\Rest\Client;
use Auth;

use Validator;

class RegisterController extends Controller
{

    public function register(Request $request)
    {


    	$gs = Generalsetting::findOrFail(1);
    	// if($gs->is_capcha == 1)
    	// {
	    //     $value = session('captcha_string');
	    //     if ($request->codes != $value){
	    //         return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));    
	    //     }    		
    	// }


        //--- Validation Section

        $rules = [
		        'email'   => 'required|email|unique:users',
		        'password' => 'required|confirmed'
                ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

	        $user = new User;
	        $input = $request->all();        
	        $input['password'] = bcrypt($request['password']);
	        $token = md5(time().$request->name.$request->email);
	        $input['verification_link'] = $token;
	        $input['affilate_code'] = md5($request->name.$request->email);
	        $input['mobile_varification_code'] = rand(100000,999999);
	        $input['mobile_varification_status'] = 0;
	        $input['admin_approval'] = 1;
	          if(!empty($request->vendor))
	          {
					//--- Validation Section
					
					$input['is_vendor'] = 2;

			  }
			 
			$id = $user->fill($input)->save();


		  if(!empty($request->vendor))
          {
          	foreach($request->category as $k => $v)
          	{
          		$dataa['category']  = $v;
				$dataa['user_id'] =  $user->id ;
				$dataa['created_at'] =  date('y:m:d h:i:s') ;
				
          		\DB::table('vendor_category')->insert($dataa);
          	}
				

		  }

	       

            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();

            // Auth::guard('web')->login($user); 
            $this->send_message( $user->phone,$input['mobile_varification_code']);
          	return response()->json(['status'=>1,'id'=>$user->id]);
	        

    }

    public function token($token)
    {
        $gs = Generalsetting::findOrFail(1);

        if($gs->is_verification_email == 1)
	        {    	
        $user = User::where('verification_link','=',$token)->first();
        if(isset($user))
        {
            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();
            Auth::guard('web')->login($user); 
            return redirect()->route('user-dashboard')->with('success','Email Verified Successfully');
        }
    		}
    		else {
    		return redirect()->back();	
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
  
            // dd( 'SMS Sent Successfully.');
  
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

				// if($_POST['forgot_pass']){
				// 	$link_activate = base_url()."login/verify_email/".$data['email_verification_code'];
				// 	$email = $mobile_verification_code = $this->db->get_where('users',['id'=>$id])->row()->email;
				// 	$msg = 'Hi '.$this->db->get_where('users',['id'=>$id])->row()->f_name.', Your password updation link is activated. You can change your password by clicking the below link  
				// 	</br>'.base_url('login/password_update/').$id.'/'.$this->db->get_where('users',['id'=>$id])->row()->password; 
		          
		  //           $email = $this->et->do_email('Optazoom','Optazoom',$email,'Updation Password',$msg);
				// }

			 if($gs->is_verification_email == 1)
	        {
	        $to = $user->email;
	        $subject = 'Verify your email address.';
	        $msg = "Dear Customer,<br> We noticed that you need to verify your email address. <a href=".url('user/register/verify/'.$token).">Simply click here to verify. </a>";
	        //Sending Email To Customer

	        if($gs->is_smtp == 1)
	        {
	        $data = [
	            'to' => $to,
	            'subject' => $subject,
	            'body' => $msg,
	        ];




	        $mailer = new GeniusMailer();
	        $mailer->sendCustomMail($data);
	        }
	        else
	        {
	        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
	        mail($to,$subject,$msg,$headers);
	        }
          	
				$user->mobile_varification_status = 1;
				$user->mobile_varification_code = '';
				$user->update();
				return response()->json(['message'=>'success']);
          		return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.');
				exit;

	        }
	        else {

	        }
				
				// echo json_encode(['message'=>'success']);
				
			}else{
				return response()->json(['message'=>'error']);
				 exit;
			}
		

    }

    public function thank_you()
    {
    	  return view('user.thank_you');
    }
}