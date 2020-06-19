<?php

namespace App\Http\Controllers;

use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_members = Team::paginate(20);
        return view('backend.team.index', compact('team_members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.team.create');
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
            'email'=>'required|email|unique:teams,email',
            'description'=>'required',
            'profile'=>'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        //make image
        $submitted_image = $request->file('profile');

        $imgName = "";
        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $team_path = public_path('storage/team');
            } else {
                $team_path = env('STORAGE_PATH').'/team';
            }

            //now check directory
            if (!file_exists($team_path)) {
                mkdir($team_path, 0775, true);
            }

            //now move upload image ok
            $moved = $submitted_image->move($team_path, $img_uniqueName);
            if ($moved) {
                $imgName = $img_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Profile Picture Uploading Problem");
            }
        }

        $team_id = Team::insertGetId([
            'name'=>$request->name,
            'email'=>$request->email,
            'description'=>$request->description,
            'profile'=>$imgName
        ]);

        if ($team_id) {
            return redirect()->route('team-members.index')
                ->with('success', 'SUCCESS - Team Member Has Been Saved Successfully!');
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
        $team_member = Team::find($id);
        return view('backend.team.edit', compact('team_member'));
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
            'email'=>'required|email',
            'description'=>'required',
            'profile'=>'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        //make image
        $submitted_image = $request->file('profile');
        $imgName = "";

        /* Find Team Member */
        $team = Team::find($id);

        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $team_path = public_path('storage/team');
            } else {
                $team_path = env('STORAGE_PATH').'/team';
            }

            //now check directory
            if (!file_exists($team_path)) {
                mkdir($team_path, 0775, true);
            }

            /* Delete File before Uploading New */
            if (file_exists($team_path.'/'.$team->profile)) {
                unlink($team_path.'/'.$team->profile);
            }

            //now move upload image ok
            $moved = $submitted_image->move($team_path, $img_uniqueName);
            if ($moved) {
                $imgName = $img_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Profile Picture Uploading Problem");
            }
        }

        $team->name = $request->name;
        $team->email = $request->email;
        $team->description = $request->description;
        $team->profile = $imgName;
        $team->save();

        return redirect()->route('team-members.index')
            ->with('success', 'SUCCESS - Team Member Has Been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);

        if (file_exists(public_path('storage/team/'.$team->profile))) {
            unlink(public_path('storage/team/'.$team->profile));
        }
        $team->delete();
        return redirect()->route('team-members.index')->with('success', 'SUCCESS - Team Member Has Been Deleted Successfully!');;
    }

    /* Function to Show All the Team Members on Frontend */
    public function ourTeam() {
        $team_members = Team::all();
        return view('frontend.team-page', compact('team_members'));
    }

    public function teamMemberDetails($id) {
        $member = Team::find($id);
        return view('frontend.team-details', compact('member'));
    }
}
