<?php

namespace App\Repository;

use App\Entity\Hook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hook[]    findAll()
 * @method Hook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HookRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Hook::class);
    }

    /**
     * @return Hook Returns an object
     */
    public function findBySecret(string $value) {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT p FROM App\Entity\Hook p WHERE p.secret = :value')->setParameter('value', $value);
        return isset($query->getResult()[0]) ? $query->getResult()[0] : false;
    }

}
