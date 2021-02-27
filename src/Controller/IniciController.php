<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BDProvaLlibres;
use App\Entity\Llibre;


class IniciController extends AbstractController{
    
    private $llibres;
    public function __construct($BDProva){
        $this->llibres = $BDProva->get();
    }
    
    /**
     * @Route("/", name="inici")
     */

    public function inici(){
        $repositori = $this->getDoctrine()->getRepository(Llibre::class);
        $llibres = $repositori->findAll();

        return $this->render('inici.html.twig', array( 'llibres' => $llibres));
    }
}
?>