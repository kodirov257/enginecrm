<?php

namespace App\Http\Controllers\Api;

use App\Entity\Station;
use App\Events\StationColumnsUpdated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api'/*, ['except' => ['login', 'register']]*/);
    }

    public function index(Request $request)
    {
        try {
            return DB::table('stations')->get();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), $e->getCode() ?? 400]);
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'station' => 'required|int|min:1|exists:stations,station',
                'name' => 'required|string',
                'alert' => 'nullable|int|between:0,1',
                'lat' => 'nullable|int|between:0,1',
                'long' => 'nullable|int|between:0,1',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $station = Station::findOrFail($request->station);
            $station->update([
                'name' => $request->name,
                'alert' => $request->alert ?? 0,
                'lat' => $request->lat ?? 0,
                'long' => $request->long ?? 0,
            ]);

            event(new StationColumnsUpdated($station));

            return $station;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), $e->getCode() ?? 400]);
        }
    }
}
