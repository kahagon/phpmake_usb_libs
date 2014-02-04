<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

/**
 *
 */
class StandardInterface extends StandardConfigurationRelated {

    public function getDescriptorType() {
        return Descriptor::TYPE_INTERFACE;
    }

    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField\Integer('bLength', 1),
            new DescriptorField\Integer('bDescriptorType', 1),
            new DescriptorField\Integer('bInterfaceNumber', 1),
            new DescriptorField\Integer('bAlternateSetting', 1),
            new DescriptorField\Integer('bNumEndpoints', 1),
            new DescriptorField\Integer('bInterfaceClass', 1),
            new DescriptorField\Integer('bInterfaceSubClass', 1),
            new DescriptorField\Integer('bInterfaceProtocol', 1),
            new DescriptorField\IndexedString('iInterface', 1),
        );
    }

}
