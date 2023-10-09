<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        // dùng authorize để kiểm tra người dùng có quyền 'apply' cho công việc($job) hay không, nếu không, stop tại đây
        $this->authorize('apply', $job);
        return view('job_application.create',['job'=>$job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {
        $this->authorize('apply', $job);
        $job->jobApplication()->create([
            'user_id' => $request-> user()->id,
            ...$request->validate([ // chú thích ... phía dưới
                'expected_salary' => 'required|min:1|max:1000000'
            ])
        ]);

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job application submited.');

            // Giải nén các mảng bên trong 
            // <?php
            // $parts = ['apple', 'pear'];
            // $fruits = ['banana', 'orange', ...$parts, 'watermelon'];
            // // ['banana', 'orange', 'apple', 'pear', 'watermelon'];
            // 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
