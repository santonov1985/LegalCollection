<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\Update;
use Core\Users\UsersRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    protected $repository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->repository = $usersRepository;
    }

    public function index()
    {
        $user = Auth::user();

        return view('account.index', compact('user'));
    }

    public function update(Update $request)
    {
        $filenamePath = null;
        $user = Auth::user();

        if ($request->input('current_password') !== null) {
            if (!Hash::check($request->input('current_password'), $user->getAuthPassword())) {
                return redirect()->back()->withErrors(['Текущий пароль не верный']);
            }
        }

        if ($request->hasFile('avatar')) {
            $filename = $user->id . '_avatar.'.$request->file('avatar')->extension();
            $request->file('avatar')->move(public_path('/upload'), $filename);
            $filenamePath = '/upload/' . $filename;
        }

        try {

            $this->repository->getUpdateAccount(
                $user,
                $request->input('name'),
                $request->input('email'),
                $request->input('password'),
                $filenamePath
            );

            return redirect()->back()->with('message', 'Сохранено!');

        } catch (\Throwable $err) {
            Log::error("Account: edit user error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка сохранения']);
        }



    }

    public function history($id)
    {
        $user = Auth::user();

        return view('users.history', compact('user'));
    }
}
