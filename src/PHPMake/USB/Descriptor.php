<?php
namespace PHPMake\USB;
use PHPMake\USB;
use PHPMake\USB\DescriptorField;
use PHPMake\USB\ShortLengthException;

abstract class Descriptor {
    private $_fields;

    public function __construct($data, $offset=0) {
        $dataLength = strlen($data);
        $fields = $this->_initDescriptorFields();
        foreach ($fields as $field) {
            $length = $field->getLength();
            if (!$length) {
                $field->setLengthWithReference($fields);
                $length = $field->getLength();
            }

            if ($offset+$length>$dataLength) {
                throw new ShortLengthException();
            }
            $field->setRawData(substr($data, $offset, $length));
            $offset += $length;
        }

        $this->_fields = $fields;
    }

    protected abstract function _initDescriptorFields();

    public static function nameForType($type) {
        return USB::constantNameForValueWithRegex($type, __CLASS__, '/^TYPE_/');
    }

    public function __get($name) {
        foreach ($this->_fields as $field) {
            if ($name == $field->getName()) {
                return $field;
            }
        }
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
