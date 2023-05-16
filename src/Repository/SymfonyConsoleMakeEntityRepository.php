<?php

namespace App\Repository;

use App\Entity\SymfonyConsoleMakeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SymfonyConsoleMakeEntity>
 *
 * @method SymfonyConsoleMakeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SymfonyConsoleMakeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SymfonyConsoleMakeEntity[]    findAll()
 * @method SymfonyConsoleMakeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SymfonyConsoleMakeEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SymfonyConsoleMakeEntity::class);
    }

    public function save(SymfonyConsoleMakeEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SymfonyConsoleMakeEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SymfonyConsoleMakeEntity[] Returns an array of SymfonyConsoleMakeEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SymfonyConsoleMakeEntity
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
