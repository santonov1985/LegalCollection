@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Роли</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('role-create') }}" class="btn btn-primary" title="Добавить роль">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>

            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Дата регистрации</th>
                    <th>Дата удаления</th>
                    <th></th>
                </tr>

                @foreach($roles as $role)
                    <tr class="{{ $role->deleted_at?'bg-gray-200':'' }}">
                        <td>{{ $role->id }}</td>
                        <td>
                            @if ($role->deleted_at)
                                {{ $role->name }}
                            @else
                                <a href="{{ route('role-edit', ['id' => $role->id]) }}" title="Редактировать">{{ $role->name }}</a>
                            @endif
                        </td>
                        <td>{{ $role->created_at }}</td>
                        <td>{{ $role->deleted_at }}</td>
                        <td class="text-right">
                            <a href="{{ route('role-edit', ['id' => $role->id]) }}" class="btn btn-light btn-sm" title="Редактировать">
                                <i class="fa fa-cog"></i>
                            </a>

                            @if ($role->deleted_at)
                                <a href="{{ route('role-restore', ['id' => $role->id]) }}" class="btn btn-light btn-sm btn-restore" title="Востановить">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            @else
                                <a href="{{ route('role-delete', ['id' => $role->id]) }}" class="btn btn-light btn-sm btn-delete" title="Удалить">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
@endsection
