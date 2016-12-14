<?php

namespace GA\Reproduction;

use GA\Reproduction;
use GA\Encoding;

/**
 * Class TwoPointCrossOver
 *
 * Two-point crossover calls for two points to be selected on
 * the parent organism strings. Everything between the two points
 * is swapped between the parent organisms, rendering two child organisms
 *
 * Example:
 * Parents:  11111 & 00000
 * Cross over points 2,4
 * Children: 10001 & 01110
 *
 * @package GA\Reproduction
 */
class TwoPointCrossOver extends Reproduction
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

            $crossOverPointA = mt_rand(0, ($max/2));
            $crossOverPointB = mt_rand(($max / 2) + 1, $max);

            $geneAA = array_slice($fc, 0, $crossOverPointA);
            $geneAB = array_slice($fc, $crossOverPointA, $crossOverPointB - $crossOverPointA);
            $geneAC = array_slice($fc, $crossOverPointB);

            $geneBA = array_slice($mc, 0, $crossOverPointA);
            $geneBB = array_slice($mc, $crossOverPointA, $crossOverPointB - $crossOverPointA);
            $geneBC = array_slice($mc, $crossOverPointB);

            $childGeneA = array_merge($geneAA, $geneBB,  $geneAC);
            $childGeneB = array_merge($geneBA, $geneAB, $geneBC);
        } else {
            $max = strlen($fc);

            $crossOverPointA = mt_rand(0, ($max/2));
            $crossOverPointB = mt_rand(($max / 2) + 1, $max);

            $geneAA = substr($fc, 0, $crossOverPointA);
            $geneAB = substr($fc, $crossOverPointA, $crossOverPointB - $crossOverPointA);
            $geneAC = substr($fc, $crossOverPointB);

            $geneBA = substr($mc, 0, $crossOverPointA);
            $geneBB = substr($mc, $crossOverPointA, $crossOverPointB - $crossOverPointA);
            $geneBC = substr($mc, $crossOverPointB);

            $childGeneA = $geneAA . $geneBB . $geneAC;
            $childGeneB = $geneBA . $geneAB . $geneBC;
        }

        return [$childGeneA, $childGeneB];
    }

}