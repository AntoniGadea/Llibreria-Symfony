<?php
namespace App\Controller;

use App\Entity\Editorial;
use App\Entity\Llibre;
use App\Repository\LlibreRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BDProvaLlibres;

class LlibreController extends AbstractController{
     
    private $llibres;
    public function __construct($BDProva){
        $this->llibres = $BDProva->get();
    }
    
    /**
     *  @Route("/llibre/nou", name="llibre_nou")
     */

    public function llibre_nou(){
        $llibre = new Llibre();
        $formulari = $this->createFormBuilder($llibre)
            ->add('isbn', TextType::class)
            ->add('titol', TextType::class)
            ->add('autor', TextType::class)
            ->add('pagines', IntegerType::class)
            ->add('editorial_id', EntityType::class, array('class' => Editorial::class,'choice_label' => 'nom'))
            ->add('save', SubmitType::class, array('label' => 'Enviar'))
            ->getForm();
            return $this->render('nou.html.twig',array('formulari' => $formulari->createView()));
     }

    /**
     *  @Route("/llibre/inserir", name="inserir_llibre")
     */

    /**public function inserir_llibre(){
        $entityManager = $this->getDoctrine()->getManager();
        $llibre = new Llibre();
        $llibre->setIsbn("7777SSSS");
        $llibre->setTitol("Noruega");
        $llibre->setAutor("Rafa Lahuela");
        $llibre->setPagines(387);
        $entityManager->persist($llibre);

        try{
            $entityManager->flush();
            return new Response("Llibre inserit amb  isbn " . $llibre->getIsbn());
        } catch (\Exception $e){
            return new Response("Error al inserir el llibre amb isbn " . $llibre->getIsbn());
        }*/

    public function inserir_llibre(){
        $entityManager = $this->getDoctrine()->getManager();
        $llibre1 = new Llibre();
        $llibre2 = new Llibre();
        $llibre3 = new Llibre();

        $llibre1->setIsbn("8888SSSS");
        $llibre1->setTitol("Memorias de una Geisha");
        $llibre1->setAutor("Arthur Golden");
        $llibre1->setPagines(580);

        $llibre2->setIsbn("9999SSSS");
        $llibre2->setTitol("El perfume");
        $llibre2->setAutor("Patrick Süskind");
        $llibre2->setPagines(255);

        $llibre3->setIsbn("3333SSSS");
        $llibre3->setTitol("Harry Potter: La Orden del Fenix");
        $llibre3->setAutor("J. K. Rowling");
        $llibre3->setPagines(647);

        $entityManager->persist($llibre1);
        $entityManager->persist($llibre2);
        $entityManager->persist($llibre3);

        try{
            $entityManager->flush();
            return new Response("Llibres inserits amb  exit: " . $llibre1->getIsbn() . " " . $llibre2->getIsbn() . " " . $llibre3->getIsbn());
        } catch (\Exception $e){
            return new Response("Error al inserir els llibres amb isbn " . $llibre1->getIsbn() . " " . $llibre2->getIsbn() . " ". $llibre3->getIsbn());
            }
        
        
     }

     /**
     *  @Route("/llibre/inserirAmbEditorial", name="inserir_llibreAmbEditorial")
     */


    public function inserir_llibreAmbEditorial(){
        $entityManager = $this->getDoctrine()->getManager();
        $repositoriEditorial = $this->getDoctrine()->getRepository(Editorial::class);

        $llibre = new Llibre();
        $editorial = new Editorial();
        
        
        $query = $repositoriEditorial->findByNom("Bromera");

        if($query){
            foreach ($query as $e) {
                $editorial = $e;
            }
        }else{
            $editorial->setNom("Bromera");
            $entityManager->persist($editorial);
        }
        
        $llibre->setIsbn("8889TTTT");
        $llibre->setTitol("El teu gust");
        $llibre->setAutor("Isabel Clara Simó");
        $llibre->setPagines(208);
        $llibre->setEditorialId($editorial);

        $entityManager->persist($llibre);
        

        try{
            $entityManager->flush();
            return new Response("Llibre amb Editorial inserit amb  exit: " . $llibre->getIsbn());
        } catch (\Exception $e){
            return new Response("Error al inserir el llibre amb Editorial isbn " . $llibre->getIsbn());
            }
        
        
     }

     /**
     *  @Route("/llibre/{isbn}", name="fitxa_llibre")
     */

     public function fitxa_llibre($isbn){
        $repositori = $this->getDoctrine()->getRepository(Llibre::class);
        $llibre = $repositori->find($isbn);
    
         if ($llibre){
             return $this->render('fitxa_llibre.html.twig', array('llibre' => $llibre));
         }else{
             return $this->render('fitxa_llibre.html.twig', array('llibre' => NULL));
         }

     }

    /**
     *  @Route("/llibre/pagines/{pagines<\d+>}", name="pagines_llibre")
     */

     public function filtro_pagines($pagines){
        $repositori = $this->getDoctrine()->getRepository(Llibre::class);
        
        $llibres = $repositori->findByPaginas($pagines);

        if ($llibres){
            return $this->render('inici.html.twig', array('llibres' => $llibres));
        }else{
            return $this->render('inici.html.twig', array('llibres' => NULL));
        }
     }

     


}
?>