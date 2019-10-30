<?php
namespace App\Helpers;

use Illuminate\Foundation\Auth\AuthenticatesUsers as LaravelAuthenticatesUsers;

trait LoginTrait {

    use LaravelAuthenticatesUsers;
    public function username()
    {
        return 'name';
    }
}
