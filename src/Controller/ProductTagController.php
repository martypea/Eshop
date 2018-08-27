<?php

namespace App\Controller;

use App\Entity\ProductTag;
use App\Form\ProductTagType;
use App\Repository\ProductTagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/tag")
 */
class ProductTagController extends Controller
{
    /**
     * @Route("/", name="product_tag_index", methods="GET|POST")
     */
    public function index(Request $request, ProductTagRepository $productTagRepository): Response
    {
      $productTag = new ProductTag();
        $form = $this->createForm(ProductTagType::class, $productTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productTag);
            $em->flush();

            return $this->redirectToRoute('product_tag_index');
        }
      
        return $this->render('product_tag/index.html.twig',[
            'product_tag' => $productTag,
            'form' => $form->createView(),
            'product_tags' => $productTagRepository->findAll(),

        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_tag_edit", methods="GET|POST")
     */
    public function edit(Request $request, ProductTag $productTag, ProductTagRepository $productTagRepository): Response
    {
        $form = $this->createForm(ProductTagType::class, $productTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_tag_edit', ['id' => $productTag->getId()]);
        }

        return $this->render('product_tag/edit.html.twig', [
            'product_tag' => $productTag,
            'form' => $form->createView(),
          'product_tags' => $productTagRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_tag_delete", methods="DELETE")
     */
    public function delete(Request $request, ProductTag $productTag): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productTag->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productTag);
            $em->flush();
        }

        return $this->redirectToRoute('product_tag_index');
    }
}
