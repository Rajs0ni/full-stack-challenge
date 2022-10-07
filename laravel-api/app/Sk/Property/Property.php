<?php
namespace App\Sk\Property;

use Exception;
use App\Sk\SkPayload;
use Webpatser\Uuid\Uuid;
use App\Sk\Property\PropertyValidation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{   
    use SoftDeletes;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'uuid',
        'property_type_id',
        'county',
        'country',
        'town',
        'postal_code',
        'description',
        'address',
        'image_full',
        'image_thumbnail',
        'latitude',
        'longitude',
        'num_bedrooms',
        'num_bathrooms',
        'price',
        'type',
        'is_admin_entry'
    ];

    public function propertyType()
    {
        return $this->hasOne('App\Sk\PropertyType\PropertyType');
    }

    public function doCreate(SkPayload $payload)
    {
        try {
            $payload->uuid = $payload->uuid??(string)Uuid::generate();
            (new PropertyValidation($payload))->validateCreate();
            /** Save Property*/
            $this->fill((array) $payload)->save();
            return $this;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function doUpdate(SkPayload $payload)
    {
        try {
            (new PropertyValidation($payload))->validateUpdate();
            $this->update((array) $payload);
            return $this;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
