<?php

namespace App\Manager;

use App\Registry\NumberStackRegistry;

final class NumberStackManager
{
    private NumberStackRegistry $numberStackRegistry;

    public function __construct(NumberStackRegistry $numberStackRegistry)
    {
        $this->numberStackRegistry = $numberStackRegistry;
    }

    public function onPop()
    {

    }

    public function onPush(int $number)
    {
        $this->numberStackRegistry->addNumber($number);
    }
}
