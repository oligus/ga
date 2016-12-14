<?php

namespace GA;

use GA\Reproduction\ReproductionException;

/**
 * Class Reproduction
 * @package GA
 */
abstract class Reproduction
{
    /**
     * @param Individual $father
     * @param Individual $mother
     * @return array
     * @throws ReproductionException
     */
    public function reproduce(Individual $father, Individual $mother) : array
    {
        if($father->encoding()->getType() !== $father->encoding()->getType()) {
            throw new ReproductionException('Father and mother of incompatible types');
        }

        list($childGeneA, $childGeneB) = $this->encoding($father->encoding(), $mother->encoding());
        $class = get_class($father->encoding());
        $childEncodingA = new $class($childGeneA);
        $childEncodingB = new $class($childGeneB);

        if(!$childEncodingA instanceof Encoding || !$childEncodingB instanceof Encoding) {
            throw new ReproductionException('Illegal child encodings');
        }

        $childA = new Individual($childEncodingA);
        $childB = new Individual($childEncodingB);

        return [$childA, $childB];
    }

    /**
     * @param Encoding $father
     * @param Encoding $mother
     * @return array
     */
     abstract protected function encoding(Encoding $father, Encoding $mother) : array;
}
