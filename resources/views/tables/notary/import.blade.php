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
            <form action="{{route('table-notary-parsing')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12 b-b-1">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Выберите файл</label>
                        <input type="file" class="form-control-file" name="excelFile" required>
                    </div>
                </div>

                <div class="col mt-3">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h5 class="card-title mb-0">День просрочки</h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" min="0" step="1" name="dayOfOverdue" class="form-control" required>
                    </div>
                </div>
                <div class="col d-flex justify-content-end mt-3">
                    <div class="btn-toolbar">
                        <button  type="submit" class="btn btn-primary" >Сформировать таблицу</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
