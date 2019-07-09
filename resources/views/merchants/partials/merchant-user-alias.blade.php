<div id="merchant-user-alias"  class="tab-pane ">
    <div class="content">
        <h3> Cвязь мерчанта и пользователя ConcordPay</h3>

            <div class="row">
                <div class="pull-right btn btn-primary" data-toggle="modal"
                     onclick="addMerchantUserAlias({{$merchant->id}})" data-target="#modal-add-merchant-user-alias" style="margin-bottom: 15px">
                    <i class="fa fa-fw fa-plus"></i> Добавить связь мерчанта и пользователя ConcordPay
                </div>
            </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$merchant->name}}</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body" id="refound-box">
                <div id="merchant-user-alias-table">
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>