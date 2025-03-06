<?php
// Conexão com o Banco de Dados
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'senac';
$dbName = 'FocusfitDB';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Iniciar sessão
session_start();

if (!isset($_SESSION['emailUsuario'])) {
    header("Location: login.php");
    exit();
}

// Pegar dados do usuário logado
$emailUsuario = $_SESSION['emailUsuario'];

$sql = "SELECT nome, email, celular, plano FROM matriculas WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $emailUsuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    /* Resetando alguns estilos padrão */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #1a1a1a;
    color: #ffffff;
}

header {
    background-color: #333;
    padding: 20px;
    text-align: center;
}

.menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.titulo {
    font-size: 2em;
    color: #f9c74f;
}

nav {
    display: flex;
    gap: 20px;
}

nav button {
    background-color: #f9c74f;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

nav button:hover {
    background-color: #f9844a;
}

.containerConteudo {
    margin: 20px auto;
    max-width: 1200px;
    padding: 20px;
    background-color: #444;
    border-radius: 10px;
}

.tituloLink h1 {
    font-size: 2.8em;
    margin-bottom: 60px;
    color: #f9c74f;
    text-align: center;
}

.Divperfil {
    display: flex;
    flex-direction: column;
    align-items: center;
}

#info, #info2 {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    text-align: center;
}

#info div, #info2 div {
    background-color: #555;
    border-radius: 10px;
    padding: 15px;
    margin: 10px;
    width: 100%;
    box-shadow: 2px 2px 5px rgb(252, 143, 42);
}

ul {
    list-style-type: none;
    padding: 0;
    text-align: left;
}

ul li {
    padding: 5px 0;
}

#horario {
    display: flex;
    flex-direction: column;
    align-items: center;
}

#horario div {
    background-color: #555;
    border-radius: 10px;
    padding: 15px;
    margin: 10px;
    width: 100%;
}

h1, h2 {
    margin: 10px 0;
}

@media (min-width: 768px) {
    .divTreinos {
        display: flex;
        justify-content: space-between;
    }
    
    #treinoA, #treinoB {
        flex: 1;
        margin: 0 10px;
    }
    
    #horario {
        flex-direction: row;
        justify-content: space-around;
    }
}

</style>

<body>
    <header>
        <div class="menu">
            <h1 class="titulo">FOCUSFIT</h1>
            <nav>
                <button id="btnPerfil"><i class="fas fa-user fa-1x"></i> Perfil</button>
                <button id="btnTreinos"><i class="fas fa-calendar-alt "></i> Agenda de Treinos</button>
                <button id="btnHorarios"><i class="fas fa-dumbbell "></i> Aulas e Horários</button>
                <button id="btnPlano"><i class="fas fa-credit-card "></i> Pagamentos e Plano</button>
            </nav>
        </div>
    </header>

    <main>

    <div class="containerConteudo" id="divPerfil">
    <div class="tituloLink">
        <h1>SEU PERFIL</h1>
    </div>
    <div class="Divperfil">
        <div id="info">
            <div>
                <i class="fa-solid fa-user fa-5x" id="userIMG" style="color: #ffffff;"></i>
                <h1><?php echo $usuario['nome']; ?></h1>
            </div>
            <div>
                <i class="fa-solid fa-envelope fa-3x" style="color: #ffffff;"></i>
                <h2><?php echo $usuario['email']; ?></h2>
            </div>
            <div>
                <i class="fa-solid fa-location-dot fa-3x"></i>
                <h2>Rua 90 - cha 321 - Lt 12 Brasilia-DF</h2>
            </div>
            <div>
                <i class="fa-solid fa-phone fa-3x"></i>
                <h2><?php echo $usuario['celular']; ?></h2>
            </div>
        </div>
    </div>
</div>




        <div id="maindois" >
            <div class="tituloLink">
                <h1>SEUS TREINOS</h1>
            </div>
            <div style="display: flex; gap: 50px;" class="divTreinos">
                <div id="treinoA">
                    <div class="Divperfil">
                        <div id="info2">
                            <div><i class="fas fa-calendar-alt fa-2x " style="color: #ffffff;" id="userIMG"></i>
                                <h1>TREINO A (Peitoral, biíceps)</h1>
                            </div>
                            <ul>
                                <li>Supino Reto com Halter</li>
                                <li>Supino inclinado Com Halter</li>
                                <li>Supino Declinado</li>
                                <li>Rosca Unilateral</li>
                                <li>Rosca Haters Alternado</li>
                                <li>Rosca Barra W</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="treinoB">
                    <div class="Divperfil">
                        <div id="info2">
                            <div><i class="fas fa-calendar-alt fa-2x " style="color: #ffffff;" id="userIMG"></i>
                                <h1>TREINO B (Pernas - Ombros)</h1>
                            </div>
                            <ul>
                                <li>Agachamento com Halter</li>
                                <li>Leg Press</li>
                                <li>Extensão de Pernas</li>
                                <li>Desenvolvimento com Halteres</li>
                                <li>Elevação Lateral</li>
                                <li>Elevação Frontal</li>
                                <li>Cadeira abdutora</li>
                                <li>Cadeira adutora</li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="maintres">
    <div class="tituloLink">
        <h1>HORÁRIOS</h1>
    </div>
    <div class="Divperfil">
        <div id="horario">
            <div>
                <h1>Funcionamento</h1>
            </div>
            <div>
                <i class="fa-solid fa-clock fa-3x" style="color: #ffffff;"></i>
                <h2>Terça a Sábado<br>(5h às 00:00)</h2>
            </div>
            <div>
                <i class="fa-solid fa-clock fa-3x" style="color: #ffffff;"></i>
                <h2>Domingos<br>8:00 às 14:00</h2>
            </div>
        </div>
    </div>
</div>


        <div class="containerConteudo" id="mainquatro">
            <div class="tituloLink">
                <h1>PAGAMENTO E PLANO</h1>
            </div>
            <div class="Divperfil">
                <div id="horario" style="height: 300px; color: #000000;">
                    <div>
                        <h1>PLANO:</h1>
                    </div>
                       
                    <div>                     
                      <h1 id="planoEscolhido"><?php echo $usuario['plano']; ?></h2>
                    </div>

                    <div>
                        <p>Mensalidadede:</p>
                        <h2 id="precoPlano"></h2>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <script src="script.js"></script>

</body>
</body>
</html>