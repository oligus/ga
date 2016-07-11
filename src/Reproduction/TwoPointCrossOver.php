<?php
/**
 * Two-point crossover calls for two points to be selected on
 * the parent organism strings. Everything between the two points
 * is swapped between the parent organisms, rendering two child organisms
 *
 * Example:
 * Parents:  11111 & 00000
 * Cross over points 2,4
 * Children: 10001 & 01110
 *
 */
namespace GA\Reproduction;

use GA\Individual;

class TwoPointCrossOver implements ReproductionStrategy
{
    public function reproduce(Individual $father, Individual $mother) 
    {
        $father = $father->getChromosome();
        $mother = $mother->getChromosome();

        $max = strlen($father);

        $crossOverPointA = mt_rand(0, ($max/2));
        $crossOverPointB = mt_rand(($max / 2) + 1, $max);

        $geneAA = substr($father, 0, $crossOverPointA);
        $geneAB = substr($father, $crossOverPointA, $crossOverPointB);
        $geneAC = substr($father, $crossOverPointB);

        $geneBA = substr($mother, 0, $crossOverPointA);
        $geneBB = substr($mother, $crossOverPointA, $crossOverPointB);
        $geneBC = substr($mother, $crossOverPointB);

        $childGeneA = $geneAA . $geneBB . $geneAC;
        $childGeneB = $geneBA . $geneAB . $geneBC;

        $childA = new Individual($childGeneA);
        $childB = new Individual($childGeneB);

        return [$childA, $childB];
    }
}