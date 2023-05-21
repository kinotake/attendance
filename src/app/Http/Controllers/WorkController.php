<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Http\Requests\WorkRequest;


class WorkController extends Controller
{   
    public function view()
       {
          return view('start');
       }
       
   public function start(WorkRequest $request)
       {
        $form = $request->all();
        Work::create($form);
        return redirect('/rest/start');
       } 

    public function index()
       {
          return view('index');
       }

    public function login()
       {
          return view('login');
       }

   

        
    
}
