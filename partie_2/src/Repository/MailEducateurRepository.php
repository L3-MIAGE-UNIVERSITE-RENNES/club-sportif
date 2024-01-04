<?php

namespace App\Repository;

use App\Entity\MailEducateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MailEducateur>
 *
 * @method MailEducateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailEducateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailEducateur[]    findAll()
 * @method MailEducateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailEducateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailEducateur::class);
    }

    public function deleteById($id)
    {
        $item = $this->find($id);
        if ($item) {
            $this->_em->remove($item);
            $this->_em->flush();
        }
    }

    public function getByEducateurId($id)
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.expediteur', 's')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }



//    /**
//     * @return MailEducateur[] Returns an array of MailEducateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MailEducateur
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
