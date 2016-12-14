<?php

namespace GA;

use GA\Encoding\Binary;

class Individual
{
    /* @var Encoding $encoding */
    private $encoding;

    public function __construct($encoding = null)
    {
        if($encoding instanceof Encoding) {
            $this->encoding = $encoding;
        } else {
            $this->encoding = new Binary(); // Default to binary
        }
    }

    /**
     * @return \GA\Encoding
     */
    public function encoding()
    {
        return $this->encoding;
    }

}