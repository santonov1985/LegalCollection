<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\Store;
use Core\ACL\Roles\Role;
use Core\Users\User;
use Core\Users\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    protected $repository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->repository = $usersRepository;
    }

    public function index()
    {
        $users = User::withTrashed()->paginate(20);

        $users->setPath(url()->current());

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles  = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(Store $request)
    {
        $roles = Role::query()->whereIn('id', $request->input('role'))->get();

        try {

            $this->repository->getCreate(
                $roles,
                $request->input('name'),
                $request->input('email'),
                $request->input('password')
            );

            return redirect()->route('users')->with('message', 'Добавлено!');

        } catch (\Throwable $err) {
            Log::error("Users: create new user error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withInput()->withErrors(['Ошибка добавления']);
        }
    }

    public function show(int $id)
    {
        $user = User::query()->findOrFail($id);

        return view('users.show', compact('user'));
    }

    public function edit(int $id)
    {
        $user   = User::query()->findOrFail($id);
        $roles  = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'id'                => 'required|numeric',
            'name'              => 'required|string',
            'email'             => 'required|email|unique:users,email,' . $id,
            'password'          => 'nullable|string|min:8|confirmed',
            'current_password'  => 'nullable|string|min:8',
            'role'              => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user  = User::query()->findOrFail($request->input('id'));
        $roles = Role::query()->whereIn('id', $request->input('role'))->get();

        try {

            $this->repository->getUpdate(
                $user,
                $roles,
                $request->input('name'),
                $request->input('email'),
                $request->input('password')
            );

            return redirect()->route('users')->with('message', 'Сохранено!');

        } catch (\Throwable $err) {
            Log::error("User: update user error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка сохранения']);
        }
    }

    public function destroy(int $id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();

        return redirect()->back();
    }

    public function restore(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back();
    }
}
