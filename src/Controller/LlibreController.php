<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LlibreController{
     
    private $llibres = array(
        array("isbn" => "A121B3", "titol" => "Narnia, El principe Caspian","autor" => "C.S. Lewis", "pàgines" => "salvasala@simarro.org"),
        array("isbn" => "B151B5", "titol" => "Juego de Tronos","autor" => "George R.Martin", "pàgines" => "annallopis@simarro.org"),
        array("isbn" => "C131B7", "titol" => "Lazarillo de Tormes","autor" => "Juan de Ortega", "pàgines" => "marcsanchis@simarro.org"),
        array("isbn" => "D111B9", "titol" => "Tirant lo Blanc","autor" => "Joanot Martorell", "pàgines" => "laurapalop@simarro.org"),
        array("isbn" => "E161B1", "titol" => "EL Quijote","autor" => "Miguel de Cervantes", "pàgines" => "sarasidle@simarro.org"),
    );

     /**
     *  @Route("/llibre/{isbn}", name="buscar_llibre")
     */

     public function buscar_llibre($isbn){
         $resultat = array_filter($this->llibres,
            function($llibre) use ($isbn){
                return strpos($llibre["titol"], $isbn) !== FALSE;
         });
         $resposta = "";
         if (count($resultat) > 0){
             foreach ($resultat as $llibre)
                $resposta .= "<ul><li>" . $llibre["titol"] . "</li>" .
                "<li>" . $llibre["autor"] . "</li>" .
                "<li>" . $llibre["pàgines"] . "</li></ul>";
            return new Response("<html><body>" . $resposta . "</body></html>");
         }else{
             return new Response("No s'han trobat llibres");
         }

     }


}
?>