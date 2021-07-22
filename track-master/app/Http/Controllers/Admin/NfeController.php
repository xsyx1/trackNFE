<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\CLient;
use App\Models\Order;
use WebmaniaBR\NFe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NFeController extends Controller
{
    public function __construct()
    {
        $this->webmaniabr = new NFe('M4hDAfNkQijWdn8166O1qSd34QFlbrnO', 
                                    'bAIg88WKWx8o6pesWHS6HTXGCFtxELsmmsgEHtWhIJYGwBma', 
                                    '2011-aL6I0LvKVKrdsuqYXfyfy4QoDSpbCjkYBbH8YZUUUqp7Mk8D', 
                                    'isDDxhlLfDqBaKhxqD2TFVRiq2pjT517bUZZVMmsJEyZuYjZ');
    }
    public function create($id)
    {
        $item = Product::findOrFail($id);
        
        return view('products.sale', compact('item'));
    }
    public function generate(Request $request)
    {
                
        $data = array(
              'ID' => 1137, 
              'operacao' => 1, 
              'natureza_operacao' => 'Venda de produção do estabelecimento', 
              'modelo' => 1, 
              'finalidade' => 1, 
              'ambiente' => 2, 
              'cliente' => array(
                'cpf' => $request->nif, 
                'nome_completo' => $request->name, 
                'endereco' => $request->address, 
                'complemento' => $request->complement, 
                'numero' => $request->number, 
                'bairro' => $request->district, 
                'cidade' => $request->city, 
                'uf' => $request->state, 
                'cep' => $request->zip_code, 
                'telefone' => $request->phone, 
                'email' => $request->email 
              )
            );
        $data['produtos'] = array(
              array(
                'nome' => $request->name, 
                'codigo' => $request->cod,
                'ncm' => $request->ncm, 
                'cest' => $request->cest,
                'quantidade' => $request->amount,
                'unidade' => $request->unit,
                'peso' => $request->weight,
                'origem' => $request->origin,
                'subtotal' => $request->subtotal,
                'total' => $request->total,
                'classe_imposto' => 'REF174527'
              ),
              array(
                'nome' => $request->name, 
                'codigo' => $request->cod,
                'ncm' => $request->ncm, 
                'cest' => $request->cest,
                'quantidade' => $request->amount,
                'unidade' => $request->unit,
                'peso' => $request->weight,
                'origem' => $request->origin,
                'subtotal' => $request->subtotal,
                'total' => $request->total,
                'tributos_federais' => $request->federal_texas,
                'tributos_estaduais' => $request->state_texas, 
                
                'impostos' => array(
                  'icms' => array(
                    'codigo_cfop' => '6.102', // Código Fiscal de Operações e Prestações (CFOP)
                    'situacao_tributaria' => '102', // Código da situação tributária
                  ),
                  'ipi' => array(
                    'situacao_tributaria' => '99', // Código da situação tributária
                    'codigo_enquadramento' => '999', // Código de enquadramento
                    'aliquota' => '0.00', // Alíquota IPI
                  ),
                  'pis' => array(
                    'situacao_tributaria' => '99', // Código da situação tributária
                    'aliquota' => '0.00', // Alíquota PIS
                  ),
                  'cofins' => array(
                    'situacao_tributaria' => '99', // Código da situação tributária
                    'aliquota' => '0.00', // Alíquota COFINS
                  ),
                ),
              )
            );

        $data['pedido'] = array(
          'pagamento' => $request->pay,
          'forma_pagamento' => $request->form_pay,
          'frete' => $request->shipping,
          'desconto' => $request->discount,
          'total' => $request->total,
        );  

        $response = $this->webmaniabr->emissaoNotaFiscal( $data );



            dd($response);

            Client::create(
                [
                    'nif' => $request->nif, 
                    'name' => $request->name, 
                    'address' => $request->address, 
                    'complement' => $request->complement, 
                    'number' => $request->number, 
                    'district' => $request->district, 
                    'city' => $request->city, 
                    'state' => $request->state, 
                    'zip_code' => $request->zip_code, 
                    'phone' => $request->phone, 
                    'email' => $request->email,
                ]
            );
            Product::create(
                [
                    'name' => $request->name, 
                    'cod' => $request->cod,
                    'ncm' => $request->ncm, 
                    'cest' => $request->cest,
                    'amount' => $request->amount,
                    'unit' => $request->unit,
                    'weight' => $request->weight,
                    'origin' => $request->origin,
                    'subtotal' => $request->subtotal,
                    'total' => $request->total,
                    'federal_texas' => $request->federal_texas,
                    'state_texas' => $request->state_texas,
                ]
              );
          Order::create(
                [
                    'pay' => $request->pay,
                    'form_pay' => $request->form_pay,
                    'shipping' => $request->shipping,
                    'discount' => $request->discount,
                    'total' => $request->total,

                ]
              );            

        return redirect()->to($danfe);
    }
}
