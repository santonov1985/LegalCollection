<?php

namespace App\Http\Controllers;
use Rap2hpoutre\FastExcel\FastExcel;
use Core\Users\User;

class SettingsController extends Controller
{
    protected $exportFile;

    public function __construct(FastExcel $FastExcel)
    {
        $this->exportFile = $FastExcel;
    }

    public function index()
    {
        $users = User::all();
//        return (new FastExcel($users))->download('file.xlsx');
        return $this->exportFile->download('file.xlsx');
    }
}
