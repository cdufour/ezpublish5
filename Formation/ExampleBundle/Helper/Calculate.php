<?php
namespace Formation\ExampleBundle\Helper;

use Formation\ExampleBundle\Helper\Logger;

class Calculate
{
    private $logger;
    private $coef;

    public function __construct(Logger $logger, $coef)
    {
        $this->logger = $logger;
        $this->coef = $coef;    
    }

    public function add($v1, $v2)
    {
        $result = ($v1 + $v2) * $this->coef;
        $this->logger->log($result);
    }
}



