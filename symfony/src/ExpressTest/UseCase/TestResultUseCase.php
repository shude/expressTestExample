<?php

namespace App\ExpressTest\UseCase;

use App\ExpressTest\Dto\ResultAnswerDto;
use App\ExpressTest\Dto\TestResultDto;
use App\ExpressTest\Dto\TestStateDto;
use App\ExpressTest\Entity\Question;
use App\ExpressTest\Storage\ExpressTestStorageInterface;

readonly class TestResultUseCase implements TestResultInterface
{
    public function __construct(
        private ExpressTestStorageInterface $expressTestStorage,
    ) {

    }

    /**
     * @throws \Exception
     */
    public function calcResults(TestStateDto $state): TestResultDto
    {
        $test = $this->expressTestStorage->getTestById($state->getTestId());
        if (null === $test) {
            throw new \Exception("Тест не существует.");
        }

        $rightAnswers = [];
        $wrongAnswers = [];

        $userAnswers = $state->getAnswers();
        foreach ($test->getQuestions() as $question) {
            $userQuestionAnswers = $userAnswers[$question->getId()];
            $answerResult = new ResultAnswerDto($question->getQuestionText());

            $wrong = $this->getWrondAnswerIds($question);
            $diff = array_diff(array_values($userQuestionAnswers), $wrong);

            if (count($diff) !== count($userQuestionAnswers)) {
                $wrongAnswers[] = $answerResult;
            } else {
                $rightAnswers[] = $answerResult;
            }
        }

        return new TestResultDto($test->getName(), $rightAnswers, $wrongAnswers);
    }

    /**
     * @return int[]
     */
    private function getWrondAnswerIds(Question $question): array
    {
        $result = [];
        foreach ($question->getAnswers() as $answer) {
            if (false === $answer->isIsRight()) {
                $result[] = $answer->getId();
            }
        }
        return $result;
    }
}