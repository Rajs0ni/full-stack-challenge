<?php
namespace App\Sk;

use App\Sk\SkException;
use Exception;
use Illuminate\Support\Facades\Validator;

class SkValidation
{
    /**
     * validate fields of given data with given rules
     */
    public function validate(array $fields, $data)
    {
        $applicableRules = array();
        foreach ($fields as $field) {
            $applicableRules[$field] = $this->rules[$field] ?? [];
        }
        if (count($applicableRules)) {
            $this->doValidateRules($data, $applicableRules);
        }
    }

    protected function doValidateRules($data, $rules)
    {
        $validator = Validator::make((array) $data, $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();

            $validation = [];
            foreach ($rules as $field => $rule) {
                if ($errors->get($field)) {
                    $validation[$field] = $errors->get($field);
                }
            }

            $e = new Exception(implode("\n", $errors->all()), 400);
            $e->validation = $validation;
            throw $e;
        }
    }
}
