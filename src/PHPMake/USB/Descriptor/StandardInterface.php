<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

class StandardInterface extends Descriptor {

    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField('bLength', 1),
            new DescriptorField('bDescriptorType', 1),
            new DescriptorField('bInterfaceNumber', 1),
            new DescriptorField('bAlternateSetting', 1),
            new DescriptorField('bNumEndpoints', 1),
            new DescriptorField('bInterfaceClass', 1),
            new DescriptorField('bInterfaceSubClass', 1),
            new DescriptorField('bInterfaceProtocol', 1),
            new DescriptorField('iInterface', 1),
        );
    }

}
