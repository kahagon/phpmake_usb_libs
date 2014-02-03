<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

class StandardConfiguration extends Descriptor {

    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField\Integer('bLength', 1),
            new DescriptorField\Integer('bDescriptorType', 1),
            new DescriptorField\Integer('wTotalLength', 2),
            new DescriptorField\Integer('bNumInterfaces', 1),
            new DescriptorField\Integer('bConfigurationValue', 1),
            new DescriptorField\Integer('iConfiguration', 1),
            new DescriptorField\Integer('bmAttributes', 1),
            new DescriptorField\Integer('bMaxPower', 1),
        );
    }

}
