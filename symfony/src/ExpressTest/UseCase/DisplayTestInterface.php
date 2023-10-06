<?php

namespace App\ExpressTest\UseCase;

use App\ExpressTest\UseCase\Output\DisplayTestOutput;

interface DisplayTestInterface
{
    /**
     * @return DisplayTestOutput[]
     */
    public function getTestsForDisplay(): iterable;
}