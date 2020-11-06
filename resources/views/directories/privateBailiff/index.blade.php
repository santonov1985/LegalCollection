@extends('layouts.app')

@section('content')

    @include('alerts.error-alert')
    @include('alerts.message-alert')

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h4 class="card-title mb-0">Частный судебный исполнитель</h4>
                </div>

                <div class="btn-toolbar">
                    @canAtLeast('private_bailiff.create')
                    <a href="{{route('privateBailiff-create')}}" class="btn btn-primary" title="Добавить">
                        <i class="fa fa-plus"></i>
                    </a>
                    @endCanAtLeast
                </div>
            </div>

            <div class="float-right">
                {{ $privateBailiffs->links() }}
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>E-mail</th>
                        <th>Телефон</th>
                        <th>Описание</th>
                        <th>Дата регистрации</th>
                        <th>Дата удаления</th>
                        <th></th>
                    </tr>

                    @foreach($privateBailiffs as $privateBailiff)
                        <tr class="{{ $privateBailiff->deleted_at?'bg-gray-200':'' }}">
                            <td>{{ $privateBailiff->id }}</td>
                            <td>
                                @if ($privateBailiff->deleted_at)
                                    {{ $privateBailiff->title }}
                                @else
                                    {{ $privateBailiff->title }}
                                @endif
                            </td>
                            <td>{{ $privateBailiff->email }}</td>
                            <td>{{ $privateBailiff->phone }}</td>
                            <td>{{ $privateBailiff->description }}</td>
                            <td>{{ $privateBailiff->created_at }}</td>
                            <td>{{ $privateBailiff->deleted_at }}</td>
                            <td class="text-right">

                                @if ($privateBailiff->deleted_at)
                                    @canAtLeast('private_bailiff.restore')
                                    <a href="{{ route('privateBailiff-restore', ['id' => $privateBailiff->id]) }}" class="btn btn-success btn-sm btn-restore" title="Востановить {{ $privateBailiff->title }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    @endCanAtLeast
                                @else
                                    @canAtLeast('private_bailiff.create')
                                    <a href="{{ route('privateBailiff-edit', ['id' => $privateBailiff->id]) }}" class="btn btn-light btn-sm" title="Редактировать {{ $privateBailiff->title }}">
                                        <i class="fa fa-cog"></i>
                                    </a>
                                    @endCanAtLeast

                                    @canAtLeast('private_bailiff.delete')
                                    <a href="{{ route('privateBailiff-delete', ['id' => $privateBailiff->id]) }}" class="btn btn-danger btn-sm btn-delete" title="Удалить {{ $privateBailiff->title }}">
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
                {{ $privateBailiffs->links() }}
            </div>

        </div>
    </div>
@endsection
