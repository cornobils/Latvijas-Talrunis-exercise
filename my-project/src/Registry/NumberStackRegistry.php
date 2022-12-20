<?php

namespace App\Registry;

use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\PhpArrayAdapter;

final class NumberStackRegistry
{
    const ITEM_NUMBERS = 'numbers';
    const FILENAME = '/numbers.dat';

    private string $cacheDir;

    public function __construct(string $cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    public function addNumber(int $number): void
    {
        $cache = new PhpArrayAdapter(
            $this->cacheDir .self::FILENAME,
            new FilesystemAdapter()
        );
        $item = $cache->getItem(self::ITEM_NUMBERS);
        $stack = $item->get();
        dump($stack);
        $stack->push($number);
        $item->set($stack);
        $cache->save($item);
    }

    public function pop()
    {
        $cache = new PhpArrayAdapter(
            $this->cacheDir .self::FILENAME,
            new FilesystemAdapter()
        );
        $item = $cache->getItem(self::ITEM_NUMBERS);
        /** @var \SplStack $stack */
        $stack = $item->get();
        $result = $stack->pop();
        $item->set($stack);
        $cache->save($item);

        return $result;
    }
}
