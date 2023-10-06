<?php

namespace App\ExpressTest\Loader;

use App\ExpressTest\Dto\TestStateDto;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class SessionStateLoader implements StateLoaderInterface
{
    public function __construct(private RequestStack $requestStack)
    {
        /*_*/
    }
    public function loadState(string $identifier): TestStateDto|null
    {
        return $this->requestStack->getSession()->get($identifier);
    }

    public function saveState(TestStateDto $state, string $identifier): void
    {
        $this->requestStack->getSession()->set($identifier, $state);
    }

    public function removeState(string $identifier): void
    {
        $this->requestStack->getSession()->remove($identifier);
    }
}