# Projeto Prático 2 - Web

Sistema web de **cadastro de livros, autores e comentários**, desenvolvido em PHP puro seguindo arquitetura MVC, com conexão em PostgreSQL e integração com duas APIs externas: **ViaCEP** (consulta de endereço) e **MockAPI** (simulação de API REST para comentários).

Projeto acadêmico desenvolvido para a disciplina de **Desenvolvimento Web**.

## Índice

- [Objetivo do Projeto](#-objetivo-do-projeto)
- [O que foi aprendido e aplicado](#-o-que-foi-aprendido-e-aplicado)
- [Tecnologias Utilizadas](#️-tecnologias-utilizadas)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Modelo de Dados](#️-modelo-de-dados)
- [Pré-requisitos](#-pré-requisitos)
- [Instalação e Configuração](#️-instalação-e-configuração)
- [Executando o Projeto](#️-executando-o-projeto)
- [Funcionalidades](#-funcionalidades)
- [Licença](#-licença)

## Objetivo do Projeto

O objetivo do projeto foi construir uma aplicação web completa em PHP aplicando manualmente uma arquitetura em camadas MVC para o gerenciamento de um pequeno acervo de livros. O sistema cobre três entidades:

- **Autor** — com CRUD completo, persistido em PostgreSQL, incluindo preenchimento automático de endereço via CEP;
- **Livro** — com CRUD completo, persistido em PostgreSQL, vinculado a um autor;
- **Comentário** — terceira entidade, consumida de uma **API externa (MockAPI)** em vez do banco local, simulando um cenário de integração com serviço de terceiros.

## O que foi aprendido e aplicado

- **Arquitetura MVC "na mão"** — separação clara entre `model` (entidades), `dao` (acesso a dados), `controller` (regras de negócio/orquestração) e `view` (páginas PHP exibidas ao usuário), sem uso de frameworks como Laravel.
- **Padrão DAO** — `AutorDao`, `LivroDao` e `ComentarioDao`, cada um isolando a lógica de acesso à sua respectiva fonte de dados.
- **PDO (PHP Data Objects)** — conexão com PostgreSQL via `PDO`, com `PDO::ATTR_ERRMODE` configurado para lançar exceções (`PDO::ERRMODE_EXCEPTION`) em vez de falhar silenciosamente.
- **Variáveis de ambiente (.env)** — classe `Env.php` própria para ler um arquivo `.env` e carregar as credenciais do banco via `putenv()`, evitando credenciais hardcoded no código-fonte (`Database.php` lê tudo via `getenv()`).
- **Consumo de API REST externa (MockAPI)** — a entidade `Comentario` não tem tabela no banco; em vez disso, `ComentarioDao` busca os dados via `file_get_contents()` numa URL do MockAPI e decodifica o JSON retornado (`json_decode`), demonstrando integração com serviços externos sem necessidade de biblioteca HTTP adicional.
- **Consumo da API ViaCEP** — no cadastro e edição de autor, o CEP informado é usado para buscar automaticamente cidade e estado, evitando digitação manual e erros de preenchimento.
- **Modelagem de entidades sem chave estrangeira "forçada"** — por decisão consciente de escopo do projeto, o campo `autor` na tabela `livro` foi mantido como texto (`VARCHAR`) em vez de chave estrangeira, documentando a limitação diretamente no script SQL (ver `create.txt`).
- **Evolução incremental do schema** — uso de `ALTER TABLE` para adicionar campos de endereço (`cep`, `cidade`, `estado`) à tabela `autor` depois da criação inicial, simulando uma migração real de banco.
- **Fluxo de CRUD completo via páginas PHP** — cada entidade tem suas próprias views de listar, cadastrar, editar e deletar (ex.: `ListaAutor.php`, `CadastrarAutor.php`, `EditaAutor.php`, `DeletaAutor.php`), com o `controller` correspondente tratando o `$_POST` e redirecionando (`header("Location: ...")`) após salvar.
- **Organização e versionamento** — uso de `.gitignore` e `.env.example` para não versionar credenciais reais, apenas um modelo de configuração.
- **Deploy em VM via SSH** — aplicação preparada para publicação em servidor próprio (VM acadêmica), rodando sobre PHP nativo com PostgreSQL.

## Tecnologias Utilizadas

- **PHP** (nativo, sem framework)
- **PostgreSQL** (via extensão `PDO`)
- **HTML5 / CSS3**
- **APIs externas:**
  - [ViaCEP](https://viacep.com.br/) — consulta de endereço por CEP
  - [MockAPI](https://mockapi.io/) — simulação de API REST para os comentários

## Estrutura do Projeto

```
Projeto_Pratico2_Web/
├── controller/                # Camada de controle (regras de negócio)
│   ├── ControlaAutor.php
│   ├── ControlaLivro.php
│   └── ControlaComentario.php
│
├── dao/                        # Camada de acesso a dados
│   ├── AutorDao.php             # CRUD de autores no PostgreSQL
│   ├── LivroDao.php             # CRUD de livros no PostgreSQL
│   └── ComentarioDao.php        # Consome comentários via MockAPI (HTTP)
│
├── model/                      # Entidades do domínio
│   ├── Autor.php
│   ├── Livro.php
│   └── Comentario.php
│
├── view/                        # Páginas PHP (interface do usuário)
│   ├── index.php                # Página inicial / menu de navegação
│   ├── CadastrarAutor.php       # Formulário de cadastro (com busca ViaCEP)
│   ├── EditaAutor.php           # Formulário de edição (com busca ViaCEP)
│   ├── ListaAutor.php           # Listagem de autores
│   ├── DeletaAutor.php          # Exclusão de autor
│   ├── CadastrarLivro.php       # Formulário de cadastro de livro
│   ├── EditaLivro.php           # Formulário de edição de livro
│   ├── ListaLivro.php           # Listagem de livros
│   ├── DeletaLivro.php          # Exclusão de livro
│   ├── CadastraComentario.php  # Cadastro de comentário (via MockAPI)
│   ├── ListaComentario.php     # Listagem de comentários (via MockAPI)
│   └── style.css                # Estilos da aplicação
│
├── Database.php                 # Classe de conexão PDO com PostgreSQL
├── Env.php                       # Carregador de variáveis de ambiente (.env)
├── .env.example                  # Modelo de configuração de ambiente
├── .gitignore
└── create.txt                    # Script SQL de criação das tabelas
```

## Modelo de Dados

Script completo em `create.txt`. Tabelas persistidas em PostgreSQL:

| Tabela | Descrição |
|---|---|
| `autor` | Nome, nacionalidade, data de nascimento e endereço (CEP, cidade, estado — adicionados via `ALTER TABLE`) |
| `livro` | Título, autor (armazenado como texto, não FK), gênero e número de páginas |

> A entidade **Comentário** não possui tabela local: seus dados vêm de uma API externa (MockAPI), consultada em tempo real pelo `ComentarioDao`.

## Pré-requisitos

- **PHP 8+** com extensão `pdo_pgsql` habilitada
- **PostgreSQL** instalado e em execução
- Servidor web (Apache/Nginx) ou o servidor embutido do PHP
- Acesso à internet (para as chamadas às APIs ViaCEP e MockAPI)

## Instalação e Configuração

1. **Clone o repositório**
   ```bash
   git clone <url-do-repositorio>
   cd Projeto_Pratico2_Web
   ```

2. **Crie o banco de dados no PostgreSQL**
   ```bash
   createdb nome_do_banco
   ```

3. **Execute o script de criação das tabelas**
   ```bash
   psql -U usuario -d nome_do_banco -f create.txt
   ```

4. **Configure o arquivo de ambiente**

   Copie o modelo e edite com suas credenciais:
   ```bash
   cp .env.example .env
   ```
   ```env
   DB_HOST=db
   DB_PORT=5432
   DB_NAME=nome_do_banco
   DB_USER=usuario
   DB_PASS=senha
   ```

## Executando o Projeto

Usando o servidor embutido do PHP, a partir da pasta `view`:

```bash
cd view
php -S localhost:8000
```

Depois acesse no navegador:
```
http://localhost:8000/index.php
```

> Alternativamente, aponte o document root do Apache/Nginx para a pasta `view/` do projeto.

## Funcionalidades

- **Página inicial** com navegação para as três entidades do sistema
- **Autores**
  - Cadastrar, listar, editar e excluir autores
  - Preenchimento automático de cidade/estado a partir do CEP (API ViaCEP)
- **Livros**
  - Cadastrar, listar, editar e excluir livros, vinculados a um autor
- **Comentários**
  - Cadastrar e listar comentários sobre livros, consumindo dados de uma API externa (MockAPI)

## Licença

Projeto acadêmico desenvolvido para fins educacionais.
