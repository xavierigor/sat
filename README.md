# SAT

## Instalação

1. `git clone https://github.com/xavierigor/sat` para clonar o repositório

2. Após ter clonado o repositório, entre na pasta dele e rode `composer install`

3. Crie um banco de dados no phpMyAdmin

4. Crie um arquivo chamado __.env__ na raíz do projeto e copie tudo do arquivo __.env.example__ para ele

5. No arquivo __.env__:

	* Em `APP_NAME`, coloque `SAT`
	* Em `DB_DATABASE`, coloque o mesmo nome que você deu ao banco de dados
	* Em `DB_USERNAME`, coloque `root`
	* Em `DB_PASSWORD`, remova o valor atual e deixe em branco

6. Rode o comando `php artisan key:generate`

7. Por fim, rode `php artisan migrate:fresh --seed`