<?php
/**
 * The Uniform Crossover uses a fixed mixing ratio between two parents.
 * Unlike one- and two-point crossover, the Uniform Crossover enables the
 * parent chromosomes to contribute the gene level rather than the segment
 * level.
 *
 * If the mixing ratio is 0.5, the offspring has approximately half of the
 * genes from first parent and the other half from second parent, although
 * cross over points can be randomly chosen as seen below:
 *
 * Example:
 * Parents:  11111 & 00000
 * Mixing ratio 0.5
 * Children: 10101 & 01010 (by chance);
 *
 */
namespace GA\Reproduction;

use GA\Individual;
use GA\Settings;

class UniformCrossOver implements ReproductionStrategy
{
    public function reproduce(Individual $father, Individual $mother)
    {
        $iFather = $father->getChromosome();
        $iMother = $mother->getChromosome();

        $childGeneA = $father->getChromosome();
        $childGeneB = $mother->getChromosome();

        $max = strlen($iFather);

        for($i = 0; $i < $max; $i++) {
            $rnd = (float)mt_rand()/(float)getrandmax();

            if($rnd <= Settings::UNIFORM_CROSSOVER_MIXING_RATIO) {
                $fg = substr($iFather, $i, 1);
                $mg = substr($iMother, $i, 1);

                $childGeneA = substr_replace($childGeneA, $mg, $i, 1);
                $childGeneB = substr_replace($childGeneB, $fg, $i, 1);
            }
        }

        $childA = new Individual($childGeneA);
        $childB = new Individual($childGeneB);

        return [$childA, $childB];
    }
}