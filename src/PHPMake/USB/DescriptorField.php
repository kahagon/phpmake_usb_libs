<?php
namespace PHPMake\USB;
use PHPMake\USB\ReferenceNotFoundException;

class DescriptorField {
    private $_name;
    private $_length;
    private $_lengthReference;
    private $_rawData;
    private $_intValue;

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

    public function intValue() {
        if (null === $this->_intValue) {
            $ret = 0;
            for ($i=0; $i<$this->_length; $i++) {
                $d = substr($this->_rawData, $i, 1);
                $c = unpack('C', $d);
                $ret += $c[1] << ($i*8);
            }
            $this->_intValue = $ret;
        }

        return $this->_intValue;
    }

    public function setLengthWithReference(array $descriptorFields) {
        foreach ($descriptorFields as $field) {
            if ($field->getName() == $this->_lengthReference) {
                $this->_length = $field->getIntValue();
                return;
            }
        }

        throw new ReferenceNotFoundException();
    }
}
