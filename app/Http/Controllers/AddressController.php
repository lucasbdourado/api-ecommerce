<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //

    public function index(Request $request)
    {
        return response()->json($request->user()->addresses);
    }

    public function find($id)
    {
        if(!$address = Address::findOrFail($id))
            return response()->json(['error' => 'Endereço não encontrado!']);


        return response()->json($address);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cep' => ['required', 'string', 'min:8', 'max:11'],
            'uf' => ['required', 'string', 'min:2', 'max:2'],
            'cidade' => ['required', 'string', 'min:2', 'max:40'],
            'bairro' => ['required', 'string', 'min:2', 'max:40'],
            'rua' => ['required', 'string', 'min:2', 'max:40'],
            'numero' => ['required', 'string', 'max:5'],
            'complemento' => ['max:40'],
        ]);

        Address::create([
                'user_id' => $request->user()->id,
                'cep' => $request['cep'],
                'uf' => $request['uf'],
                'cidade' => $request['cidade'],
                'bairro' => $request['bairro'],
                'rua' => $request['rua'],
                'numero' => $request['numero'],
                'complemento' => $request['complemento']
        ]);

        return response()->json($request->user()->addresses);
    }

    public function edit($id)
    {
        if(!$address = Address::findOrFail($id))
            return response()->json(['error' => 'Endereço não encontrado!']);


        return response()->json($address);
    }

    public function update($payload, Request $request)
    {
        if(!$address = Address::findOrFail($payload))
           return response()->json(['error' => 'Endereço não encontrado!']);

        $request->validate([
            'cep' => ['required', 'string', 'min:8', 'max:11'],
            'uf' => ['required', 'string', 'min:2', 'max:2'],
            'cidade' => ['required', 'string', 'min:2', 'max:40'],
            'bairro' => ['required', 'string', 'min:2', 'max:40'],
            'rua' => ['required', 'string', 'min:2', 'max:40'],
            'numero' => ['required', 'string', 'max:5'],
            'complemento' => ['max:40'],
        ]);

        $address->update([
            'cep' => $request['cep'],
            'uf' => $request['uf'],
            'cidade' => $request['cidade'],
            'bairro' => $request['bairro'],
            'rua' => $request['rua'],
            'numero' => $request['numero'],
            'complemento' => $request['complemento']
        ]);

        return response()->json($request->user()->addresses);
    }

    public function destroy($id, Request $request)
    {
        if(!$address = Address::findOrFail($id))
            return response()->json(['error' => 'Endereço não encontrado!']);

        $address->destroy($id);

        return response()->json($request->user()->addresses);;
    }
}
