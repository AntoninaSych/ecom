                    <div class="col-lg-3 col-xs-6" id='stat-main'>
                        <!-- small box -->
                        <div class="small-box bg-aqua" style="height: 150px" >

                           <div class="inner">
                                <h3 style="font-size: 24px">{{number_format($all, 2, ',', ' ')}} UAH</h3>
                                <p>За все время</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6" >
                        <!-- small box -->
                        <div class="small-box bg-yellow" style="height: 150px" >
                            <div class="inner">
                                <h3 style="font-size: 24px">  {{number_format($todayPayments, 2, ',', ' ')}} UAH</h3>
                                <p>Сегодня</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 style="font-size: 24px">{{number_format($currentMonth, 2, ',', ' ')}} UAH</h3>
                                <p> Текущий месяц</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3 style="font-size: 24px">{{number_format($previousMonth, 2, ',', ' ')}} UAH</h3>
                                <p> Предыдущий месяц</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>