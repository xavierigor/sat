@component('mail::message')
# Olá, {{ $aluno }}

Seu orientador atualizou o seu documento {{ $documento }}.

@component('mail::button', ['url' => route('aluno.documentos.tcc')])
Ver
@endcomponent

@endcomponent