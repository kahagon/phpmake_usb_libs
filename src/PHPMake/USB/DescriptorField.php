<?php
namespace PHPMake\USB;
use PHPMake\USB\Exception;

abstract class DescriptorField {
    private $_name;
    private $_length;
    private $_lengthReference;
    private $_rawData;

    public function __construct($name, $length) {
        $this->_name = $name;

        if (is_int($length)) {
            $this->_length = $length;
        } else {
            $this->_lengthReference = $length;
        }
    }

    public function getName() {
        return $this->_name;
    }

    public function getLength() {
        return $this->_length;
    }

    public function setRawData($data) {
        $this->_rawData = $data;
    }

    public function getRawData() {
        return $this->_rawData;
    }

    public abstract function getValue($deviceHandle);

    public function setLengthWithReference(array $descriptorFields) {
        foreach ($descriptorFields as $field) {
            if ($field->getName() == $this->_lengthReference) {
                $this->_length = $field->getIntValue();
                return;
            }
        }

        throw new Exception\ReferenceNotFound();
    }
}
