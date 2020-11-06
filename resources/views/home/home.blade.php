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
                    <a href="#" class="btn btn-primary" title="Добавить">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm text-md-center text-value-sm">
                    <caption>Таблица личная</caption>
                    <thead class="table-dark">
                    <tr>
                        <th>№</th>
                        <th>Номер займа</th>
                        <th>ИИН</th>
                        <th>Уд. личности</th>
                        <th>Ф.И.О</th>
                        <th>E-mail</th>
                        <th>Домашний телефон</th>
                        <th>Мобильный телефон</th>
                        <th>Рабочий телефон</th>
                        <th>Адрес проживания</th>
                        <th>Адрес прописки</th>
                        <th>Дата выдачи</th>
                        <th>Выданная сумма</th>
                        <th>Просрочка ОД</th>
                        <th>Просрочка %</th>
                        <th>День просрочки</th>
                        <th>Сумма к взысканию</th>
                        <th>Нотариальные расходы</th>
                        <th>Общая сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>18001</td>
                        <td>9865141053460</td>
                        <td>0569877</td>
                        <td>Иванов Иван Иванович</td>
                        <td>i.ivanov@gmail.com</td>
                        <td>+7 727 000 00 00</td>
                        <td>+7 777 000 00 00</td>
                        <td>+7 727 000 00 00</td>
                        <td>ул. Ленина, 31</td>
                        <td>ул. Ленина, 71</td>
                        <td>26.10.2020</td>
                        <td>200 000</td>
                        <td>5000</td>
                        <td>4000</td>
                        <td>5</td>
                        <td>259 000</td>
                        <td>4000</td>
                        <td>263 000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>18001</td>
                        <td>9865141053460</td>
                        <td>0569877</td>
                        <td>Иванов Иван Иванович</td>
                        <td>i.ivanov@gmail.com</td>
                        <td>+7 727 000 00 00</td>
                        <td>+7 777 000 00 00</td>
                        <td>+7 727 000 00 00</td>
                        <td>ул. Ленина, 31</td>
                        <td>ул. Ленина, 71</td>
                        <td>26.10.2020</td>
                        <td>200 000</td>
                        <td>5000</td>
                        <td>4000</td>
                        <td>5</td>
                        <td>259 000</td>
                        <td>4000</td>
                        <td>263 000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>18001</td>
                        <td>9865141053460</td>
                        <td>0569877</td>
                        <td>Иванов Иван Иванович</td>
                        <td>i.ivanov@gmail.com</td>
                        <td>+7 727 000 00 00</td>
                        <td>+7 777 000 00 00</td>
                        <td>+7 727 000 00 00</td>
                        <td>ул. Ленина, 31</td>
                        <td>ул. Ленина, 71</td>
                        <td>26.10.2020</td>
                        <td>200 000</td>
                        <td>5000</td>
                        <td>4000</td>
                        <td>5</td>
                        <td>259 000</td>
                        <td>4000</td>
                        <td>263 000</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
