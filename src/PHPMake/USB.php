<?php
namespace PHPMake;

class USB {


    public static function constantNameForValueWithRegex($value, $class, $regex) {
        $names = self::constantNamesForValue(
            $value, $class, 
            function ($name) use ($regex) {
                return preg_match($regex, $name);
            });
        if (count($names)>0) {
            return $names[0];
        } else {
            return "**UNKNOWN**";
        }
    }
    
    public static function constantNamesForValue($value, $class, $matcher=null) {
        $names = array();
        $refClass = new \ReflectionClass($class);
        foreach ($refClass->getConstants() as $name => $_value) {
            if ($_value == $value && (!$matcher || $matcher($name))) {
                $names[] = $name;
            }
        }
        return $names;
    }

    public static function bmRequestType($direction, $type, $recipient) {
        switch ($direction) {
            case self::DIRECTION_OUT:
            case self::DIRECTION_IN:
                break;
            default:
                throw new \Exception('first argument is invalid as direction.');
        }

        switch ($type) {
            case self::REQUEST_TYPE_STANDARD:
            case self::REQUEST_TYPE_CLASS:
            case self::REQUEST_TYPE_VENDOR:
                break;
            default:
                throw new \Exception('second argument is invalid as request type.');
        }

        switch ($recipient) {
            case self::RECIPIENT_DEVICE:
            case self::RECIPIENT_INTERFACE:
            case self::RECIPIENT_ENDPOINT:
            case self::RECIPIENT_OTHER:
                break;
            default:
                throw new \Exception('third argument is invalid as recipient.');
        }

        return $direction<<7|$type<<5|$recipient;
    }
    
    /** host to device */
    const DIRECTION_OUT = 0;
    /** device to host */
    const DIRECTION_IN = 1;

    const REQUEST_TYPE_STANDARD = 0;
    const REQUEST_TYPE_CLASS = 1;
    const REQUEST_TYPE_VENDOR = 2;

    const RECIPIENT_DEVICE = 0;
    const RECIPIENT_INTERFACE = 1;
    const RECIPIENT_ENDPOINT = 2;
    const RECIPIENT_OTHER = 3;
    
    const GET_STATUS = 0;
    const CLEAR_FEATURE = 1;
    const SET_FEATURE = 3;
    const SET_ADDRESS = 5;
    const GET_DESCRIPTOR = 6;
    const SET_DESCRIPTOR = 7;
    const GET_CONFIGURATION = 8;
    const SET_CONFIGURATION = 9;
    const GET_INTERFACE = 10;
    const SET_INTERFACE = 11;
    const SYNCH_FRAME = 12;
}
