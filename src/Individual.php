<?php

namespace GA;

use GA\Encoding\Binary;

/**
 * Class Individual
 * @package GA
 */
class Individual
{
    /* @var Encoding $encoding */
    private $encoding;

    /**
     * Individual constructor.
     * @param null $encoding
     */
    public function __construct($encoding = null)
    {
        if($encoding instanceof Encoding) {
            $this->encoding = $encoding;
        } else {
            $this->encoding = new Binary(); // Default to binary
        }
    }

    /**
     * @return Encoding
     */
    public function encoding() : Encoding
    {
        return $this->encoding;
    }

}