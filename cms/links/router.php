<?php

/****************************************************************************
    * Objetivo: Arquivo de rota, para segmentar as ações encaminhadas pela View 
    * (dados de um form, listagem de dados, ação de excluir ou atualizar). Esse
    * arquivo será responsável por encaminhar as solicitações para a Controller
    * Autor: Vitor Aguiar
    * Data: 04/03/2022
    * Versão: 1.0
*****************************************************************************/
$action = (string) null;
$component = (string) null;

//validação para verificar se a requisição é um POST de formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {

    //Recebendo dados via URL p/ saber quem tá solicitando e qual ação será realizada
    $component =  strtoupper($_GET['component']);
    $action = strtoupper($_GET['action']);


    //Estrutura condicional para validar quem esta solicitando algo para o maestro
    switch($component)
    {
        case 'CONTATOS';

            //Importar o arquivo da controller
            require_once('controller/controller-contatos.php');

            //Validação para qual ação será realizada
             if ($action == 'DELETAR') {
                //Recebe o id do registro que devera ser excluído, este foi enviado pela url no link da imagem do excluir que foi acionado na index
                $idContato = $_GET['id']; 
                
                $resposta = excluirMessage($idContato);

                if(is_bool($resposta)) 
                    echo("<script>
                            alert('Mensagem excluída com sucesso!!');
                            window.location.href = 'contatos.php';
                        </script>");
                 elseif (is_array($resposta))
                    echo("<script>
                            alert('".$resposta['message']."');
                            window.history.back();
                        </script>"); 
                
            } 

        case 'CATEGORIAS';

            //Importar o arquivo da controller
            require_once('controller/controller-categorias.php');

            //Validando qual sera a ação
            if($action == 'INSERIR') {

                //chama a função de inserir na controller
                $resposta = inserirCategoria($_POST);

                //Valida o tipo de dados que a controller retornou
                if (is_bool($resposta)) /*Se for booleaan*/ {   

                    //Verificar se o retorno foi verdadeiro
                    if ($resposta) 
                        echo("<script>
                                alert('Categoria inserida com sucesso!!');
                                window.location.href = 'categorias.php';
                            </script>");
                
                }   //Se o retorno for um array significa houve erro no processo de inserção
                    elseif (is_array($resposta))
                        echo("<script>
                                alert('".$resposta['message']."');
                                window.history.back();
                            </script>");

            } elseif ($action == 'DELETAR') {

                //Recebe o id da categoria que devera ser excluido
                $idCategoria = $_GET['id'];

                $resposta = excluirCategoria($idCategoria);

                if(is_bool($resposta)) 
                        echo("<script>
                                alert('Categoria excluído com sucesso!!');
                                window.location.href = 'categorias.php';
                            </script>");
                elseif (is_array($resposta))
                        echo("<script>
                                alert('".$resposta['message']."');
                                window.history.back();
                            </script>"); 
            
            } elseif ($action == 'BUSCAR') {

                //Recebe o id da categoria que devera ser excluido
                $idCategoria = $_GET['id'];
                
                //Busca a categoria pelo id
                $dados = buscarCategoria($idCategoria);

                //Ativa a utilização de variaveis de sessao no server
                session_start();

                //Guarda em uma variavel de sessao os dados que o BD retornou para a busca do ID
                $_SESSION['dadosCategoria'] = $dados;
                
                // utilizando o require não havera um novo carregamento, apenas a importação da inde.php
                require_once('categorias.php');

            } elseif ($action == 'EDITAR') {
                
                //Recebe o id da categoria que devera ser excluido
                $idCategoria = $_GET['id'];
                
                //Chama a funçao de editar
                $resposta = atualizarCategoria($_POST, $idCategoria);

                //Valida o tipo de dados que a controller retornou
                if (is_bool($resposta)) /*Se for booleaan*/ {   

                    //Verificar se o retorno foi verdadeiro
                    if ($resposta) 
                        echo("<script>
                                alert('Categoria modificada com sucesso!!');
                                window.location.href = 'categorias.php';
                            </script>");
                
                }   //Se o retorno for um array significa houve erro no processo de inserção
                    elseif (is_array($resposta))
                        echo("<script>
                                alert('".$resposta['message']."');
                                window.history.back();
                            </script>");
            }
        
        case 'USUARIOS';

            //Importar o arquivo da controller
            require_once('controller/controller-usuarios.php');

            //Validando qual sera a ação
            if($action == 'INSERIR') {

                //chama a função de inserir na controller
                $resposta = inserirUsuario($_POST);

                //Valida o tipo de dados que a controller retornou
                if (is_bool($resposta)) /*Se for booleaan*/ {   

                    //Verificar se o retorno foi verdadeiro
                    if ($resposta) 
                        echo("<script>
                                alert('Usuario inserido com sucesso!!');
                                window.location.href = 'usuarios.php';
                            </script>");
                
                }   //Se o retorno for um array significa houve erro no processo de inserção
                    elseif (is_array($resposta))
                        echo("<script>
                                alert('".$resposta['message']."');
                                window.history.back();
                            </script>");

            } elseif ($action == 'DELETAR') {

                //Recebe o id do usuario que devera ser excluido
                $idUsuario = $_GET['id'];

                $resposta = excluirUsuario($idUsuario);

                if(is_bool($resposta)) 
                        echo("<script>
                                alert('Usuario excluído com sucesso!!');
                                window.location.href = 'usuarios.php';
                            </script>");
                elseif (is_array($resposta))
                        echo("<script>
                                alert('".$resposta['message']."');
                                window.history.back();
                            </script>"); 
            
            } elseif ($action == 'BUSCAR') {

                //Recebe o id do usuario que devera ser excluido
                $idUsuario = $_GET['id'];
                
                //Busca a categoria pelo id
                $dados = buscarUsuario($idUsuario);

                //Ativa a utilização de variaveis de sessao no server
                session_start();

                //Guarda em uma variavel de sessao os dados que o BD retornou para a busca do ID
                $_SESSION['dadosUsuarios'] = $dados;
                
                // utilizando o require não havera um novo carregamento, apenas a importação da inde.php
                require_once('usuarios.php');

            } elseif ($action == 'EDITAR') {
                
                //Recebe o id da categoria que devera ser excluido
                $idUsuario = $_GET['id'];
                
                //Chama a funçao de editar
                $resposta = atualizarUsuario($_POST, $idUsuario);

                //Valida o tipo de dados que a controller retornou
                if (is_bool($resposta)) /*Se for booleaan*/ {   

                    //Verificar se o retorno foi verdadeiro
                    if ($resposta) 
                        echo("<script>
                                alert('Usuario modificado com sucesso!!');
                                window.location.href = 'usuarios.php';
                            </script>");
                
                }   //Se o retorno for um array significa houve erro no processo de inserção
                    elseif (is_array($resposta))
                        echo("<script>
                                alert('".$resposta['message']."');
                                window.history.back();
                            </script>");
            }
            
        break;

    }
}


?>