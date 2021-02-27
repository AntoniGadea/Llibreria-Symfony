<?php
namespace App\Controller;

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
     *  @Route("/llibre/{isbn}", name="fitxa_llibre")
     */

     public function buscar_llibre($isbn){
         $resultat = array_filter($this->llibres,
            function($llibre) use ($isbn){
                return strpos($llibre["isbn"], $isbn) !== FALSE;
         });
         $resposta = "";
         if (count($resultat) > 0){
             return $this->render('fitxa_llibre.html.twig', array('llibre' => array_shift($resultat)));
         }else{
             return $this->render('fitxa_llibre.html.twig', array('llibre' => NULL));
         }

     }


}
?>