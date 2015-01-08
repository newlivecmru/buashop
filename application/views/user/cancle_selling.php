<div id="adddata" >
    <fieldset>
        <legend>ค้นหาข้อมูล</legend>
    <table >
        <tr>
            <td class="heightform2" >วันที่ขาย</td>
            <td>
                <input type="text" name="datestart" value="<?php echo date("Y-m-d") ?>" id="datestart" style="width: 100px;"/>
            </td>
            <td class="heightform2" >ถึง</td>
            <td>
                <input type="text" name="dateend" value="<?php echo date("Y-m-d") ?>" id="dateend" style="width: 100px;"/>
            </td>
            <td class="heightform2"  >เลขที่การขาย</td>
            <td>
                <input type="text" name="sellingid" value="" id="sellingid" style="width: 100px;"/>
            </td>

            </td>

            <td class="heightform2" colspan="4" style=" padding-left: 20px;"  >
                <input type="button"  name="btnsearch" id="btnsearch" value="ค้นหา"  /> 

            </td>

        </tr>
    </table>
        </fieldset>
</div>
<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
         <input type="button"  name="cancle"  id="cancle" onclick="dellist();" value="ยกเลิกรายการขาย"  />
        <div id="showdata" style=" padding-top: 10px;">
                 <table border="1" class="hovertable" id="datatable">
                <thead>
                <th width="100">วันที่ขาย</th>
                <th width="120">เลขที่การขาย</th>
                 <th width="120">ลำดับการขาย</th>
                <th width="100">รหัสสินค้า</th>
                <th width="150">ชื่อสินค้า</th>
                 <th width="100">จำนวนคงเหลือ</th>
                   <th width="100">หน่วยนับ</th>
                <th width="100">จำนวนที่ขาย</th>
                <th width="100">ราคา:หน่วย</th>
                <th width="100">ราคารวม</th>
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
            url: "search_cancle_selling",
            type: "POST",
            cache: false,
            dataType: "json",
            data: "datestart=" + $("#datestart").val() + "&dateend=" + $("#dateend").val()
                    + "&selling_id=" + $("#sellingid").val(),
            success: function(res) {
                $(res).each(function(i) {
                    var html = "<tr><td>" + res[i].sell_date + "</td><td>" + res[i].selling_id + "</td><td>" + res[i].line_selling + "</td><td>" + res[i].product_id + "</td><td>" + res[i].product_des + "</td><td>" + res[i].onhand_now + "</td><td>" + res[i].unit + "</td><td>" + res[i].qty + "</td><td>" + res[i].price + "</td><td>" + res[i].total + "</td><td align='center'><input type='checkbox' name='check_cancle' id='check_cancle" + i + "' value=''/></td></tr>";
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
              
                    var idselling = myTable.rows[r].cells[1].innerHTML;
                    var lineid = myTable.rows[r].cells[2].innerHTML;
                    var idproduct = myTable.rows[r].cells[3].innerHTML;
 
                    var txtAmount_sell = myTable.rows[r].cells[7].innerHTML;
                    var txtAmountOnhand = myTable.rows[r].cells[5].innerHTML;


                    var status_selling = 0;

                
                 var totalonhand = parseFloat(txtAmountOnhand) + parseFloat(txtAmount_sell);
                 var checkdata= document.getElementById('check_cancle'+ r).checked;
                  // alert(checkdata);
                 if(checkdata == false){
                    
                  }else{
                     
              

                   $.ajax({
                     url:"cancle_selling_del",
                     type:"POST", 
                    cache:false,
                      dataType:"json",
                  data:"selling_id="+idselling
                          +"&qty="+totalonhand+"&line_selling="+lineid+"&product_id="+idproduct
                          +"&status="+status_selling,
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
            url: "search_cancle_selling",
            type: "POST",
            cache: false,
            dataType: "json",
            data: "datestart=" + $("#datestart").val() + "&dateend=" + $("#dateend").val()
                    + "&selling_id=" + $("#sellingid").val(),
            success: function(res) {
                $(res).each(function(i) {
                    var html = "<tr><td>" + res[i].sell_date + "</td><td>" + res[i].selling_id + "</td><td>" + res[i].line_selling + "</td><td>" + res[i].product_id + "</td><td>" + res[i].product_des + "</td><td>" + res[i].onhand_now + "</td><td>" + res[i].unit + "</td><td>" + res[i].qty + "</td><td>" + res[i].price + "</td><td>" + res[i].total + "</td><td align='center'><input type='checkbox' name='check_cancle' id='check_cancle" + i + "' value=''/></td></tr>";
                    $(html).appendTo("#datatable tbody");
                });

            },
            error: function(err) {
                alert("error");
            }
        });
    
 }
</script>

