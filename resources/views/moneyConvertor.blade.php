<style type="text/css" scoped="">
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
         margin: 0;
    }

    input[type=number] {
        -moz-appearance:textfield;
    }

</style>

<div class="box">
    <div class="box-header">Converter</div>
    <div class="box-body">
        <div class="fields-group">
            <div class="form-group 1">
                <label for="currentrate" class="col-sm-3 control-label">Current Exchange Rate</label>
                <div class="col-sm-18">
                    <div class="input-group">
                        <span class="input-group-addon">៛</span>
                        <input style="width: 150px" type="number" min="0" id="exchangerate" name="exchangerate" value="{{$exchangerate}}" class="form-control amount" readonly="readonly" />
                    </div>
                </div>
            </div>
            <div class="form-group 1">
                <label for="currentrate" class="col-sm-3 control-label">Amount in USD</label>
                <div class="col-sm-18">
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input style="width: 150px" type="number" min="0" id="amountd" name="amountd" value="0" class="form-control amountd" />
                    </div>
                </div>
            </div>

            <div class="form-group 1">
                <label for="currentrate" class="col-sm-3 control-label">Amount in Riel</label>
                <div class="col-sm-18">
                    <div class="input-group">
                        <span class="input-group-addon">៛</span>
                        <input style="width: 150px" type="number" min="0" id="amountr" name="amountr" value="0" class="form-control amountr" />
                    </div>
                </div>
            </div>
        </div>
    </div>




   
</div>
<script type="text/javascript">

    $(document).off('keyup','#amountd');
    $(document).on('keyup','#amountd',function(){

      
        if ( $('#amountd').val() ){
            var exchangerate = new Decimal( $('#exchangerate').val() );
            $('#amountr').val( exchangerate.mul( $('#amountd').val() ) );
        }else{
            $('#amountr').val(0);
        }
    });

    $(document).on('keyup','#amountr');
    $(document).on('keyup','#amountr',function(){
        if ( $('#amountr').val() ){
            var amountr = new Decimal( $('#amountr').val() );
            $('#amountd').val( amountr.div( $('#exchangerate').val() ) );
        }else{
            $('#amountd').val(0);
        }
    });

</script>


