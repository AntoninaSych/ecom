<div class="modal fade in" id="modal-edit-snippet-name" @if ($errors->any())style="display: block" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Изменить название шаблона</h4>
            </div>
            <div class="modal-body" id="remove-content" style="text-align: center">

                <div class="alert alert-danger" id="route-errors" style="display: none">
                </div>
                <div class="alert alert-danger" id="route-add-errors" style="display: none"></div>

                {!! Form::open(array('url' => route('payment-route.store' ),'method' => 'post','id'=>'payment-type-add')) !!}
                <div>
                    {{ Form::label('name', "Название шаблона" ) }}
                    {{ Form::text("name", null,['class'=>'form-control']) }}
                </div>
                {{ Form::hidden("snippet_id", null ) }}
                <div style="margin-top: 15px">
                    <input type="button" value="Изменить название шаблона" class="form-control btn btn-primary"
                           onclick="updateSnippetName()">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
