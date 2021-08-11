# SAT

> 🎓 Sistema de Apoio ao Trabalho de Conclusão de Curso (SAT)
>
> O sistema SAT propõe informatizar o processo de envio, recebimento e gerenciamento de documentos referentes aos TCC's por parte de Alunos, Professores e Coordenador


<p align="center">
  <img alt="Tela de login do projeto" src="public/images/telassite.jpg" />
</p>


## Versioning/Versionamento
Esse projeto não possui um sistema de versionamento.

## History/Histórico
Consulte as [Releases](https://github.com/xavierigor/sat/releases) para acompanhar as alterações feitas no projeto.



## Mais informações

<details>
<summary>Instando e iniciando o projeto</summary>
<br />

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
    
<br />
</details>