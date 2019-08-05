@if(count($snippetList)!=0)

    <h3> VISA routes snippets </h3>
    <table class="table table-bordered table-striped dataTable no-footer">
        <thead>
        <th>#</th>
        <th>Название шаблона</th>
        <th>Название роута</th>
        <th>Сумма min</th>
        <th>Сумма max</th>
        <th>Card System</th>
        <th>Bins</th>
        <th>Приоритет</th>
        <th>final</th>
        <th>Добавлен</th>
        <th>Изменен</th>
        <th>Редактировать</th>
        <th>Удалить</th>
        </thead>
        <tbody>
        @foreach($snippetList as $snippet)
            @if($snippet->cardSystem->id == 1)
                <tr>

                    <td>{{$snippet->id}}</td>
                    <td>{{$snippet->snippetName->name}}</td>


                    <td>{{$snippet->paymentRoute->name}}</td>


                    <td>{{$snippet->sum_min}}</td>


                    <td>{{$snippet->sum_max}}</td>


                    <td>{{$snippet->cardSystem->name}}</td>


                    <td>{{$snippet->bins}}</td>


                    <td>{{$snippet->priority}}</td>


                    <td>@if($snippet->final==1)
                            <span class="label label-success">Final</span>
                        @else <span class="label label-warning">Not Final</span> @endif</td>


                    <td>{{$snippet->created_at}}</td>


                    <td>{{$snippet->updated_at}}</td>

                    <td>
                        <button class="btn btn-default"
                                data-target="#modal-edit-payment-route-snippet"
                                data-toggle="modal"
                                onclick="editSnippetRoute(this)"
                                data-id = "{{$snippet->id}}"
                                data-route-id = "{{$snippet->payment_route_id}}"
                                data-sum-min = "{{$snippet->sum_min}}"
                                data-sum-max = "{{$snippet->sum_max}}"
                                data-card-system = "{{$snippet->card_system}}"
                                data-bins = "{{$snippet->bins}}"
                                data-priority = "{{$snippet->priority}}"
                                data-final = "{{$snippet->final}}"
                                data-snippet-id = "{{$snippet->snippet_id}}"

                        >
                            <i class="fa fa-fw fa-edit"></i>
                        </button>
                    </td>
                    <td>
                        <button class="btn  btn-danger"
                                data-target="#modal-remove-payment-route-snippet" data-toggle="modal"
                                onclick="askRemove({{$snippet->id}} )">
                            <i class="fa fa-fw fa-remove "></i></button>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

    <h3>   MasterCard routes snippets</h3>
    <table class="table table-bordered table-striped dataTable no-footer">
        <thead>
        <th>#</th>
        <th>Название шаблона</th>

        <th>Название роута</th>
        <th>Сумма min</th>
        <th>Сумма max</th>
        <th>Card System</th>
        <th>Bins</th>
        <th>Приоритет</th>
        <th>final</th>
        <th>Добавлен</th>
        <th>Изменен</th>
        <th>Редактировать</th>
        <th>Удалить</th>
        </thead>
        <tbody>
        @foreach($snippetList as $snippet)
            @if($snippet->cardSystem->id == 2)
                <tr>

                    <td>{{$snippet->id}}</td>
                    <td>{{$snippet->snippetName->name}}</td>
                    <td>{{$snippet->paymentRoute->name}}</td>
                    <td>{{$snippet->sum_min}}</td>
                    <td>{{$snippet->sum_max}}</td>
                    <td>{{$snippet->cardSystem->name}}</td>
                    <td>{{$snippet->bins}}</td>
                    <td>{{$snippet->priority}}</td>
                    <td>@if($snippet->final==1)
                            <span class="label label-success">Final</span>
                        @else <span class="label label-warning">Not Final</span> @endif</td>
                    <td>{{$snippet->created_at}}</td>
                    <td>{{$snippet->updated_at}}</td>
                    <td>
                        <button class="btn btn-default"
                                data-target="#modal-edit-payment-route-snippet"
                                data-toggle="modal"
                                onclick="editSnippetRoute(this)"
                                data-id = "{{$snippet->id}}"
                                data-route-id = "{{$snippet->payment_route_id}}"
                                data-sum-min = "{{$snippet->sum_min}}"
                                data-sum-max = "{{$snippet->sum_max}}"
                                data-card-system = "{{$snippet->card_system}}"
                                data-bins = "{{$snippet->bins}}"
                                data-priority = "{{$snippet->priority}}"
                                data-final = "{{$snippet->final}}"
                                data-snippet-id = "{{$snippet->snippet_id}}">
                            <i class="fa fa-fw fa-edit"></i>
                        </button>
                    </td>
                    <td>
                        <button class="btn  btn-danger"
                                data-target="#modal-remove-payment-route-snippet" data-toggle="modal"
                                onclick="askRemove({{$snippet->id}} )">
                            <i class="fa fa-fw fa-remove "></i></button>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

@else
    <h5> Роуты отсутствуют</h5>
@endif