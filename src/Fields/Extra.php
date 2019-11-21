<?php 

namespace Press\Fields;

class Extra extends FieldContract {

    public static function process($type, $value, $data) {

        // check if we already have data in field extra
        $extra = isset($data['extra']) ? json_decode($data['extra'], true) : []; 

        return [
            'extra' => json_encode(array_merge($extra, [
                $type => $value,
            ])),
        ];
    }
}