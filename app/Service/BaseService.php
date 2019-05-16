<?php

namespace App\Service;
use Validator;

class BaseService {

    public function veritify($validate_data,$rules,$isAll = false) {
        $validator = Validator::make($validate_data, $rules);
        if ($validator->fails()) {
            $errors = $isAll ? $validator->errors()->all() : $validator->errors()->first();
            return $errors;
        }
        return [];
    }
}
