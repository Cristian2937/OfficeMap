<?php

namespace App\Repository;

use App\Entity\PersonaGiuridica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PersonaGiuridica>
 *
 * @method PersonaGiuridica|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonaGiuridica|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonaGiuridica[]    findAll()
 * @method PersonaGiuridica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaGiuridicaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonaGiuridica::class);
    }

    public function save(PersonaGiuridica $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PersonaGiuridica $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PersonaGiuridica[] Returns an array of PersonaGiuridica objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PersonaGiuridica
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
