<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

class StandardConfiguration extends Descriptor {

    private $_relatedDescriptors = array();

    public function __construct($deviceHandle, $descriptorIndex, $languageID=0) {
        parent::__construct($deviceHandle, $descriptorIndex, $languageID);

        $rawData = $this->getRawData();
        $offset = $this->bLength;

        while ($offset<$this->wTotalLength) {
            $type = self::_extractNextDescriptorType($rawData, $offset);

            $relatedDescriptor = self::_createRelatedDescriptor($type, $deviceHandle, $rawData, $offset);
            $length = $relatedDescriptor->bLength;
            $offset += $length;
            $this->_relatedDescriptors[] = $relatedDescriptor;
        }
    }

    private static function _extractNextDescriptorType($rawData, $offset) {
        $t = substr($rawData, $offset+1, 1);
        $t = unpack('C', $t);
        return $t[1];
    }

    private static function _createRelatedDescriptor($type, $deviceHandle, $rawData, $offset) {
        $relatedDescriptor;
        switch ($type) {
            case Descriptor::TYPE_INTERFACE:
                $relatedDescriptor = new StandardInterface($deviceHandle, $rawData, $offset);
                break;
            case Descriptor::TYPE_ENDPOINT:
                $relatedDescriptor = new StandardEndpoint($deviceHandle, $rawData, $offset);
                break;
            case Descriptor::TYPE_INTERFACE_ASSOCIATION:
                $relatedDescriptor = new InterfaceAssociation($deviceHandle, $rawData, $offset);
                break;
            default:
                $relatedDescriptor = new NotImplemented($deviceHandle, $rawData, $offset);
                break;
        }
        return $relatedDescriptor;
    }

    public function getRelatedDescriptors() {
        return $this->_relatedDescriptors;
    }

    public function getDescriptorType() {
        return Descriptor::TYPE_CONFIGURATION;
    }

    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField\Integer('bLength', 1),
            new DescriptorField\Integer('bDescriptorType', 1),
            new DescriptorField\Integer('wTotalLength', 2),
            new DescriptorField\Integer('bNumInterfaces', 1),
            new DescriptorField\Integer('bConfigurationValue', 1),
            new DescriptorField\IndexedString('iConfiguration', 1),
            new DescriptorField\Integer('bmAttributes', 1),
            new DescriptorField\Integer('bMaxPower', 1),
        );
    }

    public function __toString() {
        $str = parent::__toString();
        foreach ($this->_relatedDescriptors as $related) {
            $str .= $related->__toString();
        }

        return $str;
    }

}
