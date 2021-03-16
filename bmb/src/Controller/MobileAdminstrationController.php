<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
    /**
     * @Route("/mobile", name="mobile_adminstration")
     */
class MobileAdminstrationController extends AbstractController
{
    /**
     * @Route("/home", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('mobile_adminstration/index.html.twig', [
            'categorie' => $categoryRepository->findAll(),
        ]);
    }
}
