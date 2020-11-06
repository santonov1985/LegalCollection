@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Разрешения</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('permissions-resource') }}" class="btn btn-primary" title="Добавить группу">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>

            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Группа</th>
                    <th>Дата регистрации</th>
                    <th></th>
                </tr>

                @foreach($permissionsGroups as $group => $permissions)
                    <tr>
                        <th colspan="5">
                            <a href="#!" data-toggle="collapse" data-target="#collapse{{ $group }}">
                                {{ $group }}
                            </a>

                            <a href="{{ route('permissions-create', $group) }}" class="btn btn-light btn-sm float-right" title="Добавить разрешение в группу {{ $group }}">
                                <i class="fa fa-plus"></i>
                            </a>
                        </th>
                    </tr>
                    @foreach($permissions as $key => $permission)
                        <tr class="collapse" id="collapse{{ $permission->resource }}">
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ route('permissions-edit', $permission->id) }}" title="Редактировать {{ $permission->name }}">{{ $permission->name }}</a>
                            </td>
                            <td>{{ $permission->resource }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td class="text-right">
                                <a href="{{ route('permissions-edit', $permission->id) }}" class="btn btn-light btn-sm" title="Редактировать {{ $permission->name }}">
                                    <i class="fa fa-cog"></i>
                                </a>
                                <a href="{{ route('permissions-delete', ['id' => $permission->id]) }}" class="btn btn-light btn-sm btn-delete" title="Удалить {{ $permission->name }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach

            </table>

        </div>
    </div>
@endsection
