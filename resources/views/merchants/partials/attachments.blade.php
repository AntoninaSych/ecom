<div id="attachments" class="tab-pane ">
    <div class="content">
        <div class="box">
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Название</th>
                    <th>Дата загрузки</th>
                    <th>Посмотреть</th>
                </tr>

                @foreach($attachments as $attachment)
                    <tr>
                        <td>
                            {{$attachment->id}}
                        </td>
                        <td>
                            {{$attachment->base_name}}.{{$attachment->ext}}
                        </td>
                        <td>
                            {{$attachment->created_at}}
                        </td>
                        <td>
                            <a href='https://ecom.local/uploads/{{$merchant->id}}/{{$attachment->attachment}}.{{$attachment->ext}}'  class="btn">
                                <i class="fa fa-fw fa-download"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>

