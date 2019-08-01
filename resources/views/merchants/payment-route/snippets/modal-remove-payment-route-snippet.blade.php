<div class="modal fade in" id="modal-remove-payment-route-snippet">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Удалить выбранный код</h4>
            </div>
            <div class="modal-body" id="remove-content" style="text-align: center">
                <p>Вы действительно желаете удалить выбранный аккаунт?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Зыкрыть</button>

                    <input type="hidden" value=""  name="routeSnippetId" id="routeSnippetId">

                    <button type="button" class="btn btn-primary"
                            onclick="removeSnippetRoute()"
                            value="Удалить">Удалить</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>