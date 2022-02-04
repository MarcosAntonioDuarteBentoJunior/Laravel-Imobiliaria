
<h2>Olá, {{ $user->name }}</h2>

<hr>

<p>
    Esta é uma aplicação que simula o funcionamento de um sistema de imobiliária <br>
    Obrigado por testa-la <br>
    Encontrou algum bug ? Responda esta mensagem com o problema encontrado.
</p>

<hr>
Email enviado em {{ date('d/m/Y H:i:s') }} para: {{ $user->email }}