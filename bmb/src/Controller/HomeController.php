<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CategoryRepository $categoryRepository,ProduitsRepository $produitsRepository): Response
    {
        $a=$produitsRepository->findAll();
        shuffle($a);
        return $this->render('home/index.html.twig', [
            'category' => $categoryRepository->findAll(),
            'produit'=> $a
        ]);
    }
    /**
     * @Route("/yaya")
     */
    public function yaya(Request $request){
        $data=json_decode($request->getContent(),true);
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $requestFile=$request->files->all();
        $sfile = $requestFile["audio"];
        $nom=$this->saveimage($sfile);
        return $this->json(['Message'=>$nom]);
    }
    public function saveimage($file){
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getParameter('chemin'), $fileName);
        return $fileName;
    }

}
