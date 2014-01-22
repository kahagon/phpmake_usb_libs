<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

/**
 * @property-read PHPMake\USB\DescriptorField $bLength
 * @property-read PHPMake\USB\DescriptorField $bDescriptorType
 * @property-read PHPMake\USB\DescriptorField $bcdUSB
 * @property-read PHPMake\USB\DescriptorField $bDeviceClass
 * @property-read PHPMake\USB\DescriptorField $bDeviceSubClass
 * @property-read PHPMake\USB\DescriptorField $bDeviceProtocol
 * @property-read PHPMake\USB\DescriptorField $bMaxPacketSize0
 * @property-read PHPMake\USB\DescriptorField $idVendor
 * @property-read PHPMake\USB\DescriptorField $idProduct
 * @property-read PHPMake\USB\DescriptorField $bcdDevice
 * @property-read PHPMake\USB\DescriptorField $iManufacturer
 * @property-read PHPMake\USB\DescriptorField $iSerialNumber
 * @property-read PHPMake\USB\DescriptorField $bNumConfigurations 
 */
class Device extends Descriptor {


    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField('bLength', 1),
            new DescriptorField('bDescriptorType', 1),
            new DescriptorField('bcdUSB', 2),
            new DescriptorField('bDeviceClass', 1),
            new DescriptorField('bDeviceSubClass', 1),
            new DescriptorField('bDeviceProtocol', 1),
            new DescriptorField('bMaxPacketSize0', 1),
            new DescriptorField('idVendor', 2),
            new DescriptorField('idProduct', 2),
            new DescriptorField('bcdDevice', 2),
            new DescriptorField('iManufacturer', 1),
            new DescriptorField('iProduct', 1),
            new DescriptorField('iSerialNumber', 1),
            new DescriptorField('bNumConfigurations', 1),
        );
    }
}
