<?php

    //variavel que tem como funcionalidade diferenciar o action do form
    $form = (string) "router.php?component=usuarios&action=inserir";

    //Valida se a variavel de sessão esta ativa
    if(session_status()) {

        //Valida se a variavel não esta vazia
        if(!empty($_SESSION['dadosUsuarios'])) {

            $id        = $_SESSION['dadosUsuarios']['id'];
            $nome = $_SESSION['dadosUsuarios']['nome'];
            $usuario = $_SESSION['dadosUsuarios']['nomeusuario'];
            $email = $_SESSION['dadosUsuarios']['email'];
            $senha = $_SESSION['dadosUsuarios']['senha'];

            //mudando o form
            $form = "router.php?component=usuarios&action=editar&id=".$id;

            //detruindo a variavel de sessao do server
            unset($_SESSION['dadosUsuarios']);
        }
    }

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-links/usuarios.css">
    <link rel="stylesheet" href="css-links/header-main-footer.css">
    <script src="https://kit.fontawesome.com/02a1c8bf88.js" crossorigin="anonymous"></script>
    <script src="js/main.js" defer></script>
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
            <a href="produtos.php" class="secao-icon">
                    <i class="fa-solid fa-shirt"></i>
                    <p class="icon-title">
                        Adm. de Produtos
                    </p>
                </a>
                
                <a href="categorias.php" class="secao-icon">
                    <i class="fa-solid fa-marker"></i>
                    <p class="icon-title">
                        Adm. de Categorias
                    </p>
                </a>

                <a href="contatos.php" class="secao-icon">
                    <i class="fa-solid fa-users-line"></i>
                    <p class="icon-title">
                        Contatos
                    </p>
                </a>

                <a href="usuarios.php" class="secao-icon">
                    <i class="fa-solid fa-address-card"></i>
                    <p class="icon-title">
                        Usuários
                    </p>
                </a>
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

        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Usuarios </h1>        
            </div>
                <div id="cadastroInformacoes">
                    <form action="<?=$form?>" name="frmCadastro" method="post" >
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Nome: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtNome" placeholder="Digite o email do usuario" maxlength="90" value="<?=isset($nome)?$nome:null?>">
                            </div>
                            <div class="cadastroInformacoesPessoais">
                                <label> Nome de usuario: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtUsuario" placeholder="Digite o nome de um usuario" maxlength="90" value="<?=isset($usuario)?$usuario:null?>">
                            </div>
                            <div class="cadastroInformacoesPessoais">
                                <label> Email: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtEmail" placeholder="Digite o email do usuario" maxlength="90" value="<?=isset($email)?$email:null?>">
                            </div>
                            <div class="cadastroInformacoesPessoais">
                                <label> Senha: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="password" name="txtSenha" id="senha" placeholder="Senha" 
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$" 
                                title=" A senha devera ter o comprimento maior ou igual a 8 e menor ou igual a 16, pelo menos uma letra minúscula, uma letra maiuscula, 
                                um dígito númerico e um caracter especial." required value="<?=isset($senha)?$senha:null?>">
                                <i class="fa-solid fa-eye" id="vizualizar" pattern="^(?=.*\d)(?=.*[az])(?=.*[AZ]).{4,15}$" ></i>
                            </div>
    
                        </div>
                                        
                        
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="Salvar">
                         </div>
                    

                    </form>
                </div>
            </div>   

            <div id="consultaDeDados">
                <table id="tblConsulta" >
                    <tr>
                        <td id="tblTitulo" colspan="6">
                            <h1> Consulta de Usuários.</h1>
                        </td>
                    </tr>
                    
                    <tr id="tblLinhas">
                        <td class="tblColunas destaque"> Nome </td>

                        <td class="tblColunas destaque"> Nome de usuario </td>

                        <td class="tblColunas destaque"> Email </td>
                        
                        <td class="tblColunas destaque"> Opções </td>
                    </tr>

                    <?php
                        require_once('./controller/controller-usuarios.php');
                        $listUsuarios = listarUsuario();
                        if($listUsuarios) {
                            
                        
                        foreach ($listUsuarios as $item)
                        {
                    ?>

                    


                    <tr id="tblLinhas">
                        <td class="tblColunas registros"><?=$item['nome']?></td>
                        <td class="tblColunas registros"><?=$item['nomeusuario']?></td>
                        <td class="tblColunas registros"><?=$item['email']?></td>
                        <td class="tblColunas registros">
                        
                            
                            <a href="router.php?component=usuarios&action=buscar&id=<?=$item['id']?>">
                                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                            </a>
                            
                            <a onclick="return confirm('Deseja realmente excluir o usuario <?=$item['nome']?>?')" href="router.php?component=usuarios&action=deletar&id=<?=$item['id']?>">
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