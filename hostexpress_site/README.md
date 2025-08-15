# HostExpress

Sistema desenvolvido como parte do curso Técnico em Informática. O HostExpress é uma plataforma voltada para o gerenciamento de produtos e lojas, com foco em pequenos comércios que desejam cadastrar e divulgar seus produtos online de forma eficiente.

---

## 📄 Visão Geral

Este projeto implementa um sistema full stack utilizando:

* **PHP** no back-end
* **JavaScript** no front-end
* **JWT** para autenticação via token
* **Banco de dados MySQL** (script incluído: `/database/schemas/estructure.sql`)

---

## 🚧 Requisitos para Execução

* PHP >= 7.4
* Composer
* Servidor web (Apache ou similar)
* MySQL ou MariaDB
* Node.js (opcional, caso queira expandir o front-end)

---

## 🔄 Instalação Local

1. Clone ou extraia o repositório:

   ```bash
   git clone <repo-url> ou extraia o ZIP
   ```

2. Instale as dependências PHP via Composer:

   ```bash
   cd hostexpress_site
   composer install
   ```

3. Configure seu banco de dados:

   * Crie um banco chamado `hostexpress`
   * Importe o arquivo `hostexpress.sql`

4. Configure as variáveis de ambiente:

   * Copie `.env.example` (se houver) para `.env`
   * Ou edite o `.env` diretamente

5. Configure o servidor local:

   * Certifique-se de que o `document root` aponte para `hostexpress_site`
   * A URL base usada nas APIs é: `https://hostexpress.ct.ws`

---

## 📂 Estrutura de Diretórios

```
/hostexpress_site
├── assets/
│   └── lang/pt-BR.json          # Traduções
├── database/
│   └── api/                     # Endpoints REST
│       ├── login.php
│       ├── logout.php
│       ├── upload.php
│       └── shop/               # Funções de loja
│           ├── addProduct.php
│           ├── editProduct.php
│           └── getShopProducts.php
├── modules/
│   └── userManager.php         # Classe de autenticação via JWT
├── config/
│   └── config.php              # Caminhos e constantes
├── conexao.php                 # Conexão com o BD
├── index.php                   # Página inicial
└── .env                        # Configurações sensíveis
```

---

## 🚀 Endpoints da API (Exemplos)

### Autenticação

* `POST /database/api/login.php`  → Realiza login do usuário e retorna um token JWT
* `POST /database/api/logout.php` → Efetua logout e remove o cookie/token

### Produtos

* `POST /database/api/shop/addProduct.php`  → Cadastra novo produto
* `POST /database/api/shop/editProduct.php` → Edita produto existente
* `GET  /database/api/shop/getShopProducts.php` → Lista produtos da loja logada

### Cliente

* `POST /database/api/client/registerClient.php` → Registra novo cliente
* `GET  /database/api/client/getClientDetails.php` → Retorna dados do cliente logado

---

## 🛡️ Segurança

* Utiliza JWT (token salvo via cookie da sessão)
* Cookies com `httponly`, `secure`, `samesite=Strict`
* Validação de token em todos os endpoints protegidos

---

## 🎓 Projeto Técnico

Este projeto foi desenvolvido como parte do Curso Técnico em Informática. Tem como objetivo prático consolidar conhecimentos em desenvolvimento web, banco de dados e autenticação segura.

---

## 🛌 Contato e Licença

Este é um projeto acadêmico. Para uso externo, favor entrar em contato com o autor.

---

**HostExpress** - Todos os direitos reservados.
