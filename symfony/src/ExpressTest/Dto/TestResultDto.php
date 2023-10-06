<?php

namespace App\ExpressTest\Dto;

readonly class TestResultDto
{
    public function __construct(
        public string $testName,
        public array $rightAnswers,
        public array $wrongAnswers,
    ) {
        /*_*/
    }
}