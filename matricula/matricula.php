<?php
// Inclui a configuração de conexão
include 'config.php';

// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $plano = $_POST['plano'];
    $nomeCartao = $_POST['nomeCartao'];
    $numeroCartao = $_POST['numeroCartao'];
    $validadeCartao = $_POST['validadeCartao'];
    $cvvCartao = $_POST['cvvCartao'];

    // Prepara o comando SQL
    $sql = "INSERT INTO matriculas (nome, cpf, email, celular, senha, plano, nomeCartao, numeroCartao, validadeCartao, cvvCartao) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepara a declaração
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $nome, $cpf, $email, $celular, $senha, $plano, $nomeCartao, $numeroCartao, $validadeCartao, $cvvCartao);

    // Executa a declaração
    if ($stmt->execute()) {
        echo "Matrícula realizada com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Matrícula Focusfit</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="script.js">
</head>

<style>

  .estiloPlanos2{
  padding-left: 0px;
  display: flex;
  justify-content: space-around;
  align-items: center;
  width: 450px;
  height: 40px;
  border: 2px solid #ff914d;
  margin-bottom: 20px;
  border-radius: 5px;
  margin-left: 35px;
  background-color: #222;
  color: #fff;
}
.estiloPlanos2 input{
  padding:15px;
  width: 250px;
  height: 40px;
}
</style>

<body>
  <main>
    <div class="mensagem">
      <h1>Bem-Vindo a Focusfit</h1>
      <img src="undraw_athletes-training_koqa.svg" alt="Atletas treinando" width="550">
    </div>

    <div class="compras">
      <div id="matriculaVoltar">
        <h1>MATRICULA-SE</h1>
        <a href="../index pagina/index.php">VOLTAR</a>
      </div>

      <!-- Início do formulário -->
      <form action="matricula.php" method="POST">
        <div class="nomeSobrenome">
          <div>
            <p>Nome completo</p>
            <input type="text" name="nome" placeholder="Digite seu nome completo" id="inputNome" required>
          </div>
          <div>
            <p>CPF</p>
            <input type="text" name="cpf" maxlength="11" pattern="\d{11}" placeholder="Digite seu CPF(Apenas numeros)" id="inputNome" required class="cpf">
          </div>
        </div>

        <div class="CelularEmail" id="estiloDivs">
          <div>
            <p>E-mail</p>
            <input type="email" name="email" placeholder="Digite seu Email" required>
          </div>

          <div>
            <p>Celular</p>
            <input type="text" name="celular" placeholder="Digite seu número" required>
          </div>
        </div>

        <div class="Senha" id="estiloDivs">
          <div>
            <p>Senha</p>
            <input type="password" name="senha" placeholder="Digite sua senha" required id="senha">
          </div>

          <div>
            <p>Confirme sua Senha</p>
            <input type="password" name="confirmaSenha" placeholder="Confirme sua senha" required id="confirmacaoSenha">
          </div>
          
        </div>

        <div class="Senha">
          <div id="divPlanos">
            <div class="estiloPlanos">
              <div>
                <input type="radio" id="p1" name="plano" value="BASICO" required>
                <label for="p1">PLANO BASICO</label>
              </div>
              <p>79/<small>mês</small></p>
            </div>

            <div class="estiloPlanos">
              <div>
                <input type="radio" id="p2" name="plano" value="PREMIUM">
                <label for="p2">PLANO PREMIUM</label>
              </div>
              <p>109/<small>mês</small></p>
            </div>

            <div class="estiloPlanos">
              <div>
                <input type="radio" id="p3" name="plano" value="MASTER_PRO">
                <label for="p3">PLANO MASTER PRO</label>
              </div>
              <p>169/<small>mês</small></p>
            </div>

            <div class="estiloPlanos2" style="display: flex; flex-direction: column; min-height: 450px;">
              <div>
                <h2 for="p3">PAGAMENTO(Cartão Credito)</h2>
              </div>
              <label for="" style="margin-top: 10px;">NOME CARTÃO:</label>
              <input type="text" name="nomeCartao" placeholder="Nome como no cartão" maxlength="30"  required
              style="height: 30px; margin-top: 0px;">
              <label for="" style="margin-top: 5px;">NUMERO CARTAO:</label>
              <input type="text" name="numeroCartao" placeholder="Número do cartão" maxlength="16" pattern="\d{16}"  required
              style="height: 30px; margin-top: 0px;">
              <label for="" style="margin-top: 5px;">DATA VALIDADE:</label>
              <input type="text" name="validadeCartao" placeholder="12/02" maxlength="5" pattern="\d{2}/\d{2}" required style="height: 30px; margin-top: 0px;">
              <label for="" style="margin-top: 5px;">CVV:</label>
              <input type="text" name="cvvCartao" placeholder="CVV" maxlength="3" pattern="\d{3}" required
              style="height: 30px;margin-top:10px;">
            </div>
          </div>
        </div>
        
        
        <button type="submit" id="btn">CONFIRMAR MATRÍCULA</button>
      </form>
      <!-- Fim do formulário -->
    </div>
  </main>
  
  <script>
    const senha = document.getElementById("senha");
    const confirmacao = document.getElementById("confirmacaoSenha");
    const btnConfirmar = document.getElementById("btn");
    const formulario = document.querySelector("form");
  
    function verificarSenhas() {
      if (senha.value !== confirmacao.value) {
        confirmacao.setCustomValidity("As senhas não conferem.");
      } else {
        confirmacao.setCustomValidity("");
      }
    }
  
    senha.addEventListener("input", verificarSenhas);
    confirmacao.addEventListener("input", verificarSenhas);
  
    formulario.addEventListener("submit", function (event) {
      if (senha.value !== confirmacao.value) {
        event.preventDefault(); // Impede o envio do formulário
        alert('A "SENHA" e a "CONFIRMAÇÃO DE SENHA" não são iguais!');
      }
    });
  </script>
  
  
</body>
</html>

