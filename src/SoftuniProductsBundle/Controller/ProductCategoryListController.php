<?php

namespace SoftuniProductsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use SoftuniProductsBundle\Entity\Product;
use SoftuniProductsBundle\Entity\ProductCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductCategoryListController extends Controller
{
    /**
     * @Route("/category/list", name="product_category_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $productCategory = $em->getRepository('SoftuniProductsBundle:ProductCategory')->findBy([
            'parent' => $request->get('parent', null)], ['rank' => 'ASC']);

        return $this->render('SoftuniProductsBundle:ProductCategoryList:list.html.twig', array(
            'productCategory' => $productCategory,
        ));
    }

    /**
     * @Route("/product/list/{id}", name="product_list")
     * @Method("GET")
     */
    public function productListAction(ProductCategory $productCategory)
    {

        $products = $productCategory->getProducts();

        return $this->render('SoftuniProductsBundle:ProductCategoryList:productlist.html.twig', array(
            'products' => $products, 'productCategory' =>$productCategory
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/product/{id}/view", name="product_view")
     * @Method("GET")
     */
    public function showAction(Product $product)
    {

        return $this->render('SoftuniProductsBundle:ProductCategoryList:view.html.twig', array(
            'product' => $product,
        ));
    }
}
