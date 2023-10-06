<?php

namespace App\ExpressTest\Loader;

use App\ExpressTest\Dto\TestStateDto;

interface StateLoaderInterface
{
    public function loadState(string $identifier): TestStateDto|null;

    public function saveState(TestStateDto $state, string $identifier): void;

    public function removeState(string $identifier): void;
}