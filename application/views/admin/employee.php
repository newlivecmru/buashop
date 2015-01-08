<div id="contentform" class="contentforms">
    <br/>
    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
        <input type="button"  name="addemp" value="เพิ่มข้อมูล" id="addemp" onclick="showdialog();"/>
        <p>จำนวน : <span class="showtotal"> <?php echo count($datashow); ?></span> รายการ</p>
        <div id="showdata" style=" padding-top: 10px;">
            <table border="1" class="hovertable" id="datatable">
                <thead>
                <th width="50">ลำดับ</th>
                <th width="50">รหัสพนักงาน</th>
                <th width="150">ชื่อ</th>
                <th width="150">สกุล</th>
                <th width="50">อายุ</th>
                <th width="150">เลขบัตรประชาชน</th>
                <th width="250">ที่อยู่</th>
                <th width="100">เบอร์</th>
                <th width="100">ชื่อผู้ใช้</th>
                <th width="150">ปรับปรุงรายการ</th>

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
                                echo "<td>" . $rs['employee_id'] . "</td>";
                                echo "<td>" . $rs['name'] . "</td>";
                                echo "<td>" . $rs['surename'] . "</td>";
                                echo "<td>" . $rs['age'] . "</td>";
                                echo "<td>" . $rs['id_card'] . "</td>";
                                echo "<td>" . $rs['address'] . "</td>";
                                echo "<td>" . $rs['tel'] . "</td>";
                                echo "<td>" . $rs['username'] . "</td>";
                                echo "<td align='center'>";
                                ?>
                            <input type="button" value="แก้ไข" href="javascript:void(0)" onclick="showdialogedit('<?= $rs['employee_id']; ?>')"></input>
                            <input type="button" value="ลบ" href="javascript:void(0)" onclick="del('<?= $rs['employee_id']; ?>',this)"></input>
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
    <h3><u>ฟอร์ม เพิ่มข้อมูลพนักงาน</u></h3>
    <fieldset>
        <table >

            <tr>
                <td class="heightform2">รหัสพนักงาน</td>
                <td>
                    <input type="text" name="emp_id" value="" id="emp_id" disabled/>
                </td>

                <td class="heightform2">ชื่อพนักงาน</td>
                <td>
                    <input type="text" name="emp_name" value="" id="emp_name"/>
                </td>
            </tr>
            <tr>
                <td class="heightform2">นามสกุล</td>
                <td>
                    <input type="text" name="emp_surename" value="" id="emp_surename"/>
                </td>
                <td class="heightform2">อายุพนักงาน</td>  
                <td><input type="text" name="emp_age" value="" id="emp_age" onKeyPress="return chkNumber(this)"/></td>


            </tr>
            <tr>
                <td class="heightform2"  >ที่อยู่</td>
                <td colspan="3">
                    <textarea name="emp_address" id="emp_address"  value="" row="10" cols="47"  style=" height: 70px"></textarea>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">รหัสบัตรประชาชน</td>
                <td>
                    <input type="text" name="emp_idcard" value="" id="emp_idcard" onKeyPress="return chkNumber(this)"/>
                </td>

                <td class="heightform2">เบอร์โทร</td>
                <td>
                    <input type="text" name="emp_tel" value="" id="emp_tel" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">ชื่อผู้ใช้</td>
                <td>
                    <input type="text" name="emp_user" value="" id="emp_user"/>
                </td>
                </td>

                <td class="heightform2">รหัสผ่าน</td>
                <td>
                    <input type="text" name="emp_pass" value="" id="emp_pass"/>
                </td>
                </td>
            </tr>
            <tr>
            </tr>
        </table>
    </fieldset>
    <br/>
    <div width="600px" style=" text-align: center">
        <input type="button"  name="insertform" id="insertform" value="เพิ่มข้อมูล"  /> 
        <input type="button"  name="cancleform" id="cancleform" value="ยกเลิก"  /> 
    </div>
</div>

<div id="editdtata" class="hiddendata">
    <h3><u>ฟอร์ม แก้ไขข้อมูลพนักงาน</u></h3>
    <fieldset>
        <table >

            <tr>
                <td class="heightform2">รหัสพนักงาน</td>
                <td>
                    <input type="text" name="edit_emp_id" value=""  id="edit_emp_id" disabled/>

                </td>

                <td class="heightform2">ชื่อพนักงาน</td>
                <td>
                    <input type="text" name="edit_emp_name" value="" id="edit_emp_name"/>
                </td>
            </tr>
            <tr>
                <td class="heightform2">นามสกุล</td>  
                <td><input type="text" name="edit_emp_surename" value="" id="edit_emp_surename"/></td>

                <td class="heightform2">อายุ</td>  
                <td><input type="text" name="edit_emp_age" value="" id="edit_emp_age" onKeyPress="return chkNumber(this)"/></td>
            </tr>
            <tr>
                <td class="heightform2">ที่อยู่</td>
                <td colspan="3">
                    <textarea name="edit_emp_address" id="edit_emp_address" value="" row="10" cols="47"  style=" height: 70px" ></textarea>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">เลขบัตรประชาชน</td>
                <td>
                    <input type="text" name="edit_emp_idcard" value="" id="edit_emp_idcard" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
                <td class="heightform2">เบอร์โทร</td>
                <td>
                    <input type="text" name="edit_emp_tel" value="" id="edit_emp_tel" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">รหัสผู้ใช้</td>
                <td>
                    <input type="text" name="edit_emp_user" value="" id="edit_emp_user"/>
                </td>
                </td>

                <td class="heightform2">รหัสผ่าน</td>
                <td>
                    <input type="text" name="edit_emp_pass" value="" id="edit_emp_pass"/>
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
    function showdialog() {
        $("#adddata").dialog({
            width: 600,
            height: 420,
            modal: true
        });
          this.genid();
    }
     function genid(){
          $.ajax({
            url:"genempid/",
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#emp_id").val(res.maxid)
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
    }
    function showdialogedit(id) {
        $("#editdtata").dialog({
            width: 600,
            height: 420,
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
        if($("#emp_id").val()==""){
        
            $("#emp_id").focus();
            return false;
        }else if($("#emp_name").val()==""){
            $("#emp_name").focus();
            return false;
        }else if($("#emp_surename").val()==""){
            $("#emp_surename").focus();
            return false;
        }else if($("#emp_age").val()==""){
            $("#emp_age").focus();
            return false;
        }else if($("#emp_address").val()==""){
            $("#emp_address").focus();
            return false;
        }else if($("#emp_idcard").val()==""){
            $("#emp_idcard").focus();
            return false;
        }else if($("#emp_tel").val()==""){
            $("#emp_tel").focus();
            return false;
        }else if($("#emp_user").val()==""){
            $("#emp_user").focus();
            return false;
        }else if($("#emp_pass").val()==""){
            $("#emp_pass").focus();
            return false;
        }
    

        else{
            var i=$("#datatable tbody tr").length;
            $.ajax({
                url:"createemployee",
                type:"POST", 
                cache:false,
                dataType:"json",
                data:"employee_id="+$("#emp_id").val()+"&name="+$("#emp_name").val()
                    +"&surename="+$("#emp_surename").val()+"&age="+$("#emp_age").val()
                    +"&id_card="+$("#emp_idcard").val()  +"&address="+$("#emp_address").val()
                    +"&tel="+$("#emp_tel").val()+"&username="+$("#emp_user").val()
                    +"&password="+$("#emp_pass").val() +"&user_type=2",
                success:function(res){
                    // if(res=="ok"){
                    i++;
                    $(".showtotal").text(i);
                    var html="<tr><td align='center'>"+i+"</td><td>"+res.employee_id+"</td><td>"+res.name+"</td><td>"+res.surename+"</td><td>"+res.age+"</td><td>"+res.id_card+"</td><td>"+res.address+"</td><td>"+res.tel+"</td><td>"+res.username+"</td><td align='center'> <input type='button' value='แก้ไข' href='javascript:void(0);' onclick='showdialogedit(\""+res.employee_id+"\");'/><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(\""+res.employee_id+"\",this);'/></td></tr>";
                    $(html).appendTo("#datatable tbody");
                        
                        
                    $("#emp_id").val(""),
                    $("#emp_name").val(""),
                    $("#emp_surename").val(""),
                    $("#emp_age").val(""),
                    $("#emp_idcard").val(""),
                    $("#emp_address").val(""),
                    $("#emp_tel").val(""),
                    $("#emp_user").val(""),
                    $("#emp_pass").val("");
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
        $("#emp_id").val(""),
        $("#emp_name").val(""),
        $("#emp_surename").val(""),
        $("#emp_age").val(""),
        $("#emp_idcard").val(""),
        $("#emp_address").val(""),
        $("#emp_tel").val(""),
        $("#emp_user").val(""),
        $("#emp_pass").val("");
    });
    
    
    function del(id,obj){
        var conf=confirm('ต้องการลบหรือไม่');
        if(conf){
            $.ajax({
                url:"delemployee/"+id,
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
            url:"geteditemployee/"+id,
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#edit_emp_id").val(res.employee_id),
                $("#edit_emp_name").val(res.name),
                $("#edit_emp_surename").val(res.surename),
                $("#edit_emp_age").val(res.age),
                $("#edit_emp_idcard").val(res.id_card),
                $("#edit_emp_address").val(res.address),
                $("#edit_emp_tel").val(res.tel),
                $("#edit_emp_user").val(res.username),
                $("#edit_emp_pass").val(res.password);

            },
            error:function(err){
                console.log("error:"+err);
            }
        });
         
    }
    var i=$("#datatable tbody tr").length;
    function edit(){
    
    if($("#edit_emp_id").val()==""){
        
            $("#edit_emp_id").focus();
            return false;
        }else if($("#edit_emp_name").val()==""){
            $("#edit_emp_name").focus();
            return false;
        }else if($("#edit_emp_surename").val()==""){
            $("#edit_emp_surename").focus();
            return false;
        }else if($("#edit_emp_age").val()==""){
            $("#edit_emp_age").focus();
            return false;
        }else if($("#edit_emp_address").val()==""){
            $("#edit_emp_address").focus();
            return false;
        }else if($("#edit_emp_idcard").val()==""){
            $("#edit_emp_idcard").focus();
            return false;
        }else if($("#edit_emp_tel").val()==""){
            $("#edit_emp_tel").focus();
            return false;
        }else if($("#edit_emp_user").val()==""){
            $("#edit_emp_user").focus();
            return false;
        }else if($("#edit_emp_pass").val()==""){
            $("#edit_emp_pass").focus();
            return false;
        }
    

        else{
    
        var html="";
   
        var strid= document.getElementById('edit_emp_id').value;
        //alert(strid);
        $.ajax({
            url:"editemployee/"+strid,
            type:"POST",
            dataType:"json",
            data:"name="+$("#edit_emp_name").val()
                +"&surename="+$("#edit_emp_surename").val()+"&age="+$("#edit_emp_age").val()
                +"&id_card="+$("#edit_emp_idcard").val()  +"&address="+$("#edit_emp_address").val()
                +"&tel="+$("#edit_emp_tel").val()+"&username="+$("#edit_emp_user").val()
                +"&password="+$("#edit_emp_pass").val() +"&user_type=2",
            success:function(res){
                $("#datatable tbody").html("<tr><td align='center' colspan='10'>loading...</td></tr>");
                var no=1;
                $("#datatable tbody").html("");
                $(res).each(function(i){
                   
                    html="<tr><td align='center'>"+no+"</td><td>"+res[i].employee_id+"</td><td>"+res[i].name+"</td><td>"+res[i].surename+"</td><td>"+res[i].age+"</td><td>"+res[i].id_card+"</td><td>"+res[i].address+"</td><td>"+res[i].tel+"</td><td>"+res[i].username+"</td><td align='center'> <input type='button' value='แก้ไข' href='javascript:void(0);' onclick='showdialogedit(\""+res[i].employee_id+"\");'/><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(\""+res[i].employee_id+"\",this);'/></td></tr>";
                    no++;
                    $(html).appendTo($("#datatable tbody"));
                
                });
                alert("แก้ไขข้อมุลเรียบร้อย");
                $("#editdtata").dialog('close');
                
            },
            error:function(err){
                console.log("error:"+err);
            }
        });
    
    }
}
    
</script>

