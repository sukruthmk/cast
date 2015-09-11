<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Location;

class LocationController extends Controller {

    public function saveLocation(Request $request){
        $location = new Location;
        $location->lattitude = $request->input('lattitude');
        $location->longitude = $request->input('longitude');
        $location->post_id = $request->input('post_id');
        $location->user_id = Auth::id();
        $location->save();

        return response()->json($location);
    }

}
