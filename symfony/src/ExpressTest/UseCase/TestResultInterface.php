<?php

namespace App\ExpressTest\UseCase;

use App\ExpressTest\Dto\TestResultDto;
use App\ExpressTest\Dto\TestStateDto;

interface TestResultInterface
{
    public function calcResults(TestStateDto $state): TestResultDto;
}