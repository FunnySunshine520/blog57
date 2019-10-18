<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getAllUsers()
    {
        echo '12323';
    }

    public function getUserDetail(Request $request) {
        $id = $request->get('id');
        echo $id;
    }
}
