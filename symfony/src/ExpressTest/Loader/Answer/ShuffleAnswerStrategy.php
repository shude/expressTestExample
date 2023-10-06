<?php

namespace App\ExpressTest\Loader\Answer;

use Exception;

readonly class ShuffleAnswerStrategy implements AnswerStrategyInterface
{
    public function __construct(
        private DirectAnswerStrategy $answerStrategy,
    ) {
        /*_*/
    }

    /**
     * @throws Exception
     */
    public function getAnswers(int $questionId): array
    {
        $result = $this->answerStrategy->getAnswers($questionId);
        shuffle($result);
        return $result;
    }
}