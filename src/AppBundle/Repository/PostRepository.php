<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 20.02.16
 * Time: 9:49
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    /**
     * @param $data
     * @return array
     */
    public function search($data)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.titlePost LIKE :data')
            //   ->orWhere('p.textPost LIKE :data')
            ->setParameter('data', '%' . $data . '%')
            ->orderBy('p.rating', 'DESC')
            ->getQuery()
            ->getResult();
    }

}