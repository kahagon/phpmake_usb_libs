<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

/**
 *
 */
class StandardEndpoint extends StandardConfigurationRelated {

    public function getDescriptorType() {
        return Descriptor::TYPE_ENDPOINT;
    }

    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField\Integer('bLength', 1),
            new DescriptorField\Integer('bDescriptorType', 1),
            new DescriptorField\Integer('bEndpointAddress', 1),
            new DescriptorField\Integer('bmAttributes', 1),
            new DescriptorField\Integer('wMaxPacketSize', 2),
            new DescriptorField\Integer('bInterval', 1),
        );
    }

}
