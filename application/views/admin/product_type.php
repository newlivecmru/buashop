<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
        <input type="button"  name="addtype" value="เพิ่มข้อมูล"  id="addtype" onclick="showdialog();"/>
        <p>จำนวน : <span class="showtotal"> <?php echo count($datashow); ?></span> รายการ</p>
        <div id="showdata" style=" padding-top: 10px">
            <table border="1" class="hovertable" id="datatable">
                <thead>
                <th width="50">ลำดับ</th>
                <th width="170">รหัส</th>
                <th width="250">ชื่อประเภท</th>
                <th width="150">ปรับปรุงรายการ</th>
               

                </thead>
                <tbody>
                   <?php
                    if (count($datashow) == 0) {
                     //  echo "<tr><td colspan='10' align='center'>--no data --</td></tr>";
                    } else {
                        $no = 1;
                        foreach ($datashow as $rs) {
                            echo "<tr>";
                            echo "<td align='center'>$no</td>";
                            echo "<td>" . $rs['product_type_id'] . "</td>";
                            echo "<td>" . $rs['product_type_des'] . "</td>";
                            echo "<td align='center'>";
                            ?>
                        <input type="button" value="แก้ไข" href="javascript:void(0)" onclick="showdialogedit('<?= $rs['product_type_id']; ?>')"></input>
                        <input type="button" value="ลบ" href="javascript:void(0)" onclick="del('<?= $rs['product_type_id']; ?>',this)"></input>
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
      <h3><u>ฟอร์ม เพิ่มข้อมูลประเภทสินค้า</u></h3>
    <fieldset>
    <table >

        <tr>
            <td class="heightform">รหัสประเภทสินค้า</td>
            <td>
                <input type="text" name="type_id" value="" id="type_id" disabled/>
            </td>
        </tr>
        <tr>
            <td class="heightform">ชื่อประเภทสินค้า</td>
            <td>
                <input type="text" name=type_name" value="" id="type_name"/>
            </td>
        </tr>
     
        <tr>
            <td></td>
            <td class="heightform">
                <input type="button"  name="insertform" id="insertform" value="เพิ่มข้อมูล"  /> 
                <input type="button"  name="cancleform" id="cancleform" value="ยกเลิก"  /> 
            </td>

        </tr>
    </table>
        </fieldset>
</div>


<div id="editdata" class="hiddendata">
      <h3><u>ฟอร์ม แก้ไขข้อมูลประเภทสินค้า</u></h3>
    <fieldset>
    <table >

        <tr>
            <td class="heightform">รหัสประเภทสินค้า</td>
            <td>
                <input type="text" name="edit_type_id" value="" id="edit_type_id" disabled />
            </td>
        </tr>
        <tr>
            <td class="heightform">ชื่อประเภทสินค้า</td>
            <td>
                <input type="text" name="edit_type_name" value="" id="edit_type_name"/>
            </td>
        </tr>
     
        <tr>
            <td></td>
            <td class="heightform">
                <input type="button"  name="edit_insertform" id="edit_insertform" onclick="edit();" value="แก้ไขข้อมูล"  /> 

            </td>

        </tr>
    </table>
        </fieldset>
</div>

<script>
    function showdialog() {
        $("#adddata").dialog({
            width:400,
            height: 330,
            modal: true
        });
             this.genid();
    }
     function genid(){
          $.ajax({
            url:"genproductype/",
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#type_id").val(res.maxid)
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
    }
     function showdialogedit(id) {
        $("#editdata").dialog({
            width: 400,
            height: 330,
            modal: true
        });
        this.getedit(id);
    }
    
    
    $("#insertform").on('click',function(){
        if($("#type_id").val()==""){
        
            $("#type_id").focus();
            return false;
        }else if($("#type_name").val()==""){
            $("#type_name").focus();
            return false;
        }
    

        else{
            var i=$("#datatable tbody tr").length;
            $.ajax({
                url:"createproduct_type",
                type:"POST", 
                cache:false,
                dataType:"json",
                data:"product_type_id="+$("#type_id").val()+"&product_type_des="+$("#type_name").val() ,
                success:function(res){
                    // if(res=="ok"){
                    i++;
                    $(".showtotal").text(i);
                    var html="<tr><td align='center'>"+i+"</td><td>"+res.product_type_id+"</td><td>"+res.product_type_des+"</td><td align='center'> <input type='button' value='แก้ไข' href='javascript:void(0);' onclick='showdialogedit(\""+res.product_type_id+"\");'/><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(\""+res.product_type_id+"\",this);'/></td></tr>";
                    $(html).appendTo("#datatable tbody");
                        
                        
                    $("#type_id").val(""),
                    $("#type_name").val("");
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
        $("#type_id").val(""),
        $("#type_name").val("");
    });
    
    
     function del(id,obj){
        var conf=confirm('ต้องการลบหรือไม่');
        if(conf){
            $.ajax({
                url:"delproductype/"+id,
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
            url:"geteditproductype/"+id,
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#edit_type_id").val(res.product_type_id),
                $("#edit_type_name").val(res.product_type_des);

            },
            error:function(err){
                console.log("error:"+err);
            }
        });
         
    }
    var i=$("#datatable tbody tr").length;
    function edit(){
    
    if($("#edit_type_id").val()==""){
        
            $("#edit_type_id").focus();
            return false;
        }else if($("#edit_type_name").val()==""){
            $("#edit_type_name").focus();
            return false;
        }
        else{
    
        var html="";
   
        var strid= document.getElementById('edit_type_id').value;
        //alert(strid);
        $.ajax({
            url:"editproductype/"+strid,
            type:"POST",
            dataType:"json",
            data:"product_type_des="+$("#edit_type_name").val(),
            success:function(res){
                $("#datatable tbody").html("<tr><td align='center' colspan='3'>loading...</td></tr>");
                var no=1;
                $("#datatable tbody").html("");
                $(res).each(function(i){
                   
                    html="<tr><td align='center'>"+no+"</td><td>"+res[i].product_type_id+"</td><td>"+res[i].product_type_des+"</td><td align='center'> <input type='button' value='แก้ไข' href='javascript:void(0);' onclick='showdialogedit(\""+res[i].product_type_id+"\");'/><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(\""+res[i].product_type_id+"\",this);'/></td></tr>";
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
