<?php
namespace PHPMake\USB;
use PHPMake\USB;
use PHPMake\USB\DescriptorField;
use PHPMake\USB\Exception;

abstract class Descriptor {
    private $_rawData;
    private $_fields;
    private $_deviceHandle;
    private $_descriptorIndex;
    private $_languageID;

    public function __construct($deviceHandle, $descriptorIndex, $languageID=0) {
        $this->_deviceHandle = $deviceHandle;
        $this->_descriptorIndex = $descriptorIndex;
        $this->_languageID = $languageID;
        $this->_rawData = $this->_requestDescriptorRawData(
            $this->_deviceHandle, $this->_descriptorIndex, $this->_languageID);
        $this->_parse($this->_rawData);
    }

    protected function _setDeviceHandle($deviceHandle) {
        $this->_deviceHandle = $deviceHandle;
    }

    private function _requestDescriptorRawData() {
        //$bmRequestType=0b10000000;
        $bmRequestType = USB::bmRequestType(
            USB::DIRECTION_IN, 
            USB::REQUEST_TYPE_STANDARD, 
            USB::RECIPIENT_DEVICE);
        $bRequest   = USB::GET_DESCRIPTOR;
        $wValue     = ($this->getDescriptorType()<<8)|$this->_descriptorIndex;
        $wIndex     = $this->_languageID;
        $data       = null;
        $timeout    = 1000;
        $result     = usb_control_transfer(
                        $this->_deviceHandle, 
                        $bmRequestType, 
                        $bRequest, 
                        $wValue, 
                        $wIndex, 
                        $data, -1, $timeout);
        if ($result < 0) {
            throw new \Exception('failed to ' . __METHOD__ . ' with error name:' . usb_error_name($result));
        }
        return $data;
    }

    protected function _parse($data, $offset=0) {
        $_offset = $offset;
        $dataLength = strlen($data);
        $fields = $this->_defineDescriptorFields();
        foreach ($fields as $field) {
            $length = $field->getLength();
            if (!$length) {
                $field->setLengthWithReference($fields);
                $length = $field->getLength();
            }

            if ($_offset+$length>$dataLength) {
                throw new Exception\ShortLength();
            }
            $field->setRawData(substr($data, $_offset, $length));
            $_offset += $length;
        }

        $this->_fields = $fields;
    }

    public abstract function getDescriptorType();
    
    protected abstract function _defineDescriptorFields();

    public function getRawData() {
        return $this->_rawData;
    }

    public static function nameForType($type) {
        return USB::constantNameForValueWithRegex($type, __CLASS__, '/^TYPE_/');
    }

    public function __get($name) {
        return $this->getFieldByName($name)->getValue($this->_deviceHandle);
    }

    public function getFieldByName($name) {
        foreach ($this->_fields as $field) {
            if ($name == $field->getName()) {
                return $field;
            }
        }
        throw new Exception\FieldDoesNotExist("field '$name' does not exist");
    }

    public function __toString() {
        $str = get_class($this) . ' {' . PHP_EOL;
        foreach ($this->_fields as $field) {
            $str .= '    ' . $field->getName() . ':' . $field->getValue($this->_deviceHandle) . PHP_EOL;
        }

        $str .= '}' . PHP_EOL;
        return $str;
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
