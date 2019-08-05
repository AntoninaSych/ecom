<div class="modal fade in" id="modal-add-payment-route-from-snippet" @if ($errors->any())style="display: block" @endif>
    <div class="modal-dialog"  style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Выбрать роуты из шаблонов</h4>
            </div>
            <div class="modal-body" style="text-align: center">
                <div id="snippet-list">

                </div>
                <div style="margin-top: 15px">
                    <input type="button" value="Применить выбранные роуты" class="form-control btn btn-primary"
                           onclick="addMerchantPaymentRouteFromSnippet()">
                </div>
            </div>
        </div>
    </div>
</div>
