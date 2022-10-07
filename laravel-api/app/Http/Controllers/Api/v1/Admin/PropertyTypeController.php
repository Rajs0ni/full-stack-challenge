<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Sk\SkPayload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sk\PropertyType\PropertyTypeApi;

class PropertyTypeController extends Controller
{
    public function list(Request $request)
    {
        $result = ['message' => 'OK'];
        $payload = new SkPayload($request->all());
        $result['propertyTypes'] = PropertyTypeApi::list($payload);
        return response()->api($result);
    }
}