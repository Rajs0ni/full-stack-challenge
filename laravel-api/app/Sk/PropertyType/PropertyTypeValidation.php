<?php
namespace App\Sk\PropertyType;
use App\Sk\SkPayload;
use App\Sk\SkValidation;

class PropertyTypeValidation extends SkValidation
{
    /**
     * fields
     */
    const FIELD_ID = 'id';
    const FIELD_TITLE = 'title';
    const FIELD_DESCRIPTION = 'description';

    public function __construct(SkPayload $data)
    {
        $this->data = $data;

        $this->rules = [
            self::FIELD_ID => 'required|numeric|exists:property_types,id',
            self::FIELD_TITLE => 'required|string',
            self::FIELD_DESCRIPTION => 'nullable|string',
        ];
    }

    /**
     * validate given data for create action
     */
    public function validateCreate()
    {
        $fields = [
            self::FIELD_TITLE,
            self::FIELD_DESCRIPTION
        ];
        $this->validate($fields, $this->data);
    }

    /**
     * validate given data for create action
     */
    public function validateUpdate()
    {
        $fields = [
            self::FIELD_ID,
            self::FIELD_TITLE,
            self::FIELD_DESCRIPTION
        ];
        $this->validate($fields, $this->data);
    }

    public function validateFindOrCreateByTitle()
    {
        $fields = [self::FIELD_TITLE];
        $this->validate($fields, $this->data);
    }
}