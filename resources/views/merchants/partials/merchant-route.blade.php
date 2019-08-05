<div id="payment-route"  class="tab-pane active">
    <div class="content">
        @if(Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_ROUTE))
        <div class="row">
            <div class="pull-left btn btn-default" data-toggle="modal"
                 data-target="#modal-add-payment-route-from-snippet"
                 style="margin-bottom: 15px;    margin-left: 15px;" onclick="loadRouteSnippets({{$merchant->id}})">
                <i class="fa fa-fw fa-plus"></i>   Выбрать роуты из шаблонов
            </div>

            <div class="pull-right btn btn-primary" data-toggle="modal" onclick="clearErrors('#route-add-errors')"
                 data-target="#modal-add-payment-route" style="margin-bottom: 15px;    margin-right: 15px;">
                <i class="fa fa-fw fa-plus"></i> Добавить роут
            </div>
        </div>
        @endif
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$merchant->name}}</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body" id="refound-box">
                <div id="merchant-payment-route">
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>

