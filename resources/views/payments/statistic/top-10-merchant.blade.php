<div class="col-lg-3 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-aqua">
        <div class="inner">
            <p>За все время</p>

            <table class="table small-box bg-aqua ">

                @foreach($top10 as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{number_format($merchant->summa, 2, ',', ' ')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>
<div class="col-lg-3 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <p>Сегодня</p>
            <table class="table ">
                @foreach($top10Today as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{number_format($merchant->summa, 2, ',', ' ')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>
<div class="col-lg-3 col-xs-12">
    <div class=" small-box bg-green">
        <div class="inner">
            <p>Текущий месяц</p>
            <table class="table">
                @foreach($top10currentMonth as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{number_format($merchant->summa, 2, ',', ' ')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-lg-3 col-xs-12">
    <div class="small-box bg-red">
        <div class="inner">
            <p>Предыдущий месяц</p>
            <table class="table small-box bg-red">

                @foreach($top10previousMonth as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{number_format($merchant->summa, 2, ',', ' ')}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>