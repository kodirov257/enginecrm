<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index(Request $request)
    {
        echo phpinfo();
    }

    public function testDb(Request $request)
    {
        try {
            return DB::table('stations')->get();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
