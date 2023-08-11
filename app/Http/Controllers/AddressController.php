<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    
    public function index()
    {
        customer()->addresses()->get();
        return Inertia::render('Cabinet/Addresses');
    }

    public function add(Request $request)
    {
        Validator::make($request->all(), [
            'city' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'building' => ['required', 'string', 'max:5'],
            'block' => ['nullable', 'string', 'max:4'],
            'apartment' => ['nullable', 'string', 'max:4'],
        ])->validate();

        $inputs = $request->only('customer_id', 'city', 'street', 'building', 'block', 'apartment');
        customer()->addresses()->create($inputs);
        notify('Адрес успешно добавлен');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'city' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'building' => ['required', 'string', 'max:5'],
            'block' => ['nullable', 'string', 'max:4'],
            'apartment' => ['nullable', 'string', 'max:4'],
        ])->validate();

        $inputs = $request->only('city', 'street', 'building', 'block', 'apartment');
        $address = customer()->addresses()->find($id);
        if($address) {
            $address->update($inputs);
            notify('Адрес успешно обновлен');
        } else {
            notify('Такого адреса не существует', $status = 'error');
        }

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $address = customer()->addresses()->find($request->input('id'));
        if($address) {
            $address->delete();
            notify('Адрес успешно удален');
        } else {
            notify('Такого адреса не существует', $status = 'error');
        }
    }

}
