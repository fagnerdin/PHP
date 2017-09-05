<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** SALVA ARQUIVO
 * @todo Salva arquivo de dados
 * @uses JqueryCall.js
 */
class Arquivo extends CI_Controller {
    
    /** SALVA ARQUIVO DE DADOS */
    public function index() {
        // recebe os dados do javascript
        $resultado = $this->input->post('Dados');
        if(!empty($resultado)){
            $data = $resultado;
            // Cria um nome ficticio
            $fname = mktime() . ".txt";

            // Arquivo, escreve, fecha
            $file = fopen("includes/" .$fname, 'w');
            fwrite($file, $data);
            fclose($file);
        }
    }
        
}
