<?php 

namespace Press\Fields;

use Illuminate\Support\Carbon;

class Date extends FieldContract {

    public static function process($type, $value, $data) {
        return [
            $type => Carbon::parse($value),
        ];
    }
}