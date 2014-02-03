<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

/**
 *
 */
class NotImplemented extends Descriptor {

    public function __construct($deviceHandle, $data, $offset=0) {
        $this->_setDeviceHandle($deviceHandle);
        $this->_parse($data, $offset);
    }

    public function getDescriptorType() {
        return 0;
    }

    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField\Integer('bLength', 1),
            new DescriptorField\Integer('bDescriptorType', 1),
        );
    }

}
