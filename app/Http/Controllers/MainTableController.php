<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class MainTableController extends Controller
{
    public function index() {
        return view('main-table.index');
    }

    public function show() {
        return view('main-table.show-form');
    }
    public function parsing(Request $request) {
//        $excelFile = $request->excelFile;
        $dayOfDelay = $request->dayOfDelay;

        $collectionsDatas = (new FastExcel)->withoutHeaders()->import($request->excelFile);

        foreach ($collectionsDatas as $collectionsData)
        {
            dd($collectionsData[2]);
        }

        return view('main-table.parsing');
    }
}
