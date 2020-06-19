<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Stripe;
use Auth;
use App\User;
use App\RequestFor;
use Carbon\Carbon;

class SubscriptionController extends Controller
{

    //subscription checkout
    public function checkout_stripe($coursrName, $plan){
        return view('frontend.checkout', compact('coursrName', 'plan'));
    }


    //paynow
    public function paynow(Request $request){
        $f = Auth::user()->f_name;
        $s = Auth::user()->s_name;
        $name = $f." ".$s;
        $email = Auth::user()->email;
        $authUserID = Auth::user()->id;
        $randNum = mt_rand(1000, 100000);
        $customer = $randNum.$authUserID;

        $amount = NULL;
        $description = "";
        $user_role = ""; //means subscription plan to access
        $expireDate = NULL; //means subscription plan expire date

        if ($request->plan == 5) {
            //2 & 3 is trail & Refugees Doctors
            //Basic
            $amount = 10;
            $description = "Basic Plan";
            $user_role = 5;
            $expireDate = Carbon::now()->addDays(30);
        }elseif ($request->plan == 6) {
            //Standard
            $amount = 15;
            $description = "Standard Plan";
            $user_role = 6;
            $expireDate = Carbon::now()->addDays(90);
        }elseif ($request->plan == 7) {
            //Advance
            $amount = 30;
            $description = "Advance Plan";
            $user_role = 7;
            $expireDate = Carbon::now()->addDays(180);
        }elseif ($request->plan == 8) {
            //Professional
            $amount = 50;
            $description = "Professional Plan";
            $user_role = 8;
            $expireDate = Carbon::now()->addDays(180);
        }else{
            return redirect()->route('stripe.paynow.status', '1');//means unknown error
        }


        Stripe\Stripe::setApiKey("sk_live_TwiQ6zy2bK4HGkvaW9jOHvDj00yGFG1Z3z");
        $transaction = Stripe\Charge::create ([
                "amount" => $amount * 100,
                "currency" => "GBP",
                "source" => $request->stripeToken,
                "description" => $description,
                "metadata"=>[
                    "customer ID" => $customer,
                    "Name" => $name,
                    "Email" => $email
                ]

        ]);

        $trxID = $transaction->id;
        $status = $transaction->status;
        $customer = $customer;

        if ($status === "succeeded") {
            User::where('id', Auth::user()->id)
                ->update([
                    'role'=>$user_role,
                    'expeir_date'=>date('Y-m-d', strtotime($expireDate)),
                    'trxID'=>$trxID,
                    'customer_id'=>$customer,
                    'amount_paid'=>$amount,
                    'paid_at'=>Carbon::now()
                ]);
            return redirect()->route('stripe.paynow.status', '2');//means success
        }else{
            return redirect()->route('stripe.paynow.status', '3');//means payment fail
        }
    }


    //paynow status
    public function paynow_status($statusID){
        if ($statusID == 1 || $statusID == 2 || $statusID == 3) {
            return view('frontend.paynow-status', compact('statusID'));
        }else{
            return abort(404);
        }

    }


    //subscription_non_payalble
    public function subscription_non_payalble(Request $request){
        if ($request->plan === "trail") {
            if(Auth::user()->free_use_trail == 1){
                //already used
                return redirect()->back()
                    ->with('no_access_permission__', 'You have already used Trial Plan once, please upgrade your plan');
            }else{
                $expireDate = Carbon::now()->addDays(1);
                $updated = User::where('id', Auth::user()->id)
                    ->update([
                        'role'=>2,
                        'expeir_date'=>date('Y-m-d', strtotime($expireDate)),
                        'free_use_trail'=>1,//once time used plan
                        'trxID'=>NULL,
                        'customer_id'=>NULL,
                        'amount_paid'=>NULL,
                        'paid_at'=>NULL
                    ]);
                if ($updated == true) {
                    return redirect()->route('myCurrentSubscription')
                        ->with('success', 'Your Trail Plan has been Activated Successfully');
                }else{
                    return redirect()->back()->with('error', 'Sorry- Something wrong, please try agian');
                }

            }


        }elseif ($request->plan === "refugees_doctors") {
            if (RequestFor::where(['user_id'=>Auth::user()->id, 'status'=>NULL])->exists()) {
                return redirect()->back()->with('no_access_permission__','You have already requested for Refugees Doctors Plan, please keep patience for approval');
            }elseif(Auth::user()->free_use_refugees == 1){
                //already used
                return redirect()->back()
                    ->with('no_access_permission__', 'You have already used Refugees Doctors Plan once, please upgrade your plan');
            }else{
                $created = RequestFor::insert([
                    'user_id'=>Auth::user()->id,
                    'request_for'=>'Refugees Doctors',
                    'created_at'=>Carbon::now(),
                ]);
                if ($created == true) {
                    return back()->with('success_response', 'Your request has been submitted, please wait for approval');
                }else{
                   return redirect()->back()->with('error', 'Sorry- Something wrong, please try agian');
                }
            }



        }else{
            return back();
        }
    }

    //
    public function course_details($courseName){
    	$pageTitle = "";

    	if ($courseName === "PLAB ONE") {
    		$pageTitle = $courseName;
    	}else{
    		//$pageTitle = "UKMLE";
            return view('frontend.underconstruction');
    	}
    	return view('frontend.course-details', compact('pageTitle'));
    }



    //subscribers list for admin
    public function subscriber_list(){
        $data = User::where([
                ['role', '!=', '4'],
                ['role', '>=', '2']
            ])->paginate(30);

        $total_trail = User::where([
                ['role', '=', '2']// 2 trail
            ])->count();

        $total_refugees = User::where([
                ['role', '=', '3']// 3 refugees
            ])->count();

        $total_basic = User::where([
                ['role', '=', '5']// 5 basic
            ])->count();

        $total_standard = User::where([
                ['role', '=', '6']// 6 standard
            ])->count();

        $total_advanced = User::where([
                ['role', '=', '7']// 7 advanced
            ])->count();

        $total_professional = User::where([
                ['role', '=', '8']// 7 professional
            ])->count();

        return view('backend.subscriber-list', compact('data', 'total_trail', 'total_refugees', 'total_basic',
                'total_standard', 'total_advanced', 'total_professional'));
    }

    //subscriptions requests
    public function subscribers_requests(){
        $data = RequestFor::where('status', NULL)
                    ->orderBy('id', 'DESC')
                    ->with('user_info')
                    ->paginate(15);
        return view('backend.requests', compact('data'));
    }
    //request reject
    public function subscribers_requests_reject($id){
        $updated = RequestFor::where('id', $id)->update([
                    'status'=>0, //0 means rejected, null means not approved, 1 means approved
                    'updated_at'=>Carbon::now()
                ]);
        if ($updated == true) {
            return redirect()->back()->with('success', 'Request Rejected Successfully');
        }else{
            return redirect()->back()->with('error', 'SORRY - Something wrong');
        }
    }
    //request approve
    public function subscribers_requests_approve(Request $request){
        $data = RequestFor::where('id', $request->id)->first();
        if ($data) {
            $updated = User::where('id', $data->user_id)
                    ->update([
                        'role'=>3,
                        'expeir_date'=>$request->expire_date,
                        'free_use_refugees'=>1,//once time used plan
                        'trxID'=>NULL,
                        'customer_id'=>NULL,
                        'amount_paid'=>NULL,
                        'paid_at'=>NULL
                    ]);
            if ($updated == true) {
                RequestFor::where('id', $data->id)->update([
                        'status'=>1,
                        'updated_at'=>Carbon::now(),
                    ]);
                return redirect()->back()
                    ->with('success', 'Request Approved Successfully');
            }else{
                return redirect()->back()->with('error', 'SORRY- Something wrong');
            }

        }else{
            return redirect()->back()->with('error', 'SORRY- Request not Found!');
        }

    }



    public function get_registered_users(){
        $data = User::where([
                        ['deleted_at', '=', NULL],
                        ['role', '!=', 4]//4 is admin
                    ])
                    ->with('get_country')
                    ->orderBy('id', 'DESC')->paginate(30);

        return view('backend.users-list', compact('data'));
    }

    public function editSubscriber($id) {
        $subscriber = User::find($id);

        return view('backend.subscriber-edit', compact('subscriber'));
    }

    public function updateSubscriber(Request $request, $id) {

        $validate = Validator::make($request->all(),[
            'f_name'=>'required',
            's_name'=>'required',
            'email'=>'required|email',
            'status'=>'required|in:0,1',
            'extension'=>'required|date',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'SORRY - Please fill out all fields');
        }

        $subscriber = User::find($id);
        $subscriber->f_name = $request->f_name;
        $subscriber->s_name = $request->s_name;
        $subscriber->email = $request->email;
        $subscriber->status = $request->status;
        $subscriber->expeir_date = date('Y-m-d', strtotime($request->extension));
        $subscriber->save();

        return redirect()->route('subscriber_list')->with('success','Subscriber Details Updated Successfully!');
    }

    public function subscriberStatus($id) {
        $subscriber = User::find($id);
        $subscriber->status = $subscriber->status ? false : true;
        $subscriber->save();
        $subscriber->fresh();

        if ($subscriber->status) {
            $msg = 'Subscriber Has been Enabled Successfully!';
        } else {
            $msg = 'Subscriber Has been Disabled Successfully!';
        }

        return redirect()->route('subscriber_list')->with('success', $msg);
    }

    public function deleteSubscriber($id) {
        $subscriber = User::find($id);
        $subscriber->delete();

        return redirect()->route('subscriber_list')->with('success', 'Subscriber has been deleted Successfully!');
    }
}
