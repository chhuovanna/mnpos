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

</style>
<div class="box" >
    <div class="box-header">Search Product</div>
    <div class="pull-right">
        <div class="form-inline pull-right">
      
            <fieldset>

                <div class="input-group input-group-sm">
                    <span class="input-group-addon">
                        <strong>Search Key</strong>
                    </span>
                    <input type="text" style="width: 70px" class="form-control" placeholder="Search Key" id="searchKey" value="">
                </div>

                <div class="btn-group btn-group-sm">
                    <a href="javascript:void(0);" class="btn btn-warning" id="searchproduct"><i class="fa fa-search"></i></a>
                </div>

             </fieldset>
         
        </div>
    </div>

    <span>
        <a class="btn btn-sm btn-primary grid-refresh" id="refresh"><i class="fa fa-refresh"></i> Refresh</a>
    </span>

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
                    <th>Drug?</th>
                    <th>Category</th>
                    <th>Manuf</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="productbody">
            @foreach($products as $product)
                <tr>
                    <td>
                        {{ $product->pid }}
                    </td>
                    <td>
                        {{ $product->barcode }}
                    </td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        {{ $product->shortcut }}
                    </td>
                    <td>
                        {{ $product->up }}
                    </td>
                    <td>
                        {{ $product->pp }}
                    </td>
                    <td>
                        {{ $product->bp }}
                    </td>
                    <td>
                        {{ $product->su }}
                    </td>
                    <td>
                        {{ $product->sp }}
                    </td>
                    <td>
                        {{ $product->sb }}
                    </td>
                    <td>
                        {{ $product->upp }}
                    </td>
                    <td>
                        {{ $product->upb }}
                    </td>
                    <td>
                        @if ($product->isdrugs === 1)
                            YES
                        @else
                            NO
                        @endif

                    </td>
                    <td>
                        {{ $product->catname}}
                    </td>
                    <td>
                        {{ $product->mname}}
                    </td>
                    <td>
                        <a href="javascript:void(0);" data-pid="{{  $product->pid   }}"  data-barcode="{{   $product->barcode   }}" data-name="{{   $product->name  }}" data-up="{{ $product->up    }}" data-pp="{{ $product->pp    }}" data-bp="{{ $product->bp    }}" data-su="{{ $product->su    }}" data-sp="{{ $product->sp    }}" data-sb="   {{  $product->sb    }}" data-upp="{{    $product->upp   }}" data-upb="{{    $product->upb   }}" class="grid-row-add-sale"><i class="fa fa-cart-plus" ></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="box">
   <!--  <form action="http://localhost:8000/admin/sale/checkout/" method="post" accept-charset="UTF-8" class="form-horizontal"  onsubmit="return validateForm()" pjax-container> -->
     
 
    <form method="post" action="{{ url('/admin/sale/checkout') }}" accept-charset="UTF-8" class="form-horizontal" onsubmit="return validateForm()">

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
                                @foreach($customers as $customer)
                                    <option value="{{  $customer->cusid  }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-group 1">
                    <label for="exchangerate" class="col-sm-2 control-label">Exchange Rate</label>
                    <div class="col-sm-1">
                        <div class="input-group">
                            <span class="input-group-addon">៛</span>
                            <input style="width: 70px" type="number" min="0" id="exchangerate" name="exchangerate" value="{{$exchangerate}}" class="form-control amount" readonly="readonly" />
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
                    <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Submit">Submit</button>
                </div>
            </div>

        </div>

        <div id='testerror'>
        </div>

    </form>

    <!-- <button onclick="allowOrder()">test</button> -->



</div>



<!-- <script src="{{ asset('js/decimal.js') }}"></script> -->

<script type="text/javascript">

    $('#searchproduct').unbind('click').click(function(){
       
        if ($('#searchKey').val() ){

            $.ajax({
                type:"GET",
                url:"searchproduct",
                data:{searchKey:$('#searchKey').val()},    // multiple data sent using ajax
                success: function (data) {
                    var html="";
                    data.forEach(function (product){
                        html = html + "<tr>"  
                        + "<td>" + product.pid         + "</td>"
                        + "<td>" + product.barcode     + "</td>"
                        + "<td>" + product.name        + "</td>"
                        + "<td>" + product.shortcut    + "</td>"
                        + "<td>" + product.up          + "</td>"
                        + "<td>" + product.pp          + "</td>"
                        + "<td>" + product.bp          + "</td>"
                        + "<td>" + product.su          + "</td>"
                        + "<td>" + product.sp          + "</td>"
                        + "<td>" + product.sb          + "</td>"
                        + "<td>" + product.upp         + "</td>"
                        + "<td>" + product.upb         + "</td>";

                        if (product.isdrugs){
                            html = html + "<td>YES</td>";
                        }else{
                            html = html + "<td>NO</td>";
                        }

                        html = html 
                        + "<td>" + product.catname          + "</td>"
                        + "<td>" + product.mname            + "</td>"
                        + "<td><a href='javascript:void(0);' "
                            + "  data-pid='"    + product.pid
                            + "' data-barcode='"+ product.barcode
                            + "' data-name='"   + product.name
                            + "' data-up='"     + product.up
                            + "' data-pp='"     + product.pp
                            + "' data-bp='"     + product.bp
                            + "' data-su='"     + product.su
                            + "' data-sp='"     + product.sp
                            + "' data-sb='"     + product.sb
                            + "' data-upp='"    + product.upp
                            + "' data-upb='"    + product.upb
                            + "' class='grid-row-add-sale'>"
                            + "<i class='fa fa-cart-plus' ></i></a></td>"
                        + "</tr>";
                    });
                    $("#productbody").html(html);

                },
                error: function(data){
                    console.log(data);
                }
            });        
        }

        
        
    });

    $(document).on('click','#refresh', function(){
        $.ajax({
                type:"GET",
                url:"refreshsearchproduct",
                success: function (data) {
                    var html="";
                    data.forEach(function (product){
                        html = html + "<tr>"  
                        + "<td>" + product.pid         + "</td>"
                        + "<td>" + product.barcode     + "</td>"
                        + "<td>" + product.name        + "</td>"
                        + "<td>" + product.shortcut    + "</td>"
                        + "<td>" + product.up          + "</td>"
                        + "<td>" + product.pp          + "</td>"
                        + "<td>" + product.bp          + "</td>"
                        + "<td>" + product.su          + "</td>"
                        + "<td>" + product.sp          + "</td>"
                        + "<td>" + product.sb          + "</td>"
                        + "<td>" + product.upp         + "</td>"
                        + "<td>" + product.upb         + "</td>";

                        if (product.isdrugs){
                            html = html + "<td>YES</td>";
                        }else{
                            html = html + "<td>NO</td>";
                        }

                        html = html 
                        + "<td>" + product.catname          + "</td>"
                        + "<td>" + product.mname            + "</td>"
                        + "<td><a href='javascript:void(0);' "
                            + "  data-pid='"    + product.pid
                            + "'  data-barcode='"+ product.barcode
                            + "' data-name='"   + product.name
                            + "' data-up='"     + product.up
                            + "' data-pp='"     + product.pp
                            + "' data-bp='"     + product.bp
                            + "' data-su='"     + product.su
                            + "' data-sp='"     + product.sp
                            + "' data-sb='"     + product.sb
                            + "' data-upp='"    + product.upp
                            + "' data-upb='"    + product.upb
                            + "' class='grid-row-add-sale'>"
                            + "<i class='fa fa-cart-plus' ></i></a></td>"
                        + "</tr>";
                    });
                    $("#productbody").html(html);
                    $("#searchKey").val("");

                },
                error: function(data){
                    console.log(data);
                }
            });
    });
        
    $(document).on('click','.grid-row-add-sale',function() {
        var prodatt = ["pid","barcode","name"];
        var i ;
        var pid = $(this).data('pid');
        var row = "<tr id='tr"+pid+"' name='tr"+pid+"' >";
        var products;
       
        if (!$('#tr'+pid).length){ 

            products = $('#products').val() + "," + pid ;
            $('#products').val(products);



            for (i = 0 ;i< 3 ; i++){
                row = row + "<td><input id='"   +   pid+    prodatt[i]
                                +   "' name='"  +   pid+    prodatt[i]  
                    +   "' type='text' value='" +   $(this).data(prodatt[i])
                    +   "' style='width: 150px' readonly= 'readonly'></td>";

            }
            
            row = row + "<td>"
                    +"<input type='hidden' id='" +pid+   "up' name='" +pid+   "up' value='"    +$(this).data('up')+   "'>"
                    +"<input type='hidden' id='" +pid+   "su' name='"   +pid+   "su' value='"    +$(this).data('su')+   "'>"
                    +"<input id='" +pid+   "qu' name='"    +pid+   "qu'     class='quantity' value='0' style='width: 60px' pattern='[-]?[0-9]+' >"
                    +"</td>";
            row = row + "<td>"
                    +"<input type='hidden' id='" +pid+   "pp' name='" +pid+   "pp' value='"   +$(this).data('pp')+   "'>"
                    +"<input type='hidden' id='" +pid+   "sp' name='"   +pid+   "sp' value='"    +$(this).data('sp')+   "'>"
                    +"<input type='hidden' id='" +pid+   "upp' value='"    +$(this).data('upp')+   "'>"
                    +"<input id='" +pid+   "qp' name='"    +pid+   "qp'    class='quantity' value='0' style='width: 60px' pattern='[-]?[0-9]+' >"
                    +"</td>";
            row = row + "<td>"
                    +"<input type='hidden' id='" +pid+   "bp' name='" +pid+   "bp' value='"   +$(this).data('bp')+   "'>"
                    +"<input type='hidden' id='" +pid+   "sb' name='"   +pid+   "sb' value='"    +$(this).data('sb')+   "'>"
                    +"<input type='hidden' id='" +pid+   "upb' value='"    +$(this).data('upb')+   "'>"
                    +"<input id='" +pid+   "qb' name='"    +pid+   "qb'  class='quantity' value='0' style='width: 60px' pattern='[-]?[0-9]+' >"
                    +"</td>";
            row = row + "<td>"
                    +"<input id = '" +pid+   "stt' name='"   +pid+   "stt' type='number'   class='stt'     value='0'  style='width: 100px' readonly= 'readonly'>"
                    +"</td></tr>";

            row = row + "<input type='hidden' id='" +pid+   "tstock' name='" +pid+   "tstock' value=''>";

            
            $("#orderlinebody").append(row);
            
            
            
        }else{
            toastr.error('Product has already been in the list. Please Change the quantity instead');
        }

    });

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



    $(document).on('keyup','#discount',getDiscount);

    $(document).on('keyup','#recievedd',getChange);

    $(document).on('keyup','#recievedr',getChange);

    $(document).on('change','#customer', function(){


        if ( $('#customer').val() < 0 && $('#customer').val() > -5 ){
            $('#discount').val(100);
            $('#discount').keyup();
        }
    });

    
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
        }else{
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
        var temp ;
        var pid;

        for( i = 1; i < size ; i++){
            pid = products[i];
            $.ajax({
                type:"GET",
                url:"getStock",
                data:{pid:pid},    // multiple data sent using ajax
                success: function (data) {
                     
                    $('#'+pid+'su').val(data[0].su);
                    $('#'+pid+'sp').val(data[0].sp);
                    $('#'+pid+'sb').val(data[0].sb);
                    
                    alert($('#'+pid+'su').val()+","+$('#'+pid+'sp').val()+","+$('#'+pid+'sb').val());
                },
                error: function(data){
                    console.log(data);
                   
                }
            });
           
        }


//         alert(temp+ $('#'+pid+'su').val()+","+$('#'+pid+'sp').val()+","+$('#'+pid+'sb').val());

        for( i = 1; i < size ; i++){
            temp = allowOrder(products[i]);
            resStock = resStock && temp;
        }

        res = $('#totald').val()!=0 && resStock 
                && ( $('#customer').val() < 0   
                     ||    ( $('#recievedd').val() != 0  
                        ||  $('#recievedr').val() !=0 )   
                   );
        
		if (!res){
			alert("Cannot Check out. Can be caused by stock or invalid input.");
		}
        return res;
    }



    function getStock(pid){
         $.ajax({
                type:"GET",
                url:"getStock",
                data:{pid:pid},    // multiple data sent using ajax
                success: function (data) {
                    
                    $('#'+pid+'su').val(data[0].su);
                    $('#'+pid+'sp').val(data[0].sp);
                    $('#'+pid+'sb').val(data[0].sb);
                   
                },
                error: function(data){
                    console.log(data);
                   
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

        if(uorder <= uinstock){

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


            // to prevent error when order unit = 0

            if(uorder == 0){
                return false;
            }

            // only  return  case can have negative quantity
            
            if ( $('#'+pid+'stt') < 0   &&   $('#customer').val() != -5 ){
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

