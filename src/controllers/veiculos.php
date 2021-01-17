<?php

class VeiculoController
{
    public function insert($request, $response)
    {
        $parsedBody = $request->getParsedBody();

        if (!isset($parsedBody['ano'])) {
            return json_encode(array('msg' => 'Informe o ano do Veiculo'));
            exit;
        }

        if (!isset($parsedBody['marca'])) {
            return json_encode(array('msg' => 'Informe a marca do Veiculo'));
            exit;
        }

        if (!isset($parsedBody['modelo'])) {
            return json_encode(array('msg' => 'Informe o Modelo do Veiculo'));
            exit;
        }

        if (!isset($parsedBody['cor'])) {
            return json_encode(array('msg' => 'Informe a cor do Veiculo'));
            exit;
        }

        $ano_veiculo    = $parsedBody['ano'];
        $marca_veiculo  = $parsedBody['marca'];
        $modelo_veiculo = $parsedBody['modelo'];
        $cor_veiculo    = $parsedBody['cor'];

        /*FAZER O CADASTRO NO BANCO*/

        $data = array(
            'ano_veiculo'    => $ano_veiculo,
            'marca_veiculo'  => $marca_veiculo,
            'modelo_veiculo' => $modelo_veiculo,
            'cor_veiculo'    => $cor_veiculo,
            'status_veiculo' => 'disponivel'
        );


        if (!QB::table('tbl_veiculos')->insert($data)) {
            return json_encode(array(
                'status' => 'error',
                'msg' => 'erro ao inserir'
            ));
            exit;
        } else {
            return json_encode(array(
                'status' => 'success',
                'msg' => 'Inserido com sucesso'
            ));
            exit;
        }
    }


    public function listar($request, $response, array $args)
    {
        $query = QB::table('tbl_veiculos')->select('*');
        $result = $query->get();
        return json_encode($result);
    }

    public function listarDisponiveis($request, $response, array $args)
    {
        $query = QB::table('tbl_veiculos')
            ->select('*')
            ->where('status_veiculo', '<>', 'locado');
        $result = $query->get();
        return json_encode($result);
    }

    public function listarLocados($request, $response, array $args)
    {
        $query = QB::table('tbl_veiculos')
            ->select('*')
            ->where('status_veiculo', '=', 'locado');
        $result = $query->get();
        return json_encode($result);
    }

    public function listarPorId($request, $response, array $args)
    {
        $id_veiculo = $args['id'];
        $query = QB::table('tbl_veiculos')
            ->select('*')
            ->where('id_veiculo', '=', $id_veiculo);
        $result = $query->get();
        return json_encode($result);
    }


    public function update($request, $response, array $args)
    {
        $id_veiculo = $args['id'];
        $parsedBody = $request->getParsedBody();



        if (!isset($parsedBody['ano'])) {
            return json_encode(array('msg' => 'Informe o ano do Veiculo'));
            exit;
        }

        if (!isset($parsedBody['marca'])) {
            return json_encode(array('msg' => 'Informe a marca do Veiculo'));
            exit;
        }

        if (!isset($parsedBody['modelo'])) {
            return json_encode(array('msg' => 'Informe o Modelo do Veiculo'));
            exit;
        }

        if (!isset($parsedBody['cor'])) {
            return json_encode(array('msg' => 'Informe a cor do Veiculo'));
            exit;
        }

        $ano_veiculo    = $parsedBody['ano'];
        $marca_veiculo  = $parsedBody['marca'];
        $modelo_veiculo = $parsedBody['modelo'];
        $cor_veiculo    = $parsedBody['cor'];

        /*FAZER O CADASTRO NO BANCO*/

        $data = array(
            'ano_veiculo'    => $ano_veiculo,
            'marca_veiculo'  => $marca_veiculo,
            'modelo_veiculo' => $modelo_veiculo,
            'cor_veiculo'    => $cor_veiculo,
            'status_veiculo' => 'disponivel'
        );


        if (!QB::table('tbl_veiculos')->where('id_veiculo', $id_veiculo)->update($data)) {
            return json_encode(array(
                'status' => 'error',
                'msg' => 'erro ao atualizar'
            ));
            exit;
        } else {
            return json_encode(array(
                'status' => 'success',
                'msg' => 'Atualizado com sucesso'
            ));
            exit;
        }
    }

    public function delete($request, $response, array $args)
    {
        $id_veiculo = $args['id'];
        if (!QB::table('tbl_veiculos')->where('id_veiculo', '=', $id_veiculo)->delete()) {
            return json_encode(array(
                'status' => 'error',
                'msg' => 'erro ao apagar'
            ));
            exit;
        } else {
            return json_encode(array(
                'status' => 'success',
                'msg' => 'Apagado com sucesso'
            ));
            exit;
        }
    }
}
