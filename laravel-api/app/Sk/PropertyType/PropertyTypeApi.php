<?php
namespace App\Sk\PropertyType;

use Exception;
use App\Sk\SkPayload;
use App\Sk\PropertyType\PropertyType;

class PropertyTypeApi
{
    /**
     * function to get all property types
     * @param SkPayload $payload
     * @return Collection propertyType
     */
    static function list(SkPayload $payload)
    {
        try {
            return PropertyType::all();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * function to create a property type
     * @param SkPayload $payload
     * @return PropertyType propertyType
     */
    static function create(SkPayload $payload)
    {   
        return (new PropertyType())->doCreate($payload);
    }

    /**
     * function to get a property type
     * @param SkPayload $payload
     * @return PropertyType propertyType
     */
    static function firstOrNew(SkPayload $payload)
    {
        return (new PropertyType())->firstOrNew($payload);
    }
}