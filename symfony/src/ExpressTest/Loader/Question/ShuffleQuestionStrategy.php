<?php

namespace App\ExpressTest\Loader\Question;

use App\ExpressTest\Dto\QuestionDto;
use App\ExpressTest\Dto\TestStateDto;
use App\ExpressTest\Storage\QuestionStorageInterface;
use Exception;

readonly class ShuffleQuestionStrategy implements NextQuestionStrategyInterface
{
    public function __construct(
        private QuestionStorageInterface $questionStorage
    ) {
        /*_*/
    }

    /**
     * @throws Exception
     */
    public function getNextQuestion(TestStateDto $stateDto): QuestionDto|null
    {
        $alreadyAnswered = array_keys($stateDto->getAnswers());

        $questions = $this->questionStorage->getQuestionsByTestId($stateDto->getTestId());
        if ([] === $questions) {
            throw new Exception("Отсутствие теста или вопросов к нему.");
        }

        $all = array_keys($questions);

        $diff = array_diff($all, $alreadyAnswered);
        if ([] === $diff) {
            return null;
        }

        shuffle($diff);

        $question = $questions[current($diff)];
        return new QuestionDto($question->getId(), $question->getQuestionText());
    }
}