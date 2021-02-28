<?php
namespace App\Service;

use Jenssegers\Date\Date;
use Symfony\Component\HttpFoundation\Response;

class Fecha{
    
    public function get(){
        Date::setLocale('ca_ES');
        $hui = Date::now();

        return ucfirst($hui-> format('l j F')) . ' de ' . $hui->format('Y') . ', carregat a les ' . $hui->format('H:i:s');
    }
}
?>