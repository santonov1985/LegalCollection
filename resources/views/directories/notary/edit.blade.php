@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Нотариус: {{ $notaries->title }}</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('notary-index') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <form action="{{ route('notary-update', ['id' => $notaries->id]) }}" method="post">
                        @csrf

                        <input type="hidden" name="id" value="{{ $notaries->id }}">
                        <div class="form-group">
                            <label>Название:</label>
                            <input type="text" name="title" value="{{ $notaries->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="text" name="email" value="{{ $notaries->email }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Телефон:</label>
                            <input type="number" min="11" name="phone" value="{{ $notaries->phone }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Описание:</label>
                            <textarea name="description" class="form-control">{{ $notaries->description }}</textarea>
                        </div>
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-dark">Сохранить</button>
                            <a href="{{ route('notary-index') }}" class="btn btn-light">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
