<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

/**
 *
 */
class InterfaceAssociation extends StandardConfigurationRelated {

    public function getDescriptorType() {
        return Descriptor::TYPE_INTERFACE_ASSOCIATION;
    }

    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField\Integer('bLength', 1),
            new DescriptorField\Integer('bDescriptorType', 1),
            new DescriptorField\Integer('bFirstInterface', 1),
            new DescriptorField\Integer('bInterfaceCount', 1),
            new DescriptorField\Integer('bFunctionClass', 1),
            new DescriptorField\Integer('bFunctionSubClass', 1),
            new DescriptorField\Integer('bFunctionProtocol', 1),
            new DescriptorField\IndexedString('iFunction', 1),
        );
    }

}
