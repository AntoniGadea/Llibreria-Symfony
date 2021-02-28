<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BDProvaLlibres;
use App\Entity\Llibre;
use Jenssegers\Date\Date;

class IniciController extends AbstractController{
    
    private $llibres;
    private $fecha;
    public function __construct($BDProva, $Fecha){
        $this->llibres = $BDProva->get();
        $this->fecha = $Fecha->get();
    }

    
    /**
     * @Route("/", name="inici")
     */

    public function inici(){
        $repositori = $this->getDoctrine()->getRepository(Llibre::class);
        $llibres = $repositori->findAll();
        $fecha = $this->fecha;

        return $this->render('inici.html.twig', array( 'llibres' => $llibres, 'data' => $fecha));
    }

}
?>