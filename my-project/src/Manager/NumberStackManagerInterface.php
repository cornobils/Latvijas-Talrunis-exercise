<?php

namespace App\Manager;

use App\Model\PushModel;

interface NumberStackManagerInterface
{
    public function onPop(): string;

    public function onPush(PushModel $pushModel): void;
}
