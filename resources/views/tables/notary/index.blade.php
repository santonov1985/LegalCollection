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
                @canAtLeast('notary.create')
                <div class="btn-toolbar">
                    <a href="{{route('table-notary-create')}}" class="btn btn-primary mr-3" title="Добавить данные">
                        <i class="fa fa-plus"></i>
                    </a>
                    <a href="{{route('table-notary-import')}}" class="btn btn-primary" title="Загрузить файл">
                        <i class="fa fa-download"></i>
                    </a>
                </div>
                @endCanAtLeast
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-responsive-md text-md-center text-value-sm">
                    <caption>Таблица по Нотариусам</caption>
                    <thead class="table-dark">
                    <tr>
                        <th>№</th>
                        <th>Номер займа</th>
                        <th>ИИН</th>
                        <th>Уд. личности</th>
                        <th>Ф.И.О</th>
                        <th>Мобильный телефон</th>
                        <th>Дата передачи Нотариусу</th>
                        <th>Срок займа</th>
                        <th>Выданная сумма</th>
                        <th>День просрочки</th>
                        <th>Просрочка ОД</th>
                        <th>Просрочка %</th>
                        <th>Просрочка штрафы</th>
                        <th>Сумма по исполнтьельной надаиси</th>
                        <th>Нотариальные расходы</th>
                        <th>Общая сумма с Нотариальными расходами</th>
                        <th width="10%"></th>
                    </tr>
                    </thead>

                    @foreach($notaries_table as $notary_tables)
                    <tbody class="table-light">
                    <tr class="{{ $notary_tables->deleted_at?'bg-gray-200':''}}">
                        <td>{{$notary_tables->id}}</td>
                        <td>{{$notary_tables->number_loan}}</td>
                        <td>
                        @if ($notary_tables->deleted_at)
                            {{ $notary_tables->iin }}
                        @else
                            {{ $notary_tables->iin }}
                        @endif
                        </td>
                        <td>{{$notary_tables->identification}}</td>
                        <td>{{$notary_tables->full_name}}</td>
                        <td>{{$notary_tables->mobile_phone}}</td>
                        <td>{{$notary_tables->transfer_date}}</td>
                        <td>{{$notary_tables->loan_term}}</td>
                        <td>{{$notary_tables->issued_amount}}</td>
                        <td>{{$notary_tables->number_of_day_overdue}}</td>
                        <td>{{$notary_tables->delayed_od}}</td>
                        <td>{{$notary_tables->delayed_prc}}</td>
                        <td>{{$notary_tables->delayed_fines}}</td>
                        <td>{{$notary_tables->total}}</td>
                        <td>{{$notary_tables->notary_cost}}</td>
                        <td>{{$notary_tables->total_with_notary_cost}}</td>
                        <td class="text-right">
                            @if ($notary_tables->deleted_at)

                                @canAtLeast('notary.restore')
                                <a href="{{ route('table-notary-restore', ['id' => $notary_tables->id]) }}" class="btn btn-success btn-sm btn-restore" title="Востановить запись с ИИН-ом {{ $notary_tables->iin }}">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                                @endCanAtLeast
                            @else
                                @canAtLeast('notary.create')
                                <a href="{{ route('table-notary-edit', ['id' => $notary_tables->id]) }}" class="btn btn-dark btn-sm" title="Редактировать запись с ИИН-ом {{ $notary_tables->iin }}">
                                    <i class="fa fa-cog"></i>
                                </a>
                                @endCanAtLeast

                                @canAtLeast('notary.delete')
                                <a href="{{ route('table-notary-delete', ['id' => $notary_tables->id]) }}" class="btn btn-danger btn-sm btn-delete" title="Удалить запись с ИИН-ом {{ $notary_tables->iin }}">
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
