<?php

namespace App\ExpressTest\UseCase;

use App\ExpressTest\Storage\ExpressTestStorageInterface;
use App\ExpressTest\UseCase\Output\DisplayTestOutput;

readonly class DisplayTestUseCase implements DisplayTestInterface
{
    public function __construct(
        private ExpressTestStorageInterface $expressTestStorage,
    ) {
        /*_*/
    }
    public function getTestsForDisplay(): iterable
    {
        $tests = $this->expressTestStorage->getTestsList();
        $result = [];
        foreach ($tests as $test) {
            $result[] = new DisplayTestOutput($test->getId(), $test->getName());
        }
        return $result;
    }
}