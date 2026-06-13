# CineVault

Projeto final A1 de Desenvolvimento de Sistemas feito em PHP com organização MVC.

## Como rodar

1. Coloque a pasta `cinevault_fixed` dentro da pasta pública do servidor local, como `htdocs` no XAMPP.
2. Importe o arquivo `banco.sql` pelo phpMyAdmin.
3. Confira usuário e senha do MySQL em `config/database.php`.
4. Abra o sistema pelo arquivo `index.php`.

## Estrutura

- `index.php`: recebe as requisições e chama o controller correto.
- `config/database.php`: cria a conexão PDO com o MySQL.
- `app/models`: classes que acessam os dados do banco.
- `app/controllers`: classes com regras de login, cadastro e CRUD de filmes.
- `app/views`: páginas HTML exibidas para o usuário.
- `public/css/style.css`: estilos visuais do projeto.

## Segurança usada

- As consultas ao banco usam PDO com prepared statements.
- Campos exibidos nas views usam `htmlspecialchars()`.
- Páginas de cadastro, edição e exclusão de filmes exigem sessão ativa.
- Formulários usam token CSRF.
