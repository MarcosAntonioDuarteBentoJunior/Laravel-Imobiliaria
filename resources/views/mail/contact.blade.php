<h3>
    mensagem de: {{ $email['name'] }}
</h3>

<hr>

<p>
    {{ $email['message'] }}
</p>

<hr>

Email enviado em {{ date('d/m/Y h:i:s') }} por: {{ $email['email'] }}
