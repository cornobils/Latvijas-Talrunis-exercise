<?php

namespace App\Registry;

use App\Exception\StackEmptyException;
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
        $stack->push($number);
        $item->set($stack);
        $cache->save($item);
    }

    /**
     * @return int
     * @throws StackEmptyException
     */
    public function pop()
    {
        $cache = new PhpArrayAdapter(
            $this->cacheDir .self::FILENAME,
            new FilesystemAdapter()
        );
        $item = $cache->getItem(self::ITEM_NUMBERS);
        /** @var \SplStack $stack */
        $stack = $item->get();
        if ($stack->isEmpty()) {
            throw new StackEmptyException();
        }
        $result = $stack->pop();
        $item->set($stack);
        $cache->save($item);

        return $result;
    }
}
