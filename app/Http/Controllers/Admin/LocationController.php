<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    public function getStatesOfCountry(string $countryId): Response
    {
        $states = State::select(['id', 'name', 'country_id'])->where('country_id', $countryId)->get();
        return response($states, 200);
    }
}
