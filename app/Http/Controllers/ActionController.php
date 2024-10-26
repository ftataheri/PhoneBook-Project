<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function index (Request $request)
    {
        $query = Employee::with(['badges'])->select(sprintf('%s.*', (new Employee)->table));
        $table = Datatables::of($query);

        // Column for View/Edit/Delete buttons
        $table->addColumn('actions', ' ');
        $table->editColumn('actions', function ($row) {
            return view('partials.datatablesActions', compact('row'));
        });
        $table->rawColumns(['actions']);

        return $table->make(true);
    }
}
