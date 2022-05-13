<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-links/contatos.css">
    <link rel="stylesheet" href="css-links/header-main-footer.css">
    <script src="https://kit.fontawesome.com/02a1c8bf88.js" crossorigin="anonymous"></script>
    <title>Contatos</title>
</head>
<body>
    <header>
        <div class="cms-header">

            <div class="header-container">
                <div class="header-titulo">
                    <p>C M S - Lojão das Torcidas </p>
                    <h2>Gerenciamento de Conteúdo do Site</h2>
                </div>
                <div class="logo">
                    <img src="../img/logo.png" alt="logo">
                </div>
            </div>
           
            <div class="header-links">
                <div class="secao-icon">
                    <i class="fa-solid fa-shirt"></i>
                    <p class="icon-title">
                        Adm. de Produtos
                    </p>
                </div>
                
                <div class="secao-icon">
                    <i class="fa-solid fa-marker"></i>
                    <p class="icon-title">
                        Adm. de Categorias
                    </p>
                </div>

                <div class="secao-icon">
                    <i class="fa-solid fa-users-line"></i>
                    <p class="icon-title">
                        Contatos
                    </p>
                </div>

                <div class="secao-icon">
                    <i class="fa-solid fa-address-card"></i>
                    <p class="icon-title">
                        Usuários
                    </p>
                </div>

                <div class="secao-logout">
                    <p class="secao-logout-welcome">
                        Bem Vindo << Nome Usuario >>
                    </p>
                    <div class="secao-icon">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <p class="icon-title">
                            Logout
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </header>
    <main>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Mensagens.</h1>
                    </td>
                </tr>
                
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Mensagem </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>
                
                <?php
                    require_once('./controller/controller-contatos.php');
                    $listarMensagem = listarMensagem();
                    if($listarMensagem) {
                    foreach ($listarMensagem as $mensagem)
                        {
                            
                ?>

                    <tr id="tblLinhas">
                        <td class="tblColunas registros"><?=$mensagem['nome']?></td>
                        <td class="tblColunas registros"><?=$mensagem['celular']?></td>
                        <td class="tblColunas registros"><?=$mensagem['email']?></td>
                        <td class="tblColunas registros"><?=$mensagem['msg']?></td>
                        <td class="tblColunas registros">
                            
                            <a onclick="return confirm('Deseja realmente excluir o contato <?=$mensagem['nome']?>?')" href="router.php?component=contatos&action=deletar&id=<?=$mensagem['id']?>">
                                <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir" >     
                            </a>
                                                       
                        </td>
                    </tr>

                <?php
                    }
                }
                ?>

            </table>
        </div>

    </main>
    <footer>
        <div class="footer-copy">
            <p>© Copyright 2021</p>
            <p>Todos os direitos reservados - Política de Privacidade</p>
        </div>
        <div class="footer-dev">
            <p>Desenvolvido por Vitor Aguiar</p>
            <p>versão 1.0.0</p>
        </div>
    </footer>
</body>
</html>