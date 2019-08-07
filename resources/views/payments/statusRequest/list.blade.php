@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>История операций</h1>
@stop


@section('content')


    <div id="listOfRequests">
    @if(isset($statusRequest))
        <table class="table table-striped dataTable">
            <th>id</th>
            <th>Ссылка</th>
            <th>Со статуса</th>
            <th>На статус</th>
            <th>Комментарий при создании  </th>
            <th>Создал</th>
            <th>Проверил</th>
            <th>Комментарий при обработке</th>
            <th>Дата</th>
            <th>Статус обработки заявки</th>
            <tbody>
            @foreach($statusRequest as $item)
                <tr>
                    <td> {{$item->id}}</td>
                    <td> {{$item->payment_id}} <a href="/payments/view?id={{$item->payment_id}}">Детали платежа</a></td>
                    <td> {{$item->statusPrev->name}}</td>
                    <td> {{$item->statusNext->name}}</td>
                    <td> {{$item->comment_request}} </td><td>  <b> {{$item->userRequest->name}}</b></td>
                    <td>
                        @if(isset($item->userResponse->name))
                            <b>  {{$item->userResponse->name}} </b>
                        @endif
                    </td>
                    <td>

                        @if(isset($item->userResponse->name))
                            {{$item->comment_response}}
                        @endif
                    </td>
                    <td>
                        {{$item->created_at}}
                    </td>
                    <td>
                        @switch($item->is_applied)
                            @case(1)

                            <span class="label label-success">Подтвержден</span>
                            @break
                            @case(2)

                            <span class="label label-danger">  Отклонен</span>

                            @break
                            @case(3)
                            <span class="label label-warning"> Отменен при создании новой заявки</span>

                            @break
                            @case(0)
                            <span class="label label-info">Новая заявка ожидает обработки<</span>

                            @break
                        @endswitch
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
        {{ $statusRequest->links() }}

</div>
    @stop

