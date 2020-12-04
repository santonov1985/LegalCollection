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
                            class="form-control"
                            placeholder="Номер займа, ИИН, Удостоверение личности, Ф.И.О">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-light">Искать</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="company" class="custom-select" onchange="this.form.submit()">
                        <option value="" hidden>По нотариусу</option>
                        <option value="">Все нотариусы</option>

{{--                        @foreach($companies as $company)--}}
{{--                            @if(request()->company == $company->id)--}}
{{--                                <option value="{{ $company->id }}" selected>{{ $company->name }}</option>--}}
{{--                            @else--}}
{{--                                <option value="{{ $company->id }}">{{ $company->name }}</option>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="custom-select" onchange="this.form.submit()">
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
                    <select name="employee" class="custom-select" onchange="this.form.submit()">
                        <option value="" hidden>По сотруднику</option>
                        <option value="">Все сотрудники</option>

{{--                        @foreach($employees as $employee)--}}
{{--                            @if(request()->employee == $employee->id)--}}
{{--                                <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>--}}
{{--                            @else--}}
{{--                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>
