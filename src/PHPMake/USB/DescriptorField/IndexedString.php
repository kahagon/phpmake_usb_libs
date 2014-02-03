<?php
namespace PHPMake\USB\DescriptorField;
use PHPMake\USB\DescriptorField;

class IndexedString extends DescriptorField\Integer {

    private $_strValue;

    public function getValue($deviceHandle) {
        if (null === $this->_strValue) {
            $index = parent::getValue($deviceHandle);
            usb_get_string_descriptor_ascii(
                $deviceHandle, $index, $this->_strValue);
        }

        return $this->_strValue;
    }
}
