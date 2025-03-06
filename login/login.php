<?php
session_start();

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'senac';
$dbName = 'FocusfitDB';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o email existe no banco de dados
    $sql = "SELECT * FROM matriculas WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        // Verificar se a senha está correta
        if (password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido, redirecionar para o espaço do cliente
            $_SESSION['emailUsuario'] = $email; // Salvar o email na sessão
            header("Location: ../espacocliente/index.php");
            exit();
        } else {
            // Senha incorreta
            echo "<script>alert('Senha incorreta. Tente novamente.'); window.history.back();</script>";
            exit();
        }
    } else {
        // Email não encontrado
        echo "<script>alert('E-mail não cadastrado. Tente novamente.'); window.history.back();</script>";
        exit();
    }
}

$conexao->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<style>
    .senha{
     margin-left: 20px;   
      }
      input{
        border-radius: 20px;
      }
</style>

<body>
    <header>
        <nav class="header">
            <div class="logo">
                <img src="imagem/logo.png" alt="Logo Focusfit" width="270px">
            </div>
            <div class="menu">
                <button onclick="abrirMenu()" style="border: none; background: none;" id="menu">
                    <i class="fa-solid fa-bars fa-4x" id="iconMenu"></i>
                    <i class="fa-solid fa-bars fa-3x" id="iconMenu_Mobile"></i>
                </button>
            </div>
            <div class="menu_flutuante">
                <nav class="link">
                    <div class="fecharMenu">
                        <h1 style="font-size: 30px; margin-right: 40px;color: #fe4d01;">FOCUSFIT</h1>
                        <button onclick="fecharMenu()" id="btnMenuFechar">
                            <i class="fa-solid fa-xmark fa-2x" style="color: #fe4d01;"></i>
                        </button>
                    </div>
                    <div class="opcoes">
                        <a href="../index pagina/index.php" class="tag_A">HOME</a>
                        <a href="../planos pagina/plano.php" class="tag_A">PLANOS</a>
                    </div>
                    <div class="corFinal"></div>
                </nav>
            </div>
        </nav>
    </header>
    <main>
        <div class="corpo_login">
            <div class="imagem_login">
                <img src="imagem/imagem_login.png" alt="Imagem de Login" width="650px">
            </div>
            <div class="login_matricula">
                <h1>BEM-VINDO A FOCUSFIT!</h1>
                <p>Faça login na sua conta para acessar sua jornada de condicionamento físico personalizada.</p>
                <form id="loginForm" action="login.php" method="POST">
                    <div class="senha">
                        <i class="fa-regular fa-user fa-2x" style="color: #ff7300;"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="senha">
                        <i class="fa-solid fa-lock fa-2x" style="color: #ff7300;"></i>
                        <input type="password" name="senha" placeholder="Senha" required>
                    </div>
                    <button type="submit">LOGIN</button>
                </form>
                <p>OU</p>
                <a href="../matricula/matricula.php" id="tag_a">MATRICULE-SE</a>
            </div>
        </div>
    </main>
    <script>
        function abrirMenu() {
            let button = document.querySelector(".menu_flutuante");
            button.style.display = "block";
        }
        function fecharMenu() {
            let button = document.querySelector(".menu_flutuante");
            button.style.display = "none";
        }
    </script>
</body>
</html>
