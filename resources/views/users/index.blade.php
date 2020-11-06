@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Пользователи</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('user-create') }}" class="btn btn-primary" title="Добавить">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>

            <div class="float-right">
                {{ $users->links() }}
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Статус</th>
                        <th>Дата регистрации</th>
                        <th>Дата удаления</th>
                        <th></th>
                    </tr>

                    @foreach($users as $key => $user)
                        <tr class="{{ $user->deleted_at?'bg-gray-200':'' }}">
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if ($user->deleted_at)
                                    {{ $user->name }}
                                @else
                                    <a href="{{ route('user-edit', ['id' => $user->id]) }}" title="Редактировать {{ $user->name }}">{{ $user->name }}</a>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="btn btn-dark btn-sm text-white">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($user->userIsOnline())
                                    <span class="btn btn-success btn-sm text-white" title="Пользователь online">
                                        Online
                                    </span>
                                @else
                                    <span class="btn btn-danger btn-sm text-white" title="Пользователь offline">
                                        Offline
                                    </span>
                                @endif
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->deleted_at }}</td>
                            <td class="text-right">
                                @if ($user->deleted_at)
                                    <a href="{{ route('user-restore', ['id' => $user->id]) }}" class="btn btn-success btn-sm btn-restore" title="Востановить {{ $user->name }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                @else
                                    @if(!$user->hasRole('super_admin'))
                                        <a href="{{ route('user-edit', ['id' => $user->id]) }}" class="btn btn-light btn-sm" title="Редактировать {{ $user->name }}">
                                            <i class="fa fa-cog"></i>
                                        </a>
                                        <a href="{{ route('user-delete', ['id' => $user->id]) }}" class="btn btn-danger btn-sm btn-delete" title="Удалить {{ $user->name }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>

            <div class="float-right">
                {{ $users->links() }}
            </div>

        </div>
    </div>
@endsection
