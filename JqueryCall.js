// SALVA ARQUIVO DE DADOS
// @uses Arquivo.php
function dtResultado(data){
   var pagina = "http://localhost/Pagina/Arquivo";
   $.post(pagina,{Dados: data});
}
