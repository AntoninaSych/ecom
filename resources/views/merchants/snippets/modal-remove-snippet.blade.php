<div class="modal fade in" id="modal-remove-snippet">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Удалить выбранный шаблон</h4>
            </div>
            <div class="modal-body" id="remove-content" style="text-align: center">
                <p>Вы действительно желаете удалить выбранный шаблон?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>

                    <input type="hidden" value=""  name="snippet_id" id="snippet_id">

                    <button type="button" class="btn btn-primary"
                            onclick="removeSnippetName()"
                            value="Удалить">Удалить</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>