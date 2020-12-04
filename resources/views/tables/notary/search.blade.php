@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')
    @include('tables.notary.filter')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Таблица по Нотариусам</h4>
                </div>
                <div class="btn-toolbar">
                    <a href="{{ route('table-notary-index') }}" class="btn btn-light" title="Назад">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-responsive-md text-md-center text-value-sm">
                    <thead class="table-dark">
                    <tr>
                        <th>№</th>
                        <th>Номер займа</th>
                        <th>ИИН</th>
                        <th>Уд. личности</th>
                        <th>Ф.И.О</th>
                        <th>Мобильный телефон</th>
                        <th>Дата выдачи</th>
                        <th>Срок займа</th>
                        <th>Выданная сумма</th>
                        <th>День просрочки</th>
                        <th>Просрочка ОД</th>
                        <th>Просрочка %</th>
                        <th>Просрочка штрафы</th>
                        <th>Сумма по исполнтьельной надаиси</th>
                        <th>Нотариальные расходы</th>
                        <th>Общая сумма с Нотариальными расходами</th>
                    </tr>
                    </thead>

                    @foreach($notaryTablesSearches as $notaryTablesSearch)
                        <tbody class="table-light">
                        <tr class="{{ $notaryTablesSearch->deleted_at?'bg-gray-200':''}}">
                            <td>{{$notaryTablesSearch->id}}</td>
                            <td>{{$notaryTablesSearch->number_loan}}</td>
                            <td>
                                @if ($notaryTablesSearch->deleted_at)
                                    {{ $notaryTablesSearch->iin }}
                                @else
                                    {{ $notaryTablesSearch->iin }}
                                @endif
                            </td>
                            <td>{{$notaryTablesSearch->identification}}</td>
                            <td>{{$notaryTablesSearch->full_name}}</td>
                            <td>{{$notaryTablesSearch->mobile_phone}}</td>
                            <td>{{$notaryTablesSearch->date_of_issue}}</td>
                            <td>{{$notaryTablesSearch->loan_term}}</td>
                            <td>{{$notaryTablesSearch->issued_amount}}</td>
                            <td>{{$notaryTablesSearch->number_of_day_overdue}}</td>
                            <td>{{$notaryTablesSearch->delayed_od}}</td>
                            <td>{{$notaryTablesSearch->delayed_prc}}</td>
                            <td>{{$notaryTablesSearch->delayed_fines}}</td>
                            <td>{{$notaryTablesSearch->total}}</td>
                            <td>{{$notaryTablesSearch->notary_cost}}</td>
                            <td>{{$notaryTablesSearch->total_with_notary_cost}}</td>
                            <td class="text-right">
                                @if ($notaryTablesSearch->deleted_at)

                                    @canAtLeast('notary.restore')
                                    <a href="{{ route('table-notary-restore', ['id' => $notaryTablesSearch->id]) }}" class="btn btn-success btn-sm btn-restore" title="Востановить запись с ИИН-ом {{ $notaryTablesSearch->iin }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    @endCanAtLeast
                                @else
                                    @canAtLeast('notary.create')
                                    <a href="{{ route('table-notary-edit', ['id' => $notaryTablesSearch->id]) }}" class="btn btn-dark btn-sm" title="Редактировать запись с ИИН-ом {{ $notaryTablesSearch->iin }}">
                                        <i class="fa fa-cog"></i>
                                    </a>
                                    @endCanAtLeast

                                    @canAtLeast('notary.delete')
                                    <a href="{{ route('table-notary-delete', ['id' => $notaryTablesSearch->id]) }}" class="btn btn-danger btn-sm btn-delete" title="Удалить запись с ИИН-ом {{ $notaryTablesSearch->iin }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endCanAtLeast
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
