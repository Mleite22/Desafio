Prezado, {{ $user->name }}
    Você solicitou um código de verificação para redefinir sua senha. O código é:
    {{ $code }}
    Por favor, insira este código no campo apropriado para continuar com o processo de redefinição de senha.
    Por questões de segurança esse código é válido somente até as {{ $formattedTime }} do dia {{ $formattedDate }}. 
    Caso esse prazo esteja expirado, será necessário solicitar outro código.
Se você não solicitou essa alteração, por favor, desconsidere este e-mail.

Atenciosamente,
Equipe do Sistema