<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-links/categorias.css">
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

        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Produtos </h1>        
            </div>
                <div id="cadastroInformacoes">
                    <form action="produtos.php" name="frmCadastro" method="post" >
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Nome: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtNome" placeholder="Digite o nome de uma categoria" maxlength="90">
                            </div>
                        </div>


                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Descrição: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtDescricao" placeholder="Digite o nome de uma categoria" maxlength="90">
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Preço: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="is_float" name="txtPreco" placeholder="Digite o nome de uma categoria" maxlength="90">
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Destaque: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="checkbox" name="txtDestaque">
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Desconto: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtDesconto" id="desconto">
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Imagem: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input  type="file" name="fleFoto" accept=".jpg, .png, .jpeg, .gif">
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
                            <h1> Consulta de Produtos.</h1>
                        </td>
                    </tr>
                    
                    <tr id="tblLinhas">
                        <td class="tblColunas destaque"> Nome </td>
                        <td class="tblColunas destaque"> Preço </td>
                        <td class="tblColunas destaque"> Destaque </td>
                        <td class="tblColunas destaque"> Desconto </td>
                        <td class="tblColunas destaque"> Imagem </td>
                        
                        <td class="tblColunas destaque"> Opções </td>
                    </tr>

                    <tr id="tblLinhas">
                        <td class="tblColunas registros">aaaaaaaaa</td>
                        <td class="tblColunas registros">aaaaaaaaa</td>
                        <td class="tblColunas registros">aaaaaaaaa</td>
                        <td class="tblColunas registros">aaaaaaaaa</td>
                        <td class="tblColunas registros">aaaaaaaaa</td>
                        

                        <td class="tblColunas registros">
                        
                            <!-- <a href="router.php?component=categorias&action=buscar&id=<?=$item['id']?>"> -->
                                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                            <!-- </a> -->

                            <!-- <a onclick="return confirm('Deseja realmente excluir a categoria <?=$item['categoria']?>?')" href="router.php?component=categorias&action=deletar&id=<?=$item['id']?>"> -->
                                <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir" >     
                            <!-- </a> -->
                                                        
                        </td>

                    </tr>

                    


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