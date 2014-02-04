<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

/**
 *
 */
abstract class StandardConfigurationRelated extends Descriptor {

    public function __construct($deviceHandle, $data, $offset=0) {
        $this->_setDeviceHandle($deviceHandle);
        $this->_parse($data, $offset);
    }
}
