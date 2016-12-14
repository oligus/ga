<?php

namespace GA\Reproduction;

use GA\Reproduction;
use GA\Settings;
use GA\Encoding;

/**
 * Class UniformCrossOver
 *
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
 * @package GA\Reproduction
 */
class UniformCrossOver extends Reproduction
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

        $childGeneA = $father->chromosome();
        $childGeneB = $mother->chromosome();

        if($type === 'array') {
            $max = count($fc);

            for($i = 0; $i < $max; $i++) {
                $rnd = (float) mt_rand() / (float) getrandmax();

                if($rnd <= Settings::UNIFORM_CROSSOVER_MIXING_RATIO) {
                    $fg = $fc[$i];
                    $mg = $mc[$i];

                    $childGeneA[$i] = $mg;
                    $childGeneB[$i] = $fg;
                }
            }
        } else {
            $max = strlen($fc);

            for($i = 0; $i < $max; $i++) {
                $rnd = (float) mt_rand() / (float) getrandmax();

                if($rnd <= Settings::UNIFORM_CROSSOVER_MIXING_RATIO) {
                    $fg = substr($fc, $i, 1);
                    $mg = substr($mc, $i, 1);

                    $childGeneA = substr_replace($childGeneA, $mg, $i, 1);
                    $childGeneB = substr_replace($childGeneB, $fg, $i, 1);
                }
            }
        }

        return [$childGeneA, $childGeneB];

    }
}