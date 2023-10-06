<?php

namespace App\ExpressTest\Dto;

class TestStateDto
{
    private int $testId;
    private array $answers = [];

    public function __construct(int $testId)
    {
        $this->testId = $testId;
    }
    public function addAnswers(int $questionId, array $answers): void
    {
        $this->answers[$questionId] = $answers;
    }

    public function getTestId(): int
    {
        return $this->testId;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }
}