<?php

namespace App\Repository;

use App\Entity\Reclamation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reclamation>
 */
class ReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamation::class);
    }

    /**
     * Compte le nombre de réclamations créées dans les 7 derniers jours
     *
     * @return int
     */
    public function countLast7DaysReclamations(): int
    {
        $date = new \DateTime();
        $date->modify('-7 days');

        return (int) $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->andWhere('r.daterecl >= :date')
            ->setParameter('date', $date->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Récupère le nombre de réclamations par jour dans les 7 derniers jours
     *
     * @param \DateTime $startDate
     * @return array
     */
    public function getReclamationsCountLast7Days(\DateTime $startDate): array
    {
        $qb = $this->createQueryBuilder('r')
            ->select('DATE(r.daterecl) as date', 'COUNT(r.id) as count')
            ->andWhere('r.daterecl >= :startDate')
            ->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
            ->groupBy('date')
            ->orderBy('date', 'ASC');

        $result = $qb->getQuery()->getResult();

        // Convertir les résultats en tableau associatif avec la date comme clé
        $reclamationsPerDay = [];
        foreach ($result as $row) {
            $reclamationsPerDay[$row['date']] = (int) $row['count'];
        }

        return $reclamationsPerDay;
    }
}
