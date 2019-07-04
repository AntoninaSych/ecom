<div id="payment-route"  class="tab-pane ">
    <div class="content">
        @if(Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_ROUTE))
        <div class="row">
            <div class="pull-right btn btn-primary" data-toggle="modal" onclick="clearErrors('#route-add-errors')" data-target="#modal-add-payment-route" style="margin-bottom: 15px">
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

