# AutoPortal - Portal de Anúncios de Veículos

Bem-vindo ao **AutoPortal**, o seu sistema completo de classificados de veículos desenvolvido como projeto final da disciplina de Desenvolvimento Web I (Universidade Federal de Uberlândia - UFU). 

Este repositório contém a versão completa (Etapa 3) que une uma interface fluída construída com tecnologias nativas e uma API robusta feita em PHP com Banco de Dados MySQL.

---

## 🚀 Tecnologias Utilizadas

Este projeto seguiu rigorosamente os requisitos acadêmicos, mantendo-se livre de frameworks modernos (como React ou Tailwind) para focar no aprendizado dos fundamentos da web:

**Front-end:**
- HTML5 (Semântico)
- CSS3 (Vanilla / Flexbox)
- JavaScript (Vanilla / ES6+)
- Fetch API para chamadas Assíncronas (AJAX)

**Back-end:**
- PHP 8
- Padrão de Arquitetura MVC
- Autenticação por Sessão Nativas (`session_start()`)
- Roteamento e Respostas em JSON (REST API nativa)
- PDO para blindagem contra SQL Injection
- Bcrypt para Hash de Senhas de Usuário

**Banco de Dados & Infraestrutura:**
- MySQL 8.0
- Docker e Docker Compose (para facilidade de testes)

---

## ⚙️ Como baixar e rodar o projeto localmente

Para que o projeto funcione perfeitamente na sua máquina, você só precisa ter o [Docker](https://www.docker.com/products/docker-desktop/) instalado e rodando.

### 1. Clonando o Repositório

Abra o seu terminal (ou Git Bash) e digite o seguinte comando para baixar o projeto:

```bash
git clone https://github.com/SEU-USUARIO/ProjectWeb1.git
cd ProjectWeb1
```
*(Lembre-se de substituir o link acima caso a URL do repositório mude)*

### 2. Subindo o Servidor com Docker

Dentro da pasta do projeto, inicie os contêineres em segundo plano executando:

```bash
docker compose up -d
```

> **Aviso:** Na primeira vez, isso pode demorar alguns minutos pois o Docker baixará as imagens oficiais do PHP e do MySQL. 

### 3. Acessando a Aplicação

Uma vez que o terminal retorne sucesso, o sistema já estará no ar com o banco de dados populado com anúncios de teste! 

Abra o seu navegador de preferência e acesse:
👉 **[http://localhost:8000](http://localhost:8000)**

---

## 👤 Testando a Área Restrita (Login)

O sistema possui uma área pública (onde qualquer pessoa vê anúncios) e uma área restrita (para gerenciar os próprios anúncios). O banco de dados já vem populado com um usuário para você testar imediatamente:

- **E-mail:** `joao@email.com`
- **Senha:** `root`

Você também pode acessar a aba **"Cadastro"** na interface para criar um usuário próprio do zero. 

---

## 🛑 Como desligar o Servidor

Quando você terminar de usar ou avaliar o projeto, pode desligar a infraestrutura local rodando o comando:

```bash
docker compose down
```

---

*Desenvolvido com ☕ e dedicação por:*
- Eduardo Oliveira Marson
- Lorena Fernandes Izidoro
- Luis Felipe Garcia de Souza Paim
- Maria Clara Silva Borges
- Willy Naresse Lúcio
