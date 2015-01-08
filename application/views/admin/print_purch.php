<div id="adddata" >
    <fieldset>
        <legend>ค้นหาข้อมูล</legend>
    <table >
        <tr>
            <td class="heightform2" >วันที่สั่งซื้อ</td>
            <td>
                <input type="text" name="datestart" value="<?php echo date("Y-m-d") ?>" id="datestart" style="width: 100px;" />
            </td>
            <td class="heightform2" >ถึง</td>
            <td>
                <input type="text" name="dateend" value="<?php echo date("Y-m-d") ?>" id="dateend" style="width: 100px;" />
            </td>
            <td class="heightform2"  >เลขที่สั่งซื้อ</td>
            <td>
                <input type="text" name="purchaseid" value="" id="purchaseid" style="width: 100px;"/>
            </td>

            </td>

            <td class="heightform2" colspan="4" style=" padding-left: 20px;"  >
                <input type="button"  name="btnsearch" value="ค้นหา"  id="btnsearch" /> 

            </td>

        </tr>
    </table>
        </fieldset>
</div>
<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
      
        <div id="showdata" style=" padding-top: 10px;">
               <table border="1" class="hovertable" id="datatable">
                <thead>
     
                <th width="120">เลขที่สั่งซื้อ</th>
                <th width="100">วันที่สั่งซื้อ</th>
                <th width="150">จำนวนรายการสั่งซื้อ</th>
                <th width="100">ราคารวม</th>
                <th width="100"></th>

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
            url: "search_print_pur",
            type: "POST",
            cache: false,
            dataType: "json",
            data: "datestart=" + $("#datestart").val() + "&dateend=" + $("#dateend").val()
                    + "&purchaseid=" + $("#purchaseid").val(),
            success: function(res) {
               

                $(res).each(function(i) {
                    var html = "<tr><td>" + res[i].purchase_id + "</td><td>" + res[i].purchase_date + "</td><td>" + res[i].purchase_id_qty + "</td><td>" + res[i].total + "</td><td align='center'><input type='button' id='printid' name='printid' value='print'/></td></tr>";
                    $(html).appendTo("#datatable tbody");
                });
               
                 if($("#datatable tbody tr").length == 0){
                    alert("ไม่มีรายการที่คุณเลือก");
                }

            },
            error: function(err) {
                alert("error");
            }
        });
        
    });
</script>
