<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function index(Request $request)
    {
        return response()->json($request->user()->addresses);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
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
            'postal_code' => ['required', 'string', 'min:8', 'max:11'],
            'state' => ['required', 'string', 'min:2', 'max:2'],
            'city' => ['required', 'string', 'min:2', 'max:40'],
            'neighborhood' => ['required', 'string', 'min:2', 'max:40'],
            'street' => ['required', 'string', 'min:2', 'max:40'],
            'number' => ['required', 'string', 'max:5'],
            'complement' => ['max:40'],
        ]);

        Address::create([
                'user_id' => $request->user()->id,
                'postal_code' => $request['postal_code'],
                'state' => $request['state'],
                'city' => $request['city'],
                'neighborhood' => $request['neighborhood'],
                'street' => $request['street'],
                'number' => $request['number'],
                'complement' => $request['complement']
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
            'postal_code' => ['required', 'string', 'min:8', 'max:11'],
            'state' => ['required', 'string', 'min:2', 'max:2'],
            'city' => ['required', 'string', 'min:2', 'max:40'],
            'neighborhood' => ['required', 'string', 'min:2', 'max:40'],
            'street' => ['required', 'string', 'min:2', 'max:40'],
            'number' => ['required', 'string', 'max:5'],
            'complement' => ['max:40'],
        ]);

        $address->update([
            'postal_code' => $request['postal_code'],
            'state' => $request['state'],
            'city' => $request['city'],
            'neighborhood' => $request['neighborhood'],
            'street' => $request['street'],
            'number' => $request['number'],
            'complement' => $request['complement']
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
