@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Редактирование данных в таблице Нотариус</h4>
                </div>

                <div class="btn-toolbar">
                    <a href="{{ route('table-notary-index') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>

            <form action="{{ route('table-notary-update', ['id' => $notaries_table->id]) }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Номер займа:</label>
                            <input type="number" min="0" name="number_loan" class="form-control" value="{{ $notaries_table->number_loan }}" required>
                        </div>
                        <div class="form-group">
                            <label>ИИН:</label>
                            <input type="number" min="0" name="iin" class="form-control" value="{{ $notaries_table->iin }}" required>
                        </div>
                        <div class="form-group">
                            <label>Удостоверение личности:</label>
                            <input type="number" min="0" name="identification" class="form-control" value="{{ $notaries_table->identification }}" required>
                        </div>
                        <div class="form-group">
                            <label>Ф.И.О:</label>
                            <input type="text" name="full_name" class="form-control" value="{{ $notaries_table->full_name }}" required>
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" name="email" class="form-control" value="{{ $notaries_table->email }}">
                        </div>
                        <div class="form-group">
                            <label>Домашний телефон:</label>
                            <input type="number" name="home_phone" class="form-control" value="{{ $notaries_table->home_phone }}">
                        </div>
                        <div class="form-group">
                            <label>Мобильный телефон:</label>
                            <input type="number" min="11" name="mobile_phone" class="form-control" value="{{ $notaries_table->mobile_phone }}" required>
                        </div>
                        <div class="form-group">
                            <label>Нотариус:</label>
                            <select class="form-control" name="notary_id">
                                @foreach($notaries as $notary)
                                    @if ($notary->id === $notaries_table->notary_id)
                                        <option value="{{ $notary->id }}" selected>{{ $notary->title }}</option>
                                    @else
                                        <option value="{{ $notary->id }}">{{ $notary->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Рабочий телефон:</label>
                            <input type="number" name="work_phone" class="form-control" value="{{ $notaries_table->work_phone }}">
                        </div>
                        <div class="form-group">
                            <label>Адрес проживания:</label>
                            <input type="text" name="residence_address" class="form-control" value="{{ $notaries_table->residence_address }}">
                        </div>
                        <div class="form-group">
                            <label>Адрес прописки:</label>
                            <input type="text" name="place_of_residence" class="form-control" value="{{ $notaries_table->place_of_residence }}">
                        </div>
                        <div class="form-group">
                            <label>Дата выдачи:</label>
                            <input type="date" name="date_of_issue" class="form-control" value="{{ $notaries_table->date_of_issue }}" required>
                        </div>
                        <div class="form-group">
                            <label>Срок займа:</label>
                            <input type="number" min="0" max="20" name="loan_term" class="form-control" value="{{ $notaries_table->loan_term }}" required>
                        </div>
                        <div class="form-group">
                            <label>Выданная сумма:</label>
                            <input type="number" min="0" name="issued_amount" class="form-control" value="{{ $notaries_table->issued_amount }}" required>
                        </div>
                        <div class="form-group">
                            <label>Просрочка ОД:</label>
                            <input type="number" min="0" step="0.01" name="delayed_od" class="form-control" value="{{ $notaries_table->delayed_od }}" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Просрочка %:</label>
                            <input type="number" min="0" step="0.01" name="delayed_prc" class="form-control" value="{{ $notaries_table->delayed_prc }}" required>
                        </div>
                        <div class="form-group">
                            <label>Просрочка штрафы:</label>
                            <input type="number" min="0" step="0.01" name="delayed_fines" class="form-control" value="{{ $notaries_table->delayed_fines }}" required>
                        </div>
                        <div class="form-group">
                            <label>Количество дней просрочки:</label>
                            <input type="number" min="1"  name="number_of_day_overdue" class="form-control" value="{{ $notaries_table->number_of_day_overdue }}" required>
                        </div>
                        <div class="form-group">
                            <label>Сумма по исполнительной надписи:</label>
                            <input type="number" step="0.01" min="0" name="total" class="form-control" value="{{ $notaries_table->total }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Нотариальные расходы:</label>
                            <input type="number" min="0" step="0.01" name="notary_cost" class="form-control" value="{{ $notaries_table->notary_cost }}">
                        </div>
                        <div class="form-group">
                            <label>Общая сумма с Нотариальными расходами:</label>
                            <input type="number" step="0.01" min="0" name="total_with_notary_cost" class="form-control" value="{{ $notaries_table->total_with_notary_cost }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Дата передачи Нотариусу:</label>
                            <input type="date" name="transfer_date" class="form-control" value="{{ $notaries_table->transfer_date }}">
                        </div>
                    </div>
                    <div class="col-sm-4">

                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Изменить</button>
                    <a href="{{ route('table-notary-index') }}" class="btn btn-light">Отмена</a>
                </div>
            </form>

        </div>
    </div>
@endsection
