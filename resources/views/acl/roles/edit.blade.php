@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Роль: {{ $role->name }}</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('roles') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>

            <form action="{{ route('role-update', ['id' => $role->id]) }}" method="post">
                @csrf

                <input type="hidden" name="id" value="{{ $role->id }}">
                <div class="row">
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label>Название:</label>
                            <input type="text" name="name" value="{{ $role->name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Описание:</label>
                            <textarea type="text" name="description" rows="5" class="form-control">{{ $role->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Сохранить</button>
                            <a href="{{ route('roles') }}" class="btn btn-light">Отмена</a>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            @foreach($permissionsGroups as $group => $permissions)
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{ $group }}:</label>

                                        <select name="permissions[]" class="form-control" size="{{ count($permissions) }}" multiple>
                                            @foreach($permissions as $permission)
                                                @if ($role->can($permission->slug))
                                                    <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                                                @else
                                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
