<?php

namespace GA;

use GA\Encoding\Binary;
use GA\Encoding\Permutation;
use GA\Encoding\Value;
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

        if(!$this->isLegalSize($chromosome)) {
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

    public static function create($encodingType = 'binary', $chromosome = null, $genes = []) : self
    {
        switch($encodingType) {
            case 'binary':
                return new Binary($chromosome, $genes);
                break;

            case 'permutation':
                return new Permutation($chromosome, $genes);
                break;

            case 'value':
                return new Value($chromosome, $genes);
                break;

            default:
                return new Binary($chromosome, $genes);
        }
    }

    private function isLegalSize($chromosome) : bool
    {
        if(is_null($chromosome)) {
            return true;
        }

        if($this->getType() === 'string' && strlen($chromosome) === Settings::CHROMOSOME_SIZE) {
            return true;
        }

        if($this->getType() === 'array' && count($chromosome) === Settings::CHROMOSOME_SIZE) {
            return true;
        }

        return false;
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
     * @return array|null|string
     */
    public function chromosome()
    {
        return $this->chromosome;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    protected function getRandomPosition() : int
    {
        return mt_rand(0, count($this->genes) - 1);
    }

    /**
     * Generate a string chromosome
     *
     * @return string
     */
    private function generateString() :string
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
    private function generateArray() : array
    {
        $chromosome = [];

        for ($i = 0; $i < Settings::CHROMOSOME_SIZE; $i++) {
            $chromosome[$i] = $this->genes[$this->getRandomPosition()];
        }

        return $chromosome;
    }
}
