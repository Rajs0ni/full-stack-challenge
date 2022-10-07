<?php
namespace App\Sk\Property;

use Exception;
use App\Sk\SkPayload;
use App\Sk\Property\Property;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PropertyApi
{
    static function list(SkPayload $payload)
    {
        try {
            return Property::all();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    static function create(SkPayload $payload)
    {   
        return (new Property())->doCreate($payload);
    }

    static function getInstance($id)
    {
        try {
            return Property::findOrFail($id);
        } catch (\Exception $e) {
            throw new ModelNotFoundException($e->getMessage());
        }
    }

    static function update(SkPayload $payload, Property $property)
    {   
        return $property->doUpdate($payload);
    }

    static function delete(SkPayload $payload, Property $property)
    {   
        try {
            return $property->delete();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    static function findByUuid($uuid)
    {
        return Property::where('uuid', $uuid)->first();
    }
}
