<div id="adddata" >
    <table >
        <tr>
            <td class="heightform2">เลขที่สั่งซื้อ</td>
            <td>
                <input type="text" name="purch_id" value="" id="purch_id" disabled/>
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
            <td class="heightform2">วันที่สั่งซื้อ</td>
            <td>
                <input type="text" name="date_purchase" value="<?php echo date("Y-m-d") ?>" id="date_purchase" disabled/>
            </td>

        </tr>
        <tr>
            <td class="heightform2">ประเภทสินค้า</td>  
            <td><input type="text" name="typename_id" value="" id="typename_id" disabled/></td>  
            <td class="heightform2">รหัสผู้ขายสินค้า</td>  
            <td><input type="text" name="supplier_id" value="" id="supplier_id" disabled/></td>
            <td class="heightform2">ผู้ขายสินค้า</td>  
            <td><input type="text" name="supplier_name" value="" id="supplier_name" disabled/></td>
        </tr>
        <tr>
            <td class="heightform2">ส่วนลดการสั่งซื้อ:ชิ้น</td>
            <td>
                <input type="text" name="discount" value="" id="discount" disabled/>
            </td>


            <td class="heightform2">หน่วยนับ</td>
            <td>
                <input type="text" name="unit" value="" id="unit" disabled/>
            </td>
            <td class="heightform2">ราคา</td>
            <td>
                <input type="text" name="price" value="" id="price" disabled/>
            </td>

        </tr>
        <tr>
            <td class="heightform2">จำนวนคงเหลือ</td>
            <td>
                <input type="text" name="onhand" value="" id="onhand" disabled  />
            </td>
            <td class="heightform2">จำนวนสั่งซื้อ</td>
            <td>
                <input type="text" name="qty" value="" id="qty"  />
            </td>
            <td class="heightform2">ราคารวม</td>
            <td >
                <input type="text" name="price_total" value="" id="price_total" style=" color: red"  disabled/>
            </td>
        <input type="hidden" name="nameproduct" value="" id="nameproduct" >

        </tr>

        <tr>

            <td class="heightform22" colspan="4"  >
                <input type="button"  name="insertform" id="insertform" value="เพิ่มรายการสั่งซื้อ"  /> 
     
            </td>

        </tr>
    </table>
</div>
<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>รายการสั่งซื้อ</b></legend>
        <p>จำนวน : <span class="showtotal" value=""> </span> รายการ</p>
        <input type="button"  name="addpurchase" id="addpurchase" value="บันทึกรายการสั่งซื้อ" onclick="insertlist();"  />
        <div id="showdata" style=" padding-top: 10px;">
            <table border="1" class="hovertable" id="datatable">
                <thead>
                <th width="50">ลำดับ</th>
                <th width="120">เลขที่สั่งซื้อ</th>
                <th width="100">รหัสสินค้า</th>
                <th width="150">ชื่อสินค้า</th>
                <th width="150">รหัสSupplier</th>
                <th width="150">ชื่อSupplier</th>
                <th width="100">จำนวนสั่งซื้อ</th>
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

    </fieldset>



</div>

<script>
    $(document).ready(function() { 
        $("#ddlproduct").select2();
        
        var inp = document.getElementById('qty');

        inp.onkeyup = function() {
            caltotal();
        }
    });
  
    $(document).ready( function() { 
        $.ajax({
            url:"genpurchaseid/",
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#purch_id").val(res.maxid)
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
    });
    
    var puch1=0;
    var puch2=0;
    function caltotal(){
        puch1 = document.getElementById('qty');
        puch2 = document.getElementById('price');
        document.getElementById('price_total').value= parseFloat(puch1.value) * parseFloat(puch2.value);  
    
    }
    $(document).ready( function() { 
        var i=$("#datatable tbody tr").length;
        $(".showtotal").text(i);
    });
    
    function getchange(){
        var id=document.getElementById('ddlproduct').value;
        $.ajax({
            url:"getchangeproduct/"+id,
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#supplier_name").val(res.supplier_name),
                $("#price").val(res.price),
                $("#unit").val(res.unit),
                $("#discount").val(res.discount),
                $("#typename_id").val(res.product_type_des),
                $("#supplier_id").val(res.supplier_id);
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
    
    $("#insertform").on('click',function(){
        if($("#qty").val()==""){
            $("#qty").focus();
            return false;
        }else{
            var i=$("#datatable tbody tr").length;
            i++;
            $(".showtotal").text(i);
            var html="<tr><td align='center'>"+i+"</td><td>"+$("#purch_id").val()+"</td><td>"+$("#ddlproduct").val()+"</td><td>"+$("#nameproduct").val()+"</td><td>"+$("#supplier_id").val()+"</td><td>"+$("#supplier_name").val()+"</td><td>"+$("#qty").val()+"</td><td>"+$("#price").val()+"</td><td>"+$("#unit").val()+"</td><td>"+$("#price_total").val()+"</td><td align='center'><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(this);'/></td></tr>";
            $(html).appendTo("#datatable tbody");
        }
        
    });
    
    function del(obj){
        var conf=confirm('ต้องการลบหรือไม่');
        if(conf){
            $(obj).parent().parent().remove();
            $(".showtotal").text(numrow());
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
				   	
                    var idpurchase = myTable.rows[r].cells[1].innerHTML;
                    var idproduct = myTable.rows[r].cells[2].innerHTML;
                    var idsuplier = myTable.rows[r].cells[4].innerHTML;
                    var qty = myTable.rows[r].cells[6].innerHTML;
                    var price = myTable.rows[r].cells[7].innerHTML;
                    var unit = myTable.rows[r].cells[8].innerHTML;
                    var total = myTable.rows[r].cells[9].innerHTML;
                    var status = 1;
                    var datepurchase =  $("#date_purchase").val();
                    var lineid=r+1;
                    var noreceive=myTable.rows[r].cells[6].innerHTML
                    //  alert(idproduct);
                                      
    
                    $.ajax({
                        url:"createpurchase",
                        type:"POST", 
                        cache:false,
                        dataType:"json",
                        data:"purchase_id="+idpurchase+"&product_id="+idproduct
                            +"&supplier_id="+idsuplier+"&qty="+qty
                            +"&price="+price+"&unit="+unit+"&noreceive="+noreceive
                            +"&total="+total+"&status="+status+"&purchase_date="+datepurchase+"&line_purchase="+lineid,
                        success:function(){
                        },
                        error :function(err){
                            console.log("error:"+err);
                        }
                    });

                }
            }
        }
        alert("บันทึกรายการสั่งซื้อสำเร็จ");
        this.refreshdata();
       
    }
    function refreshdata(){
        $.ajax({
            url:"genpurchaseid/",
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#purch_id").val(res.maxid),
                $("#supplier_name").val(""),
                $("#price").val(""),
                $("#unit").val(""),
                $("#discount").val(""),
                $("#typename_id").val(""),
                $("#supplier_id").val("");
                $("#onhand").val("");
                $("#nameproduct").val("");
                $("#qty").val("");
                $("#price_total").val("");
                $("#ddlproduct").val("");
          
                for (var i = document.getElementById("datatable").rows.length; i > 1; i--) {
                    document.getElementById("datatable").deleteRow(i - 1);
                } 
                $(".showtotal").text(numrow());
               
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
    }

</script>




