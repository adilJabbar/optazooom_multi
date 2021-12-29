<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Hash;
use Session;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function indexx()
    {
         return view('front.lock_user');
    }
    public function loginn(Request $request)
    {

        //--- Validation Section

        $rules = [
                  'email'   => 'required|email',
                  'password' => 'required'
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

      // Attempt to log the user in
        $user = User::where('email',$request->email)->where('is_vendor',3)->first();

        if(isset( $user->password))
        {
              if (!Hash::check($request->password, $user->password)) {

            return redirect()->back()->with('error','Credentails are not matched');
          }else{

            \DB::table('users')->where('is_vendor',3)->update(['status'=>1]);

             return redirect()->route('front.indexx');
          }
        }else{
          return redirect()->back()->with('error','Credentails are not matched');
        }





      if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location

        // Check If Email is verified or not

         if(Auth::guard('web')->user()->mobile_varification_status   == '' || Auth::guard('web')->user()->mobile_varification_status   == 0)
          {
            Auth::guard('web')->logout();
            return response()->json(array('errors' => [ 0 => 'You phone is not verified' ]));
          }

          if(Auth::guard('web')->user()->admin_approval   == '' || Auth::guard('web')->user()->admin_approval   == 0)
          {
            Auth::guard('web')->logout();
            return response()->json(array('errors' => [ 0 => 'You are not approved by admin' ]));
          }



          if(Auth::guard('web')->user()->email_verified == 'No')
          {
            Auth::guard('web')->logout();
            return response()->json(array('errors' => [ 0 => 'Your Email is not Verified!' ]));
          }

          if(Auth::guard('web')->user()->ban == 1)
          {
            Auth::guard('web')->logout();
            return response()->json(array('errors' => [ 0 => 'Your Account Has Been Banned.' ]));
          }

          // Login Via Modal
          if(!empty($request->modal))
          {
             // Login as Vendor
            if(!empty($request->vendor))
            {
              if(Auth::guard('web')->user()->is_vendor == 2)
              {
                return response()->json(route('vendor-dashboard'));
              }
              else {
                return response()->json(route('user-package'));
                }
            }
          if(Auth::guard('web')->user()->is_vendor == 2 || Auth::guard('web')->user()->is_vendor == 1)
          {
            Auth::guard('web')->logout();
            return response()->json(array('errors' => [ 0 => 'Your are not Practitioner.' ]));
          }
          // Login as User
          return response()->json(1);
          }
          // Login as User
          return response()->json(route('user-dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
          return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));
    }
}
