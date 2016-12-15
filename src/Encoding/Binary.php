<?php

namespace GA\Encoding;

use GA\Encoding;
use GA\Settings;

/**
 * Binary encoding is the most common, mainly because first works about GA used this type of encoding.
 *
 * In binary encoding every chromosome is a string of bits, 0 or 1.
 *
 * Chromosome A	101100101100101011100101
 * Chromosome B	111111100000110000011111
 * Example of chromosomes with binary encoding
 *
 * Binary encoding gives many possible chromosomes even with a small number of alleles. On the other hand, this encoding
 * is often not natural for many problems and sometimes corrections must be made after crossover and/or mutation.
 *
 * Class Binary
 * @package GA\Encoding
 */
class Binary extends Encoding
{
    protected $genes = [0, 1];

    /**
     * @param null $bit
     * @return int
     */
    public function flipBit($bit = null) : int
    {
        if(is_null($bit)) {
            return $this->genes[$this->getRandomPosition()];
        }

        if($bit === 1) {
            return 0;
        }

        return 1;
    }

    /**
     * @return Binary
     */
    public function mutate() : self
    {
        $chromosome = $this->chromosome;

        for($i = 0; $i < Settings::CHROMOSOME_SIZE; $i++) {
            $rnd = (float) mt_rand() / (float) getrandmax();

            if($rnd <= (1 / Settings::CHROMOSOME_SIZE)) {
                $gene = (int) substr($chromosome, $i , 1);
                $newGene = $this->flipBit($gene);

                $chromosome = substr_replace($chromosome, $newGene, $i, 1);
            }
        }

        return new self($chromosome);
    }
}