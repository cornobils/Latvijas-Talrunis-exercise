<?php

namespace App\Manager;

use App\Registry\NumberStackRegistry;
use NumberFormatter;

final class NumberStackManager
{
    private NumberStackRegistry $numberStackRegistry;

    public function __construct(NumberStackRegistry $numberStackRegistry)
    {
        $this->numberStackRegistry = $numberStackRegistry;
    }

    public function onPush(int $number): void
    {
        $this->numberStackRegistry->addNumber($number);
    }

    public function onPop(): string
    {
        $number = $this->numberStackRegistry->pop();
        return NumberFormatter::create('en', NumberFormatter::SPELLOUT)->format($number);
    }
}
