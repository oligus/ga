<?php
/**
 * A single crossover point on both parents' organism strings is selected.
 * All data beyond that point in either organism string is swapped between
 * the two parent organisms. The resulting organisms are the children.
 * 
 * Example:
 * Parents:  11111 & 00000
 * Cross over point 3
 * Children: 11100 & 00011
 * 
 */
namespace GA\Reproduction;

use GA\Individual;

class SinglePointCrossOver implements ReproductionStrategy
{
    public function reproduce(Individual $father, Individual $mother)
    {
        $fc = $father->getChromosome();
        $mc = $mother->getChromosome();

        $max = strlen($fc);

        $crossOverPoint = mt_rand(1, $max -1);
        
        $geneAA = substr($fc, 0, $crossOverPoint);
        $geneAB = substr($fc, $crossOverPoint);
        $geneBA = substr($mc, 0 , $crossOverPoint);
        $geneBB = substr($mc, $crossOverPoint);

        $childGeneA = $geneAA . $geneBB;
        $childGeneB = $geneBA . $geneAB;

        $childA = new Individual($childGeneA);
        $childB = new Individual($childGeneB);

        return [$childA, $childB];
    }
}