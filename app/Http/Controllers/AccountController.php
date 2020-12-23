<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\Update;
use Core\Users\UsersRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'name'              => 'required|string',
            'email'             => 'required|email|unique:users,email,' . Auth::id(),
            'password'          => 'nullable|string|min:1|confirmed',
            'current_password'  => 'nullable|string',
            'avatar'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $filenamePath = null;
        $user = Auth::user();

        if ($request->input('password') !== null) {
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
}
