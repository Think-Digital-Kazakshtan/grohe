<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FavoriteController extends Controller
{

    public function add(Request $request)
    {
        if(checkAuth()) {
            customer()->favorites()->attach($request->post('id'));
            notify('Товар успешно добавлен в избранное', button: ['Перейти в избранное', 'favorites.index']);
        } else {
            notify("Необходимо авторизоваться", $status = 'warning', $button = ['Авторизоваться', 'router.visit("login")']);
        }
        
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        if(checkAuth()) {
            customer()->favorites()->detach($request->post('id'));
            notify('Товар успешно удален из избранных');
        } else {
            notify("Необходимо авторизоваться", $status = 'warning', $button = ['Авторизоваться', '/login']);
        }
        
        return redirect()->back();
    }

}
