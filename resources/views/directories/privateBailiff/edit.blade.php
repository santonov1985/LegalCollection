@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Частный судебный исполнитель: {{ $privateBailiff->title }}</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('privateBailiff-index') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <form action="{{ route('privateBailiff-update', ['id' => $privateBailiff->id]) }}" method="post">
                        @csrf

                        <input type="hidden" name="id" value="{{ $privateBailiff->id }}">
                        <div class="form-group">
                            <label>Название:</label>
                            <input type="text" name="title" value="{{ $privateBailiff->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="text" name="email" value="{{ $privateBailiff->email }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Телефон:</label>
                            <input type="text" name="phone" value="{{ $privateBailiff->phone }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Описание:</label>
                            <textarea name="description" class="form-control">{{ $privateBailiff->description }}</textarea>
                        </div>
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-dark">Сохранить</button>
                            <a href="{{ route('privateBailiff-index') }}" class="btn btn-light">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
