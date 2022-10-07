<?php
namespace App\Sk;

use Illuminate\Http\Request;

class SkPayload
{
    public function __construct($data)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        return $this;
    }
}
