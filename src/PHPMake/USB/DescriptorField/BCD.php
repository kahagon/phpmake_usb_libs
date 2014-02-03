<?php
namespace PHPMake\USB\DescriptorField;
use PHPMake\USB\DescriptorField;

class BCD extends DescriptorField{

    private $_intValue;

    public function getValue() {
        if (null === $this->_intValue) {
            $ret = '';
            for ($i=0; $i<$this->getLength(); $i++) {
                $d = substr($this->getRawData(), $i, 1);
                $_c = unpack('C', $d);
                $c = $_c[1];
                $u = $c>>4;
                $l = $c&0x0F;
printf('$i:%d, $c:%d, $u:%d, $l:%d'.PHP_EOL, $i, $c, $u, $l);
                $ret = $u . $l . $ret;
            }
            $this->_intValue = (int)ltrim($ret, '0');
        }

        return $this->_intValue;
    }
}
