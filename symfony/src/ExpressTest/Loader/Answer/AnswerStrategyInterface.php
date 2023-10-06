<?php

namespace App\ExpressTest\Loader\Answer;

use App\ExpressTest\Dto\AnswerDto;

interface AnswerStrategyInterface
{
    /**
     * @return AnswerDto[]
     */
    public function getAnswers(int $questionId): array;
}