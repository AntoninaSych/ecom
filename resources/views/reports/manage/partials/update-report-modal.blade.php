<div class="modal fade in" id="modal-update-report" @if ($errors->any())style="display: block" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Изменить отчет</h4>
            </div>
            <div class="modal-body" id="remove-content" style="text-align: center">

                <div class="alert alert-danger" id="route-errors" style="display: none">
                </div>
                <div class="alert alert-danger" id="route-add-errors" style="display: none"></div>

                 <div>

                    {{ Form::hidden("id",  null ) }}
                </div>
                <div>
                    {{ Form::label('name ', "Название отчета" ) }}
                    {{ Form::text("name",  null,['class'=>'form-control']) }}
                </div>
                <div>
                    {!! Form::label("query", "Введите SQL запрос" )   !!}
                    {!! Form::textarea('query', null, ['class'=>'form-control']) !!}
                </div>
                <div style="margin-top: 15px">
                    <input type="button" value="Изменить отчет" class="form-control btn btn-primary"
                           onclick="updateReport()">
                </div>
             </div>
        </div>
    </div>
</div>
