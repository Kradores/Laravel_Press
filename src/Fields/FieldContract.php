<?php 

namespace Press\Fields;

abstract class FieldContract {

    public static function process($fieldType, $filedValue, $data) {

        return [$fieldType => $filedValue];
    }
}