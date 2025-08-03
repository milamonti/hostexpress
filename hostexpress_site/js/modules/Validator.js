export default class Validator {
  static validarCPF(cpf) {
    // Usa a função do CDN
    return window.cpfIsValid(cpf);
  }

  static validarCNPJ(cnpj) {
    // Usa a função do CDN
    return window.cnpjIsValid(cnpj);
  }

  static validarEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  static validarTelefone(telefone) {
    const re = /^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/;
    return re.test(telefone);
  }

  static createErrorMsg(field, fieldType) {
    const error = $("<div>").addClass("error-msg").insertAfter(field);
    error.text(`${fieldType} inválido!`);
    $(field).css("border-color", "red");
  }
  
  static clearError(field) {
    const error = $(field).next(".error-msg");
    error.text("");
    $(field).css("border-color", "");
  }

  static validateFields(form) {
    let filled = true;
    for (const field of form.elements) {
      // Ignora botão ou elementos sem name
      if (field.tagName === "BUTTON" || !field.name) continue;
    
      if (!field.value.trim()) {
        field.style.borderColor = "red";
        filled = false;
        console.warn(`Campo "${field.name}" está vazio.`);
      }
      if(field.name === "CPF" && !validator.validarCPF(field.value.trim())){
        validator.createErrorMsg(field, "cpf");
        filled = false;
      } else if (field.name === "CNPJ" && !validator.validarCNPJ(field.value.trim())){
        validator.createErrorMsg(field, "cnpj");
        filled = false;
      } else if (field.name === "EMAIL" && !validator.validarEmail(field.value.trim())){
        validator.createErrorMsg(field, "email");
        filled = false;
      } else if (field.name === "TELEFONE" && !validator.validarTelefone(field.value.trim())){
        validator.createErrorMsg(field, "telefone");
        filled = false;
      } else {
        validator.clearError(field);
      }
    }
    
    return filled;
  }
}
