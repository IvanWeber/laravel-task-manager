<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ListItem;
use App\models\ListUser;

class TodoListController extends Controller
{

    public function index() {
        //return view('welcome', ['listItems' => ListItem::where('is_complete', 0)->get()]);
        return view('welcome', ['listItems' => ListItem::get(), 'listUsers' => ListUser::get()]);
        //return view('welcome', ['listUsers' => ListUser::get()]);
    }


    public function changeTask($id, Request $request) {

        $listItem = ListItem::find($id);
        \Log::info($listItem);

        // $listItem->is_complete = 1;
        $listItem->name_executor = $request->nameExec;
        $listItem->status = $request->taskStatus;
        $listItem->save();

        return redirect('/');
    }



    public function markComplete($id) {

        $listItem = ListItem::find($id);
        \Log::info($listItem);

        $listItem->status = 1;
        $listItem->save();

        return redirect('/');
    }

    public function markUncomplete($id) {

        $listItem = ListItem::find($id);
        \Log::info($listItem);

        $listItem->status = 0;
        $listItem->save();

        return redirect('/');
    }

    public function removeTask($id) {

        $listItem = ListItem::find($id);
        \Log::info($listItem);

        $listItem->delete();

        return redirect('/');
    }

    public function saveItem (Request $request) {
        \Log::info(json_encode($request->all()));

        $request->validate ([
            "taskTitle" => "required",
            "taskDesc" => "required",
            "nameExec" => "required",
            "deadline" => "required",
        ]);


        $newListItem = new ListItem;
        $newListItem->title = $request->taskTitle;
        $newListItem->description = $request->taskDesc;
        $newListItem->name_executor = $request->nameExec;
        $newListItem->deadline = $request->deadline;
        $newListItem->status = "Добавлена";
        $newListItem->save();
        return redirect('/');
    }
}
