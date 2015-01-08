<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
        <input type="button"  name="addsup" value="เพิ่มข้อมูล" id="addsup" onclick="showdialog();"/>
        <p>จำนวน : <span class="showtotal"> <?php echo count($datashow); ?></span> รายการ</p>
        <div id="showdata" style=" padding-top: 10px;">
            <table border="1" class="hovertable" id="datatable">
                <thead>
                <th width="50">ลำดับ</th>
                <th width="150">รหัสผู้ขาย</th>
                <th width="150">ชื่อผู้ขาย</th>
                <th width="250">ที่อยู่</th>
                <th width="150">เบอร์โทร</th>
                <th width="150">แฟ็กซ์</th>
                <th width="100">อีเมล์</th>
                <th width="100">ปรับปรุงรายการ</th>

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
                            echo "<td>" . $rs['supplier_id'] . "</td>";
                            echo "<td>" . $rs['supplier_name'] . "</td>";
                            echo "<td>" . $rs['address'] . "</td>";
                            echo "<td>" . $rs['tel'] . "</td>";
                            echo "<td>" . $rs['fax'] . "</td>";
                            echo "<td>" . $rs['email'] . "</td>";

                            echo "<td align='center'>";
                            ?>
                        <input type="button" value="แก้ไข" href="javascript:void(0)" onclick="showdialogedit('<?= $rs['supplier_id']; ?>')"></input>
                        <input type="button" value="ลบ" href="javascript:void(0)" onclick="del('<?= $rs['supplier_id']; ?>',this)"></input>
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
    <h3><u>ฟอร์ม เพิ่มข้อมูลผู้ขายสินค้า</u></h3>
    <fieldset>
        <table >

            <tr>
                <td class="heightform2">รหัสผู้ขาย</td>
                <td>
                    <input type="text" name="supp_id" value="" id="supp_id" disabled/>
                </td>

                <td class="heightform2">ชื่อผู้ขาย</td>
                <td>
                    <input type="text" name="supp_name" value="" id="supp_name"/>
                </td>
            </tr>
            <tr>
                <td class="heightform2">อีเมล์</td>
                <td>
                    <input type="text" name="supp_email" value="" id="supp_email"/>
                </td>
                </td>


                <td class="heightform2">เบอร์โทร</td>
                <td>
                    <input type="text" name="supp_tel" value="" id="supp_tel" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">แฟ็กซ์</td>
                <td>
                    <input type="text" name="supp_fax" value="" id="supp_fax"/>
                </td>
                <td class="heightform2">ที่อยู่</td>  
                <td> <textarea name="supp_address" id="supp_address"  value="" row="10" cols="30"  style=" height: 70px"></textarea></td>


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
       <h3><u>ฟอร์ม แก้ไขข้อมูลผู้ขายสินค้า</u></h3>
    <fieldset>
     <table >

            <tr>
                <td class="heightform2">รหัสผู้ขาย</td>
                <td>
                    <input type="text" name="edit_supp_id" value="" id="edit_supp_id" disabled/>
                </td>

                <td class="heightform2">ชื่อผู้ขาย</td>
                <td>
                    <input type="text" name="edit_supp_name" value="" id="edit_supp_name"/>
                </td>
            </tr>
            <tr>
                <td class="heightform2">อีเมล์</td>
                <td>
                    <input type="text" name="edit_supp_email" value="" id="edit_supp_email"/>
                </td>
                </td>


                <td class="heightform2">เบอร์โทร</td>
                <td>
                    <input type="text" name="edit_supp_tel" value="" id="edit_supp_tel" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">แฟ็กซ์</td>
                <td>
                    <input type="text" name="edit_supp_fax" value="" id="edit_supp_fax"/>
                </td>
                <td class="heightform2">ที่อยู่</td>  
                <td> <textarea name="edit_supp_address" id="edit_supp_address"  value="" row="10" cols="30"  style=" height: 70px"></textarea></td>


            </tr>

        </table>
        </fieldset>
    
      <br/>
    <div width="600px" style=" text-align: center">
        <input type="button"  name="edit_insertform" id ="edit_insertform" onclick="edit();" value="แก้ไขข้อมูล"  /> 
    
    </div>
</div>


<script>
    function showdialog() {
        $("#adddata").dialog({
            width: 650,
            height: 380,
            modal: true
        });
     this.genid();
    }
     function genid(){
          $.ajax({
            url:"gensupplier",
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#supp_id").val(res.maxid)
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
    }
    function showdialogedit(id) {
        $("#editdata").dialog({
            width: 650,
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
        if($("#supp_id").val()==""){
            $("#supp_id").focus();
            return false;
        }else if($("#supp_name").val()==""){
            $("#supp_name").focus();
            return false;
        }else if($("#supp_tel").val()==""){
            $("#supp_tel").focus();
            return false;
        }else if($("#supp_address").val()==""){
            $("#supp_address").focus();
            return false;
        }
        else{
            var i=$("#datatable tbody tr").length;
            $.ajax({
                url:"createsupplier",
                type:"POST", 
                cache:false,
                dataType:"json",
                data:"supplier_id="+$("#supp_id").val()+"&supplier_name="+$("#supp_name").val()
                    +"&email="+$("#supp_email").val()+"&tel="+$("#supp_tel").val()
                    +"&fax="+$("#supp_fax").val()  +"&address="+$("#supp_address").val(),
                success:function(res){
                    // if(res=="ok"){
                    i++;
                    $(".showtotal").text(i);
                    var html="<tr><td align='center'>"+i+"</td><td>"+res.supplier_id+"</td><td>"+res.supplier_name+"</td><td>"+res.address+"</td><td>"+res.tel+"</td><td>"+res.fax+"</td><td>"+res.email+"</td><td align='center'> <input type='button' value='แก้ไข' href='javascript:void(0);' onclick='showdialogedit(\""+res.supplier_id+"\");'/><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(\""+res.supplier_id+"\",this);'/></td></tr>";
                    $(html).appendTo("#datatable tbody");
                        
                        
                    $("#supp_id").val(""),
                    $("#supp_name").val(""),
                    $("#supp_email").val(""),
                    $("#supp_tel").val(""),
                    $("#supp_fax").val(""),
                    $("#supp_address").val("");
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
        $("#supp_id").val(""),
        $("#supp_name").val(""),
        $("#supp_email").val(""),
        $("#supp_tel").val(""),
        $("#supp_fax").val(""),
        $("#supp_address").val("");
    });
    
    
    function del(id,obj){
        var conf=confirm('ต้องการลบหรือไม่');
        if(conf){
            $.ajax({
                url:"delsupplier/"+id,
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
            url:"geteditsupplier/"+id,
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#edit_supp_id").val(res.supplier_id),
                $("#edit_supp_name").val(res.supplier_name),
                $("#edit_supp_email").val(res.email),
                $("#edit_supp_tel").val(res.tel),
                $("#edit_supp_fax").val(res.fax),
                $("#edit_supp_address").val(res.address)
               

            },
            error:function(err){
                console.log("error:"+err);
            }
        });
         
    }
    var i=$("#datatable tbody tr").length;
    function edit(){
    
      if($("#edit_supp_id").val()==""){
            $("#edit_supp_id").focus();
            return false;
        }else if($("#edit_supp_name").val()==""){
            $("#edit_supp_name").focus();
            return false;
        }else if($("#edit_supp_tel").val()==""){
            $("#edit_supp_tel").focus();
            return false;
        }else if($("#edit_supp_address").val()==""){
            $("#edit_supp_address").focus();
            return false;
        }

        else{
    
        var html="";
   
        var strid= document.getElementById('edit_supp_id').value;
        //alert(strid);
        $.ajax({
            url:"editsupplier/"+strid,
            type:"POST",
            dataType:"json",
           data:"supplier_name="+$("#edit_supp_name").val()
                    +"&email="+$("#edit_supp_email").val()+"&tel="+$("#edit_supp_tel").val()
                    +"&fax="+$("#edit_supp_fax").val()  +"&address="+$("#edit_supp_address").val(),
            success:function(res){
                $("#datatable tbody").html("<tr><td align='center' colspan='8'>loading...</td></tr>");
                var no=1;
                $("#datatable tbody").html("");
                $(res).each(function(i){
                   
                     html="<tr><td align='center'>"+i+"</td><td>"+res[i].supplier_id+"</td><td>"+res[i].supplier_name+"</td><td>"+res[i].address+"</td><td>"+res[i].tel+"</td><td>"+res[i].fax+"</td><td>"+res[i].email+"</td><td align='center'> <input type='button' value='แก้ไข' href='javascript:void(0);' onclick='showdialogedit(\""+res[i].supplier_id+"\");'/><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(\""+res[i].supplier_id+"\",this);'/></td></tr>";
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
