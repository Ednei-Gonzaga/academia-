document.addEventListener("DOMContentLoaded", function () {
  // Lista com os IDs das seções
  const sections = ["divPerfil", "maindois", "maintres", "mainquatro"];

  // Função que oculta todas as seções e exibe somente a selecionada
  function showSection(sectionId) {
    sections.forEach(id => {
      const element = document.getElementById(id);
      if (element) {
        element.style.display = "none";
      }
    });
    const sectionToShow = document.getElementById(sectionId);
    if (sectionToShow) {
      sectionToShow.style.display = "block";
    }
  }

  // Eventos de clique para cada botão do menu
  document.getElementById("btnPerfil").addEventListener("click", function () {
    showSection("divPerfil");
  });

  document.getElementById("btnTreinos").addEventListener("click", function () {
    showSection("maindois");
  });

  document.getElementById("btnHorarios").addEventListener("click", function () {
    showSection("maintres");
  });

  document.getElementById("btnPlano").addEventListener("click", function () {
    showSection("mainquatro");
  });

  // Exibe a seção do Perfil por padrão
  showSection("divPerfil");
});

let planoEscolhido = document.querySelector("#planoEscolhido").innerText,
  precoPlano = document.querySelector("#precoPlano");

if (planoEscolhido == "BASICO") {
  precoPlano.innerText = "R$ 79,00";
}

if (planoEscolhido == "PREMIUM") {
  precoPlano.innerText = "R$ 109,00";
}
if (planoEscolhido == "MASTER_PRO") {
  precoPlano.innerText = "R$ 169,00";
}
console.log(planoEscolhido);
