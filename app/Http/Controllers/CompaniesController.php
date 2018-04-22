<?php

namespace App\Http\Controllers;

use App\Company;
use App\Project;
use App\Task;
use App\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all list of companies
        if(Auth::check()){
            
            
            $companies = Company::orderBy('name', 'asc')->get();
            $projects = Project::all();
            $tasks = Task::all();

            return view('companies.index')->with(['companies' => $companies])->with(['projects' => $projects])->with(['tasks' => $tasks]);
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
        return view('companies.create');
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
            $company = Company::create([
                'name'             => $request->input('name'),
                'description'      => $request->input('description'),
                'user_id' => Auth::user()->id,
            ]);

            if($company){
                return redirect()->route('companies.show', ['company' => $company->id])->with('success', 'Company created successfully');
            }
        }

        return back()->withInput()->with('errors', 'Error creating new Company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //$company = Company::where('id', $company->id)->first();
        $company = Company::find($company->id);
        $tasks = Task::all();

        return view('companies.show', ['company'=>$company], ['tasks'=>$tasks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //passing parameter id ke halaman companies/edit
        $company = Company::find($company->id);
        $users = User::where('role_id', 3)->get();

        return view('companies.edit', ['company'=>$company], ['users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //save data
        $companyUpdate = Company::where('id', $company->id)
                                ->update([
                                    'name' => $request->input('name'),
                                    'description' => $request->input('description'),
                                    'user_id' => $request->input('user_id'),
                                ]);

        if($companyUpdate){
            Alert::success('Company updated successfully!');
            return redirect()->route('companies.show', ['company' => $company->id]);
        }

        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $findCompany = Company::find($company->id);
        if($findCompany->delete()){
            //redirect
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
        }

        return back()->withInput()->with('errors', 'Company could not be deleted');
    }
}
