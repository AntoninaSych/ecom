<div id="main-information" class="tab-pane active">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{$merchant->name}}</h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <div class="box-body col-md-6">
            <table class="table">
                <tr>
                    <td>Идентификатор мерчанта</td>
                    <td>{{$merchant->merchant_id}}</td>
                </tr>
                <tr>
                    <td>Имя</td>
                    <td>{{$merchant->name}}</td>
                </tr>
                <tr>
                    <td>URL</td>
                    <td><a href="{{$merchant->url}}">{{$merchant->url}}</a></td>
                </tr>
                <tr>
                    <td>Статус</td>
                    <td>{{$relations['status']->name}}</td>
                </tr>
                <tr>
                    <td>Имя мерчанта</td>
                    <td>
                        {{$relations['user']->username}}<br>

                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        {{$relations['user']->email}}
                    </td>
                </tr>
                <tr>
                    <td>Дата обновления</td>
                    <td>{{$merchant->updated}}</td>
                </tr>
            </table>
        </div>
        <div class="box-footer">
        </div>
    </div>
</div>