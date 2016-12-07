<?php

namespace GA\Encoding;

use GA\Encoding;
use GA\Settings;

/**
 * Permutation encoding can be used in ordering problems, such as travelling salesman problem or task ordering problem.
 *
 * In permutation encoding, every chromosome is a string of numbers, which represents number in a sequence.
 *
 * Chromosome A	1  5  3  2  6  4  7  9  8
 * Chromosome B	8  5  6  7  2  3  1  4  9
 *
 * Example of chromosomes with permutation encoding
 *
 * Permutation encoding is only useful for ordering problems. Even for this problems for some types of crossover and
 * mutation corrections must be made to leave the chromosome consistent (i.e. have real sequence in it).
 *
 * Class Binary
 * @package GA\Encoding
 */
class Permutation extends Encoding
{
    protected $genes = [1, 2, 3, 4, 5, 6, 7, 8, 9];

    /**
     * Order changing - two numbers are selected and exchanged
     *
     * @return Permutation
     */
    public function mutate()
    {
        $chromosome = $this->chromosome;

        $firstPosition = mt_rand(0, Settings::CHROMOSOME_SIZE);

        do {
            $lastPosition = mt_rand(0, Settings::CHROMOSOME_SIZE);
        } while($lastPosition === $firstPosition);

        $firstGene =  (int) substr($chromosome, $firstPosition , 1);
        $lastGene =  (int) substr($chromosome, $lastPosition , 1);

        $chromosome = substr_replace($chromosome, $lastGene, $firstPosition, 1);
        $chromosome = substr_replace($chromosome, $firstGene, $lastPosition, 1);

        return new self($chromosome);
    }
}