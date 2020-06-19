<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Auth::user()->ticket;
        return view('frontend.Ticket.tickets', compact('tickets'));
    }

    public function backendIndex()
    {
        /* For Admin Ticket Listing */
        $tickets = Ticket::paginate(30);
//        dd($tickets);
        return view('backend.ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.Ticket.create-ticket');
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
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        $ticket = Ticket::create(['title' => $request->title, 'description' => $request->description, 'status' => false, 'user_id' => Auth::id()]);

        return redirect()->route('ticket.index')->withSuccess('Your Ticket has been Submitted Successfully!!');
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
        //
    }

    public function updateStatus($id) {
        $ticket = Ticket::find($id);
        $ticket->status = $ticket->status ? false : true;
        $ticket->save();
        $ticket->fresh();

        if ($ticket->status) {
            $msg = 'Ticket has been Resolved!';
        } else {
            $msg = 'Ticket has been Disintegrated!';
        }

        return redirect()->route('admin-tickets')->with('success', $msg);
    }

    public function showTicket($id) {
        $ticket = Ticket::find($id);
        return view('backend.ticket.view', compact('ticket'));
    }
}
