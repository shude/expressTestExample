<?php

namespace App\ExpressTest\Loader\Answer;

use App\ExpressTest\Dto\AnswerDto;
use App\ExpressTest\Storage\AnswerStorageInterface;
use Exception;

readonly class DirectAnswerStrategy implements AnswerStrategyInterface
{
    public function __construct(
        private AnswerStorageInterface $answerStorage,
    ) {
        /*_*/
    }

    /**
     * @throws Exception
     */
    public function getAnswers(int $questionId): array
    {
        $answers = $this->answerStorage->getAnswersByQuestionID($questionId);
        if ([] === $answers) {
            throw new Exception("Не существует вопроса или ответов к нему нет.");
        }

        $result = [];
        foreach ($answers as $answer) {
            $result[] = new AnswerDto($answer->getId(), $answer->getAnswerText());
        }

        return $result;
    }
}