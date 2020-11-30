@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Главная</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="#Будет-доступна-позднее" class="btn btn-primary" title="Добавить">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>



        </div>
    </div>
@endsection
