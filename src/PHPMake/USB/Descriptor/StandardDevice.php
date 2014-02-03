<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

/**
 * @property-read PHPMake\USB\DescriptorField\Integer $bLength
 * @property-read PHPMake\USB\DescriptorField\Integer $bDescriptorType
 * @property-read PHPMake\USB\DescriptorField\Integer $bcdUSB
 * @property-read PHPMake\USB\DescriptorField\Integer $bDeviceClass
 * @property-read PHPMake\USB\DescriptorField\Integer $bDeviceSubClass
 * @property-read PHPMake\USB\DescriptorField\Integer $bDeviceProtocol
 * @property-read PHPMake\USB\DescriptorField\Integer $bMaxPacketSize0
 * @property-read PHPMake\USB\DescriptorField\Integer $idVendor
 * @property-read PHPMake\USB\DescriptorField\Integer $idProduct
 * @property-read PHPMake\USB\DescriptorField\Integer $bcdDevice
 * @property-read PHPMake\USB\DescriptorField\Integer $iManufacturer
 * @property-read PHPMake\USB\DescriptorField\Integer $iSerialNumber
 * @property-read PHPMake\USB\DescriptorField\Integer $bNumConfigurations 
 */
class StandardDevice extends Descriptor {


    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField\Integer('bLength', 1),
            new DescriptorField\Integer('bDescriptorType', 1),
            new DescriptorField\Integer('bcdUSB', 2),
            new DescriptorField\Integer('bDeviceClass', 1),
            new DescriptorField\Integer('bDeviceSubClass', 1),
            new DescriptorField\Integer('bDeviceProtocol', 1),
            new DescriptorField\Integer('bMaxPacketSize0', 1),
            new DescriptorField\Integer('idVendor', 2),
            new DescriptorField\Integer('idProduct', 2),
            new DescriptorField\Integer('bcdDevice', 2),
            new DescriptorField\Integer('iManufacturer', 1),
            new DescriptorField\Integer('iProduct', 1),
            new DescriptorField\Integer('iSerialNumber', 1),
            new DescriptorField\Integer('bNumConfigurations', 1),
        );
    }
}
