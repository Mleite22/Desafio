<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Código de Verificação</title>
</head>
<body>
    <div class="card">
        <h1>Prezado, {{ $user->name }}</h1>
        
        <p>Você solicitou um código de verificação para redefinir sua senha. O código é:</p>
        <h2 style="color: #ffffff; background-color:#333">{{ $code }}</h2>
        <p>Por favor, insira este código no campo apropriado para continuar com o processo de redefinição de senha.</p>
        <p>Por questões de segurança esse código é válido somente até as {{ $formattedTime }} do dia {{ $formattedDate }}. 
            Caso esse prazo esteja expirado, será necessário solicitar outro código.</p>

        <p>Se você não solicitou essa alteração, por favor, desconsidere este e-mail.</p>
        <p>Atenciosamente,</p>
        <p>Equipe do Sistema</p>
    
        <footer>
            <p>&copy; {{ date('Y') }} Sistema. Todos os direitos reservados.</p>
        </footer>        
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            align-items: center;
            justify-content: center;
            
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
            width: 100%;

            
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
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
            .card {
                padding: 15px;
                width: 90%;
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
    </script>
    
</body>
</html>