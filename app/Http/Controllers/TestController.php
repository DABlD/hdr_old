<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{User, Patient};

class TestController extends Controller
{
    function test(){
        $user = User::find(6);
        // $user->load('patient');
        $columns = $user->getFillable();
        foreach($columns as $col){
            echo $col . '<br>';
        }

        // dd($user->getFillable());
    }
}
