<?php

namespace App\ExpressTest\UseCase\Output;

readonly class DisplayTestOutput
{
    public function __construct(
        public int $testId,
        public string $testName,
    ) {
        /*_*/
    }
}