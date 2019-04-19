<?php

namespace App\Repository;

use App\Entity\TaskFolder;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TaskFolder|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskFolder|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskFolder[]    findAll()
 * @method TaskFolder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskFolderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TaskFolder::class);
    }


    /**
    * @return TaskFolder[] Returns an array of TaskFolder objects
    */
    public function getTaskFolders(User $user, $parent_folder_id = NULL)
    {
        $qb = $this->createQueryBuilder('u')
            ->andWhere('u.createdBy = :user_id');

        if(is_null($parent_folder_id)){
          $qb->andWhere('u.folder IS NULL');
        } else {
          $qb->andWhere('u.folder = :parent_folder_id');
          $qb->setParameter('parent_folder_id', $parent_folder_id);
        }

        $qb->setParameter('user_id', $user->getId());

        return $qb->getQuery()->getResult();
    }

}
