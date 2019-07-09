<div class="col-lg-3 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-aqua">
        <div class="inner">
            <p>За все время</p>
            <table class="table">

                @foreach($allPaymentsByRoutes as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->sc_name}}</td>
                        <td>{{number_format($data->summa, 2, ',', ' ')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="icon">
            <i class="ion ion-stats"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">

            <p>Сегодня</p>
            <table class="table">
                @foreach($todayPaymentsByRoutes as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->sc_name}}</td>
                        <td>{{number_format($data->summa, 2, ',', ' ')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="icon">
            <i class="ion ion-stats"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">

            <p> Текущий месяц</p>
            <table class="table">
                @foreach($currentMonthByRoutes as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->sc_name}}</td>
                        <td>{{number_format($data->summa, 2, ',', ' ')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="icon">
            <i class="ion ion-stats"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-red">
        <div class="inner">
            <p> Предыдущий месяц</p>
            <table class="table">
                @foreach($previousMonthByRoutes as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->sc_name}}</td>
                        <td>{{number_format($data->summa, 2, ',', ' ')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="icon">
            <i class="ion ion-stats"></i>
        </div>
    </div>
</div>
<hr>