<?php

namespace App\Registry;

use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\PhpArrayAdapter;

final class NumberStackRegistry
{
    private string $cacheDir;

    public function __construct(string $cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    public function addNumber(int $number)
    {
        $cache = new PhpArrayAdapter(
            $this->cacheDir . '/numbers.dat',
            new FilesystemAdapter()
        );
        $item = $cache->getItem('numbers');
        dump($item->get());
        $stack = new \SplStack();
        $stack->push($number);
        $item->set($stack);
        $cache->save($item);
    }
}
