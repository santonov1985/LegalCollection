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
            </div>
                <form action="{{route('parsing')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 b-b-1">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Выберите файл</label>
                            <input type="file" class="form-control-file" name="excelFile">
                        </div>
                    </div>

                    <div class="col mt-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <h5 class="card-title mb-0">День просрочки</h5>
                            </div>
                        </div>
                        <select class="custom-select" name="dayOfDelay[]">
                            <option value="1">1</option>
                            <option value="2">5</option>
                            <option value="3">10</option>
                            <option value="3">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="60">60</option>
                            <option value="90">90</option>
                        </select>
                    </div>
                    <div class="col d-flex justify-content-end mt-3">
                        <div class="btn-toolbar">
                            <input  type="submit" class="btn btn-primary" value="Сформировать таблицу">
                        </div>
                    </div>
                </form>
        </div>
    </div>
@endsection
