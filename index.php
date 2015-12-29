<?php
require_once 'Xml.Class.php';
require_once 'config.php';


$xml = new Xml();

$erro = "";

$icidContrato = $_GET['icidContrato'];
$inumContrato = $_GET['inumContrato'];

$xml->openTag("OrdGeradas");


if($icidContrato == ''){
 $erro=1;
 $msgerro = "codigo invalido";
}else {
    
    $sql = "select *
            from geradas g
                INNER JOIN cidades    c on  g.cidContrato  = c.cidContrato
                 LEFT JOIN assinantes a on  g.cidContrato  = a.cidContrato and g.idEnder = a.idEnder
                                                                                         and g.numContrato = a.numContrato
                 LEFT JOIN tipo_os    t on  g.idTipoOs    = t.idTipoOs
                 LEFT JOIN ender      e on  c.codOperadora = e.codOperadora and g.idEnder   = e.idEnder
                 LEFT JOIN imoveis    i on  e.codOperadora = i.codOperadora and e.codImovel = i.codImovel
                 LEFT JOIN endereco   d on  i.codOperadora = d.codOperadora and i.codImovel = d.codImovel
                                                    and i.codEndereco  = d.codEndereco  and i.codLogradouro = d.codLogradouro
                 LEFT JOIN bairro     b on  d.codBairro    = b.codBairro    and c.cidContrato = b.cidContrato
                 WHERE g.cidContrato = $icidContrato AND g.numContrato in($inumContrato)";
    
    //consulta sql
    $query = mysql_query($sql) or die(mysql_error());
    
    while($array = mysql_fetch_array($query)){
           $xml->addTag('OrdSrv',
                    'nomeCidade="'    .$array['nomeCidade']      .'" '
                   . 'numContrato="'   .$array['numContrato']     .'" '
                   . 'codOs="'         .$array['codOs']           .'" '
                   . 'dtAtend="'       .$array['dtAtend']         .'" '
                   . 'descricao="'      .$array['descricao']        .'" '
                   . 'grupoOsDescr="' .$array['grupoOsDescr']   .'" '
                   . 'codNode="'       .$array['codNode']         .'" '
                   . 'nomLogrAbrev="' .$array['nomLogrAbrev']   .'" '
                   . 'nomCompleto="'   .$array['nomCompleto']     .'" '
                   . 'nomBairro="'     .$array['nomBairro']       .'" '
                   );
    }

}
//$xml->addTag('erro', $erro);
//$xml->addTag('msg_erro', $msgerro);

$xml->closeTag("OrdGeradas");

echo $xml;
