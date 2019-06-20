<div id="limits"  class="tab-pane">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{$merchant->name}} Лимиты платежей</h3>
            <div class="box-tools pull-right">
                <div class="row">
                    <div class="pull-right btn btn-primary" data-toggle="modal" data-target="#modal-add-payment-limit"
                         style="margin-bottom: 15px" onclick="clearErrors('#limits-add-errors')">
                        <i class="fa fa-fw fa-plus"></i> Добавить лимит платежей
                    </div>
                </div>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="merchant-payment-limits">
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- box-footer -->
    </div>
</div>