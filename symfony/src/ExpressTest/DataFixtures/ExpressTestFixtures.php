<?php

namespace App\ExpressTest\DataFixtures;

use App\ExpressTest\Entity\Answer;
use App\ExpressTest\Entity\ExpressTest;
use App\ExpressTest\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpressTestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $expressTest = new ExpressTest();
        $expressTest->setName("Демонстрационный экспресс тест");

        $manager->persist($expressTest);

        $this->addQuestion(
            $manager,
            $expressTest,
            "1 + 1 = ?",
            [
                "3" => false,
                "2" => true,
                "0" => false,
            ]
        );

        $this->addQuestion(
            $manager,
            $expressTest,
            "2 + 2 = ?",
            [
                "4" => true,
                "3 + 1" => true,
                "10" => false,
            ]
        );

        $this->addQuestion(
            $manager,
            $expressTest,
            "3 + 3 = ?",
            [
                "1 + 5" => true,
                "1" => false,
                "6" => true,
                "2 + 4" => true,
            ]
        );

        $this->addQuestion(
            $manager,
            $expressTest,
            "4 + 4 = ?",
            [
                "8" => true,
                "4" => false,
                "0" => false,
                "0 + 8" => true,
            ]
        );

        $manager->flush();
    }

    protected function addQuestion(ObjectManager $manager, ExpressTest $parent, string $questionText, array $answers)
    {
        $question = new Question();
        $question->setQuestionText($questionText);
        $question->setTest($parent);

        $manager->persist($question);

        foreach ($answers as $answerText => $isRight) {
            $answer = new Answer();
            $answer->setAnswerText($answerText)
                ->setIsRight($isRight);
            $answer->setQuestion($question);

            $manager->persist($answer);
        }

        $manager->flush();
    }
}