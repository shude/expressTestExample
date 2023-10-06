<?php

namespace App\ExpressTest\Dto;

readonly class AnswerDto
{
    public function __construct(
        public int $answerId,
        public string $answerText,
    ) {
        /*_*/
    }
}