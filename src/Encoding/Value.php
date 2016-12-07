<?php

namespace GA\Encoding;

use GA\Encoding;
use GA\Settings;

/**
 * Direct value encoding can be used in problems, where some complicated value, such as real numbers, are used.
 * Use of binary encoding for this type of problems would be very difficult.
 *
 * In value encoding, every chromosome is a string of some values. Values can be anything connected to problem,
 * form numbers, real numbers or chars to some complicated objects.
 *
 * Chromosome A	1.2324  5.3243  0.4556  2.3293  2.4545
 * Chromosome B	ABDJEIFJDHDIERJFDLDFLFEGT
 * Chromosome C	(back), (back), (right), (forward), (left)
 *
 * Example of chromosomes with value encoding
 *
 * Value encoding is very good for some special problems. On the other hand, for this encoding is often necessary to
 * develop some new crossover and mutation specific for the problem.
 *
 * Class Value
 * @package GA\Encoding
 */
class Value extends Encoding
{
    protected $type = 'array';

    public function mutate()
    {

    }
}