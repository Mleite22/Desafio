<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste de email</title>
</head>
<body>
    <h1>Olá, {{ $user->name }}</h1>
    <p>Seja bem-vindo(a) ao nosso sistema!</p>
    <p>Seu e-mail de cadastro é: {{ $user->email }}</p>
    <p>Estamos felizes em tê-lo(a) conosco.</p>
    <p>Atenciosamente,</p>
    <p>A equipe do sistema</p>

    <footer>
        <p>&copy; {{ date('Y') }} Sistema. Todos os direitos reservados.</p>
    </footer>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            
        }
        h1 {
            color: #2c3e50;
        }
        p {
            margin-bottom: 15px;
        }
        footer {
            margin-top: 20px;
            font-size: 0.8em;
            
        }
        footer p {
            margin: 0;
        }
        /* Responsive styles */
        @media (max-width: 600px) {
            body {
                font-size: 14px;
            }
            h1 {
                font-size: 24px;
            }
            p {
                font-size: 16px;
            }
            footer {
                font-size: 0.7em;
                background-color: #ffffff;
            }
        }
    </style>
    <script>
        // JavaScript can be added here if needed
        console.log('Email template loaded');
        // You can add more functionality as per your requirements
        // For example, you can track email opens or clicks using a tracking pixel
        // or link click events.
        // Example of a tracking pixel
        // var img = new Image();
        // img.src = 'https://example.com/tracking-pixel?email={{ $user->email }}';
        // document.body.appendChild(img);
    </script>
    
</body>
</html>