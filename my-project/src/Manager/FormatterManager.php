<?php
declare(strict_types=1);

namespace App\Manager;

use NumberFormatter;
use Symfony\Component\HttpFoundation\RequestStack;

final class FormatterManager implements FormatterManagerInterface
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function format(int $number): string
    {
        if ($this->requestStack->getMainRequest()->headers->contains('Accept-Language', 'lv')) {
            $lang = 'lv';
        } else {
            $lang = 'en';
        }

        return NumberFormatter::create($lang, NumberFormatter::SPELLOUT)->format($number);
    }
}
