<?php
namespace PHPMake\USB;
use PHPMake\USB;

class Descriptor {

    public static function typeForValue($type) {
        return USB::constantNameForValueWithRegex($type, __CLASS__, '/^TYPE_/');
    }

    const TYPE_DEVICE = 0x01;
    const TYPE_CONFIGURATION = 0x02;
    const TYPE_STRING = 0x03;
    const TYPE_INTERFACE = 0x04;
    const TYPE_ENDPOINT = 0x05;
    const TYPE_DEVICE_QUALIFIER = 0x06;
    const TYPE_OTHER_SPEED_CONFIGURATION = 0x07;
    const TYPE_INTERFACE_POWER = 0x08;
    const TYPE_OTG = 0x09;
    const TYPE_DEBUG = 0x0A;
    const TYPE_INTERFACE_ASSOCIATION = 0x0B;
    const TYPE_SECURITY = 0x0C;
    const TYPE_KEY = 0x0D;
    const TYPE_ENCRYPTION_TYPE = 0x0E;
    const TYPE_BINARY_DEVICE_OBJECT_STORE = 0x0F;
    const TYPE_DEVICE_CAPABILITY = 0x10;
    const TYPE_WIRELESS_ENDPOINT_COMPANION = 0x11;
    const TYPE_SUPERSPEED_ENDPOINT_COMPANION = 0x30;
}
