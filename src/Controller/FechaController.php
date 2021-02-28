<?php
namespace App\Controller;

use Jenssegers\Date\Date;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FechaController{


     /**
     * @Route("/dates", name="dates",  methods={"GET"})
     */

    public function dates(){
        Date::setLocale('ca_ES');
        $hui = Date::now();

        return new Response($hui->format('l j F') . ' de ' . $hui->format('Y') . ', carregat a les ' . $hui->format('H:i:s'));

     }

}
?>