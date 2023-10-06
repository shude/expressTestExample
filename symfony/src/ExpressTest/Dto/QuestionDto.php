<?php

namespace App\ExpressTest\Dto;

readonly class QuestionDto
{
    public function __construct(
        public int $questionId,
        public string $questionText,
    ) {
        /*_*/
    }
}