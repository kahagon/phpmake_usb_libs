<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

class Configuration extends Descriptor {

    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField('bLength', 1),
            new DescriptorField('bDescriptorType', 1),
            new DescriptorField('wTotalLength', 2),
            new DescriptorField('bNumInterfaces', 1),
            new DescriptorField('bConfigurationValue', 1),
            new DescriptorField('iConfiguration', 1),
            new DescriptorField('bmAttributes', 1),
            new DescriptorField('bMaxPower', 1),
        );
    }

}
