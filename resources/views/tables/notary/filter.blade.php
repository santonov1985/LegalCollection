<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{route('table-notary-search')}}" method="get">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            value="{{ request()->search ?? '' }}"
                            id="search_input"
                            class="form-control"
                            placeholder="Номер займа, ИИН, удостоверение личности, Ф.И.О, день прострочки">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-light" id="search_btn" disabled="disabled">Искать</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <select name="notary" class="custom-select" onchange="this.form.submit()">
                        <option value="" hidden> По нотариусу </option>
                        <option value="" > Все нотариусы </option>
                        @foreach($notaries as $notary)
                            @if(request()->notary == $notary->id)
                                <option value="{{ $notary->id }}" selected>{{ $notary->title }}</option>
                            @else
                                <option value="{{ $notary->id }}">{{ $notary->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="privateBailiff" class="custom-select" onchange="this.form.submit()">
                        <option value="" hidden>По ЧСИ</option>
                        <option value="">Все статусы</option>

{{--                        @foreach($statuses as $status)--}}
{{--                            @if(request()->status == $status->id)--}}
{{--                                <option value="{{ $status->id }}" selected>{{ $status->name }}</option>--}}
{{--                            @else--}}
{{--                                <option value="{{ $status->id }}">{{ $status->name }}</option>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="transfer_date" class="form-control" onchange="this.form.submit()" value="{{ request()->transfer_date ?? '' }}">
                </div>
            </div>
        </form>
    </div>
</div>
