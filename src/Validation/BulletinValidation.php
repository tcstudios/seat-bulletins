<?php

namespace TCStudios\Seat\SeatBulletins\Validation;

use Illuminate\Foundation\Http\FormRequest;

class BulletinValidation extends FormRequest {
    public function authorize() { return true; }
    public function rules() {
        return [

        ];
    }
}