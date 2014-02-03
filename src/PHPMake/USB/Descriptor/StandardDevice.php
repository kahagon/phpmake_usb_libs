<?php
namespace PHPMake\USB\Descriptor;
use PHPMake\USB\Descriptor;
use PHPMake\USB\DescriptorField;

/**
 * @property-read PHPMake\USB\DescriptorField\Integer $bLength
 * @property-read PHPMake\USB\DescriptorField\Integer $bDescriptorType
 * @property-read PHPMake\USB\DescriptorField\BCD $bcdUSB
 * @property-read PHPMake\USB\DescriptorField\Integer $bDeviceClass
 * @property-read PHPMake\USB\DescriptorField\Integer $bDeviceSubClass
 * @property-read PHPMake\USB\DescriptorField\Integer $bDeviceProtocol
 * @property-read PHPMake\USB\DescriptorField\Integer $bMaxPacketSize0
 * @property-read PHPMake\USB\DescriptorField\Integer $idVendor
 * @property-read PHPMake\USB\DescriptorField\Integer $idProduct
 * @property-read PHPMake\USB\DescriptorField\BCD $bcdDevice
 * @property-read PHPMake\USB\DescriptorField\Integer $iManufacturer
 * @property-read PHPMake\USB\DescriptorField\Integer $iSerialNumber
 * @property-read PHPMake\USB\DescriptorField\Integer $bNumConfigurations 
 */
class StandardDevice extends Descriptor {

    public function getDescriptorType() {
        return Descriptor::TYPE_DEVICE;
    }

    protected function _defineDescriptorFields() {
        return array(
            new DescriptorField\Integer('bLength', 1),
            new DescriptorField\Integer('bDescriptorType', 1),
            new DescriptorField\BCD('bcdUSB', 2),
            new DescriptorField\Integer('bDeviceClass', 1),
            new DescriptorField\Integer('bDeviceSubClass', 1),
            new DescriptorField\Integer('bDeviceProtocol', 1),
            new DescriptorField\Integer('bMaxPacketSize0', 1),
            new DescriptorField\Integer('idVendor', 2),
            new DescriptorField\Integer('idProduct', 2),
            new DescriptorField\BCD('bcdDevice', 2),
            new DescriptorField\IndexedString('iManufacturer', 1),
            new DescriptorField\IndexedString('iProduct', 1),
            new DescriptorField\IndexedString('iSerialNumber', 1),
            new DescriptorField\Integer('bNumConfigurations', 1),
        );
    }
}
