
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="img.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Checkers - Cartao
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />

    <link href="assets/demo/demo.css" rel="stylesheet" />
</head>


<div class="wrapper ">
    <div class="main-panel" id="main-panel">

        <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                    </div>
                    <a class="navbar-brand" href="../../">Voltar</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
            </div>
        </nav>

        <div class="panel-header panel-header-sm">
        </div>



        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <h1 class="card-body h6"> BANCO DO BRASIL (DONATE)</h1>
                                <br>
                                <center><span></span></center>
                                <div class="md-form">
                                    <div class="col-md-12">
                                        <textarea type="text" style="text-align: center; color: black;" id="lista" class="md-textarea form-control" rows="2" placeholder="Formato : xxxxxxxxxxxxxxxx|xx|xxxx|xxx"></textarea>
                                        <br>
                                    </div>
                                </div>
                                <center>
                                    <button class="btn btn-success" style="width: 100px; outline: none;" id="testar" onclick="enviar()">TESTAR</button>
                                    <button class="btn btn-danger" style="width: 100px; outline: none;">PARAR</button>
                                    <button class="btn btn-info" style="width: 100px; outline: none;" onclick="myToast()"> AVISO </button><br />

                                    Aprovadas: <span class="badge badge-success" id="cLive2">0</span>
                                    - Reprovadas: <span class="badge badge-danger" id="cDie2">0</span>
                                    - Testadas: <span class="badge badge-info" id="total">0</span>
                                    - Carregadas: <span class="badge badge-primary" id="carregadas">0</span>
                                    - Creditos: <span class="badge badge-dark saldo">0</span>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <div class="container">
                                    <div class="panel panel-content">
                                        <div style="text-align: center;" class="panel-heading"><strong> Aprovadas </strong><i class="text-success">✓</i> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-copy btn-copy"></i></div>
                                        <div style="font-size: 15px;" class="aprovados">
                                            <div id=".aprovadas" class="aprovadas"></div>
                                        </div>
                                    </div>
                                    <hr><br>
                                    <div class="panel panel-content">
                                        <div style="text-align: center;" class="panel-heading"><i class=""></i> <strong> Reprovadas </strong> <i class="fa fa-times text-danger"></i> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<i id="show-or-hide" class="fas fa-eye-slash"></i></div>
                                        <div style="font-size: 15px;" class="reprovados">
                                            <div id=".reprovadas" class="reprovadas"></div>
                                        </div>
                                    </div>
                                    </center>

                                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
                                    <script type="text/javascript">
                                        $(document).ready(function() {

                                            getSaldo();


                                            $("#bode").hide();
                                            $("#esconde").show();

                                            $('#mostra').click(function() {
                                                $("#bode").slideToggle();
                                            });

                                        });
                                    </script>

                                    <script type="text/javascript">
                                        $(document).ready(function() {


                                            $("#bode2").hide();
                                            $("#esconde2").show();

                                            $('#mostra2').click(function() {
                                                $("#bode2").slideToggle();
                                            });

                                        });
                                    </script>

                                    <script title="ajax do checker">
                                        function enviar() {
                                            var linha = $("#lista").val();
                                            var linhaenviar = linha.split("\n");
                                            var total = linhaenviar.length;
                                            var ap = 0;
                                            var rp = 0;
                                            linhaenviar.forEach(function(value, index) {
                                                setTimeout(
                                                    function() {
                                                        Swal.fire({
                                                            title: 'Teste Iniciado!',
                                                            icon: 'success',
                                                            showConfirmButton: false,
                                                            toast: true,
                                                            position: 'top-end',
                                                            timer: 3000
                                                        });
                                                        $.ajax({
                                                            url: 'api.php?lista=' + value,
                                                            type: 'GET',
                                                            async: true,
                                                            success: function(resultado) {
                                                                if (resultado.match("Aprovada")) {
                                                                    removelinha();
                                                                    getSaldo();
                                                                    ap++;
                                                                    aprovadas(resultado + "");
                                                                } else {
                                                                    removelinha();
                                                                    rp++;
                                                                    reprovadas(resultado + "");
                                                                }
                                                                $('#carregadas').html(total);
                                                                var fila = parseInt(ap) + parseInt(rp);
                                                                $('#cLive').html(ap);
                                                                $('#cDie').html(rp);
                                                                $('#total').html(fila);
                                                                $('#cLive2').html(ap);
                                                                $('#cDie2').html(rp);
                                                            }
                                                        });


                                                    }, 10 * index);
                                            });
                                        }

                                        function aprovadas(str) {
                                            $(".aprovadas").append(str + "<br>");
                                        }

                                        function reprovadas(str) {
                                            $(".reprovadas").append(str + "<br>");
                                        }

                                        function removelinha() {
                                            var lines = $("#lista").val().split('\n');
                                            lines.splice(0, 1);
                                            $("#lista").val(lines.join("\n"));
                                        }

                                        function getSaldo() {
                                            $.get('../getSaldo.php', function(saldo) {
                                                $('.saldo').text(saldo);
                                            });
                                        }
                                    </script>
                                    <script src="assets/js/core/jquery.min.js"></script>
                                    <script src="assets/js/core/popper.min.js"></script>
                                    <script src="assets/js/core/bootstrap.min.js"></script>
                                    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
                                    <script src="assets/js/plugins/bootstrap-notify.js"></script>
                                    <script src="assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
                                    <script src="assets/demo/demo.js"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.13.1/dist/sweetalert2.all.min.js"></script>
                                    <script>
                                        $(document).ready(function() {

                                            demo.initDashboardPageCharts();

                                        });

                                        $('.btn-copy').click(function() {
                                            var lista_lives = document.getElementById('.aprovadas').innerText;
                                            var textarea = document.createElement("textarea");
                                            textarea.value = lista_lives;
                                            document.body.appendChild(textarea);
                                            textarea.select();
                                            document.execCommand('copy');
                                            document.body.removeChild(textarea);
                                            Swal.fire({
                                                title: 'Lista de Aprovadas Copiada!',
                                                icon: 'success',
                                                showConfirmButton: false,
                                                toast: true,
                                                position: 'top-end',
                                                timer: 3000
                                            });
                                        });

                                        var btn = document.querySelector('#show-or-hide');
                                        var HideID = document.querySelector('.reprovadas');

                                        btn.addEventListener('click', function() {
                                            if (HideID.style.display == 'block') {
                                                HideID.style.display = 'none';
                                            } else {
                                                HideID.style.display = 'block';
                                            }
                                        })

                                        function myToast() {
                                            Swal.fire({title: 'Cada Live 0.5 sera Descontado!', icon: 'error', showConfirmButton: false, toast: true, position: 'top-end', timer: 3000});
                                        }
                                    </script>
                                    </body>

</html>