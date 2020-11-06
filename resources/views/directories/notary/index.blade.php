@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Нотариусы</h4>
                </div>
                <div class="btn-toolbar">

                    @canAtLeast('notary.create')
                    <a href="{{route('notary-create')}}" class="btn btn-primary" title="Добавить">
                        <i class="fa fa-plus"></i>
                    </a>
                    @endCanAtLeast

                </div>
            </div>

            <div class="float-right">
                {{ $notaries->links() }}
            </div>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>№</th>
                        <th>Название</th>
                        <th>E-mail</th>
                        <th>Телефон</th>
                        <th>Описание</th>
                        <th>Дата регистрации</th>
                        <th>Дата удаления</th>
                        <th></th>
                    </tr>

                    @foreach($notaries as $notary)
                        <tr class="{{ $notary->deleted_at?'bg-gray-200':'' }}">
                            <td>{{ $notary->id }}</td>
                            <td>
                                @if ($notary->deleted_at)
                                    {{ $notary->title }}
                                @else
                                    {{ $notary->title }}
                                @endif
                            </td>
                            <td>{{ $notary->email }}</td>
                            <td>{{ $notary->phone }}</td>
                            <td>{{ $notary->description }}</td>
                            <td>{{ $notary->created_at }}</td>
                            <td>{{ $notary->deleted_at }}</td>
                            <td class="text-right">
                                @if ($notary->deleted_at)

                                    @canAtLeast('notary.restore')
                                    <a href="{{ route('notary-restore', ['id' => $notary->id]) }}" class="btn btn-success btn-sm btn-restore" title="Востановить {{ $notary->title }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    @endCanAtLeast
                                @else
                                    @canAtLeast('notary.create')
                                    <a href="{{ route('notary-edit', ['id' => $notary->id]) }}" class="btn btn-light btn-sm" title="Редактировать {{ $notary->title }}">
                                        <i class="fa fa-cog"></i>
                                    </a>
                                    @endCanAtLeast

                                    @canAtLeast('notary.delete')
                                    <a href="{{ route('notary-delete', ['id' => $notary->id]) }}" class="btn btn-danger btn-sm btn-delete" title="Удалить {{ $notary->title }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endCanAtLeast
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="float-right">
                {{ $notaries->links() }}
            </div>

        </div>
    </div>
@endsection
