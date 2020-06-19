<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Subscription::all();
        return view('backend.subscription.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'status'=>'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        $subscription = Subscription::insert(['name' => $request->name, 'description' => $request->description, 'price' => $request->price]);

        return redirect()->route('subscriptions.index')->with('success', 'Plan created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Subscription::find($id);
        return view('backend.subscription.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validate = Validator::make($request->all(),[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'status'=>'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        $subscription = Subscription::find($id);
        $subscription->name = $request->name;
        $subscription->description = $request->description;
        $subscription->price = $request->price;
        $subscription->status = $request->status;
        $subscription->save();

        return redirect()->route('subscriptions.index')->with('success', 'Plan Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Subscription::find($id);
        $plan->delete();

        return redirect()->route('subscriptions.index')->with('success', 'Plan Deleted Successfully!');
    }
}
