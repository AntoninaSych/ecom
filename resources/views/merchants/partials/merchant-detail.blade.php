<div id="main-information" class="tab-pane active">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Имя мерчанта: {{$merchant->name}}</h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        @if(isset($merchantInfo))



            <div class="box-body col-md-6">
                <table class="table">
                    @foreach( $merchantInfo->toArray() as $key => $value )
                        @if(!is_null($value))
                            <tr>
                                <td> {{ OrderFieldHelper::getLabel($key)}}</td>
                                <td>{{$value}}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>

        @endif
        <div class=" col-md-6">

            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="/images/shop-icon.png"  >

                    <h3 class="profile-username text-center">{{$merchant->name}}</h3>

                    <p class="text-muted text-center">{{$relations['status']->name}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Идентификатор мерчанта</b> <span class="pull-right">{{$merchant->merchant_id}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Имя мерчанта</b> <span class="pull-right">{{$merchant->name}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>URL</b> <a href="{{$merchant->url}}" class="pull-right">{{$merchant->url}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Статус</b> <span   class="pull-right">{{$relations['status']->name}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Создал (имя пользователя в dispatcher)</b> <span   class="pull-right">  {{$relations['user']->username}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <span   class="pull-right">  {{$relations['user']->email}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Дата обновления</b> <span   class="pull-right">  {{$merchant->updated}}</span>
                        </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                </div>
                <!-- /.box-body -->
            </div>


        </div>

        <div class="box-footer">
        </div>
    </div>





</div>