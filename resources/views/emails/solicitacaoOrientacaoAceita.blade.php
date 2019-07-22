@component('mail::message')
# Olá, {{ $aluno }}

Boas notícias! {{ $professor }} aceitou sua solicitação de orientação.

@component('mail::button', ['url' => route('aluno.orientador.tcc')])
Ver
@endcomponent

@endcomponent