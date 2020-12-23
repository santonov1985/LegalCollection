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
                @canAtLeast('notary_table.create')
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

            <div class="float-right">
                {{ $notariesTable->links() }}
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

                    @foreach($notariesTable as $notaryTable)
                    <tbody class="table-light">
                    <tr class="{{ $notaryTable->deleted_at?'bg-gray-200':''}}">
                        <td>{{ $notaryTable->id }}</td>
                        <td>{{ $notaryTable->number_loan }}</td>
                        <td>
                        @if ($notaryTable->deleted_at)
                            {{ $notaryTable->iin }}
                        @else
                            {{ $notaryTable->iin }}
                        @endif
                        </td>
                        <td>{{ $notaryTable->identification }}</td>
                        <td>{{ $notaryTable->full_name }}</td>
                        <td>{{ $notaryTable->mobile_phone }}</td>
                        <td>{{ $notaryTable->transfer_date }}</td>
                        <td>{{ $notaryTable->loan_term }}</td>
                        <td>{{ $notaryTable->issued_amount }}</td>
                        <td>{{ $notaryTable->number_of_day_overdue }}</td>
                        <td>{{ $notaryTable->delayed_od }}</td>
                        <td>{{ $notaryTable->delayed_prc }}</td>
                        <td>{{ $notaryTable->delayed_fines }}</td>
                        <td>{{ $notaryTable->total }}</td>
                        <td>{{ $notaryTable->notary_cost }}</td>
                        <td>{{ $notaryTable->total_with_notary_cost }}</td>
                        <td class="text-right">
                            @if ($notaryTable->deleted_at)

                                @canAtLeast('notary_table.restore')
                                <a href="{{ route('table-notary-restore', ['id' => $notaryTable->id]) }}" class="btn btn-success btn-sm btn-restore" title="Востановить запись с ИИН-ом {{ $notaryTable->iin }}">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                                @endCanAtLeast
                            @else
                                @canAtLeast('notary_table.create')
                                <a href="{{ route('table-notary-edit', ['id' => $notaryTable->id]) }}" class="btn btn-dark btn-sm" title="Редактировать запись с ИИН-ом {{ $notaryTable->iin }}">
                                    <i class="fa fa-cog"></i>
                                </a>
                                @endCanAtLeast

                                @canAtLeast('notary_table.delete')
                                <a href="{{ route('table-notary-delete', ['id' => $notaryTable->id]) }}" class="btn btn-danger btn-sm btn-delete" title="Удалить запись с ИИН-ом {{ $notaryTable->iin }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endCanAtLeast
                            @endif
                        </td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>
                <div class="float-right">
                    {{ $notariesTable->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
