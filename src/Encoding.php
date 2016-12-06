<?php

namespace GA;

abstract class Encoding
{
    protected $type = 'string';
    protected $chromosome;
    protected $genes = [];

    public function generate()
    {
        if($this->type === 'array') {
            return $this->generateArray();
        }

        return $this->generateString();
    }

    protected function getRandomPosition() : int
    {
        return mt_rand(0, count($this->genes) - 1);
    }

    public function chromosome()
    {
        return $this->chromosome;
    }


    private function generateString()
    {
        $chromosome = '';

        for ($i = 0; $i < Settings::CHROMOSOME_SIZE; $i++) {
            $chromosome = $chromosome . $this->genes[$this->getRandomPosition()];
        }

        return $chromosome;
    }

    private function generateArray()
    {
        $chromosome = [];

        for ($i = 0; $i < Settings::CHROMOSOME_SIZE; $i++) {
            $chromosome[$i] = $this->genes[$this->getRandomPosition()];
        }

        return $chromosome;
    }
}
