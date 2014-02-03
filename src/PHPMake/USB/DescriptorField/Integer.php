<?php
namespace PHPMake\USB\DescriptorField;
use PHPMake\USB\DescriptorField;

class Integer extends DescriptorField{

    private $_intValue;

    public function getValue($deviceHandle) {
        if (null === $this->_intValue) {
            $ret = 0;
            for ($i=0; $i<$this->getLength(); $i++) {
                $d = substr($this->getRawData(), $i, 1);
                $c = unpack('C', $d);
                $ret += $c[1] << ($i*8);
            }
            $this->_intValue = $ret;
        }

        return $this->_intValue;
    }
}
