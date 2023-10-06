<?php

namespace App\ExpressTest\Storage;

use App\ExpressTest\Entity\ExpressTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

class ExpressTestStorage extends ServiceEntityRepository implements ExpressTestStorageInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExpressTest::class);
    }

    public function getTestsList(): iterable
    {
        return $this->createQueryBuilder('et')
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getTestById(int $testId): ExpressTest|null
    {
        return $this->createQueryBuilder('t', 't.id')
            ->leftJoin('t.questions', 'q')
            ->leftJoin('q.answers', 'a')
            ->select(['t','q','a'])
            ->andWhere('t.id = :id')
            ->setParameter('id', $testId)
            ->getQuery()
            ->getOneOrNullResult();
    }


}