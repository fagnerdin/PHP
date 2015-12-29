<?php
/*
 * @todo {construtor de xml}
 * @author {Fagner da Silva}
 */

class Xml{
    //ATRIBUTOS
    private $xml;
    private $tab = 1;
    
    //METODOS
    public function __construct($version='1.0', $encode='UTF-8') {
        $this->xml  .= "<?xml version='$version' encoding='$encode'?>\n";
    }
    
    public function openTag($name) {
        $this->addTab();
        $this->xml .= "<$name>\n";
        $this->tab++;
    }
    
    public function closeTag($name) {
        $this->tab--;
        $this->addTab();
        $this->xml .= "</$name>\n";
    }
    
    public function setValue($value) {
        $this->xml .= "$value\n";
    }
    
    //edenta
    private function addTab() {
        for ($i = 1; $i <= $this->tab;$i++){
            $this->xml .= "\t";
        }
    }
    
    public function addTag($name,$value) {
        $this->addTab();
        #$this->xml .= "<$name $value />$value</$name>\n";
        $this->xml .= "<$name $value />\n";
    }
    
    public function __toString(){
        return $this->xml;
    }
    
}
