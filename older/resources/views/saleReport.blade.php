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

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}


</style>
<div class="box">
    <div class="box-header">Sale Report</div>
    <div class="box-body table-responsive no-padding">
        <table style="width: 800px;" id="salereporttable">
            <thead>
                <tr>
                    <th>Sale Type</th>
                    <th>Sum Total</th>
                    <th>Sum Grand Total</th>
                </tr>
            </thead>
            <tbody id="salereportbody">
            
            </tbody>
        </table>
    </div>
   
</div>
<script type="text/javascript">
    /*$(document).ready( function(){
     
        var tables = document.getElementsByClassName("table table-hover");
        var rows        = tables[0].rows;
        var i;
        var used       = new Array( );
        var gift       = new Array( );
        var expired    = new Array( );
        var lost       = new Array( );
        var returned   = new Array( );
        var ordinary   = new Array( );
        var cells;
        const ISTOTAL     = 0;
        const ISFTOTAL    = 1;
        const ICUSTOMER   = 2;
        const ITOTAL      = 4;
        const IFTOTAL     = 6;


        if (rows.length < 502) {
            used.push(new Decimal(0));
            used.push(new Decimal(0));

            gift.push(new Decimal(0));
            gift.push(new Decimal(0));

            expired.push(new Decimal(0));
            expired.push(new Decimal(0));

            lost.push(new Decimal(0));
            lost.push(new Decimal(0));

            returned.push(new Decimal(0));
            returned.push(new Decimal(0));
            
            ordinary.push(new Decimal(0));
            ordinary.push(new Decimal(0));

            for( i = 1; i < rows.length; i++){
                cells = rows[i].cells;
                            
                switch ( parseInt(cells[ICUSTOMER].innerHTML)  ) {
                    case -1:
                        expired[ISTOTAL]  = expired[ISTOTAL].add( Number(cells[ITOTAL].innerHTML) );
                        expired[ISFTOTAL] = expired[ISFTOTAL].add( Number(cells[IFTOTAL].innerHTML) );
                        break;
                    case -2:
                        lost[ISTOTAL]  = lost[ISTOTAL].add( Number(cells[ITOTAL].innerHTML) );
                        lost[ISFTOTAL] = lost[ISFTOTAL].add( Number(cells[IFTOTAL].innerHTML) );
                        break;
                    case -3:
                        used[ISTOTAL]  = used[ISTOTAL].add( Number(cells[ITOTAL].innerHTML) );
                        used[ISFTOTAL] = used[ISFTOTAL].add( Number(cells[IFTOTAL].innerHTML) );
                        break;
                    case -4:
                        gift[ISTOTAL]  = gift[ISTOTAL].add( Number(cells[ITOTAL].innerHTML) );
                        gift[ISFTOTAL] = gift[ISFTOTAL].add( Number(cells[IFTOTAL].innerHTML) );
                        break;
                    case -5:
                        returned[ISTOTAL]  = returned[ISTOTAL].add( Number(cells[ITOTAL].innerHTML) );
                        returned[ISFTOTAL] = returned[ISFTOTAL].add( Number(cells[IFTOTAL].innerHTML) );
                        break;
                    default:
                        ordinary[ISTOTAL]  = ordinary[ISTOTAL].add( Number(cells[ITOTAL].innerHTML) );
                        ordinary[ISFTOTAL] = ordinary[ISFTOTAL].add( Number(cells[IFTOTAL].innerHTML) );
                        break;
                }
                

            }

            $('#salereportbody').append("<tr><td>Ordinary Sale</td><td>" 
                                        + ordinary[ISTOTAL]  + "</td><td>" 
                                        + ordinary[ISFTOTAL] + "</td></tr>");
            $('#salereportbody').append("<tr><td>Expired</td><td>" 
                                        + expired[ISTOTAL]  + "</td><td>" 
                                        + expired[ISFTOTAL] + "</td></tr>");
            $('#salereportbody').append("<tr><td>Lost</td><td>" 
                                        + lost[ISTOTAL]  + "</td><td>" 
                                        + lost[ISFTOTAL] + "</td></tr>");
            $('#salereportbody').append("<tr><td>Used</td><td>" 
                                        + used[ISTOTAL]  + "</td><td>" 
                                        + used[ISFTOTAL] + "</td></tr>");
            $('#salereportbody').append("<tr><td>Gift</td><td>" 
                                        + gift[ISTOTAL]  + "</td><td>" 
                                        + gift[ISFTOTAL] + "</td></tr>");
            $('#salereportbody').append("<tr><td>Return</td><td>" 
                                        + returned[ISTOTAL]  + "</td><td>" 
                                        + returned[ISFTOTAL] + "</td></tr>");

        }else{
            var divbox = document.getElementsByClassName('box');
            var para = document.createElement("P");
            var t = document.createTextNode("Sale Report is generated from the table above. Once the number of sale is over 500, it cannot generate the correct result.");
            
            para.appendChild(t);                        
            divbox[1].appendChild(para);
        }

    });*/

</script>

<script type="text/javascript">
    $(document).ready( function(){
     
        
        var saleid         = $("input[name=saleid]").val();
        var saledate_start = $('#saledate_start').val();
        var i;
        var saledate_end   = $('#saledate_end').val();
        var discount       = $("[placeholder='Discount%']");
        

        var grandtotalrange = $("[placeholder='Total or GTD(ex: 1 and 100)']").val()
        var cusid = $("select[name=cusid]").val();

        var test = "";
        var searchKey = [];
        var jsonsearchkey;
        
        //alert("saleid="+saleid+"saledate_start"+saledate_start+","+ saledate_end+ ", discount="+ discount[0].value+","+ discount[1].value+", grandtotalrange"+grandtotalrange+", cusid="+cusid);
        if (saleid){
            searchKey.push('"saleid":"'+saleid+ '"');
        }

        if (saledate_start && saledate_end){
            searchKey.push('"saledate_start":"' + saledate_start + '"');
            
            searchKey.push('"saledate_end":"' + saledate_end + '"');
            
        }

       

        if (discount[0].value && discount[1].value){
            searchKey.push('"discount_start":"'+discount[0].value+ '"');
        
            searchKey.push('"discount_end":"'+discount[1].value+ '"');
        }

        if (grandtotalrange){
            searchKey.push('"grandtotalrange":"'+grandtotalrange+ '"');
        }

        if (cusid){
            searchKey.push('"cusid":"'+cusid+ '"');
        }

        for (i = 0; i<searchKey.length; i++){
            test += searchKey[i] + ',' ;
        }

        test = test.substring(0, test.length-1);
        test = '{' + test + '}';

        jsonsearchkey = JSON.parse(test);

        //alert(test);
     

        $.ajax({
            type:"GET",
            url:"searchsale",
            data:jsonsearchkey,    // multiple data sent using ajax
            success: function (data) {
                //console.log(data);
                    
                $('#salereportbody').append("<tr><td>Ordinary Sale</td><td>" 
                                            + data.Ordinary.stotal  + "</td><td>" 
                                            + data.Ordinary.sftotal + "</td></tr>");
                $('#salereportbody').append("<tr><td>Expired</td><td>" 
                                            + data.Expired.stotal  + "</td><td>" 
                                            + data.Expired.sftotal + "</td></tr>");
                $('#salereportbody').append("<tr><td>Lost</td><td>" 
                                            + data.Lost.stotal  + "</td><td>" 
                                            + data.Lost.sftotal + "</td></tr>");
                $('#salereportbody').append("<tr><td>Used</td><td>" 
                                            + data.Used.stotal  + "</td><td>" 
                                            + data.Used.sftotal + "</td></tr>");
                $('#salereportbody').append("<tr><td>Gift</td><td>" 
                                            + data.Gift.stotal  + "</td><td>" 
                                            + data.Gift.sftotal + "</td></tr>");
                $('#salereportbody').append("<tr><td>Return</td><td>" 
                                            + data.Return.stotal  + "</td><td>" 
                                            + data.Return.sftotal + "</td></tr>");

                $('#salereportbody').append("<tr><td></td><td>Estimated Imported Cost</td><td>" 
                                            + data.Expense  + "</td></tr>");
                $('#salereportbody').append("<tr><td></td><td>Estimated Profit</td><td>" 
                                            + data.Profit  + "</td></tr>");
                
            },
            error: function(xhr, status, error){
                    toastr.error(xhr.responseText);

                    alert(xhr.responseText);
                }
            });        



        
       

    });

</script>

