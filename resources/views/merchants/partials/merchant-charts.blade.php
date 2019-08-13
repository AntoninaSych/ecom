<div id="merchant-charts" class="tab-pane  active">
    <div class="content">
        <div class="row">

            <form role="form" id="search-form">
                <div class="row">
                    <div class=" col-md-4">
                        <div style="margin-left: 25px;">
                            <label class="control-label" for="request_period_updated">Дата платежа</label>
                            <div class="input-group input-daterange" style="width: 100%">
                                <input required="" id="request_period_updated" class="form-control valid"
                                       name="request_period_updated" type="text"
                                       aria-invalid="false" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-4">
                        <label class="control-label" for="request_period_updated">&nbsp;</label>
                        <div class="btn btn-default form-control pull-right" onclick="loadCharts()">Загрузить график</div>
                    </div>
                </div>
            </form>

        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$merchant->name}}</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body" >
                <div id="charts">

                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>

