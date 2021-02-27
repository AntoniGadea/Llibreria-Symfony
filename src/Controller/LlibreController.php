<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LlibreController extends AbstractController{
     
    private $llibres = array(
        array("isbn" => "A121B3", "titol" => "Narnia, El principe Caspian","autor" => "C.S. Lewis", "pàgines" => "546"),
        array("isbn" => "B151B5", "titol" => "Juego de Tronos","autor" => "George R.Martin", "pàgines" => "789"),
        array("isbn" => "C131B7", "titol" => "Lazarillo de Tormes","autor" => "Juan de Ortega", "pàgines" => "356"),
        array("isbn" => "D111B9", "titol" => "Tirant lo Blanc","autor" => "Joanot Martorell", "pàgines" => "456"),
        array("isbn" => "E161B1", "titol" => "EL Quijote","autor" => "Miguel de Cervantes", "pàgines" => "897"),
    );

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