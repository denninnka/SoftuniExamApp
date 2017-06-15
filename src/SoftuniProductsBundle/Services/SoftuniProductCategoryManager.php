<?php
/**
 * Created by PhpStorm.
 * User: denninnka
 * Date: 15.06.17
 * Time: 16:16
 */

namespace SoftuniProductsBundle\Services;

use Doctrine\ORM\EntityManager;
use SoftuniProductsBundle\Entity\Product;
use SoftuniProductsBundle\Entity\ProductCategory;

class SoftuniProductCategoryManager
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

    public function getEntityManager(){
        return $this->em;
    }

    public function createCategory()
    {
        $class =$this->getClass();
        return new $class;
    }

    public function removeCategory(ProductCategory $product)
    {
        $this->em->remove($product);
        $this->em->flush();
    }

    public function findCategoryBy($criteria)
    {
        return $this->reposytory->findBy($criteria);
    }

    public function addProduct(ProductCategory $productCategory, Product $product)
    {
        $productCategory->addProduct($product);
    }

}