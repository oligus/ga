<?php

namespace GA;

use GA\Encoding\EncodingException;

/**
 * Class Encoding
 * @package GA
 */
abstract class Encoding
{
    protected $type = 'string';
    protected $chromosome;
    protected $genes = [];

    /**
     * Encoding constructor.
     * @param null $chromosome
     * @param array $genes
     * @throws EncodingException
     */
    public function __construct($chromosome = null, $genes = [])
    {
        if(!is_null($chromosome) && strlen($chromosome) < Settings::CHROMOSOME_SIZE) {
            throw new EncodingException('Illegal chromosome size');
        }

        if(!is_array($genes)) {
            throw new EncodingException('Genes must be of type array');
        }

        if(!empty($genes)) {
            $this->genes = $genes;
        }

        $this->chromosome = empty($chromosome) ? $this->generate() : $chromosome;
    }

    /**
     * Generate a chromosome
     *
     * @return array|string
     */
    public function generate()
    {
        if($this->type === 'array') {
            return $this->generateArray();
        }

        return $this->generateString();
    }

    /**
     * @return int
     */
    protected function getRandomPosition() : int
    {
        return mt_rand(0, count($this->genes) - 1);
    }

    /**
     * @return array|null|string
     */
    public function chromosome()
    {
        return $this->chromosome;
    }

    /**
     * Generate a string chromosome
     *
     * @return string
     */
    private function generateString()
    {
        $chromosome = '';

        for ($i = 0; $i < Settings::CHROMOSOME_SIZE; $i++) {
            $chromosome = $chromosome . $this->genes[$this->getRandomPosition()];
        }

        return $chromosome;
    }

    /**
     * Generate a array chromosome
     *
     * @return array
     */
    private function generateArray()
    {
        $chromosome = [];

        for ($i = 0; $i < Settings::CHROMOSOME_SIZE; $i++) {
            $chromosome[$i] = $this->genes[$this->getRandomPosition()];
        }

        return $chromosome;
    }
}
