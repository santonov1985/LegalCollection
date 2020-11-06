@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Новый пользователь</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('users') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>

            <form action="{{ route('user-store') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Имя:</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Пароль:</label>
                            <input type="password" name="password" value="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Подтверждение пароля:</label>
                            <input type="password" name="password_confirmation" value="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Роль:</label>
                            <select name="role[]" size="{{ $roles->count() }}" class="form-control" multiple required>
                                <option value="" hidden>Выберите роль</option>

                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">

                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Добавить</button>
                    <a href="{{ route('users') }}" class="btn btn-light">Отмена</a>
                </div>
            </form>

        </div>
    </div>
@endsection
