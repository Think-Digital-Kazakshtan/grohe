<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function get(Request $request) {
        $sets = Group::active()->withProducts()->firstOrFail()->get();
        return Inertia::render('Sets', compact('sets'));
    }

    public function sets(Request $request, $slug) {
        $sets = Group::active();
        return Inertia::render('Sets', compact('sets'));
    }

}
