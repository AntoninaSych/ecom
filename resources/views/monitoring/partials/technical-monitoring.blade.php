<div id="technical-monitoring" class="tab-pane">
    <div class="content">
        <div class="row">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Technical monitoring</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body">
                    <div>
                        <div class="col-md-6">
                            <label class="control-label" for="period"> Выберите период:</label>
                            <div class="" style="width: 100%">
                                <input required="" id="period" class="form-control valid"
                                       name="period" type="text"
                                       aria-invalid="false" style="width: 100%;">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label> Выберите типы платежей: </label>
                            <select class="form-control"   style="width: 100%"
                                    multiple="multiple" id="payment-type">
                                @foreach (PaymentTypesHelper::getList()->pluck('name','id') as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>&nbsp;</label>
                            <button class="form-control" onclick="makeTechChart()"> Построить гарфик</button>
                        </div>
                    </div>
                    <div style="margin-bottom: 15px;  min-height:25px">
&nbsp;
                    </div>
                    <div id="technical-chart" style="margin-top: 35px">
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
</div>
