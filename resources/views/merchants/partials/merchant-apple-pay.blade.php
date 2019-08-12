<div id="apple-pay"  class="tab-pane ">
    <div class="content">
        @if(Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_APPLE_PAY))
            <div class="row">
                <div class="pull-right btn btn-primary" data-toggle="modal" onclick="clearErrors('#route-add-errors')"
                     data-target="#modal-add-apple-pay" style="margin-bottom: 15px;    margin-right: 15px;">
                    <i class="fa fa-fw fa-plus"></i> Добавить apple-pay
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
                <div id="merchant-apple-pay">
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>
