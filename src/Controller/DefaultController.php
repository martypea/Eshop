<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;

class DefaultController extends Controller
{
  /**
   * @Route("/",name="startpage")
   */
  public function index(ProductCategoryRepository $productCategoryRepository)
  {
    return $this->render('default/index.html.twig', ['product_categories' => $productCategoryRepository->findAll()]);
  }
  
  /**
   * @Route("/admin",name="adminpage")
   */
  public function admin(ProductCategoryRepository $productCategoryRepository)
  {
    return $this->render('default/admin.html.twig', ['product_categories' => $productCategoryRepository->findAll()]);
  }
  
  
}