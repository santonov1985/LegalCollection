@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Загрузка файла отдела Аналитики</h4>
                </div>
                <div class="btn-toolbar">
                    <a href="{{ route('table-notary-index') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>
            <form action="{{ route('table-notary-parsing') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Выберите файл</label>
                            <input type="file" class="form-control-file" name="excelFile" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>День просрочки:</label>
                            <input type="number" min="0" step="1" name="dayOfOverdue" class="form-control" value="0" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Нотариус:</label>
                            <select class="form-control" name="notary_id" required>
                                <option value="" hidden>Выберите нотариус</option>
                                @foreach($notaries as $notary)
                                    <option value="{{ $notary->id }}">{{ $notary->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="btn-toolbar">
                    <button  type="submit" class="btn btn-primary" >Сформировать таблицу</button>
                </div>
            </form>
        </div>
    </div>
@endsection
