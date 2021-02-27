<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BDProvaLlibres;


class IniciController extends AbstractController{
    
    private $llibres;
    public function __construct($BDProva){
        $this->llibres = $BDProva->get();
    }
    
    /**
     * @Route("/", name="inici")
     */

    public function inici(){
        return $this->render('inici.html.twig', array('llibres'=> $this->llibres));
    }
}
?>