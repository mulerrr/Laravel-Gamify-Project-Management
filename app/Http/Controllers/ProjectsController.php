<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\ProjectUser;
use App\User;
use App\Task;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all list of projects
        if(Auth::check()){
            $companies = DB::table('companies')->orderBy('name', 'asc')->get();
            $projects = Project::where('user_id', Auth::user()->id)->get();

            return view('projects.index', ['projects' => $projects], ['companies' => $companies]);
        }

        return view('auth.login');
    }

    //add user to project
    public function adduser(Request $request){

        //take a project, add a user to it
        $project = Project::find($request->input('project_id'));

        //check if user is the one who created this project
        if(Auth::user()->id == $project->user_id){
            $user = User::where('email', $request->input('email'))->first(); //single record

            //check if user already added to project
            $projectUser = ProjectUser::where('user_id', $user->id)
                                        ->where('project_id', $project->id)
                                        ->first();

            if($projectUser){
                //if user already exist, exit
                return redirect()->route('projects.show', ['project' => $project->id])
                        ->with('success', $request->input('email') . ' already a member of this project');
            }

            if($user && $project){
                $project->users()->attach($user->id); //take method from model

                return redirect()->route('projects.show', ['project' => $project->id])
                        ->with('success', $request->input('email') . ' was added to the project succesfully');
            }
        }

        return redirect()->route('projects.show', ['project' => $project->id])->with('errors', 'Error adding user to the project !!');



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $company_id = null)
    {
        $companies = null;
        if(!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }

        return view('projects.create', ['company_id'=>$company_id, 'companies'=>$companies]);
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
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'project_nickname' => $request->input('project_nickname'),
                'company_id' => $request->input('company_id'),
                'user_id' => Auth::user()->id,
            ]);

            if($project){
                return redirect()->route('projects.show', ['project' => $project->id])->with('success', 'project created successfully');
            }
        }

        return back()->withInput()->with('errors', 'Error creating new project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //$project = Project::where('id', $project->id)->first();
        $project = Project::find($project->id);
        $tasks = Task::where('project_id', $project->id)->get();
        $comments = $project->comments;

        //initialize current date
        $date = \Carbon\Carbon::now();

        //variables for presence calculation
        $previousMonth     = $date->subMonth()->format('F');
        $currentYear       = $date->format('Y');
        $presenceName      = $previousMonth . $currentYear;
        
        //variables for presence task points
        $fromDate = new Carbon('first day of last month');
        $toDate   = new Carbon('last day of last month');

        //TASK COUNTER
        $totalTask = Task::where('project_id', $project->id)->whereBetween('created_at', [ $fromDate, $toDate])->count();
        $totalTaskFinish = Task::where('project_id', $project->id)->where('status', 'done')->whereBetween('created_at', [ $fromDate, $toDate])->count();
        $totalTaskInProgress = Task::where('project_id', $project->id)->where('status', 'In Progress')->whereBetween('created_at', [ $fromDate, $toDate])->count();
        $totalTaskNew = Task::where('project_id', $project->id)->where('status', 'new')->whereBetween('created_at', [ $fromDate, $toDate])->count();

        //PROJECT DETAIL
        $startDate  = Task::where('project_id', $project->id)->first();
        $lastDate   = Task::where('project_id', $project->id)->orderBy('updated_at', 'desc')->first();
        $totalEmployee = Task::where('project_id', $project->id)->distinct('user_id')->count('user_id');

        //performance percentage
        $doneTasks        = Task::where('project_id', $project->id)->where('status', 'done')->get();
        $inProgressTasks  = Task::where('project_id', $project->id)->where('status', 'in progress')->get();

        //Bottom Table Date
        $lastMonthName = $previousMonth . ' ' . $currentYear;
        

        return view('projects.show', ['project'=>$project, 'comments'=>$comments, 'tasks'=>$tasks])->with(['totalTask' => $totalTask])->with(['totalTaskFinish' => $totalTaskFinish])->with(['totalTaskInProgress' => $totalTaskInProgress])->with(['totalTaskNew' => $totalTaskNew])->with(['startDate' => $startDate])->with(['lastDate' => $lastDate])->with(['totalEmployee' => $totalEmployee])->with(['doneTasks' => $doneTasks])->with(['inProgressTasks' => $inProgressTasks])->with(['lastMonthName' => $lastMonthName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //passing parameter id ke halaman projects/edit
        $project = Project::find($project->id);


        return view('projects.edit', ['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        //save data
        $projectUpdate = Project::where('id', $project->id)
                                ->update([
                                    'name' => $request->input('name'),
                                    'description' => $request->input('description'),
                                    'project_nickname' => $request->input('project_nickname')
                                ]);

        if($projectUpdate){
            return redirect()->route('projects.show', ['project' => $project->id])->with('success', 'project updated successfully');
        }

        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $findproject = Project::find($project->id);
        if($findproject->delete()){
            //redirect
            return redirect()->route('projects.index')->with('success', 'project deleted successfully');
        }

        return back()->withInput()->with('errors', 'project could not be deleted');
    }
}
