@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Аккаунт: {{ $user->name }}</h4>
                </div>
            </div>

            <form action="{{ route('account-update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Имя:</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Текущий пароль:</label>
                            <input type="password" name="current_password" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Новый пароль:</label>
                            <input type="password" name="password" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Подтверждение пароля:</label>
                            <input type="password" name="password_confirmation" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-5">

                    </div>

                    <div class="col-sm-3">
                        <div class="container">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-11 col-md-offset-1">
                                        <img class="img-thumbnail" src="{{ Auth::user()->photo ?? '/img/avatars/user-default.png' }}" alt="user@email.com">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input" id="validatedCustomFile" >
                                            <label class="custom-file-label" for="validatedCustomFile">Выберите файл...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark mr-1">Сохранить</button>
                    <a href="{{route('home')}}" class="btn btn-secondary">Отмена</a>
                </div>

            </form>

        </div>
    </div>
@endsection
