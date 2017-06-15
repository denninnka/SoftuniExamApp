<?php
/**
 * Created by PhpStorm.
 * User: denninnka
 * Date: 15.06.17
 * Time: 16:15
 */

namespace SoftuniProductsBundle\Services;

use Doctrine\ORM\EntityManager;
use SoftuniProductsBundle\Entity\Product;

class SoftuniProductManager
{
    private $em, $class, $container, $reposytory;

    public function __construct(EntityManager $em, $class, $container)
    {
        $this->em = $em;
        $this->class = $class;
        $this->container = $container;
        $this->reposytory = $this->em->getRepository($class);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getEntityManager()
    {
        return $this->em;
    }
    public function createProduct()
    {
        $class =$this->getClass();
        return new $class;
    }

    public function removeProduct(Product $product)
    {
        $this->em->remove($product);
        $this->em->flush();
    }

    public function findProductBy($criteria)
    {
        return $this->reposytory->findBy($criteria);
    }
}