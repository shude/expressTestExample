<?php

namespace App\ExpressTest\Loader\Question;

use App\ExpressTest\Dto\QuestionDto;
use App\ExpressTest\Dto\TestStateDto;

interface NextQuestionStrategyInterface
{
    public function getNextQuestion(TestStateDto $stateDto): QuestionDto|null;
}