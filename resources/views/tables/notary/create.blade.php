@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Добавление данных в таблицу Нотариус</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('table-notary-index') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>
            <form action="{{ route('table-notary-store') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Номер займа:</label>
                            <input type="number" min="0" name="number_loan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>ИИН:</label>
                            <input type="number" min="0" name="iin" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Удостоверение личности:</label>
                            <input type="number" min="0" name="identification" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Ф.И.О:</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Домашний телефон:</label>
                            <input type="text" name="home_phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Мобильный телефон:</label>
                            <input type="text" name="mobile_phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Рабочий телефон:</label>
                            <input type="text" name="work_phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Адрес проживания:</label>
                            <input type="text" name="residence_address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Адрес прописки:</label>
                            <input type="text" name="place_of_residence" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Дата выдачи:</label>
                            <input type="date" name="date_of_issue" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Срок займа:</label>
                            <input type="number" min="0" max="20" name="loan_term" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Выданная сумма:</label>
                            <input type="number" min="0" name="issued_amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Просрочка ОД:</label>
                            <input type="number" min="0" step="0.01" name="delayed_od" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Просрочка %:</label>
                            <input type="number" min="0" step="0.01" name="delayed_prc" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Просрочка штрафы:</label>
                            <input type="number" min="0" step="0.01" name="delayed_fines" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Количество дней просрочки:</label>
                            <input type="number" min="1" name="number_of_day_overdue" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Сумма по исполнительной надписи:</label>
                            <input type="number" min="0" step="0.01" name="total" class="form-control" disabled>
                        </div>
                        @foreach($notary_costs as $cost)
                        <div class="form-group">
                            <label>Нотариальные расходы:</label>
                            <input type="number" min="0" step="0.01" name="notary_cost" class="form-control" value="{{$cost->notary_cost}}">
                        </div>
                        @endforeach
                        <div class="form-group">
                            <label>Общая сумма с Нотариальными расходами:</label>
                            <input type="number" min="0" step="0.01" name="total_with_notary_cost" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">

                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Добавить</button>
                    <a href="{{ route('table-notary-index') }}" class="btn btn-light">Отмена</a>
                </div>
            </form>

        </div>
    </div>
@endsection
