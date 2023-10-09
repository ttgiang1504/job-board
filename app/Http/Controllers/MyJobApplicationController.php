<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // có thể dùng như này 
        // 'applications' => auth()->user()->jobApplications()
        //             ->with('job', 'job.employer')
        //             ->latest()->get()
        //nhưng do Vscode không biết auth()->user() là Model User nên ta cần định nghĩa lại nó 
        /** @var \App\Models\User */
        $user = auth()->user();


        return view(
            'my_job_application.index',
            [
                'applications' => $user ->jobApplications()
                   
                    ->latest()->get()
            ]
        );
    }

    
    public function destroy(string $id)
    {
        //
    }
}
