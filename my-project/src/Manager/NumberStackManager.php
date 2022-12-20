<?php

namespace App\Manager;

use App\Exception\StackEmptyException;
use App\Model\PushModel;
use App\Registry\NumberStackRegistry;
use NumberFormatter;

final class NumberStackManager
{
    private NumberStackRegistry $numberStackRegistry;

    public function __construct(NumberStackRegistry $numberStackRegistry)
    {
        $this->numberStackRegistry = $numberStackRegistry;
    }

    public function onPush(PushModel $pushModel): void
    {
        $this->numberStackRegistry->addNumber($pushModel->getNumber());
    }

    public function onPop(): string
    {
        try {
            $number = $this->numberStackRegistry->pop();
        } catch (StackEmptyException $e) {
            return 'Empty queue';
        }

        return NumberFormatter::create('en', NumberFormatter::SPELLOUT)->format($number);
    }
}
