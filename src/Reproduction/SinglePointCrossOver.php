<?php

namespace GA\Reproduction;

use GA\Reproduction;
use GA\Encoding;

/**
 * Class SinglePointCrossOver
 *
 * A single crossover point on both parents' organism strings is selected.
 * All data beyond that point in either organism string is swapped between
 * the two parent organisms. The resulting organisms are the children.
 *
 * Example:
 * Parents:  11111 & 00000
 * Cross over point 3
 * Children: 11100 & 00011
 *
 * @package GA\Reproduction
 */
class SinglePointCrossOver extends Reproduction
{
    /**
     * @param Encoding $father
     * @param Encoding $mother
     * @return array
     */
    protected function encoding(Encoding $father, Encoding $mother) : array
    {
        $type = $father->getType();

        $fc = $father->chromosome();
        $mc = $mother->chromosome();

        if($type === 'array') {
            $max = count($fc);

            $crossOverPoint = mt_rand(1, $max -1);

            $geneAA = array_slice($fc, 0, $crossOverPoint);
            $geneAB = array_slice($fc, $crossOverPoint);
            $geneBA = array_slice($mc, 0 , $crossOverPoint);
            $geneBB = array_slice($mc, $crossOverPoint);

            $childGeneA = array_merge($geneAA, $geneBB);
            $childGeneB = array_merge($geneBA, $geneAB);
        } else {
            $max = strlen($fc);

            $crossOverPoint = mt_rand(1, $max -1);

            $geneAA = substr($fc, 0, $crossOverPoint);
            $geneAB = substr($fc, $crossOverPoint);
            $geneBA = substr($mc, 0 , $crossOverPoint);
            $geneBB = substr($mc, $crossOverPoint);

            $childGeneA = $geneAA . $geneBB;
            $childGeneB = $geneBA . $geneAB;
        }

        return [$childGeneA, $childGeneB];

    }

}