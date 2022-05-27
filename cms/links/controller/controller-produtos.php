<?php

/******************************************************************* 
     * Objetivo: Arquivo responsavel pela manipulação de dados de contato
     * Obs: Este arquivo fara a ponte entre a view e a model
     * Autor: Vitor Aguiar   
     * Data: 25/02/2022
     * Versão: 1.0    
*********************************************************************/

function inserirProduto($dadosProdutos, $file) {

    $nomeFoto = (string) null;
    $destaque = (int) 0;

    if(!empty($dadosProdutos)) {
        //Validação de campos obrigatorios

        if(!empty($dadosProdutos['txtNome']) || !empty($dadosProdutos['txtDescricao']) || !empty($dadosProdutos['txtPreco']) || !empty($dadosProdutos['txtDesconto']) ) {

            if(isset($_POST['cbkDestaque'])) {
                $destaque = 1;
            } else {
                $destaque = 0;
            }

            if ($file['fleFoto']['name'] != null) {

                //import da função de upload
                require_once('modulo/upload.php');
                
                //chama a função
                $nomeFoto = uploadFile($file['fleFoto']);
                
                if (is_array($nomeFoto)) {
                    return $nomeFoto;    
                }                
            }




            //Criação do array de dados que será encaminhado a model
            $arrayDados = array (
                "nome"      => $dadosProdutos['txtNome'],
                "descricao" => $dadosProdutos['txtDescricao'],
                "preco"     => $dadosProdutos['txtPreco'],
                "desconto"  => $dadosProdutos['txtDesconto'],
                "destaque"  => $destaque,
                "foto"      => $nomeFoto,
                "idcategoria" => $sltCategoria
                
            );

            //Require da model
            require_once('model/bd/produto.php');

            //chamada a função que insere no BD
            if (insertProduto($arrayDados))
                return true;
            else 
                return array ('idErro'  => 1,
                              'message' => 'Não foi possivel inserir os dados no Banco de Dados');

        } else
            return array ('idErro'  =>  2,
                          'message' =>  'Existem campos obrigatórios que não foram preenchidos');  
    }
}

//Função para solicitar os dados da model e encaminhar a lista de produtos p/ view (Listar)
function listarProduto(){
    //import do arquivo que vai buscar os dados no BD
    require_once('model/bd/produto.php');

    //chama a função q8e vai buscar os dados no BD
    $dados = selectAllProdutos();

    if (!empty($dados))
        return $dados;
    else
        return false;
}

//Função para realizar a exclusão de um produto (Excluir)
function excluirProduto($arrayDados) {

    //Recebe o id do registro que será excluido
    $id = $arrayDados['id'];

    //Recebe o nome da foto que será excluida da pasta do servidor
    $foto = $arrayDados['foto'];
    
    //Validação para verificar se o id contem um numero valido
    if($id != 0 && !empty($id) && is_numeric($id)) {
        
        //Import do arquivo de contato
        require_once('model/bd/produto.php');

        //import da constante
        require_once('modulo/config.php');

        //Chama a função na model e valida se o retorno foi verdadeiro ou falso
        if(deleteProduto($id)) {
            
            if($foto != null) {
                if(unlink(DIRETORIO_FILE_UPLOAD.$foto))
                return true;
            else
                return array ('idErro'   => 5, 
                              'message'  => 'O registro no Banco de Dados foi excluído com sucesso
                              porem a imagem não foi excluída do diretorio do servidor'); 
            } else
                return true;
            
        } else
            return array('idErro' => 3,
                         'message' => 'O banco de dados não pode excluir o registro.');
    
    } else 
        return array('idErro' => 4,
                         'message' => 'Não é possivel excluir um registro sem informar um id válido.');
}

//Função para buscar um produto atraves do id do registro
function buscarProduto($id) {

    //validação para verificar se o id contem um numero valido
    if($id != 0 && !empty($id) && is_numeric($id)) {

        //import do arquivo de contato
        require_once('model/bd/produto.php');

        //chama a função na model que vai buscar no BD
        $dados = selectByIdProduto($id);

        //valida se existem dados para serem devolvidos
        if(!empty($dados))
            return $dados;
        else
            return false;

    } else {
        return array('idErro' => 4,
                         'message' => 'Não é possivel excluir um registro sem informar um id válido.');
    }
}

//Função para receber dados da view e encaminhar para a model (Atualizar)
function atualizarProduto($dadosProduto, $arrayDados){

    $statusUpload = (boolean) false;

    $destaque = (int) null;    

    //Recebe o id enviado pelo arrayDados
    $id = $arrayDados['id'];

    //Recebe a foto enviada pelo arrayDados (nome da foto ja existente no BD)
    $foto = $arrayDados['foto'];

    //Recebe o objeto de array referente a nova foto que poderá ser enviada ao servidor
    $file = $arrayDados['file'];

    if(!empty($dadosProduto)){
        //Validação de caixa vazia pois esses elementos são obrigatórios no banco de dados
        if(!empty($dadosProduto['txtNome']) || !empty($dadosProduto['txtDescricao']) || !empty($dadosProduto['txtPreco']) || !empty($dadosProduto['txtDesconto']) ){
            

            if(isset($_POST['cbkDestaque'])) {
                $destaque = 1;
            } else {
                $destaque = 0;
            }

            //validação para garantir que o id seja valido
            if(!empty($id) && $id != 0 && is_numeric($id)) {

                //validação para identificar se será enviado uma nova foto
                if($file['fleFoto']['name'] != null) {

                    //import da função de upload
                    require_once('modulo/upload.php');
                    
                    //chama a função de upload para enviar para o servidor
                    $novaFoto = uploadFile($file['fleFoto']);
            
                } else {
                    //permanece a mesma foto no banco
                    $novaFoto = $foto;
                    $statusUpload = true;
                }

                //Criação do array de dados que será encaminhado a model para inserir no BD, é importante criar este array conforme as necessidades de manipulação do BD 
                //OBS: criar as chave do array conforme os nomes dos atributos do BD
                $arrayDados = array (
                    "id"       => $id,
                    "nome"     => $dadosProduto['txtNome'],
                    "descricao" => $dadosProduto['txtDescricao'],
                    "preco"  => $dadosProduto['txtPreco'],
                    "desconto"    => $dadosProduto['txtDesconto'],
                    "destaque"      => $destaque,
                    "foto"     => $novaFoto
                ); 

                //Require do arquivo da model que faz a conexão direta com o BD
                require_once('model/bd/produto.php');
                //Função que recebe o array e passa ele pro BD
                if (updateProduto($arrayDados)) {
                    //validação para verificar se será necessario apagar a foto antiga
                    if($statusUpload) {
                        //apaga a foto antiga do servidor
                        unlink(DIRETORIO_FILE_UPLOAD.$foto);
                    }
                    
                    return true;
                }else
                    return array ('idErro' => 1, 
                                  'message' => 'Não foi posivel atualizar os dados no Banco de Dados');
            } else
                return array ('idErro'  => 4,
                              'message' => 'Não é possivel editar um registro sem um ID válido ');

        } else
            return array ('idErro'  => 2,
                          'message' => 'Existem campos obrigatórios que não foram preenchidos');
    }
}






?>