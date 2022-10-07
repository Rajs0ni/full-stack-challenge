<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Sk\SkPayload;
use Illuminate\Http\Request;
use App\Sk\Property\Property;
use App\Sk\Property\PropertyApi;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function list(Request $request)
    {
        $result = ['message' => 'OK'];
        $payload = new SkPayload($request->all());
        $result['properties'] = PropertyApi::list($payload);
        return response()->api($result);
    }

    public function create(Request $request)
    {
        $result = ['message' => 'OK'];
        $payload = new SkPayload($request->all());
        $result['result'] = PropertyApi::create($payload);
        return response()->api($result);
    }

    public function get(Request $request)
    {
        $result = ['message' => 'OK'];
        $payload = new SkPayload($request->all());
        $property = PropertyApi::getInstance($payload->id);
        $result['property'] = $property;
        return response()->api($result);
    }

    public function update( Request $request, Property $property) {
        $result = ['message' => 'OK'];
        $payload = new SkPayload($request->all());
        $result['result'] = PropertyApi::update($payload, $property);
        return response()->api($result);
    }

    public function delete(Request $request, Property $property) {
        $result = ['message' => 'OK'];
        $payload = new SkPayload($request->all());
        $result['result'] = PropertyApi::delete($payload, $property);
        return response()->api($result);
    }
}
