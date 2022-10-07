<?php
namespace App\Sk\PropertyType;

use Exception;
use App\Sk\SkPayload;
use Illuminate\Database\Eloquent\Model;
use App\Sk\PropertyType\PropertyTypeValidation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PropertyType extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function doCreate(SkPayload $payload)
    {
        try {
            (new PropertyTypeValidation($payload))->validateCreate();
            /** Save Property*/
            $this->fill((array) $payload)->save();
            return $this;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * get property type or create if not find
     * @return PropertyType
     **/
    public function firstOrNew(SkPayload $data)
    {
        try {
            (new PropertyTypeValidation($data))->validateFindOrCreateByTitle();
            return self::where('title', $data->title)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->create((array) $data);
        }
    }
}