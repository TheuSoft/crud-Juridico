/////MOSTRAR SENHA FORMULARIO

function mostrarSenha() {
  var inputPass = document.getElementById("senha");
  var btnShowPass = document.getElementById("btn-senha");

  if (inputPass.type === "password") {
    inputPass.setAttribute("type", "text");
    btnShowPass.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
  } else {
    inputPass.setAttribute("type", "password");
    btnShowPass.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
  }
}

//////// Menu-Login

var menuItem = document.querySelectorAll(".item-menu");
function selectlink() {
  menuItem.forEach((item) => item.classList.remove("ativo"));
  this.classList.add("ativo");
}

menuItem.forEach((item) => item.addEventListener("click", selectlink));

////Expandir Menu-Login

var btnExp = document.querySelector("#btn-exp");
var menuSide = document.querySelector(".menu-lateral");

btnExp.addEventListener("click", function () {
  menuSide.classList.toggle("expandir");
});

//////

document
  .getElementById("logoutLink")
  .addEventListener("click", function (event) {
    if (!confirm("Você realmente deseja fazer logout?")) {
      event.preventDefault(); // Impede o comportamento padrão do link se o usuário cancelar
    }
  });

/////////////FORMATAR DATA INPUT

function formatarData(input) {
  // Remove caracteres não numéricos (exceto barras)
  var inputValue = input.value.replace(/\D/g, "");

  // Adiciona as barras na data
  if (inputValue.length > 2) {
    inputValue = inputValue.substring(0, 2) + "/" + inputValue.substring(2);
  }
  if (inputValue.length > 5) {
    inputValue = inputValue.substring(0, 5) + "/" + inputValue.substring(5, 9);
  }

  input.value = inputValue;
}

///// FORMATAR NUMERO PROCESSO
function formatarCampo(input) {
  var inputValue = input.value.replace(/\D/g, ""); // Remove caracteres não numéricos

  // Aplica a formatação apenas quando a entrada atinge o tamanho necessário
  if (inputValue.length >= 7) {
    inputValue = inputValue.substring(0, 7) + "-" + inputValue.substring(7);
  }
  if (inputValue.length >= 10) {
    inputValue = inputValue.substring(0, 10) + "." + inputValue.substring(10);
  }
  if (inputValue.length >= 15) {
    inputValue = inputValue.substring(0, 15) + "." + inputValue.substring(15);
  }

  if (inputValue.length >= 17) {
    inputValue = inputValue.substring(0, 17) + "." + inputValue.substring(17);
  }

  if (inputValue.length >= 20) {
    inputValue = inputValue.substring(0, 20) + "." + inputValue.substring(20);
  }

  if (inputValue.length > 25) {
    inputValue = inputValue.substring(0, 25);
}

  input.value = inputValue;
}

/////////////////// HORA :

document.addEventListener('DOMContentLoaded', function() {
    const horaInput = document.getElementById('hora');

    horaInput.addEventListener('input', function() {
        let input = this.value.replace(/\D/g, ''); // Remove não dígitos
        if (input.length > 4) {
            input = input.substring(0, 4); // Limita a 4 caracteres
        }

        // Formata para o formato "HH:MM"
        if (input.length >= 4) {
            input = input.substring(0, 2) + ':' + input.substring(2);
        }

        this.value = input;
    });
});

///////////////
function confirmDelete() {
  if (confirm('Tem certeza de que deseja excluir este registro?')) {
      return true; // Continuar com a exclusão
  } else {
      return false; // Cancelar a exclusão
  }
}
////////
function enviarFormulario() {
  var autor = document.getElementById('itens').value;
  var numero_pro = document.getElementById('numero_pro').value;
  var data_auto = document.getElementById('data_auto').value;
  var data_aud = document.getElementById('data_aud').value;
  var hora = document.getElementById('hora').value;
  var cidade = document.getElementById('cidade').value;

  $.ajax({
      type: 'POST',
      url: 'config_form.php', // Substitua pelo URL do seu arquivo de processamento PHP
      data: {
          autor: autor,
          numero_pro: numero_pro,
          data_auto: data_auto,
          data_aud: data_aud,
          hora: hora,
          cidade: cidade
      },
      success: function(data) {
          if (data === 'sucesso') {
              mostrarMensagem('Sucesso: Formulário enviado.', true);
          } else {
              mostrarMensagem('Erro: Preencha todos os campos.', false);
          }
      }
  });

  return false; // Impede o envio padrão do formulário
}

