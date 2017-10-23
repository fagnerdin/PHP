<?php

// AutenticaÃ§Ã£o HTTP Digest

function myDigestCheckAuth() {
    $iRequest = Array(
        'realm' => 'QualiNET'
    );
	$iUsers = Array(
		'USR$LOGIN' => Array(
            'mail' => 'usuario.email@domain.com.br',
            'name' => 'nomeUsuario',
            'pass' => '$3n#@d34c3$$0',
        ),
	);
    //obs: sessÃ£o deve ter sido iniciada antes
    if ( empty($_SESSION['DIGEST_ID']) ) {
        $_SESSION['DIGEST_ID'] = uniqid();
    }
	if ( empty($_SERVER['PHP_AUTH_DIGEST']) ) {
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Digest realm="'.$iRequest['realm'].'",qop="auth",nonce="'.$_SESSION['DIGEST_ID'].'",opaque="'.md5($iRequest['realm']).'"');
		die('Authorization Required');
	}
	if ( ! ( $iResponse = myDigestParse($_SERVER['PHP_AUTH_DIGEST']) ) || ! isset( $iUsers[$iResponse['username']] ) ) {
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Digest realm="'.$iRequest['realm'].'",qop="auth",nonce="'.$_SESSION['DIGEST_ID'].'",opaque="'.md5($iRequest['realm']).'"');
		die('Authorization Required');
	}
	$iRequest['auth'] = md5(https://github.com/fagnerdin/PHP
        md5($iResponse['username'] . ':' . $iResponse['realm'] . ':' . $iUsers[$iResponse['username']]['pass']).
        ':' .
        $iResponse['nonce'] .
        ':' .
        $iResponse['nc'] .
        ':' .
        $iResponse['cnonce'] .
        ':' .
        $iResponse['qop'].
        ':' .
        md5($_SERVER['REQUEST_METHOD'].':'.$iResponse['uri'])
    );
	if ( $_SESSION['DIGEST_ID'] != $iResponse['nonce'] || $iRequest['auth'] != $iResponse['response'] ) {
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Digest realm="'.$iRequest['realm'].'",qop="auth",nonce="'.$_SESSION['DIGEST_ID'].'",opaque="'.md5($iRequest['realm']).'"');
		die('Access Denied');
	}
    return true;
}
function myDigestParse($txtDigest) {
	$iResponse = Array();
	$iOptions = Array(
		'username' => true,
		'realm' => true,
		'nonce' => true,
		'uri' => true,
		'response' => true,
		'opaque' => true,			
		'qop' => true,
		'nc' => true,
		'cnonce' => true,
	);
	$iKeys = implode('|', array_keys($iOptions));
	preg_match_all('@(' . $iKeys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txtDigest, $iMatches, PREG_SET_ORDER);
	foreach ( $iMatches as $key ) {
		$iResponse[$key[1]] = $key[3] ? $key[3] : $key[4];
		unset($iOptions[$key[1]]);
	}
	return $iOptions ? false : $iResponse;
}
