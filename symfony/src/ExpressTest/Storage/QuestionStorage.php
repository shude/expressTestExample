<?php

namespace App\ExpressTest\Storage;

use App\ExpressTest\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuestionStorage extends ServiceEntityRepository implements QuestionStorageInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function getQuestionsByTestId(int $testId): array
    {
        return $this->createQueryBuilder('q', 'q.id')
            ->andWhere('q.test = :testId')
            ->setParameter('testId', $testId)
            ->getQuery()
            ->getResult();
    }
}