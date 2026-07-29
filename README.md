# AutoPortal - Portal de Anúncios de Veículos

Bem-vindo ao **AutoPortal**, o seu sistema completo de classificados de veículos desenvolvido como projeto final da disciplina de Desenvolvimento Web I (Universidade Federal de Uberlândia - UFU).

Este repositório contém a versão completa (Etapa 3) que une uma interface fluída construída com tecnologias nativas e uma API robusta feita em PHP com Banco de Dados MySQL.

🌐 **Site no ar (Live Demo):** [https://projectdevweb1.infinityfree.io](https://projectdevweb1.infinityfree.io)

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
- **CI/CD:** GitHub Actions configurado para deploy contínuo na InfinityFree.

---

## ⚙️ Como baixar e rodar o projeto localmente (Ambiente de Desenvolvimento)

Para que o projeto funcione perfeitamente na sua máquina para testes ou desenvolvimento, você só precisa ter o [Docker](https://www.docker.com/products/docker-desktop/) instalado e rodando. Não é necessário configurar PHP, Apache ou MySQL manualmente, nem rodar scripts de banco de dados, o Docker fará tudo automaticamente.

### 1. Clonando o Repositório

Abra o seu terminal (ou Git Bash) e digite o seguinte comando para baixar o projeto:

```bash
git clone https://github.com/WillyNaresse/ProjectWeb1.git
cd ProjectWeb1
```

### 2. Subindo o Servidor com Docker

Dentro da pasta do projeto, inicie os contêineres em segundo plano executando:

```bash
docker compose up -d
```

> **Aviso:** Na primeira vez, isso pode demorar alguns minutos pois o Docker baixará as imagens oficiais do PHP e do MySQL. O banco de dados e as tabelas já serão criados e populados automaticamente durante esse processo.

### 3. Acessando a Aplicação Local

Uma vez que o terminal retorne sucesso, o sistema já estará no ar!

Abra o seu navegador de preferência e acesse:
👉 **[http://localhost:8000](http://localhost:8000)**

---

## ☁️ Deploy Contínuo (Produção)

Este projeto possui uma esteira de **CI/CD** configurada através do GitHub Actions (`.github/workflows/deploy.yml`). Toda vez que um novo código for integrado (push ou merge request) na branch `main`, o robô do GitHub testará os arquivos e fará o envio via FTP automaticamente para o servidor de produção da InfinityFree, ocultando credenciais e protegendo o ambiente.

*(Nota de segurança: O arquivo `config.php` da hospedagem é blindado pelo `.gitignore` e gerido isoladamente no servidor).*

---

## 👤 Testando a Área Restrita (Login)

O sistema possui uma área pública (onde qualquer pessoa vê anúncios) e uma área restrita (para gerenciar os próprios anúncios). O banco de dados de teste (tanto no Docker quanto no site online) já vem populado com um usuário para você testar imediatamente:

- **E-mail:** `joao@email.com`
- **Senha:** `root`

Você também pode acessar a aba **"Cadastro"** na interface para criar um usuário próprio do zero.

---

## 🛑 Como desligar o Servidor Local

Quando você terminar de usar ou avaliar o projeto no seu computador, pode desligar a infraestrutura do Docker rodando o comando:

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
