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

        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Usuarios </h1>        
            </div>
                <div id="cadastroInformacoes">
                    <form action="router.php?component=usuarios&action=inserir" name="frmCadastro" method="post" >
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Nome: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtNome" placeholder="Digite o email do usuario" maxlength="90">
                            </div>
                            <div class="cadastroInformacoesPessoais">
                                <label> Nome de usuario: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtUsuario" placeholder="Digite o nome de um usuario" maxlength="90">
                            </div>
                            <div class="cadastroInformacoesPessoais">
                                <label> Email: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtEmail" placeholder="Digite o email do usuario" maxlength="90">
                            </div>
                            <div class="cadastroInformacoesPessoais">
                                <label> Senha: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="password" name="txtSenha" id="senha" placeholder="Senha" 
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$" 
                                title=" A senha devera ter o comprimento maior ou igual a 8 e menor ou igual a 16, pelo menos uma letra minúscula, uma letra maiuscula, 
                                um dígito númerico e um caracter especial." required>
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
                            <h1> Consulta de Categorias.</h1>
                        </td>
                    </tr>
                    
                    <tr id="tblLinhas">
                        <td class="tblColunas destaque"> Nome </td>

                        <td class="tblColunas destaque"> Nome de usuario </td>

                        <td class="tblColunas destaque"> email </td>
                        
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
                        
                            
                            
                                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">    
                            
                            
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