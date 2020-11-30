@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Предворительный просмотр сформированного файла</h4>
                </div>
                @foreach($arr as $item)
                <h1>{{$item}}</h1>
                @endforeach
            </div>
            <form action="#" method="post" enctype="multipart/form-data">
                @csrf

                <div class="col d-flex justify-content-end mt-3">
                    <div class="btn-toolbar">
                        <input  type="submit" class="btn btn-primary" value="Сформировать таблицу">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
