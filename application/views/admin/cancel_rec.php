<div id="adddata" >
    <fieldset>
        <legend>ค้นหาข้อมูล</legend>
    <table >
        <tr>
            <td class="heightform2" >วันที่รับ</td>
             <td>
                    <input type="text" name="datestart" value="<?php echo date("Y-m-d") ?>" id="datestart" style="width: 100px;"/>
                </td>
                <td class="heightform2" >ถึง</td>
                <td>
                    <input type="text" name="dateend" value="<?php echo date("Y-m-d") ?>" id="dateend" style="width: 100px;"/>
                </td>
                <td class="heightform2"  >เลขที่สั่งซื้อ</td>
                <td>
                    <input type="text" name="purchaseid" value="" id="purchaseid" style="width: 100px;"/>
                </td>

                </td>

                <td class="heightform2" colspan="4" style=" padding-left: 20px;"  >
                    <input type="button"  name="btnsearch" value="ค้นหา" id="btnsearch" /> 
          
                </td>

            </td>

        </tr>
    </table>
        </fieldset>
</div>
<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
   <input type="button"  name="cancle"  id="cancle" onclick="dellist();" value="ยกเลิกการรับสินค้า"  />
        <div id="showdata" style=" padding-top: 10px;">
               <table border="1" class="hovertable" id="datatable">
                <thead>
            <th width="120">วันที่รับสินค้า</th>
                 <th width="120">เลขที่สั่งซื้อ</th>
                <th width="100">ลำดับสั่งซื้อ</th>
                <th width="100">รหัสสินค้า</th>
                <th width="150">ชื่อสินค้า</th>
                <th width="130">จำนวนคงเหลือ</th>
                <th width="100">หน่วยนับ</th>
                <th width="130">จำนวนรับ</th>
                <th width="100">จำนวนค้างรับ</th>
                <th width="100">ยกเลิก</th>
     
                </thead>
                <tbody>
                  
                </tbody>
            </table>
        </div>
        <br/>

    </fieldset>
</div>

<script>
    $(function() {
        $("#datestart").datepicker({dateFormat: 'yy-mm-dd'});
        $("#dateend").datepicker({dateFormat: 'yy-mm-dd'});
    });
    
     var i = $("#datatable tbody tr").length;
    $("#btnsearch").on('click', function() {
        for (var i = document.getElementById("datatable").rows.length; i > 1; i--) {
                    document.getElementById("datatable").deleteRow(i - 1);
         } 
        $.ajax({
            url: "search_cancle_receive",
            type: "POST",
            cache: false,
            dataType: "json",
            data: "datestart=" + $("#datestart").val() + "&dateend=" + $("#dateend").val()
                    + "&purchaseid=" + $("#purchaseid").val(),
            success: function(res) {
                $(res).each(function(i) {
                    var html = "<tr><td>" + res[i].receive_date + "</td><td>" + res[i].purchase_id + "</td><td>" + res[i].line_purchase + "</td><td>" + res[i].product_id + "</td><td>" + res[i].product_des + "</td><td>" + res[i].onhand_now + "</td><td>" + res[i].unit + "</td><td>" + res[i].qty_recieve + "</td><td>" + res[i].none_receive + "</td><td align='center'><input type='checkbox' name='check_cancle' id='check_cancle" + i + "' value=''/></td></tr>";
                    $(html).appendTo("#datatable tbody");
                });

            },
            error: function(err) {
                alert("error");
            }
        });
    });
    
     function dellist() {



        var myTable = document.getElementById('datatable').tBodies[0];
        for (var r=0, n = myTable.rows.length; r < n; r++) {
               
//     for (var c = 0, m = myTable.rows[r].cells.length; c < m; c++) {
//        if(myTable.rows[r].cells[c].childNodes[0].value){
              
                    var idpurchase = myTable.rows[r].cells[1].innerHTML;
                    var lineid = myTable.rows[r].cells[2].innerHTML;
                    var idproduct = myTable.rows[r].cells[3].innerHTML;
 
                    var qtynoreceive =myTable.rows[r].cells[8].innerHTML;
                    var txtAmountReceive = myTable.rows[r].cells[7].innerHTML;
                    var txtAmountOnhand = myTable.rows[r].cells[5].innerHTML;


                    var statuspurchase = 1;

                 var  totalnoreceive = parseFloat(qtynoreceive) + parseFloat(txtAmountReceive);
                 var totalonhand = parseFloat(txtAmountOnhand) - parseFloat(txtAmountReceive);
                 var checkdata= document.getElementById('check_cancle'+ r).checked;
                  // alert(checkdata);
                 if(checkdata == false){
                    
                  }else{
                     
              

                   $.ajax({
                     url:"canclereceive",
                     type:"POST", 
                    cache:false,
                      dataType:"json",
                  data:"purchase_id="+idpurchase
                          +"&qty="+totalonhand+"&line_purchase="+lineid+"&product_id="+idproduct
                          +"&status="+statuspurchase+"&nonereceive="+totalnoreceive,
                   success:function(){
                    },
                 error :function(err){
                        console.log("error:"+err);
                     }
                });
                 
       }
   }
     for (var i = document.getElementById("datatable").rows.length; i > 1; i--) {
      document.getElementById("datatable").deleteRow(i - 1);
         } 
        $.ajax({
            url: "search_cancle_receive",
            type: "POST",
            cache: false,
            dataType: "json",
            data: "datestart=" + $("#datestart").val() + "&dateend=" + $("#dateend").val()
                    + "&purchaseid=" + $("#purchaseid").val(),
            success: function(res) {
                $(res).each(function(i) {
                    var html = "<tr><td>" + res[i].receive_date + "</td><td>" + res[i].purchase_id + "</td><td>" + res[i].line_purchase + "</td><td>" + res[i].product_id + "</td><td>" + res[i].product_des + "</td><td>" + res[i].onhand_now + "</td><td>" + res[i].unit + "</td><td>" + res[i].qty_recieve + "</td><td>" + res[i].none_receive + "</td><td align='center'><input type='checkbox' name='check_cancle' id='check_cancle" + i + "' value=''/></td></tr>";
                    $(html).appendTo("#datatable tbody");
                });

            },
            error: function(err) {
                alert("error");
            }
        });
    
 }

</script>
