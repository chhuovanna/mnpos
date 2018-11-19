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


table.table-hover td:nth-child(5), table.table-hover td:nth-child(6), table.table-hover td:nth-child(7){
    background-color: #ffff99;
}

table.table-hover td:nth-child(8), table.table-hover td:nth-child(9), table.table-hover td:nth-child(10){
    background-color: #ccffcc;
}
table.table-hover td:nth-child(11){
    background-color: #66ffcc;
}

table.table-hover td:nth-child(12), table.table-hover td:nth-child(13), table.table-hover td:nth-child(14){
    background-color: #ffff99;
}

tbody.saleprodutreportbody td:nth-child(6), tbody.saleprodutreportbody  td:nth-child(7), tbody.saleprodutreportbody  td:nth-child(8){
    background-color: #ccffcc;
}

tbody.saleprodutreportbody td:nth-child(3), tbody.saleprodutreportbody td:nth-child(4),tbody.saleprodutreportbody td:nth-child(5){
    background-color:#ffff99;
}


tbody.saleprodutreportbody td:nth-child(9){
    background-color: #66ffcc;
}
tbody.saleprodutreportbody td:nth-child(10), tbody.saleprodutreportbody td:nth-child(12), tbody.saleprodutreportbody td:nth-child(11){
    background-color: #ffff99;
}
</style>
<div class="box">
    <div class="box-header">Inventory Report</div>
    <div class="box-body table-responsive no-padding">
        <table  id="saleproductreporttable">
           <!--  <thead> -->
                <tr>
                    <th>PID</th>
                    <th>Product</th>
                    <th bgcolor="#ffff99">Sum Unit</th>
                    <th bgcolor="#ffff99">Sum Pack</th>
                    <th bgcolor="#ffff99">Sum Box</th>
                    <th bgcolor="#ccffcc">Avg UP</th>
                    <th bgcolor="#ccffcc">Avg PP</th>
                    <th bgcolor="#ccffcc">Avg BP</th>
                    <th bgcolor="#66ffcc">Sum Total</th>
                    <th bgcolor="#ffff99">Sum SU</th>
                    <th bgcolor="#ffff99">Sum SP</th>
                    <th bgcolor="#ffff99">Sum SB</th>
                    <th>Finish</th>
                </tr>
            <!-- </thead> -->
            <tbody id="saleprodutreportbody" class="saleprodutreportbody">
            
            </tbody>
        </table>
    </div>
   
</div>
<script type="text/javascript">
    $(document).ready( function(){
     
        var impid = $("select[name=impid]").val();
        var invid = $("input[name=invid]").val();
        var finish = $("select[name=finish]").val();
        var importdate_start = $('#importdate_start').val();
        var importdate_end = $('#importdate_end').val();
        var pid = $("select[name=pid]").val();
        var i;
        var test = "";
        var searchKey = [];
        var jsonsearchkey;
        
        //alert("saleid="+saleid+"created_at_start"+created_at_start+","+ created_at_end+ "subtotal="+ subtotal_start[0].value+","+ subtotal_start[1].value+"quantity="+quantity+"pid="+pid);
     

        if (importdate_start && importdate_end){
            searchKey.push('"importdate_start":"'+importdate_start+ '"');
            
            searchKey.push('"importdate_end":"'+ importdate_end + '"');
            
        }

        if (invid){
            searchKey.push('"invid":"'+invid+ '"');
        }        

        if (finish){
            searchKey.push('"finish":"'+finish+ '"');
        }

        if (pid){
            searchKey.push('"pid":"'+pid+ '"');
        }

        if (impid){
            searchKey.push('"impid":"'+impid+ '"');
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
            url:"searchinventory",
            data:jsonsearchkey,    // multiple data sent using ajax
            success: function (data) {
                //console.log(data);
                var html="";
                data.forEach(function (inventory){
                    html = html + "<tr>"  
                    + "<td>" + inventory.PID         + "</td>"
                    + "<td>" + inventory.Product     + "</td>"
                    + "<td>" + inventory.sumunit     + "</td>"
                    + "<td>" + inventory.sumpack     + "</td>"
                    + "<td>" + inventory.sumbox      + "</td>"
                    + "<td>" + inventory.avgup       + "</td>"
                    + "<td>" + inventory.avgpp       + "</td>"
                    + "<td>" + inventory.avgbp       + "</td>"
                    + "<td>" + inventory.sumstt      + "</td>"
                    + "<td>" + inventory.sumsu       + "</td>"
                    + "<td>" + inventory.sumsp       + "</td>"
                    + "<td>" + inventory.sumsb       + "</td>";
                    if (inventory.finish){
                        html +=  "<td>YES</td>";
                    }else{
                        html += "<td>NO</td>";
                    }
                    
                    html += "</tr>";
                }); 


                $('#saleprodutreportbody').append(html);   

            },
            error: function(xhr, status, error){
                    toastr.error(xhr.responseText);
                    console.log(xhr.responseText);

                    //alert(xhr.responseText);
                }
            });        



        
       

    });

</script>


