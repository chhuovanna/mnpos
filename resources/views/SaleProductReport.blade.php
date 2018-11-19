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

#saleprodutreportbody td:nth-child(3), #saleprodutreportbody td:nth-child(4) ,#saleprodutreportbody td:nth-child(5){
    background-color: #f4f442;
}

#saleprodutreportbody td:nth-child(6), #saleprodutreportbody td:nth-child(7) ,#saleprodutreportbody td:nth-child(8){
    background-color: #b8f441;
}

#saleprodutreportbody td:nth-child(9){
    background-color: #41f4f1;
}


</style>
<div class="box">
    <div class="box-header">Orderline Report</div>
    <div class="box-body table-responsive no-padding">
        <table  id="saleproductreporttable">
            <!-- <thead> -->
                <tr>
                    <th>PID</th>
                    <th>Product</th>
                    <th bgcolor="#f4f442">Sum Unit</th>
                    <th bgcolor="#f4f442">Sum Pack</th>
                    <th bgcolor="#f4f442">Sum Box</th>
                    <th bgcolor="#b8f441">Avg UP</th>
                    <th bgcolor="#b8f441">Avg PP</th>
                    <th bgcolor="#b8f441">Avg BP</th>
                    <th bgcolor="#41f4f1">Sum STT</th>
                </tr>
            <!-- </thead> -->
            <tbody id="saleprodutreportbody" >
            
            </tbody>
        </table>
    </div>
   
</div>
<script type="text/javascript">
    $(document).ready( function(){
     
        
        var saleid = $("input[name=saleid]").val();
        var created_at_start = $('#created_at_start').val();
        var i;
        var created_at_end = $('#created_at_end').val();
        var subtotal = $("input[placeholder=SubtotalRange");
        //var subtotal_end = $("input[name=subtotalend").val();

        var quantity = $("input[placeholder=Quantity]").val()
        var pid = $("select[name=pid]").val();

        var test = "";
        var searchKey = [];
        var jsonsearchkey;
        
        //alert("saleid="+saleid+"created_at_start"+created_at_start+","+ created_at_end+ "subtotal="+ subtotal_start[0].value+","+ subtotal_start[1].value+"quantity="+quantity+"pid="+pid);
        if (saleid){
            searchKey.push('"saleid":"'+saleid+ '"');
        }

        if (created_at_start && created_at_end){
            searchKey.push('"created_at_start":"'+created_at_start+ '"');
            
            searchKey.push('"created_at_end":"'+ created_at_end + '"');
            
        }

       

        if (subtotal[0].value && subtotal[1].value){
            searchKey.push('"subtotal_start":"'+subtotal[0].value+ '"');
        
            searchKey.push('"subtotal_end":"'+subtotal[1].value+ '"');
        }

        if (quantity){
            searchKey.push('"quantity":"'+quantity+ '"');
        }

        if (pid){
            searchKey.push('"pid":"'+pid+ '"');
        }
        for (i = 0; i<searchKey.length; i++){
            test += searchKey[i] + ',' ;
        }

        test = test.substring(0, test.length-1);
        test = '{' + test + '}';

        jsonsearchkey = JSON.parse(test);

       // alert(test);
     

        $.ajax({
            type:"GET",
            url:"searchsaleproduct",
            data:jsonsearchkey,    // multiple data sent using ajax
            success: function (data) {
                //console.log(data);
                var html="";
                data.forEach(function (saleproduct){
                    html = html + "<tr>"  
                    + "<td>" + saleproduct.PID         + "</td>"
                    + "<td>" + saleproduct.Product     + "</td>"
                    + "<td>" + saleproduct.sumunit     + "</td>"
                    + "<td>" + saleproduct.sumpack     + "</td>"
                    + "<td>" + saleproduct.sumbox      + "</td>"
                    + "<td>" + saleproduct.avgup       + "</td>"
                    + "<td>" + saleproduct.avgpp       + "</td>"
                    + "<td>" + saleproduct.avgbp       + "</td>"
                    + "<td>" + saleproduct.sumstt      + "</td></tr>";
                }); 

                $('#saleprodutreportbody').append(html);   

            },
            error: function(xhr, status, error){
                    //toastr.error(xhr.responseText);

                    alert(xhr.responseText);
                }
            });        



        
       

    });

</script>


