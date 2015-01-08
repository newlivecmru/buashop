<div id="adddata" >
    
    <fieldset>
        <legend>ค้นหาข้อมูล</legend>
        <table >
            <tr>
                <td class="heightform2" >วันที่สั่งซื้อ</td>
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
                    <input type="hidden" name="date_receive" value="<?php echo date("Y-m-d") ?>" id="date_receive" />
                </td>

            </tr>
        </table>
    </fieldset>
</div>
<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
        <input type="button"  name="addproduct"  id="addproduct" onclick="insertlist();" value="บันทึกการรับสินค้า"  />
        <div id="showdata" style=" padding-top: 10px;">
            <table border="1" class="hovertable" id="datatable">
                <thead>

                <th width="120">เลขที่สั่งซื้อ</th>
                <th width="100">ลำดับสั่งซื้อ</th>
                <th width="100">รหัสสินค้า</th>
                <th width="150">ชื่อสินค้า</th>
                <th width="150">ผู้ขายสินค้า</th>
                <th width="130">จำนวนคงเหลือ</th>
                <th width="100">หน่วยนับ</th>
                <th width="130">จำนวนสั่งซื้อ</th>
                <th width="100">จำนวนค้างรับ</th>
                <th width="100">จำนวนที่รับ</th>

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
            url: "searchreceive",
            type: "POST",
            cache: false,
            dataType: "json",
            data: "datestart=" + $("#datestart").val() + "&dateend=" + $("#dateend").val()
                    + "&purchaseid=" + $("#purchaseid").val(),
            success: function(res) {
                $(res).each(function(i) {
                    var html = "<tr><td>" + res[i].purchase_id + "</td><td>" + res[i].line_purchase + "</td><td>" + res[i].product_id + "</td><td>" + res[i].product_des + "</td><td>" + res[i].supplier_name + "</td><td>" + res[i].onhand_now + "</td><td>" + res[i].unit + "</td><td><input type='text' id='qty" + i + " ' value='" + res[i].qty + "' name='qty' disabled style=' color:red;text-align:center;width:80px' /></td><td><input type='text' id='qty_no_re" + i + "' value='" + res[i].noreceive + "' name='qty_no_re' disabled style=' color:red;text-align:center;width:80px' /></td><td><input type='text' id='qty_re" + i + "' value='0' name='qty_re' style=' color:blue;text-align:center;width:80px' /></td></tr>";
                    $(html).appendTo("#datatable tbody");
                });

            },
            error: function(err) {
                alert("error");
            }
        });
    });


    function insertlist() {



        var myTable = document.getElementById('datatable').tBodies[0];
        for (var r=0, n = myTable.rows.length; r < n; r++) {
               
          //  for (var c = 0, m = myTable.rows[r].cells.length; c < m; c++) {
         // if(myTable.rows[r].cells[c].childNodes[0].value){
              
               var idpurchase = myTable.rows[r].cells[0].innerHTML;
                    var lineid = myTable.rows[r].cells[1].innerHTML;
                    var idproduct = myTable.rows[r].cells[2].innerHTML;
                   
                    var qtynoreceive = document.getElementById('qty_no_re' + r).value;
                    var txtAmountReceive = document.getElementById('qty_re' + r).value;
                    var txtAmountOnhand = myTable.rows[r].cells[5].innerHTML;
                    var unit = myTable.rows[r].cells[6].innerHTML;
              var receivedate = $("#date_receive").val();
            var employee = "<?=$_SESSION["userid"]?>";
 ////             alert(employee);
                    var statuspurchase = "";
                    var totalnoreceive = 0;
                    var totalonhand = 0;
                    if (txtAmountReceive.length < 1) {
                        totalnoreceive = parseFloat(qtynoreceive) - 0;
                    } else {
                        totalnoreceive = parseFloat(qtynoreceive) - parseFloat(txtAmountReceive);
                    }

                    if (txtAmountReceive.length < 1) {
                        totalonhand = parseFloat(txtAmountOnhand) + 0;
                    } else {
                        totalonhand = parseFloat(txtAmountOnhand) + parseFloat(txtAmountReceive);
                    }


                    if (txtAmountReceive == 0 || txtAmountReceive.length < 1) {
                        statuspurchase = 1;
                    } else {
                        if (txtAmountReceive == qtynoreceive) {
                            statuspurchase = 3;
                        } else if (txtAmountReceive < qtynoreceive) {
                            statuspurchase = 2;
                        } else if (txtAmountReceive > qtynoreceive) {
                            statuspurchase = 4;

                        }
                    }

              
                    if(txtAmountReceive != 0 || txtAmountReceive.length > 1){
                        $.ajax({
                        url:"createreceive",
                        type:"POST", 
                        cache:false,
                        dataType:"json",
                        data:"purchase_id="+idpurchase+"&product_id="+idproduct
                            +"&qty="+totalonhand+"&line_purchase="+lineid
                            +"&status="+statuspurchase+"&nonereceive="+totalnoreceive+"&unit="+unit
                            +"&employeeid="+employee+"&receivedate="+receivedate+"&receive_qty="+txtAmountReceive,
                        success:function(){
                        },
                        error :function(err){
                            console.log("error:"+err);
                        }
                    });
                }
           
            //  }
                
      //      }
        }
       alert("บันทึกรายการรับสำเร็จ");
        for (var i = document.getElementById("datatable").rows.length; i > 1; i--) {
                    document.getElementById("datatable").deleteRow(i - 1);
         } 
          $.ajax({
            url: "searchreceive",
            type: "POST",
            cache: false,
            dataType: "json",
            data: "datestart=" + $("#datestart").val() + "&dateend=" + $("#dateend").val()
                    + "&purchaseid=" + $("#purchaseid").val(),
            success: function(res) {
                $(res).each(function(i) {
                    var html = "<tr><td>" + res[i].purchase_id + "</td><td>" + res[i].line_purchase + "</td><td>" + res[i].product_id + "</td><td>" + res[i].product_des + "</td><td>" + res[i].supplier_name + "</td><td>" + res[i].onhand_now + "</td><td>" + res[i].unit + "</td><td><input type='text' id='qty" + i + " ' value='" + res[i].qty + "' name='qty' disabled style=' color:red;text-align:center;width:80px' /></td><td><input type='text' id='qty_no_re" + i + "' value='" + res[i].noreceive + "' name='qty_no_re' disabled style=' color:red;text-align:center;width:80px' /></td><td><input type='text' id='qty_re" + i + "' value='0' name='qty_re' style=' color:blue;text-align:center;width:80px' /></td></tr>";
                    $(html).appendTo("#datatable tbody");
                });

            },
            error: function(err) {
                alert("error");
            }
        });


    }


</script>
