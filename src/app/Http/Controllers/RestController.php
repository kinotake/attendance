<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Http\Requests\RestRequest;

class RestController extends Controller
{

    public function  restStartView()
       {
          return view('reststart');
       }

    public function  restStart(RestRequest $request)
       {
        $form = $request->all();
        Rest::create($form);
        return redirect('/rest/end');
       } 
       
    public function  restEndView()
       {
          return view('restend');
       }
       
    public function  restEnd(RestRequest $request)
       {
        $form = $request->all();
        Rest::update($form);
        return redirect('/rest/end');
       } 

}
