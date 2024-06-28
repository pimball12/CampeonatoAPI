<h1>Campeonato</h1>
<p>Sistema criado em laravel e angular para simular campeonatos de futebol aleatoriamente</p>
<p>Esse módulo do projeto se trata da API de acesso ao banco.</p>

<h2>Instalação</h2>
<p>Baixe os pacotes necessários com composer</p>
<pre>> composer install</pre>

<p>Altere o arquivo .env e insira suas credenciais do banco de dados em questão</p>
<pre>
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=[SEU_BANCO]
DB_USERNAME=[SEU_USUARIO]
DB_PASSWORD=[SUA_SENHA]
</pre>

<p>Faça as migrações para contrução das tabelas.</p>
<pre>> php artisan migrate</pre>

<p>Agora basta iniciar o servidor</p>
<pre>> php artisan serve</pre>

<p>A porta padrão é a 8000, portanto, a API pode ser acessada através do endereço localhost:8000</p>
