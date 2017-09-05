<?php defined('BASEPATH') OR exit('No direct script access allowed');
// codeigniter
class Arquivo extends CI_Controller {
    
    /** SALVA ARQUIVO DE DADOS */
    public function index() {
        $resultado = $this->input->post('Dados');
        if(!empty($resultado)){
            $data = $resultado;
            $fname = mktime() . ".txt";

            $file = fopen("includes/" .$fname, 'w');
            fwrite($file, $data);
            fclose($file);
        }
    }
        
}
