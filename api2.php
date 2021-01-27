<?php
session_start();
include("../banco.php");

if (!isset($_SESSION['usuario'])) {
    header("location: ../");
    die();
} else {

    $usuario = $_SESSION['usuario'];
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $resultado = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    $count = mysqli_num_rows($resultado);
    $saldo = $row['saldo'];
}

if ($saldo >= 0.5) {


    $lista = $_GET['lista'];
    $url = file_get_contents("http://localhost/Painel/checkers/GGBB/bb.php?lista=$lista");

    if (strpos($url, 'Aprovada')) {

        $logica = "live";
        echo $url;
    } else {

        echo $url;
    }

    if ($logica == "live") {

        $usuario = $_SESSION['usuario'];
        $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
        $resultado = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
        $count = mysqli_num_rows($resultado);
        $aprovados = $row['cartoes_aprovados'];
        $aprovados02 = $aprovados + 1;
        $saldo = $row['saldo'];
        $saldo02 = $saldo - 0.5;
        $sql = "UPDATE usuarios SET cartoes_aprovados='$aprovados02', saldo='$saldo02' WHERE usuario='$usuario'";
        $resultado = mysqli_query($conexao, $sql);
    }
} else {

    $logica = false;
    echo '<span class="badge badge-danger"> Reprovada </span> <span style="color: black;"> → <span class="badge badge-warning">VOÇÊ ESTA SEM SALDO!</span> | <span class="badge badge-warning">[ NEON CENTER ]</span></br>';
}
