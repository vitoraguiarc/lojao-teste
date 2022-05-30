<?php
    //import arquivo de config
    require_once('modulo/config.php');

    //variavel que tem como finalidade diferenciar no action do form qual será a action encaminhada para a router (inserir ou editar)
    $form = (string) "router.php?component=produtos&action=inserir";

    //variavel para carregar o nome da foto do banco de dados
    $foto = (string) null;

    $destaque = (int) null;

    $idcategoria = (string) null;


    //Valida se a utilização de variaveis de sessão esta ativa no servidor
    if(session_status()) {

        //Valida se a variavel de sessão dadosProduto não esta vazia
        if(!empty($_SESSION['dadosProduto'])) {

            $id        = $_SESSION['dadosProduto']['id'];
            $nome      = $_SESSION['dadosProduto']['nome'];
            $descricao = $_SESSION['dadosProduto']['descricao'];
            $preco     = $_SESSION['dadosProduto']['preco'];
            $destaque  = $_SESSION['dadosProduto']['destaque'];
            $desconto  = $_SESSION['dadosProduto']['desconto'];
            $foto      = $_SESSION['dadosProduto']['foto'];
            $idcategoria = $_SESSION['dadosProduto']['idcategoria'];
            

            //Mudando o action para editar
            $form = "router.php?component=produtos&action=editar&id=".$id."&foto=".$foto;

            //Destroi uma variavel da memoria do servidor
            unset($_SESSION['dadosProduto']);

        }

    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-links/produtos.css">
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
                <h1> Cadastro de Produtos </h1>        
            </div>
                <div id="cadastroInformacoes">
                    <form action="<?=$form?>" name="frmCadastro" method="post" enctype="multipart/form-data" >
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Nome: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtNome" placeholder="Digite o nome de uma categoria" maxlength="90" value="<?=isset($nome)?$nome:null?>">
                            </div>
                        </div>


                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Descrição: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtDescricao"  value="<?=isset($descricao)?$descricao:null?>">
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Preço: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtPreco" maxlength="90" value="<?=isset($preco)?$preco:null?>">
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Destaque: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="checkbox" name="cbkDestaque" <?= $destaque == '1' ? 'checked' : null ?>>
                            </div>
                        </div>

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Desconto: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtDesconto" id="desconto" value="<?=isset($desconto)?$desconto:null?>">
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

                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Categoria: </label>
                            </div>
                        
                            <div class="cadastroEntradaDeDados">
                                <select name="sltCategoria" id="">
                                    <option value="">Selecione um item</option>
                                    <?php
                                        //import da controller de categoria
                                        require_once('controller/controller-categorias.php');
                                        //chama a função para carregar todos as categorias no banco
                                        $listCategorias = listarCategoria();
                    
                                            foreach ($listCategorias as $item) {

                                                ?>
                                                    <option <?=$idcategoria==$item['id']?'selected':null ?> value="<?=$item['id']?>"><?=$item['categoria']?></option>
                                                <?php
                                            }
                                    
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="campos editar-foto">
                            <img src="<?=DIRETORIO_FILE_UPLOAD.$foto?>" alt="">
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
                    <?php
                        require_once('./controller/controller-produtos.php');
                        $listarProduto = listarProduto();
                        if($listarProduto) {
                        foreach ($listarProduto as $produto){
                            $foto = $produto['foto'];
                    ?>

                    <tr id="tblLinhas">
                        <td class="tblColunas registros"><?=$produto['nome']?></td>
                        <td class="tblColunas registros"><?=$produto['preco']?></td>
                        <td class="tblColunas registros"><?=$produto['destaque'] == '1' ? 'SIM' : 'NÂO'?></td>
                        <td class="tblColunas registros"><?=$produto['desconto']."%"?></td>
                        <td class="tblColunas registros"><img src="<?=DIRETORIO_FILE_UPLOAD.$foto?>" class="foto"></td>
                        

                        <td class="tblColunas registros">
                        
                            <a href="router.php?component=produtos&action=buscar&id=<?=$produto['id']?>">
                                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                            </a>

                            <a onclick="return confirm('Deseja realmente excluir o produto <?=$produto['nome']?>?')" href="router.php?component=produtos&action=deletar&id=<?=$produto['id']?>&foto=<?=$foto?>">
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