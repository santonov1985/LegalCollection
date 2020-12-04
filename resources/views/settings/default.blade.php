@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Базовые настройки по Нотариусу</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('table-notary-index') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>

            @foreach($defaultSettings as $defaultSetting)

                <form action="{{route('settings-store',['id' => $defaultSetting->id])}}" method="post">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Нотартальные расходы:</label>
                            <input type="number" min="0" name="notary_cost" class="form-control" value="{{ $defaultSetting->notary_cost}}" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Изменить</button>
                            <a href="{{ route('table-notary-index') }}" class="btn btn-light">Отмена</a>
                        </div>
                    </div>

                </form>
            @endforeach
        </div>
    </div>
@endsection
