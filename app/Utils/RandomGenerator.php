<?php

namespace App\Utils;

class RandomGenerator
{
    private bool $isNumberOnly = false;
    private bool $isCapitalOnly = false;
    private int $length = 5;

    public function __construct($isNumberOnly = false, $isCapitalOnly = false, $length = 5)
    {
        $this->isNumberOnly = $isNumberOnly;
        $this->isCapitalOnly = $isCapitalOnly;
        $this->length = $length;
    }

    public function generate(): string
    {
        $combination = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($this->isNumberOnly) {
            $combination = '0123456789';
        }

        if ($this->isCapitalOnly) {
            $combination = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        $combinationLength = strlen($combination);
        $generatedString = '';
        for ($i = 0; $i < $this->length; $i++) {
            $generatedString .= $combination[rand(0, $combinationLength - 1)];
        }

        return $generatedString;
    }
}
