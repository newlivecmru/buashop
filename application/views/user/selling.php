<div id="adddata" >
    <table >
        <tr>
            <td class="heightform2">เลขที่การขาย</td>
            <td>
                <input type="text" name="sell_id" value="" id="sell_id" disabled/>
            </td>

             <td class="heightform2">รหัสสินค้า/ชื่อสินค้า</td>
            <td>
                <select name="ddlproduct" id="ddlproduct" style="width:180px" onchange="getchange();">
                    <option  value="" >เลือก 1 รายการ</option>
                    <? foreach ($product->result() as $row) { ?>
                        <option value="<?= $row->product_id ?>"><?= $row->product_id . ' : ' . $row->product_des ?></option>
                    <? } ?>
                </select>
            </td>
            
             <td class="heightform2">วันที่ขาย</td>
            <td>
                <input type="text" name="date_selling" value="<?php echo date("Y-m-d") ?>" id="date_selling" disabled/>
            </td>
         
        </tr>
        <tr>
            <td class="heightform2">ราคา:ต่อหน่วย</td>
            <td>
                <input type="text" name="price" value="" id="price" disabled/>
            </td>
      
            
              <td class="heightform2" >หน่วยนับ</td>
            <td>
                <input type="text" name="unit" value="" id="unit" disabled/>
            </td>
              <td class="heightform2">จำนวนคงเหลือ</td>
            <td>
                <input type="text" name="onhand" value="" id="onhand" disabled/>
            </td> 
        </tr>
        <tr>
            <td class="heightform2"></td>
            <td>
              
            </td>
            
            <td class="heightform2">จำนวนที่ขาย</td>
            <td>
                <input type="text" name="qty" value="" id="qty"/>
            </td>
            <td class="heightform2">ราคารวม</td>
            <td>
                <input type="text" name="price_total" value="" id="price_total" style=" color: red" disabled/>
                <input type="hidden" name="nameproduct" value="" id="nameproduct" >
               
            </td>
             
        </tr>
 

        <tr>
       
      <td align="right"colspan="6"  >
      <input type="button"  name="insertform" id="insertform" value="เพิ่มรายการขาย"  /> 
       
            </td>

        </tr>
    </table>
</div>
<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
        <input type="button"  name="addproduct" value="บันทึกรายการขาย" onclick="insertlist();"  />
         <p>จำนวน : <span class="showtotal" value=""> </span> รายการ</p>
        <div id="showdata" style=" padding-top: 10px;">
            <table border="1" class="hovertable" id="datatable">
                <thead>
                <th width="50">ลำดับ</th>
                <th width="120">เลขที่การขาย</th>
                <th width="100">รหัสสินค้า</th>
                <th width="150">ชื่อสินค้า</th>
                <th width="100">จำนวนคงเหลือ</th>
                <th width="100">จำนวนที่ขาย</th>
                <th width="100">ราคา:หน่วย</th>
                <th width="100">หน่วยนับ</th>
                <th width="100">ราคารวม</th>
                <th width="100"></th>

                </thead>
                <tbody>
                   
                </tbody>
            </table>
            
        </div>
        <br/>
    <p style=" font-size: 18px; color: blue; text-align: right;">รวมทั้งหมด : <span class="showtotalprice" value=""> </span> บาท</p>
    </fieldset>
</div>
<div id="changemoney" class="hiddendata">
    <table>
        <tr>
            <td>ราคารวมทั้งหมด</td>
            <td><input type="text" id="txttotal" name="txttotal" value="" disabled/></td>
        </tr>
        
          <tr>
            <td>จำนวนเงินทีรับมา</td>
            <td><input type="text" id="txttotal_rec" name="txttotal_rec" value="" /></td>
        </tr>
        
        <tr>
            <td>จำนวนเงินทีต้องทอน</td>
            <td><input type="text" id="txtchange" name="txtchange" value="" disabled /></td>
        </tr>
        
           <tr>
       
            <td>
                <br/>
                <input type="button" id="btnprint" name="btnprint" value="ปริ้นใบเสร็จ"/></td>
        </tr>
     
    </table>
            
        <br/>
        <div id="print_price" width="700px" height="400px" style=" background: white;color: black; border: 2px;text-align: center">
            <p style=" text-align: center">ใบเสร็จรับเงิน</p>
            <table style=" border: 1px;" id="">
                <thead>
                <th width="30px"></th>
                <th width="400px" >รายการ</th>
                 <th width="50px" style=" text-align: right;">จำนวน</th>
                 <th width="100px" style=" text-align: right;">ราคา</th>
                 <th width="100px" style=" text-align: right;">ราคารวม</th>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            
        </div>
</div>

<script>
 
 $(document).ready( function() { 
        
     $("#ddlproduct").select2();
        $.ajax({
            url:"gensellingid/",
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#sell_id").val(res.maxid)
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
    });
    
      $(document).ready(function() { 
        $("#ddlproduct").select2();
        
        var inp = document.getElementById('qty');

        inp.onkeyup = function() {
            caltotal();
        }
    });
     var puch1=0;
    var puch2=0;
    function caltotal(){
        puch1 = document.getElementById('qty');
        puch2 = document.getElementById('price');
        document.getElementById('price_total').value= parseFloat(puch1.value) * parseFloat(puch2.value);  
    
    }
    
      function getchange(){
        var id=document.getElementById('ddlproduct').value;
        $.ajax({
            url:"getchangeproduct/"+id,
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#price").val(res.price),
                $("#unit").val(res.unit),
                $("#typename_id").val(res.product_type_des),
                $("#onhand").val(res.onhand_now);
                $("#nameproduct").val(res.product_des);
                $("#qty").val("");
                $("#price_total").val("");
                

            },
            error:function(err){
                console.log("error:"+err);
            }
        });
         
    }
  $(document).ready( function() { 
        var i=$("#datatable tbody tr").length;
        $(".showtotal").text(i);
        // $("#txttotal").val(i)
        pricetotal();
        
    });
    
    function pricetotal(){

       var total_all=0;
        var myTable = document.getElementById('datatable').tBodies[0];
        for (var r=0, n = myTable.rows.length; r < n; r++) {
            var total1=0;
            for (var c = 0, m = myTable.rows[r].cells.length; c < m; c++) {
                if(myTable.rows[r].cells[c].childNodes[0].value){
                 total1 = myTable.rows[r].cells[8].innerHTML;

                }
               // total_all=total2;
           }
           var  total2 = parseFloat(total1)+ parseFloat(total_all);
           total_all=total2;
        //  alert(total_all);
        }
         $(".showtotalprice").text(total_all);
          //$("#txttotal").val(total_all)
     
    }
    
    
    
    $("#insertform").on('click',function(){
        if($("#qty").val()==""){
            $("#qty").focus();
            return false;
        }else{
            var i=$("#datatable tbody tr").length;
            i++;
            $(".showtotal").text(i);
            var html="<tr><td align='center'>"+i+"</td><td>"+$("#sell_id").val()+"</td><td>"+$("#ddlproduct").val()+"</td><td>"+$("#nameproduct").val()+"</td><td>"+$("#onhand").val()+"</td><td>"+$("#qty").val()+"</td><td>"+$("#price").val()+"</td><td>"+$("#unit").val()+"</td><td>"+$("#price_total").val()+"</td><td align='center'><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(this);'/></td></tr>";
            $(html).appendTo("#datatable tbody");
        }
          pricetotal();
        
    });
    function del(obj){
        var conf=confirm('ต้องการลบหรือไม่');
        if(conf){
            $(obj).parent().parent().remove();
            $(".showtotal").text(numrow());
            pricetotal();
        }else{
            return false
        }
    }
    function numrow(){
        return $("#datatable tbody tr").length;
   
    }
    
      function insertlist(){

        var myTable = document.getElementById('datatable').tBodies[0];
        for (var r=0, n = myTable.rows.length; r < n; r++) {
            for (var c = 0, m = myTable.rows[r].cells.length; c < m; c++) {
                if(myTable.rows[r].cells[c].childNodes[0].value){
				   	
                    var idselling = myTable.rows[r].cells[1].innerHTML;
                    var idproduct = myTable.rows[r].cells[2].innerHTML;
                    var qty = myTable.rows[r].cells[5].innerHTML;
                    var price = myTable.rows[r].cells[6].innerHTML;
                    var unit = myTable.rows[r].cells[7].innerHTML;
                    var total = myTable.rows[r].cells[8].innerHTML;
                    var status = 1;
                    var dateselling =  $("#date_selling").val();
                    var employee = "<?=$_SESSION["userid"]?>";
                    var lineid=r+1;
                    
                    var onhand=myTable.rows[r].cells[4].innerHTML;
                    var onhand_now= parseFloat(onhand) - parseFloat(qty);

                    $.ajax({
                        url:"create_selling",
                        type:"POST", 
                        cache:false,
                        dataType:"json",
                        data:"selling_id="+idselling+"&product_id="+idproduct
                            +"&sell_date="+dateselling+"&qty="+qty
                            +"&price="+price+"&unit="+unit+"&onhand_now="+onhand_now
                            +"&total="+total+"&status="+status+"&employee_id="+employee+"&line_selling="+lineid,
                        success:function(){
                        },
                        error :function(err){
                            console.log("error:"+err);
                        }
                    });

                }
            }
        }
     //   alert("บันทึกรายการขายสำเร็จ");
        
        this.showdialog(idselling);
        this.refreshdata();
        

    }
    function showdialog(id) {
        $("#changemoney").dialog({
            width: 800,
            height: 600,
            modal: true
        });
        this.change_money(id);
    }
     function refreshdata(){
        $.ajax({
            url:"gensellingid/",
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#sell_id").val(res.maxid),
                $("#price").val(""),
                $("#unit").val(""),
                $("#typename_id").val(""),
                $("#onhand").val("");
                $("#nameproduct").val("");
                $("#qty").val("");
                $("#price_total").val("");
          
                for (var i = document.getElementById("datatable").rows.length; i > 1; i--) {
                    document.getElementById("datatable").deleteRow(i - 1);
                } 
                $(".showtotal").text(numrow());
                pricetotal();
               
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
    }
    
    function change_money(id)
    {
        $.ajax({
            url:"getselling_sum/"+id,
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#txttotal").val(res.total)
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
        this.print(id);
        
    }
      function print(id_print)
    {
        $.ajax({
            url:"getselling_print/"+id_print,
            type:"POST",
            dataType:"json",
             
            success:function(res){
               
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
        
    }
    
    
     $(document).ready(function() { 
        var inp = document.getElementById('txttotal_rec');

        inp.onkeyup = function() {
            caltotal_change_money();
        }
    });
     var puch3=0;
    var puch4=0;
    function caltotal_change_money(){
        puch3 = document.getElementById('txttotal_rec');
        puch4 = document.getElementById('txttotal');
        document.getElementById('txtchange').value= parseFloat(puch3.value) - parseFloat(puch4.value);  
    
    }
</script>