<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ListItem;

class TodoListController extends Controller
{

    public function index() {
        return view('welcome', ['listItems' => ListItem::where('is_complete', 0)->get()]);
    }

    public function markComplete($id) {

        $listItem = ListItem::find($id);
        \Log::info($listItem);

        $listItem->is_complete = 1;
        $listItem->save();

        return redirect('/');
    }

    public function saveItem (Request $request) {
        \Log::info(json_encode($request->all()));
        $newListItem = new ListItem;
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = 0;
        $newListItem->save();
        return redirect('/');
    }
}
