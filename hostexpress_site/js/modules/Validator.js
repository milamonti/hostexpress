class Validator {
  validateCPF(cpf) {
    // Usa a função do CDN
    return window.cpfIsValid(cpf);
  }

  validateCNPJ(cnpj) {
    // Usa a função do CDN
    return window.cnpjIsValid(cnpj);
  }

  validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  validatePhone(telefone) {
    const re = /^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/;
    return re.test(telefone);
  }

  createErrorMsg(field, fieldType) {
    const error = $("<div>").addClass("error-msg").insertAfter(field);
    error.text(`${fieldType} inválido!`);
    $(field).css("border-color", "red");
  }
  
  clearError(field) {
    const error = $(field).next(".error-msg");
    error.text("");
    $(field).css("border-color", "");
  }

  /**
   * 
   * @param {FormData} form Formulário com as informações de cadastro 
   * @param {string} type Tipo de cadastro a ser realizado
   * @returns {boolean} Filled
   */
  validateFields(form = null, type = null) {
    if(!form || !type) return;

    const allowHiddenFields = ["CIDADE", "BAIRRO", "ENDERECO"];
    const interpriseFields = ["RAZAO_SOCIAL", "CNPJ", "ESPECIALIDADE"];
    let filled = true;
    for (const field of form.elements) {
      console.log(field.value);
      // Ignora o botão submit, elementos hidden do endereço e elementos de loja 
      // quando o cadastro é de cliente
      if (
        field.tagName === "BUTTON" ||
        ($(field).is(":hidden") && !allowHiddenFields.includes(field.name)) ||
        (type === "CLIENT" && interpriseFields.includes(field.name))
      ) continue;
    
      if (!field.value.trim()) {
        field.style.borderColor = "red";
        filled = false;
        console.warn(`Campo "${field.name}" está vazio.`);
      }
      if(field.name === "CPF" && !this.validateCPF(field.value.trim())){
        this.createErrorMsg(field, "cpf");
        filled = false;
      } else if (field.name === "CNPJ" && !this.validateCNPJ(field.value.trim())){
        this.createErrorMsg(field, "cnpj");
        filled = false;
      } else if (field.name === "EMAIL" && !this.validateEmail(field.value.trim())){
        this.createErrorMsg(field, "email");
        filled = false;
      } else if (field.name === "TELEFONE" && !this.validatePhone(field.value.trim())){
        this.createErrorMsg(field, "telefone");
        filled = false;
      } else {
        this.clearError(field);
      }
    }
    
    return filled;
  }
}
const validator = new Validator();
export default validator;