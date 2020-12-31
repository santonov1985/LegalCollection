@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Загрузка файла с данными по оплате</h4>
                </div>
                <div class="btn-toolbar">
                    <a href="{{ route('table-notary-index') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>

            <form action="{{ route('table-notary-parseCheck', request()->query()) }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Выберите файл</label>
                            <input type="file" class="form-control-file" name="checkFile" >
                        </div>
                    </div>
                </div>
                <div class="btn-toolbar">
                    <button  type="submit" class="btn btn-primary" >Добавить данные</button>
                </div>
            </form>
        </div>
    </div>
@endsection
