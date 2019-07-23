@component('mail::message')
# Olá, {{ $aluno }}

{{ $professor }} aceitou sua solicitação de orientação.

@component('mail::button', ['url' => route('aluno.orientador.tcc')])
Ver
@endcomponent

@endcomponent