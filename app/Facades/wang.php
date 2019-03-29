<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Wang extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wang';
    }
}