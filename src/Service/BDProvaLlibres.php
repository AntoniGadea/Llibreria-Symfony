<?php
namespace App\Service;
class BDProvaLlibres{
    
    private $llibres = array(
        array("isbn" => "A121B3", "titol" => "Narnia, El principe Caspian","autor" => "C.S. Lewis", "pàgines" => "546"),
        array("isbn" => "B151B5", "titol" => "Juego de Tronos","autor" => "George R.Martin", "pàgines" => "789"),
        array("isbn" => "C131B7", "titol" => "Lazarillo de Tormes","autor" => "Juan de Ortega", "pàgines" => "356"),
        array("isbn" => "D111B9", "titol" => "Tirant lo Blanc","autor" => "Joanot Martorell", "pàgines" => "456"),
        array("isbn" => "E161B1", "titol" => "EL Quijote","autor" => "Miguel de Cervantes", "pàgines" => "897"),
    );

    public function get(){
        return $this->llibres;
    }
}
?>