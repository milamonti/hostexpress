/**
 * Função que adiciona uma máscara no input,
 * para se adequar ao tipo de dado esperado.
 * 
 * @param {string} id ID do elemento HTML  
 * @param {string} type Tipo de cleave a ser utilizada 
 */
export function addCleave(id, type){
  if(type === "phone"){
    new Cleave(`#${id}`, {
      numericOnly: true,
      blocks: [ 0, 2, 5, 4 ],
      delimiters: [ "(", ")", "-", "" ]
    });
  } else if (type === "cpf") {
    new Cleave(`#${id}`, {
      numericOnly: true,
      blocks: [ 3, 3, 3, 2 ],
      delimiters: [ ".", ".", "-", "" ]
    });
  } else if (type === "cep") {
    new Cleave(`#${id}`, {
      numericOnly: true,
      blocks: [5, 3],
      delimiters: [ "-", ""]
    });
  } else if (type === "cnpj"){
    new Cleave(`#${id}`, {
      numericOnly: true,
      blocks: [2, 3, 3, 4, 2],
      delimiters: [".", ".", "/", "-", ""]
    });
  }
}

/**
 * 
 * @param {string} str 
 * @returns Retorna a string somente com números e/ou letras
 */
export const removeMask = str => str.replace(/\D/g, '');

export function showAlert(type = 'info', title = 'Atenção', message = '', timer = 1500){
  Swal.fire({
    position: 'center',
    icon: type,
    title: title,
    text: message,
    timer: timer,
    showConfirmButton: false
  });
}

export function formatDate(date){
  if(!date) return;

  const dateObj = new Intl.DateTimeFormat('pt-BR', {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: false,
    timeStyle: 'short',
  }).format(date);
  
  return dateObj;
}

export const fetchConfig = (method, body = null) => { 
  if(body === null) {
    return {
      method: method
    }
  } else {
    return {
      method: method,
      body: body
    }
  }
}

// export const fetchConfig = (method = 'GET', body = null) => {
//   const headers = {
//     'Content-Type': 'application/json',
//     'credentials': 'include'
//   };

//   const config = { method, headers };

//   if (body !== null && method !== 'GET') {
//     if (body instanceof FormData) {
//       config.body = body; // não define Content-Type
//     } else {
//       headers['Content-Type'] = 'application/json';
//       config.body = typeof body === 'string' ? body : JSON.stringify(body);
//     }
//   }

//   return config;
// };

export function mostrarLoading(element_id) {
  $(`${element_id} .overlay`).removeClass("d-none");
  $(`${element_id} .overlay`).addClass("d-flex");
  $(`${element_id} .overlay`).removeClass("opacity-0");
}

export function ocultarLoading(element_id) {
  $(`${element_id} .overlay`).addClass("opacity-0");
  setTimeout(() => {
    $(`${element_id} .overlay`).addClass("d-none");
  }, 300);
}

export const toggleInput = (id) => {
  $(`#${id}`).on("click", function () {
    const senhaInput = $("#senha");
    const isPassword = senhaInput.attr("type") === "password";

    senhaInput.attr("type", isPassword ? "text" : "password");

    $(this).toggleClass("bi-eye");
    $(this).toggleClass("bi-eye-slash");
  });
}

/**
 * Função que mostra um SweetAlert pré-definido de acordo 
 * com a requisição realizada anteriormente
 * @param {Response} response JSON de resposta da requisição
 */
export const handleResponse = (response) => {
  showAlert(
    response.success ? "success" : "error",
    response.success ? "Feito!" : "Erro!",
    response.message,
    2000
  );
};

/**
 * Função de logout que executa um fetch
 * em um arquivo PHP e reinicia a página
 */
window.Logout = async () => {
  await fetch("./database/api/logout.php")
  .then((response) => response.json())
  .then((result) => {
    if(!result.success) {
      showAlert("error", "Erro!", result.message);
      return;
    }
    reloadPage();
  });
}

export const api = async (url, config = null) => {
  if(config){
    return await fetch(url, config)
    .then((res) => res.json());
  } else {
    return await fetch(url)
    .then((res) => res.json());
  }
};