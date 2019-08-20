<div class="modal fade in" id="modal-remove-apple-pay">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Удаление apple pay</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">
                <div class="alert alert-danger" id="route-edit-errors" style="display: none"></div>


                {!! Form::open(array('url' => route('apple-pay.remove',['id'=>$merchantId]),'method' => 'post',
                'id'=>'merchant-alias-remove')) !!}

                <p>Вы действительно желаете удалить?</p>
                <div>
                    {{Form::hidden('id', null)}}
                </div>



                <div style="margin-top: 15px">
                    <input type="button" value="Удалить" class="form-control btn btn-primary"
                           onclick="removeApplePay()">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
