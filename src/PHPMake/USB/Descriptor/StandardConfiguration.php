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
        $getType = function() use ($rawData, $offset) {
            $t = substr($rawData, $offset+1, 1);
            $t = unpack('C', $t);
            return $t[1];
        };

        $l = substr($rawData, $offset, 1);
        $l = unpack('C', $l);
        $length = $l[1];
        for (; $offset+$length<=$this->wTotalLength; $offset+=$length) {
            $t = substr($rawData, $offset+1, 1);
            $t = unpack('C', $t);
            $type = $t[1];
            $relatedDescriptor;
            switch ($type) {
                case Descriptor::TYPE_INTERFACE:
                    $relatedDescriptor = new StandardInterface($deviceHandle, $rawData, $offset);
                    break;
                default:
                    $relatedDescriptor = new NotImplemented($deviceHandle, $rawData, $offset);
                    break;
            }
            $length = $relatedDescriptor->bLength;
            $this->_relatedDescriptors[] = $relatedDescriptor;
        }
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
