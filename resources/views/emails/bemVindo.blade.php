@component('mail::message')
# Olá, {{ $nome }}

Você foi cadastrado(a) no <strong>Sistema de Apoio ao Trabalho de Conclusão de Curso (SAT)</strong> da Universidade Estadual da Paraíba.

Sua senha temporária é a sua data de nascimento no formato <strong>ddmmaaaa</strong>.

@component('mail::button', 
['url' => $userType == null ? route('aluno.dashboard') : route('professor.dashboard')])
Acessar
@endcomponent

@endcomponent