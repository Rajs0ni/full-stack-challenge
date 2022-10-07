<?php
namespace App\Sk\Property;
use App\Sk\SkPayload;
use App\Sk\SkValidation;

class PropertyValidation extends SkValidation
{
    /**
     * fields
     */
    const FIELD_ID = 'id';
    const FIELD_UUID = 'uuid';
    const FIELD_PROPERTY_TYPE_ID = 'property_type_id';
    const FIELD_COUNTY = 'county';
    const FIELD_COUNTRY = 'country';
    const FIELD_POSTAL_CODE = 'postal_code';
    const FIELD_TOWN = 'town';
    const FIELD_DESCRIPTION = 'description';
    const FIELD_ADDRESS = 'address';
    const FIELD_IMAGE_FULL = 'image_full';
    const FIELD_IMAGE_THUMBNAIL = 'image_thumbnail';
    const FIELD_LATITUDE = 'latitude';
    const FIELD_LONGITUDE = 'longitude';
    const FIELD_NUM_BEDROOMS = 'num_bedrooms';
    const FIELD_NUM_BATHROOMS = 'num_bathrooms';
    const FIELD_PRICE = 'price';
    const FIELD_TYPE = 'type';

    public function __construct(SkPayload $data)
    {
        $this->data = $data;

        $this->rules = [
            self::FIELD_ID => 'required|numeric|exists:properties,id',
            self::FIELD_UUID => 'required',
            self::FIELD_PROPERTY_TYPE_ID => 'numeric',
            self::FIELD_COUNTY => 'required|string',
            self::FIELD_COUNTRY => 'required|string',
            self::FIELD_POSTAL_CODE => 'nullable|string',
            self::FIELD_TOWN => 'required|string', 
            self::FIELD_DESCRIPTION => 'required|string',
            self::FIELD_ADDRESS => 'required|string',
            self::FIELD_IMAGE_FULL => 'nullable|string',
            self::FIELD_IMAGE_THUMBNAIL => 'nullable|string',
            self::FIELD_LATITUDE => 'nullable', 
            self::FIELD_LONGITUDE => 'nullable',
            self::FIELD_NUM_BEDROOMS => 'numeric|min:1',
            self::FIELD_NUM_BATHROOMS => 'numeric|min:1',
            self::FIELD_PRICE => 'required|numeric',
            self::FIELD_TYPE => 'required|string',            
        ];
    }

    /**
     * validate given data for create action
     */
    public function validateCreate()
    {
        $fields = [
            self::FIELD_UUID,
            self::FIELD_PROPERTY_TYPE_ID,
            self::FIELD_COUNTY,
            self::FIELD_COUNTRY,
            self::FIELD_POSTAL_CODE,
            self::FIELD_TOWN, 
            self::FIELD_DESCRIPTION,
            self::FIELD_ADDRESS,
            self::FIELD_IMAGE_FULL,
            self::FIELD_IMAGE_THUMBNAIL,
            self::FIELD_LATITUDE, 
            self::FIELD_LONGITUDE,
            self::FIELD_NUM_BEDROOMS,
            self::FIELD_NUM_BATHROOMS,
            self::FIELD_PRICE,
            self::FIELD_TYPE
        ];
        $this->validate($fields, $this->data);
    }

    /**
     * validate given data for update action
     */
    public function validateUpdate()
    {
        $fields = [
            self::FIELD_ID,
            self::FIELD_UUID,
            self::FIELD_PROPERTY_TYPE_ID,
            self::FIELD_COUNTY,
            self::FIELD_COUNTRY,
            self::FIELD_POSTAL_CODE,
            self::FIELD_TOWN, 
            self::FIELD_DESCRIPTION,
            self::FIELD_ADDRESS,
            self::FIELD_IMAGE_FULL,
            self::FIELD_IMAGE_THUMBNAIL,
            self::FIELD_LATITUDE, 
            self::FIELD_LONGITUDE,
            self::FIELD_NUM_BEDROOMS,
            self::FIELD_NUM_BATHROOMS,
            self::FIELD_PRICE,
            self::FIELD_TYPE
        ];
        $this->validate($fields, $this->data);
    }
}
