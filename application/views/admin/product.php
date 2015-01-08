<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
        <input type="button"  name="addproduct" value="เพิ่มข้อมูล" id="addproduct" onclick="showdialog();"  />
        <p>จำนวน : <span class="showtotal"> <?php echo count($datashow); ?></span> รายการ</p>
        <div id="showdata" style=" padding-top: 10px;">
            <table border="1" class="hovertable" id="datatable">
                <thead>
                <th width="50">ลำดับ</th>
                <th width="120">ประเภท</th>
                <th width="100">รหัสสินค้า</th>
                <th width="150">ชื่อสินค้า</th>
                <th width="150">ผู้ขายสินค้า</th>
                <th width="100">จำนวนคงเหลือ</th>
                <th width="100">ราคา</th>
                <th width="100">หน่วยนับ</th>
                <th width="100">ส่วนลด</th>
                <th width="100">ปรับปรุง</th>

                </thead>
                <tbody>
                    <?php
                    if (count($datashow) == 0) {
                        //   echo "<tr><td colspan='10' align='center'>--no data --</td></tr>";
                    } else {
                        $no = 1;
                        foreach ($datashow as $rs) {
                            echo "<tr>";
                            echo "<td align='center'>$no</td>";
                            echo "<td>" . $rs['product_type_des'] . "</td>";
                            echo "<td>" . $rs['product_id'] . "</td>";
                            echo "<td>" . $rs['product_des'] . "</td>";
                            echo "<td>" . $rs['supplier_name'] . "</td>";
                            echo "<td>" . $rs['onhand_now'] . "</td>";
                            echo "<td>" . $rs['price'] . "</td>";
                            echo "<td>" . $rs['unit'] . "</td>";
                            echo "<td>" . $rs['discount'] . "</td>";
                            echo "<td align='center'>";
                            ?>
                        <input type="button" value="แก้ไข" href="javascript:void(0)" onclick="showdialogedit('<?= $rs['product_id']; ?>')"></input>
                        <input type="button" value="ลบ" href="javascript:void(0)" onclick="del('<?= $rs['product_id']; ?>',this)"></input>
                        <?php
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </fieldset>



</div>

<div id="adddata" class="hiddendata">
    <h3><u>ฟอร์ม เพิ่มข้อมูลสินค้า</u></h3>
    <fieldset>
        <table >
            <tr>
                <td class="heightform2">ประเภทสินค้า</td>
                <td>
                    <select name="ddlType" id="ddlType" style="width:140px" >
                         <!--<option  value="" >เลือก 1 รายการ</option>-->
                        <? foreach ($product_type->result() as $row) { ?>
                            <option value="<?= $row->product_type_id ?>"><?= $row->product_type_des ?></option>
                        <? } ?>
                    </select>
                </td>

                <td class="heightform2">รหัสสินค้า</td>
                <td>
                    <input type="text" name="pro_id" value="" id="pro_id" disabled/>
                </td>
            </tr>
            <tr>
                <td class="heightform2">ชื่อสินค้า</td>
                <td>
                    <input type="text" name="pro_name" value="" id="pro_name"/>
                </td>

                <td class="heightform2">ผู้ขายสินค้า</td>  
                <td>
                    <select name="ddlSup" id="ddlSup" style="width:140px"  >
                      <!--<option  value="" >เลือก 1 รายการ</option>-->
                        <? foreach ($supplier->result() as $row) { ?>
                            <option value="<?= $row->supplier_id ?>"><?= $row->supplier_name ?></option>
                        <? } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="heightform2">จำนวนคงเหลือ</td>
                <td>
                    <input type="text" name="onhand" value="" id="onhand" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>

                <td class="heightform2">ราคา</td>
                <td>
                    <input type="text" name="price" value="" id="price" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">หน่วยนับ</td>
                <td>
                    <input type="text" name="unit" value="" id="unit"/>
                </td>
                </td>

                <td class="heightform2">ส่วนลด</td>
                <td>
                    <input type="text" name="discount" value="0" id="discount" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>

        </table>
    </fieldset>
    <br/>
    <div width="600px" style=" text-align: center">
        <input type="button"  name="insertform" id="insertform" value="เพิ่มข้อมูล"  /> 
        <input type="button"  name="cancleform" id="cancleform" value="ยกเลิก"  /> 
    </div>
</div>


<div id="editdata" class="hiddendata">
    <h3><u>ฟอร์ม แก้ไขข้อมูลสินค้า</u></h3>
    <fieldset>
        <table >
            <tr>
                <td class="heightform2">ประเภทสินค้า</td>
                <td>
                    <select name="ddlType_edit" id="ddlType_edit" style="width:140px" >
                        <!--<option  value="all" >ทุกประเภท</option>-->
                        <? foreach ($product_type->result() as $row) { ?>
                            <option value="<?= $row->product_type_id ?>"><?= $row->product_type_des ?></option>
                        <? } ?>
                    </select>
                </td>

                <td class="heightform2">รหัสสินค้า</td>
                <td>
                    <input type="text" name="edit_pro_id" value="" id="edit_pro_id" disabled/>
                </td>
            </tr>
            <tr>
                <td class="heightform2">ชื่อสินค้า</td>
                <td>
                    <input type="text" name="edit_pro_name" value="" id="edit_pro_name"/>
                </td>

                <td class="heightform2">ผู้ขายสินค้า</td>  
                <td>
                    <select name="ddlSup_edit" id="ddlSup_edit" style="width:140px"  >
                      
                        <? foreach ($supplier->result() as $row) { ?>
                            <option value="<?= $row->supplier_id ?>"><?= $row->supplier_name ?></option>
                        <? } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="heightform2">จำนวนคงเหลือ</td>
                <td>
                    <input type="text" name="edit_onhand" value="" id="edit_onhand" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>

                <td class="heightform2">ราคา</td>
                <td>
                    <input type="text" name="edit_price" value="" id="edit_price" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">หน่วยนับ</td>
                <td>
                    <input type="text" name="edit_unit" value="" id="edit_unit"/>
                </td>
                </td>

                <td class="heightform2">ส่วนลด</td>
                <td>
                    <input type="text" name="edit_discount" value="" id="edit_discount" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>

        </table>
    </fieldset>
    <br/>
    <div width="600px" style=" text-align: center">
        <input type="button"  name="edit_insertform" id ="edit_insertform" onclick="edit();" value="แก้ไขข้อมูล"  /> 

    </div>
</div>

<script>
    $(document).ready(function() { 
        $("#ddlType_edit").select2();
        $("#ddlSup_edit").select2();
        $("#ddlType").select2();
        $("#ddlSup").select2();
    });
    function showdialog() {
        $("#adddata").dialog({
            width: 600,
            height: 380,
            modal: true
        });
        this.genid();
    }
    function genid(){
          $.ajax({
            url:"genproductid/",
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#pro_id").val(res.maxid)
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
    }
    
    function showdialogedit(id) {
        $("#editdata").dialog({
            width: 600,
            height: 380,
            modal: true
        });
        this.getedit(id);
    }
    
    function chkNumber(ele){
        var vchar=String.fromCharCode(event.charCode);
        if((vchar <'0' || vchar >'9') && (vchar !='.'))
            return false;
       
        ele.onKeyPress=vchar;
    }
    
    $("#insertform").on('click',function(){
        if($("#pro_id").val()==""){
            $("#pro_id").focus();
            return false;
        }else if($("#pro_name").val()==""){
            $("#pro_name").focus();
            return false;
        }else if($("#onhand").val()==""){
            $("#onhand").focus();
            return false;
        }else if($("#price").val()==""){
            $("#price").focus();
            return false;
        }else if($("#unit").val()==""){
            $("#unit").focus();
            return false;
        }else if($("#discount").val()==""){
            $("#discount").focus();
            return false;
        }

        else{
            var i=$("#datatable tbody tr").length;
            $.ajax({
                url:"createproduct",
                type:"POST", 
                cache:false,
                dataType:"json",
                data:"ref_product_type_id="+$("#ddlType").val()+"&product_id="+$("#pro_id").val()
                    +"&product_des="+$("#pro_name").val()+"&ref_supplier_id="+$("#ddlSup").val()
                    +"&onhand_now="+$("#onhand").val()  +"&price="+$("#price").val()
                    +"&unit="+$("#unit").val()+"&discount="+$("#discount").val(),
                success:function(res){
                    // if(res=="ok"){
                    i++;
                    $(".showtotal").text(i);
                    var html="<tr><td align='center'>"+i+"</td><td>"+res.product_type_des+"</td><td>"+res.product_id+"</td><td>"+res.product_des+"</td><td>"+res.supplier_name+"</td><td>"+res.onhand_now+"</td><td>"+res.price+"</td><td>"+res.unit+"</td><td>"+res.discount+"</td><td align='center'> <input type='button' value='แก้ไข' href='javascript:void(0);' onclick='showdialogedit(\""+res.product_id+"\");'/><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(\""+res.product_id+"\",this);'/></td></tr>";
                    $(html).appendTo("#datatable tbody");
                        
                        
                 
                    $("#pro_name").val(""),
                    $("#onhand").val(""),
                    $("#price").val(""),
                    $("#unit").val(""),
                    $("#discount").val("");
                    alert("บันทึกข้อมูลสำเร็จ");
                   $("#adddata").dialog('close');
               
                    //  }
              
                },
                error :function(err){
                    alert("error");
                }
            });
        
          
        }

    });
    
    
    
    $("#cancleform").on('click',function(){
       
        $("#pro_name").val(""),
        $("#onhand").val(""),
        $("#price").val(""),
        $("#unit").val(""),
        $("#discount").val("");
        
       
 
    });
    
    
    function del(id,obj){
        var conf=confirm('ต้องการลบหรือไม่');
        if(conf){
            $.ajax({
                url:"delproduct/"+id,
                type:"POST",
                cache:false,
                success:function(res){
                    if(res=="ok"){
                        $(obj).parent().parent().remove();
                        $(".showtotal").text(numrow());
                        
                    }
                    
                },
                error : function(err){
                    console.log("erroe ;"+err)
                }
                
                
            });
            
        }else{
            return false
        }
    }
    function numrow(){
        return $("#datatable tbody tr").length;
    }
    
    
    function getedit(id){

        $.ajax({
            url:"geteditproduct/"+id,
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#ddlType_edit").val(res.ref_product_type_id),
                $("#edit_pro_id").val(res.product_id),
                $("#edit_pro_name").val(res.product_des),
                $("#ddlSup_edit").val(res.ref_supplier_id),
                $("#edit_onhand").val(res.onhand_now),
                $("#edit_price").val(res.price),
                $("#edit_unit").val(res.unit),
                $("#edit_discount").val(res.discount);

            },
            error:function(err){
                console.log("error:"+err);
            }
        });
         
    }
    var i=$("#datatable tbody tr").length;
    function edit(){
    
        if($("#edit_pro_id").val()==""){
        
            $("#edit_pro_id").focus();
            return false;
        }else if($("#edit_pro_name").val()==""){
            $("#edit_pro_name").focus();
            return false;
        }else if($("#edit_onhand").val()==""){
            $("#edit_onhand").focus();
            return false;
        }else if($("#edit_price").val()==""){
            $("#edit_price").focus();
            return false;
        }else if($("#edit_unit").val()==""){
            $("#edit_unit").focus();
            return false;
        }else if($("#edit_discount").val()==""){
            $("#edit_discount").focus();
            return false;
        }
    

        else{
    
            var html="";
   
            var strid= document.getElementById('edit_pro_id').value;
            //alert(strid);
            $.ajax({
                url:"editproduct/"+strid,
                type:"POST",
                dataType:"json",
                data:"ref_product_type_id="+$("#ddlType_edit").val()
                    +"&product_des="+$("#edit_pro_name").val()+"&ref_supplier_id="+$("#ddlSup_edit").val()
                    +"&onhand_now="+$("#edit_onhand").val()  +"&price="+$("#edit_price").val()
                    +"&unit="+$("#edit_unit").val()+"&discount="+$("#edit_discount").val(),
                success:function(res){
                    $("#datatable tbody").html("<tr><td align='center' colspan='10'>loading...</td></tr>");
                    var no=1;
                    $("#datatable tbody").html("");
                    $(res).each(function(i){
                   
                        html="<tr><td align='center'>"+i+"</td><td>"+res[i].product_type_des+"</td><td>"+res[i].product_id+"</td><td>"+res[i].product_des+"</td><td>"+res[i].supplier_name+"</td><td>"+res[i].onhand_now+"</td><td>"+res[i].price+"</td><td>"+res[i].unit+"</td><td>"+res[i].discount+"</td><td align='center'> <input type='button' value='แก้ไข' href='javascript:void(0);' onclick='showdialogedit(\""+res[i].product_id+"\");'/><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(\""+res[i].product_id+"\",this);'/></td></tr>";
                        no++;
                        $(html).appendTo($("#datatable tbody"));
                
                    });
                    alert("แก้ไขข้อมุลเรียบร้อย");
                    $("#editdata").dialog('close');
                
                },
                error:function(err){
                    console.log("error:"+err);
                }
            });
    
        }
    }
    
    
</script>
