<div id="archive-monitoring" class="tab-pane ">
    <div class="content">
        <div class="row">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Archive monitoring</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body" >
                    <div class="col-md-6">
                        <label class="control-label" for="periodArchive"> Выберите период:</label>
                        <div class="" style="width: 100%">
                            <input required="" id="periodArchive" class="form-control valid"
                                   name="periodArchive" type="text"
                                   aria-invalid="false" style="width: 100%;">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <label>&nbsp;</label>
                        <button class="form-control btn-default" onclick="makeArchiveChart()"> Построить гарфик</button>
                    </div>

                    <div id="archive-chart">
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
</div>
