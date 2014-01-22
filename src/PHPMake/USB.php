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
}
