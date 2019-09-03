<div class="modal fade in" id="modal-remove-report" @if ($errors->any())style="display: block" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Добавить новый отчет</h4>
            </div>
            <div class="modal-body" id="remove-content" style="text-align: center">
                Вы действительно желаете удалить выбранный отчет?
                <input type="hidden" value="" id="remove_report_id">
            </div>

            <div class="modal-footer">
                <button  class="btn  button btn-default" onclick="removeReport()">Удалить</button>
            </div>
        </div>
    </div>
</div>

