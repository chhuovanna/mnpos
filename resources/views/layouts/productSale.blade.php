<!--view for orderline called by saleController-->

<style type="text/css" scoped="">
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
         margin: 0;
    }

    input[type=number] {
        -moz-appearance:textfield;
    }

    #producttable td:nth-child(5), #producttable td:nth-child(6), #producttable td:nth-child(7){
        background-color: #f4f442;
    }


    #producttable td:nth-child(8), #producttable td:nth-child(9), #producttable td:nth-child(10){
        background-color: #b8f441;
    }

    #producttable td:nth-child(11), #producttable td:nth-child(12){
        background-color: #41f4f1;
    }
</style>
<div class="box" >
    <div class="box-header"> @yield('header')</div>
    @section('search')
            
        @show
</div>
<div class="box">

    <div class="box-body table-responsive no-padding">
        <table class="table table-hover" id="producttable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barcode</th>
                    <th>Name</th>
                    <th>Shortcut</th>
                    <th bgcolor="#f4f442">UP</th>
                    <th bgcolor="#f4f442">PP</th>
                    <th bgcolor="#f4f442">BP</th>
                    <th bgcolor="#b8f441">SU</th>
                    <th bgcolor="#b8f441">SP</th>
                    <th bgcolor="#b8f441">SB</th>
                    <th bgcolor="#41f4f1">UPP</th>
                    <th bgcolor="#41f4f1">UPB</th>
                    <!-- <th>Drug?</th>
                    <th>Category</th>
                    <th>Manuf</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="productbody">
                @section('productbody')
           
                    @show
            </tbody>
        </table>
    </div>
</div>

<div class="box">
   
     
    <form method="post" action="{{ url('/admin/sale/checkout') }}" accept-charset="UTF-8" class="form-horizontal" id="checkoutform">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        <div class="box-header">Order Line</div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover" id="orderline">
                <thead>
                    <tr>
                        <th>PID</th> 
                        <th>Barcode</th>
                        <th>Name</th>
                        <th>U.Q</th>
                        <th>P.Q</th>
                        <th>B.Q</th>
                        <th>Sub Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody id = "orderlinebody">
                </tbody>
            </table>
        </div>

    



        <div class="box-body">
            <div class="fields-group">

                <input type="hidden" name="products" id="products" value="ignore">
                
                <div class="form-group 1">
                    <label for="customer" class="col-sm-2 control-label">Customer</label>
                    <div class="col-sm-1">
                        <div class="input-group">
                            <select class="form-control customer" name="customer" id="customer" style="width:150px">
                                    <option value="0">Select Customer</option>
                                    @section('customers')
                                        @show
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-group 1">
                    <label for="exchangerate" class="col-sm-2 control-label">Exchange Rate</label>
                    <div class="col-sm-1">
                        <div class="input-group">
                            <span class="input-group-addon">៛</span>
                            @section('exchangerate')
                                @show
                        </div>
                    </div>
                </div>
                <div class="form-group 1">
                    <label for="total" class="col-sm-2 control-label">Total</label>
                    <div class="col-sm-4">
                        <div class="input-group" >
                            <span class="input-group-addon">$</span>
                            <input style="width: 120px" type="number"   id="totald" name="totald" value="0" class="form-control totald" placeholder="Total in USD" readonly="readonly" />
                            <span class="input-group-addon">៛</span>
                            <input style="width: 120px" type="number"   id="totalr" name="totalr" value="0" class="form-control totalr" placeholder="Total in Riel" readonly="readonly" />
                        </div>
                    </div>
                </div>

                <div class="form-group 1">
                    <label for="discount" class="col-sm-2 control-label">Discount</label>
                    <div class="col-sm-6">
                         <div class="input-group" >
                            <span class="input-group-addon">%</span>
                            <input style="width: 70px" type='number' step="0.01" min='0' id="discount" name="discount" value="0" class="form-control discount"  />
                            <span class="input-group-addon">$</span>
                            <input style="width: 140px" type="number" min="0" id="discountd" name="discountd" value="0" class="form-control discountd" placeholder="Discount in USD" readonly="readonly" />
                            <span class="input-group-addon">៛</span>
                            <input style="width: 140px" type="number" min="0" id="discountr" name="discountr" value="0" class="form-control discountr" placeholder="Discount in Riel" readonly="readonly" />
                         </div>
                    </div>
                </div>


                <div class="form-group 1">
                    <label for="ftotal" class="col-sm-2 control-label">Amount to Be Paid</label>
                    <div class="col-sm-6">
                         <div class="input-group" >
                            <span class="input-group-addon">$</span>
                            <input style="width: 220px" type="number"   id="ftotald" name="ftotald" value="0" class="form-control ftotald" placeholder="Amount to Be Paid in USD" readonly="readonly" />
                            <span class="input-group-addon">៛</span>
                            <input style="width: 220px" type="number"   id="ftotalr" name="ftotalr" value="0" class="form-control ftotalr" placeholder="Amount to Be Paid in Riel" readonly="readonly" />

                         </div>
                    </div>
                </div>
                <div class="form-group 1">
                    <label for="recieved" class="col-sm-2 control-label">Recieved</label>
                    <div class="col-sm-6">
                         <div class="input-group" >
                            <span class="input-group-addon">$</span>
                            <input style="width: 210px" type="number" step="0.01" id="recievedd" name="recievedd" value="0" class="form-control recievedd" placeholder="Amount Recieved in USD"  />
                            <span class="input-group-addon">៛</span>
                            <input style="width: 210px" type="number" id="recievedr" name="recievedr" value="0" class="form-control recievedr" placeholder="Amount Recieved in Riel"  />
                            <input type="hidden" id="recieveenough" value="">

                         </div>
                    </div>
                </div>



                <div class="form-group 1">
                    <label for="change" class="col-sm-2 control-label">Given Back Change</label>
                    <div class="col-sm-6">
                         <div class="input-group" >

                            <span class="input-group-addon">$</span>
                            <input style="width: 210px" type="number" min="0" id="changed" name="changed" value="0" class="form-control changed" placeholder="Give Back Change in USD" readonly="readonly" />
                            <span class="input-group-addon">៛</span>
                            <input style="width: 210px" type="number" min="0" id="changer" name="changer" value="0" class="form-control changer" placeholder="Give Back Change in Riel" readonly="readonly" />
                         </div>
                    </div>
                </div>
                <div class="form-group 1">
                    <label for="totalchanger" class="col-sm-2 control-label"></label>
                    <div class="col-sm-1">
                         <div class="input-group" >
                            <span class="input-group-addon">៛</span>
                            <input style="width: 240px" type="number" min="0" id="tchanger" name="tchanger" value="" class="form-control tchanger" placeholder="Total Give Back Change in Riel"  readonly="readonly" />

                         </div>
                    </div>
                </div>
                

            </div>
        </div>

        <div class="box-footer">
            <div class="col-sm-8">
                <div class="btn-group pull-right">
                    <input type="button" class="btn btn-info pull-right" id="checkoutsubmit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Submit" value="Checkout">
                </div>
            </div>

        </div>

        
    </form>

    <div id='testerror' >
            <!-- <button onclick="getStock()">click me</button> -->
        </div>


</div>


<script type="text/javascript">
    var temp = false ;
    
    $(document).off('keyup','.quantity');
    $(document).on('keyup','.quantity', function(){
        
        var inputid = $(this).attr('id');
        var pid = inputid.substring(0,inputid.indexOf('q'));
        var totald= new Decimal(0);
        var totalr= new Decimal(0);
        var exchangerate = $('#exchangerate').val();
        var discount = $('#discount').val();
        var discountamount = new Decimal(0);
        var subtotal= new Decimal(0);
        
        var up = new Decimal($('#'+pid+'up').val());
        var pp = new Decimal($('#'+pid+'pp').val());
        var bp = new Decimal($('#'+pid+'bp').val());
        var amount = new Decimal(0);
        

        if (!$('#'+pid+'qu').val() || isNaN($('#'+pid+'qu').val()) ){
            $('#'+pid+'qu').val(0);
        }

        if (!$('#'+pid+'qp').val() || isNaN($('#'+pid+'qp').val()) ){
            $('#'+pid+'qp').val(0);
        }

        if (!$('#'+pid+'qb').val() || isNaN($('#'+pid+'qb').val()) ){
            $('#'+pid+'qb').val(0);
        }
            



        subtotal = subtotal.add(up.mul($('#'+pid+'qu').val()));
        subtotal = subtotal.add(pp.mul($('#'+pid+'qp').val()));
        subtotal = subtotal.add(bp.mul($('#'+pid+'qb').val()));
        

        //$('#testerror').text('subtotal = ' +subtotal);

        $('#'+ pid + 'stt').val(subtotal);

        $( '.stt' ).each(function( ) {
            totald = totald.add( $(this).val());
        });

        $('.totald').val(totald);
        totalr = totald.mul(exchangerate);
        $('.totalr').val(Math.round(totalr));  
        
        discountamount = totald.mul(discount).div(100);
        $('.discountd').val(discountamount);
        $('.discountr').val(Math.round(discountamount*exchangerate));

        $('.ftotald').val(totald.sub(discountamount));
        $('.ftotalr').val(Math.round(totald.sub(discountamount).mul(exchangerate)));
        getChange();

    });


    $(document).off('keyup','#discount');
    $(document).on('keyup','#discount',getDiscount);

    $(document).off('keyup','#recievedd');
    $(document).on('keyup','#recievedd',getChange);

    $(document).off('keyup','#recievedr');
    $(document).on('keyup','#recievedr',getChange);

    $(document).off('change','#customer');
    $(document).on('change','#customer', function(){


        if ( $('#customer').val() < 0 && $('#customer').val() > -5 ){
            $('#discount').val(100);
            $('#discount').keyup();
        }

        if ( $('#customer').val() == -5){
            $('#discount').val(0);
            $('#discount').keyup();   
        }

    });

    
    $(document).off('click', '.removeorderline');
    $(document).on('click', '.removeorderline', function(){

        if ( confirm("Do you really want to remove the orderline?") ){
            var idtr = $(this).data('idtr');
            var products = $('#products').val();

            $('#'+idtr+'qu').val(0);
            $('#'+idtr+'qp').val(0);
            $('#'+idtr+'qb').val(0);
            $('#'+idtr+'qu').keyup();
            $(this).parents("tr").remove();

            products = products.replace(","+idtr, '');

            $('#products').val(products);

        }
    })

    function getDiscount(){
        
        var totald= new Decimal($('#totald').val());
        var exchangerate = $('#exchangerate').val();
        var discount= $('#discount').val();
        var discountamount = new Decimal(totald.mul(discount).div(100));
        var ftotald ;
        
        $('.discountd').val(discountamount);
        $('.discountr').val(Math.round(discountamount.mul(exchangerate)));

        ftotald = new Decimal(totald.sub(discountamount));
        $('.ftotald').val(ftotald);
        $('.ftotalr').val(Math.round(ftotald.mul(exchangerate)));

        getChange();    
    }


    function getChange(){

        var exchangerate = $('#exchangerate').val();
        var recievedd = new Decimal($('#recievedd').val());
        var recievedr = new Decimal($('#recievedr').val());
        var recievedt = new Decimal(recievedd.add(recievedr.div(exchangerate)));

        var ftotald = $('#ftotald').val();
        var change ;
        var changein ;
        var changedec ;

        if ( recievedt.greaterThan(ftotald)){
            change = recievedt.sub(ftotald);
            changein = Math.floor(change);
            changedec = change.sub(changein).mul(exchangerate);

            //$('#testerror').text(' c = '+change +  ' ci = '+changein + ' cd = ' + changedec   );


            $('#changed').val(changein);
            $('#changer').val(Math.round(changedec));
            $('#tchanger').val(Math.round(change.mul(exchangerate)));
            $('#recieveenough').val(1);
        }else{

            if (recievedt.lessThan(ftotald)){
                $('#recieveenough').val(0);
            }else{
                $('#recieveenough').val(1);
            }

            $('#changed').val(0);
            $('#changer').val(0);
            $('#tchanger').val(0);
        }
    }







    function validateForm(){
        var products = $('#products').val().split(',');
        var size     = products.length;
        var i;
        var resStock = true;
        var res;
        
        

        
        for( i = 1; i < size ; i++){
            resStock = resStock && allowOrder(products[i]);
        }

        res = $('#totald').val()!=0 && resStock 
                && ( $('#recieveenough').val() == 1 );

        /*res = $('#totald').val()!=0 && resStock 
                && ( $('#recieveenough').val() == 1 ) && ( $('#customer').val() < 0   
                     ||    ( $('#recievedd').val() != 0  
                        ||  $('#recievedr').val() !=0 )   
                   );*/
        
        // alert(res);

        if (!res){
            alert("Cannot Check out. Can be caused by stock or invalid input.");
        }
    
       
        return res;
    }

    $(document).off('click', '#checkoutsubmit');
    $(document).on('click', '#checkoutsubmit', function(e){

        document.getElementById("checkoutsubmit").disabled = true;
        
        
        $.when( getStock() ).done( function(){
            var res = validateForm();

            if ( res ){
                $('#checkoutform').submit();
            }else{
                document.getElementById("checkoutsubmit").disabled = false;
            }
        });


    
    });


    function getStock(){

        var products = $('#products').val().split(',');
        var i;

        products = products.slice(1, products.length);
        
        
        return $.ajax({
                    type:"GET",
                    url:"getStock",
                    data:{products:products},    // multiple data sent using ajax
                    success: function (data) {
                        var temp = "";
                        for (i = 0 ; i < data.length ; i++){                         
                            $('#'+data[i].pid+'su').val(data[i].su);
                            $('#'+data[i].pid+'sp').val(data[i].sp);
                            $('#'+data[i].pid+'sb').val(data[i].sb);
                            //temp += "  " + data[i].pid +  "su=" + $('#'+data[i].pid+'su').val() +"  "+ data[i].pid + "sp=" + $('#'+data[i].pid+'sp').val() +"  "+ data[i].pid + "sb=" + $('#'+data[i].pid+'sb').val()+"  " ;
                        }

                        //alert(temp);

                        
                        
                    },
                    error: function(data){
                        console.log(data);
                        alert("Can't Checkout because the app can't get the update from stock.");
                       
                    }
            });

       

    }
    
    function allowOrder(pid){


        var stocku  = parseInt($('#'+pid+'su').val());
        var stockp  = parseInt($('#'+pid+'sp').val());
        var stockb  = parseInt($('#'+pid+'sb').val());
        var qu      = parseInt($('#'+pid+'qu').val());
        var qp      = parseInt($('#'+pid+'qp').val());
        var qb      = parseInt($('#'+pid+'qb').val());
        var upp     = parseInt($('#'+pid+'upp').val());
        var upb     = parseInt($('#'+pid+'upb').val());
        var uinstock    = stocku + stockp*upp + stockb*upb;
        var uorder      = qu + qp*upp + qb*upb;  
        var quantity;
        var tounit;
        var pid;



        

        if(uorder <= uinstock){
            //to prevent error if uorder =0
            if(uorder == 0){
                return false;    
            }

            if (qu > stocku){
                quantity = stocku;

                while (quantity < qu){
                    if (stockp <= 0){
                        break;
                    }
                    quantity += upp;
                    stockp --;
                }

                while (quantity < qu){
                    if (stockb <= 0){
                        break;
                    }
                    quantity += upb;
                    stockb --;
                }

                stocku = quantity - qu;
                
            }else{
                stocku -= qu;
            }

            if (qp > stockp){
                
                quantity = stockp*upp + stocku;
                tounit   = qp*upp;
                stockp = 0;


                if (tounit > quantity){
                   
                    while (quantity < tounit){
                        if (stockb <= 0){
                            break;
                        }
                        quantity += upb;
                        stockb --;
                    }
            
                }

                stocku  = quantity - tounit;

            }else{
                stockp -= qp;
            }


            if (qb > stockb){

                tounit = qb*upb;
                quantity = stocku + stockp*upp + stockb*upb;

                stocku = quantity - tounit;
                stockp = 0;
                stockb = 0;


            }else{
                stockb -= qb;
            }

            $('#'+pid+'tstock').val( stocku + "," + stockp + "," + stockb);


            

            

            // only  return  case can have negative quantity

            
            
            if ( ( $('#'+pid+'stt').val() < 0   &&   $('#customer').val() != -5 )  
                || ( $('#customer').val() == -5  &&  $('#'+pid+'stt').val() >= 0 ) ){
               
                return false;
                
            }


            return true;

        }else{
            return false;
        }

    }

    $(document).ready(function() { 
        $('#customer').select2();

    });
   
</script>

