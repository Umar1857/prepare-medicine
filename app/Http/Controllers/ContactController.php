<?php

namespace App\Http\Controllers;

use App\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     *
     */
    public function contactus() {
        return view('frontend.contact-us');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('backend.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title'=>'required',
            'description'=>'required',
            'email'=>'nullable',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'SORRY - Please fill out all fields');
        }

        /* Create Contact */
        $contact = Contact::insertGetId([
            'title'=>$request->title,
            'description'=>$request->description,
            'email'=>$request->email ? $request->email : Auth::user()->email,
            'status'=>false,
            'user_id'=>Auth::id(),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            ]);

        if ($contact) {
            return redirect()->back()
                ->with('success', 'SUCCESS - Your Request Has Been Submitted!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        return view('backend.contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return redirect()->route('contact.index');
    }

    public function updateStatus($id){
        $contact = Contact::find($id);
        $contact->status = true;
        $contact->save();

        return redirect()->back()
            ->with('success', 'SUCCESS - Contact Status Has Been Updated!');
    }
}
