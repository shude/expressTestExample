<?php

namespace App\ExpressTest\Storage;

use App\ExpressTest\Entity\ExpressTest;

interface ExpressTestStorageInterface
{
    /**
     * @return ExpressTest[]
     */
    public function getTestsList(): iterable;

    public function getTestById(int $testId): ExpressTest|null;
}