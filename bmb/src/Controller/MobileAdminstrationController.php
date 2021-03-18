<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\CategoryInput;
use App\Entity\Produits;
use App\Entity\ProduitsInput;
use App\Repository\CategoryInputRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProduitsInputRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
     * @Route("/mobile", name="mobile_adminstration")
     */
class MobileAdminstrationController extends AbstractController
{
    /**
     * @Route("/home", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository,CategoryInputRepository $categoryInputRepository,ProduitsInputRepository $produitsInputRepository): Response
    {
        return $this->render('mobile_adminstration/index.html.twig', [
            'categorie' => $categoryRepository->findAll(),
            'categorieinput' => $categoryInputRepository->findAll(),
            'produitsinput' => $produitsInputRepository->findAll(),
            // 'produits'=>$produitsRepository->findAll()
        ]);
    }
    /**
     * @Route("/produits", methods={"GET"} ,name="produits")
     */
    public function getproduits(ProduitsRepository $produitsRepository): Response
    {
        return $this->render('mobile_adminstration/produits.html.twig', [
            'produits'=>$produitsRepository->findAll()
        ]);
    }
        /**
     * @Route("/savecategorie",name="add_categorie", methods={"POST"})
     */
    public function savecategorie(Request $request,EntityManagerInterface $entityManagerInterface){
        $data=json_decode($request->getContent(),true);
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $requestFile=$request->files->all();
        $sfile = $requestFile["image"];
        $nom=$this->saveimage($sfile,$data['nomImage']);
        $slug=$this->createSlug($data['nom']);
        $categorie= new Category();
        $categorie->setNom($data['nom'])
                  ->setImage('uploads/'.$data['nomImage'])
                  ->setPosition(0)
                  ->setSlug($slug)
                  ->setDescription($data['description']);
        $entityManagerInterface->persist($categorie);
        $entityManagerInterface->flush();
        return $this->json([
            'Message'=>'good'
        ]);
    }
        /**
     * @Route("/removecategorie",name="remove_categorie", methods={"POST"})
     */
    public function suppresion(Request $request,EntityManagerInterface $entityManagerInterface,CategoryRepository $categoryRepository){
        $data=json_decode($request->getContent(),true);
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $id=$data['id'];
        $cat=$categoryRepository->find($id);
        $entityManagerInterface->remove($cat);
        $entityManagerInterface->flush();
        return $this->json([
            'Message'=>'good'
        ]);
    }

            /**
     * @Route("/saveproduits",name="add_produits", methods={"POST"})
     */
    public function saveproduits(Request $request,EntityManagerInterface $entityManagerInterface,CategoryRepository $categoryRepository){
        $data=json_decode($request->getContent(),true);
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $requestFile=$request->files->all();
        $sfile = $requestFile["image"];
        $nom=$this->saveimage($sfile,$data['nomImage']);
        $slug=$this->createSlug($data['nom']);
        $produits= new Produits();
        $produits->setNom($data['nom'])
                  ->setImage('uploads/'.$data['nomImage'])
                  ->setCouleur($data['couleur'])
                  ->setSlug($slug)
                  ->setDimmenssion($data['dimmension'])
                  ->setDescription($data['description']);
        $al=$categoryRepository->findAll();
        if (($al[0])) {
            $cat=$al[0];
            $produits->setCategorie($cat);
        }
        $entityManagerInterface->persist($produits);
        $entityManagerInterface->flush();
        return $this->json([
            'Message'=>'good'
        ]);
    }
        /**
     * @Route("/removeproduits",name="remove_produits", methods={"POST"})
     */
    public function suppresionproduits(Request $request,EntityManagerInterface $entityManagerInterface,ProduitsRepository $categoryRepository){
        $data=json_decode($request->getContent(),true);
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $id=$data['id'];
        $cat=$categoryRepository->find($id);
        $entityManagerInterface->remove($cat);
        $entityManagerInterface->flush();
        return $this->json([
            'Message'=>'good'
        ]);
    }



    /**
     * @Route("/addinputcat", methods={"POST"})
     */
    public function addinputat(Request $request,EntityManagerInterface $entityManagerInterface){
        $data=json_decode($request->getContent(),true);
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $categotyinput= new CategoryInput();
        $categotyinput->setNom($data['nom']);
        $categotyinput->settype('texte');
        $entityManagerInterface->persist($categotyinput);
        $entityManagerInterface->flush();
        return $this->json([
            'Message'=>'good'
        ]);
    }
        /**
     * @Route("/removeinputcat", methods={"POST"})
     */
    public function removeinputcat(Request $request,EntityManagerInterface $entityManagerInterface,CategoryInputRepository $categoryInputRepository){
        $data=json_decode($request->getContent(),true);
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $categotyinput= $categoryInputRepository->find($data['id']);
        $entityManagerInterface->remove($categotyinput);
        $entityManagerInterface->flush();
        return $this->json([
            'Message'=>'good'
        ]);
    }


    /**
     * @Route("/addinputproduits", methods={"POST"})
     */
    public function addinputproduits(Request $request,EntityManagerInterface $entityManagerInterface){
        $data=json_decode($request->getContent(),true);
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $produitInput= new ProduitsInput();
        $produitInput->setNom($data['nom']);
        $produitInput->settype('texte');
        $entityManagerInterface->persist($produitInput);
        $entityManagerInterface->flush();
        return $this->json([
            'Message'=>'good'
        ]);
    }
        /**
     * @Route("/removeinputproduits", methods={"POST"})
     */
    public function removeinputproduits(Request $request,EntityManagerInterface $entityManagerInterface,ProduitsInputRepository $produitsInputRepository){
        $data=json_decode($request->getContent(),true);
        if(!$data){//s il n'existe pas donc on recupere directement le tableau via la request
            $data=$request->request->all();
        }
        $categotyinput= $produitsInputRepository->find($data['id']);
        $entityManagerInterface->remove($categotyinput);
        $entityManagerInterface->flush();
        return $this->json([
            'Message'=>'good'
        ]);
    }
    /**
     * @Route("/allcategorie", methods={"GET"})
     */
    public function allcategorie(CategoryRepository $categoryRepository,SerializerInterface $serializer){
        $cat=$categoryRepository->findAll();
        $data = $serializer->serialize($cat, 'json', [
            'groups' => ['list']
        ]);
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
    public function saveimage($file,$nom){
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getParameter('chemin'), $nom);
        return $fileName;
    }
    public static function createSlug($str, $delimiter = '-'){

        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;
    
    } 
}
