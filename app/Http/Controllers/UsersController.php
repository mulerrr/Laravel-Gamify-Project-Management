<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use App\Presence;
use App\PresenceUser;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(Auth::check()){

            $presences = Presence::all();
            $userProgrammers = User::where('status', 'active')->where('role_id', 2)->orderBy('name', 'asc')->get();
            $userClients = User::where('role_id', 3)->orderBy('name', 'asc')->get();
            $userCount = User::all()->count();

            return view('users.index', ['presences' => $presences], ['userProgrammers' => $userProgrammers])->with(['userClients' => $userClients])->with(['userCount' => $userCount]);
        }

        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $user = User::create([
                'name'        => $request->input('name'),
                'username'    => $request->input('username'),
                'email'       => $request->input('email'),
                'description' => $request->input('description'),
                'position'    => $request->input('position'),
                'role'        => $request->input('role'),
                'status'      => $request->input('status'),
                'password'    => bcrypt($request->input('password')),
            ]);

            if($user){
                return redirect()->route('users.index')->with('success', 'User created successfully');
            }
        }

        return back()->withInput()->with('errors', 'Error creating new User');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //$company = Company::where('id', $company->id)->first();
        $user = User::find($user->id);

        return view('users.show', ['user'=>$user]);
    }

    public function performanceDetail($user_id)
    {
        $user = User::find($user_id);

        //initialize current date
        $date = \Carbon\Carbon::now();

        //variables for presence calculation
        $previousMonth     = $date->subMonth()->format('F');
        $currentYear       = $date->format('Y');
        $presenceName      = $previousMonth . $currentYear;
        
        //variables for presence task points
        $fromDate = new Carbon('first day of last month');
        $toDate   = new Carbon('last day of last month');

        //top counter
        $totalTask = Task::where('user_id', $user_id)->whereBetween('created_at', [ $fromDate, $toDate])->count();
        $totalTaskFinish = Task::where('user_id', $user_id)->where('status', 'done')->whereBetween('created_at', [ $fromDate, $toDate])->count();
        $totalTaskInProgress = Task::where('user_id', $user_id)->where('status', 'In Progress')->whereBetween('created_at', [ $fromDate, $toDate])->count();
        $totalTaskNew = Task::where('user_id', $user_id)->where('status', 'new')->whereBetween('created_at', [ $fromDate, $toDate])->count();

        //performance percentage
        $doneTasks    = Task::whereBetween('created_at', [ $fromDate, $toDate])->where('user_id', $user_id)->where('status', 'done')->get();
        $inProgressTasks    = Task::whereBetween('created_at', [ $fromDate, $toDate])->where('user_id', $user_id)->where('status', 'in progress')->get();
        $totalPoints  = $doneTasks->sum('points');//total poin yg didapat
        $presence     = Presence::where('name', $presenceName)->where('user_id', $user_id)->first();

        //performance percentage calculation
        $totalDays    = $presence->days;
        $targetPoints = $totalDays * 2;
        $performancePercentage = (int)(($totalPoints/$targetPoints) * 100);

        //total hari project development
        $developmentDays = $this->getTotalHour($user_id);

        //total presence
        $months = $this->getMonthList();
        $presenseLists = Presence::where('user_id', $user_id)->limit(4)->orderBy('id', 'desc')->get();

        //Bottom Table Date
        $lastMonthName = $previousMonth . ' ' . $currentYear;
        
        return view('users.performanceDetail', ['user'=>$user])->with(['totalTask' => $totalTask])->with(['totalTaskFinish' => $totalTaskFinish])->with(['totalTaskInProgress' => $totalTaskInProgress])->with(['totalTaskNew' => $totalTaskNew])->with(['performancePercentage' => $performancePercentage])->with(['totalPoints' => $totalPoints])->with(['targetPoints' => $targetPoints])->with(['totalDays' => $totalDays])->with(['lastMonthName' => $lastMonthName])->with(['developmentDays' => $developmentDays])->with(['doneTasks' => $doneTasks])->with(['inProgressTasks' => $inProgressTasks])->with(['months' => $months])->with(['presenseLists' => $presenseLists]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    
    public function edit(User $user)
    {
        //passing parameter id ke halaman companies/edit
        $user = User::find($user->id);

        return view('users.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {


        // if($request->hasFile('avatar')){
        //   if($user->avatar != NULL){
        //     unlink(public_path($user->avatar));
        //   }

        //   // $avatar = $request->file('avatar')->store(public_path('/images/avatar'));
        //   // dd($avatar);
          
        //   $input = $request->all();
        //   $input['avatar'] = $user->avatar;

        //   $input['avatar'] = '/images/avatar/'.str_slug($input['name'], '-') . '.' . $request->avatar->getClientOriginalExtension();
        //   //dd($input['avatar']);
        //   $request->avatar->move(public_path('/images/avatar'), $input['avatar']);

          
        // }

        //save data
        $userUpdate = User::where('id', $user->id)
                                ->update([
                                    'name' => $request->input('name'),
                                    'username' => $request->input('username'),
                                    'position' => $request->input('position'),
                                    'email' => $request->input('email'),
                                    'description' => $request->input('description')
                                    //'avatar' => $input['avatar']
                                ]);

        if($userUpdate){
            return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Your profile updated successfully');
        }

        //redirect
        return back()->withInput();
    }

    public function userUpdate(Request $request, User $user)
    {
        $input = $request->all();
        $id = $request->input('id');
        $userUpdate = User::where('id', $id)
                                ->update([
                                    'role_id' => $request->input('role')
                                ]);

        if($userUpdate){
            return redirect()->route('users.index')->with('success', 'User role updated successfully');
        }

        return redirect()->route('users.index')->with('errors', 'User role failed to update!!');
    }

    public function userInactive(Request $request, User $user)
    {
        $input = $request->all();
        $id = $request->input('id');
        $userUpdate = User::where('id', $id)
                                ->update([
                                    'status' => $request->input('status')
                                ]);

        if($userUpdate){
            return redirect()->route('users.index')->with('success', 'User has been inactivated');
        }

        return redirect()->route('users.index')->with('errors', 'User failed to inactivated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function changeAvatar(Request $request, User $user){

        $input = $request->all();
        $input['avatar'] = $user->avatar;

        $input['avatar'] = '/images/avatar/'.str_slug($input['name'], '-') . '.' . $request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('/images/avatar'), $input['avatar']);

        $userUpdate = User::where('id', Auth::user()->id)
                                ->update([
                                    'avatar' => $input['avatar']
                                ]);

        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Avatar updated successfully');
    }

    public function getTotalHour($user_id){
        // $lateDays = 0;

        //variables for presence task points
        $fromDate = new Carbon('first day of last month');
        $toDate   = new Carbon('last day of last month');

        // $tasks = Task::where('user_id', $user_id)->where('status', 'done')->whereBetween('created_at', [ $fromDate, $toDate])->get();

        // foreach ($tasks as $task) {
        //     $start = $task->created_at;
        //     $end   = $task->finished_at;
        // }

        //initiate diff days
        $totalDiffDays = 0;

        $tasks = Task::where('user_id', $user_id)->where('status', 'done')->whereBetween('created_at', [ $fromDate, $toDate])->get();

        foreach ($tasks as $task) {
            //calculate diff days without week end
            $intervalDateDaysWithoutWeekEnd = $task->created_at->diffInDaysFiltered(function(Carbon $date) {
              return !$date->isWeekend();
            }, $task->updated_at);

            $totalDiffDays = $totalDiffDays + $intervalDateDaysWithoutWeekEnd;
        }

        return $totalDiffDays;
    }

    public function getMonthList()
    {
        $date = \Carbon\Carbon::now(); //current time

        $months = array();

        array_push($months, $date->subMonth(4)->format('M-y'));
        $date = \Carbon\Carbon::now(); 
        array_push($months, $date->subMonth(3)->format('M-y'));
        $date = \Carbon\Carbon::now(); 
        array_push($months, $date->subMonth(2)->format('M-y'));
        $date = \Carbon\Carbon::now(); 
        array_push($months, $date->subMonth(1)->format('M-y'));

        return $months;
    }
}
