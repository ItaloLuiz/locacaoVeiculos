<?php

class LocacaoController
{

    public function listar($request, $response, array $args)
    {
        $query = QB::table('tbl_veiculo_locados')
            ->select('*')
            ->where('status_locacao', '=', 'ativo');
        $result = $query->get();
        return json_encode($result);
    }

    public function listarHistorico($request, $response, array $args)
    {
        $query = QB::table('tbl_veiculo_locados')
            ->select('*');
        $result = $query->get();
        return json_encode($result);
    }

    public function locar($request, $response)
    {
        $parsedBody = $request->getParsedBody();

        if (!isset($parsedBody['id_veiculo'])) {
            return json_encode(array('msg' => 'Informe o id do Veiculo'));
            exit;
        }

        if (!isset($parsedBody['nome_cliente'])) {
            return json_encode(array('msg' => 'Informe o nome do cliente'));
            exit;
        }

        if (!isset($parsedBody['email_cliente'])) {
            return json_encode(array('msg' => 'Informe o email do cliente'));
            exit;
        }

        if (!isset($parsedBody['telefone_cliente'])) {
            return json_encode(array('msg' => 'Informe o telefone do cliente'));
            exit;
        }

        $id_veiculo    = $parsedBody['id_veiculo'];
        $nome_cliente  = $parsedBody['nome_cliente'];
        $email_cliente = $parsedBody['email_cliente'];
        $telefone_cliente   = $parsedBody['telefone_cliente'];

        /*FAZER O CADASTRO NO BANCO*/

        $data = array(
            'id_veiculo'    => $id_veiculo,
            'nome_cliente'  => $nome_cliente,
            'email_cliente' => $email_cliente,
            'telefone_cliente' => $telefone_cliente,
            'data_entrega'     => '',
            'status_locacao'   => 'ativo'
        );


        if (!QB::table('tbl_veiculo_locados')->insert($data)) {
            return json_encode(array(
                'status' => 'error',
                'msg' => 'erro ao inserir'
            ));
            exit;
        } else {

            /*Mudar status do veiculo */
            $dataVeiculo = array(
                'status_veiculo' => 'locado'
            );
            QB::table('tbl_veiculos')->where('id_veiculo', $id_veiculo)->update($dataVeiculo);

            return json_encode(array(
                'status' => 'success',
                'msg' => 'Inserido com sucesso'
            ));
            exit;
        }
    }

    public function devolver($request, $response, array $args)
    {


        if (!isset($args['id'])) {
            return json_encode(array('msg' => 'Informe o id do Veiculo'));
            exit;
        }

        $id_veiculo = $args['id'];

        $data = array(
            'data_entrega'    => date('Y-m-d'),
            'status_locacao'  => 'inativo'
        );


        if (!QB::table('tbl_veiculo_locados')->where('id_veiculo', $id_veiculo)->update($data)) {
            return json_encode(array(
                'status' => 'error',
                'msg' => 'erro ao atualizar'
            ));
            exit;
        } else {

            /*mudar status do veiculo*/
            $dataVeiculo = array(
                'status_veiculo' => 'disponivel'
            );
            QB::table('tbl_veiculos')->where('id_veiculo', $id_veiculo)->update($dataVeiculo);


            return json_encode(array(
                'status' => 'success',
                'msg' => 'Atualizado com sucesso'
            ));
            exit;
        }
    }
}
