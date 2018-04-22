<?php

namespace App\Http\Controllers;

use App\Task;
use App\Company;
use App\Project;
use App\User;
use Excel;
use DB;
use DateTime;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //$project = Project::where('id', $project->id)->first();
        $task = Task::find($task->id);
        //$tasks = Task::where('project_id', $project->id)->get();

        $comments = $task->comments;

        return view('tasks.show', ['task'=>$task, 'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    //export example
    public function taskExport(){
        $task = Contact::select('name', 'email')->get();
        return Excel::create('data_contact', function($excel) use ($task){
            $excel->sheet('mysheet', function($sheet) use ($task){
                $sheet->fromArray($task);
            });
        })->download('xls');
    }

    public function taskImport(Request $request){

        // protected $delimiter  = ',';
        // protected $enclosure  = '"';
        // protected $lineEnding = '\r\n';

        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {

                    //get task_id
                    $taskId = $value->ref;
                    $dataExist = Task::where('id', $taskId)->first();

                    //prepare data to be edited
                    if($value->is_closed == 'TRUE'){
                            $taskClosed = 1;
                        } else {
                            $taskClosed = 0;
                        }
                    $taskStatus = $value->status;

                    $createdAt  = new DateTime($value->created_date);
                    $updatedAt  = new DateTime($value->modified_date);
                    $taskCreated  = $createdAt->format('Y-m-d H:i:s');
                    $taskUpdate   = $updatedAt->format('Y-m-d H:i:s');
                    $finishedAt   = ($value->finish_date != null) ? new DateTime($value->finish_date) : null;
                    $taskFinished = ($finishedAt != null) ? $finishedAt->format('Y-m-d H:i:s') : null;

                    //check condition if data exist
                    if($dataExist) { //continue;
                        $taskUpdate = Task::where('id', $taskId)
                                ->update([
                                    'is_closed'   => $taskClosed,
                                    'status'      => $taskStatus,
                                    'created_at'  => $taskCreated,
                                    'updated_at'  => $taskUpdate,
                                    'finished_at' => $taskFinished
                                ]);
                    } else {

                        $task = new Task();
                        //$company_nickname = $value->tags;
                        $task->id          = $value->ref;
                        $task->name        = $value->subject;
                        $task->description = $value->description;
                        $username          = $value->assigned_to;

                        //find project_id
                        $project_nickname  = $value->tags;
                        $project_id        = DB::table('projects')->where('project_nickname', $project_nickname)->value('id');
                        $task->project_id  = $project_id;

                        //find company_id
                        $company_id        = DB::table('projects')->where('project_nickname', $project_nickname)->value('company_id');
                        $task->company_id  = $company_id;

                        $user_id           = DB::table('users')->where('username', $username)->value('id');
                        $task->user_id     = $user_id;
                        $task->points      = (int)$value->total_points;

                        if($value->is_closed == 'TRUE'){
                            $task->is_closed  = 1;
                        } else {
                            $task->is_closed  = 0;
                        }

                        $task->status      = $value->status;

                        $createdAt = new DateTime($value->created_date);
                        $task->created_at = $createdAt->format('Y-m-d H:i:s');
                        $updatedAt = new DateTime($value->modified_date);
                        $task->updated_at = $updatedAt->format('Y-m-d H:i:s');
                        $finishedAt = ($value->finish_date != null) ? new DateTime($value->finish_date) : null;
                        $task->finished_at = ($finishedAt != null) ? $finishedAt->format('Y-m-d H:i:s') : null;
                        
                        $task->save();

                    }

                    
                }
            }
        }
        return back()->with('success', 'File has been uploaded');
    }

}


// if($request->hasFile('file')){
//             $path = $request->file('file')->getRealPath();
//             $data = Excel::load($path, function($reader){})->get();
//             if(!empty($data) && $data->count()){
//                 foreach ($data as $key => $value) {
//                     $task = new Task();

//                     //$company_nickname = $value->tags;



//                     $task->id          = $value->ref;
//                     $task->name        = $value->subject;
//                     $task->description = $value->description;

//                     //if($value->tags == '')

//                     $task->project_id  = 1;
//                     $task->company_id  = 3;
//                     $task->user_id     = 1;
//                     $task->points      = 2;
//                     $task->is_closed   = 0;
//                     $task->status      = $value->status;
//                     // $task->finished_at = $value->finish_date;
//                     // $task->created_at  = $value->created_date;
//                     $task->save();

//                     $taskUser = new TaskUser();
//                     $taskUser->task_id  = $value->ref;
//                     $taskUser->user_id  = 1;
//                     $taskUser->save();
//                 }
//             }
//         }
//         return back();