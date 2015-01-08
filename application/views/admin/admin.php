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
                <th width="50">รหัส</th>
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
    <h3><u>ฟอร์ม เพิ่มข้อมูลผู้ดูแลระบบ</u></h3>
    <fieldset>
        <table >

            <tr>
                <td class="heightform2">รหัส</td>
                <td>
                    <input type="text" name="admin_id" value="" id="admin_id" disabled/>
                </td>

                <td class="heightform2">ชื่อ</td>
                <td>
                    <input type="text" name="admin_name" value="" id="admin_name"/>
                </td>
            </tr>
            <tr>
                <td class="heightform2">นามสกุล</td>
                <td>
                    <input type="text" name="admin_surename" value="" id="admin_surename"/>
                </td>
                <td class="heightform2">อายุ</td>  
                <td><input type="text" name="admin_age" value="" id="admin_age" onKeyPress="return chkNumber(this)"/></td>


            </tr>
            <tr>
                <td class="heightform2"  >ที่อยู่</td>
                <td colspan="3">
                    <textarea name="admin_address" id="admin_address"  value="" row="10" cols="47"  style=" height: 70px"></textarea>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">รหัสบัตรประชาชน</td>
                <td>
                    <input type="text" name="admin_idcard" value="" id="admin_idcard" onKeyPress="return chkNumber(this)"/>
                </td>

                <td class="heightform2">เบอร์โทร</td>
                <td>
                    <input type="text" name="admin_tel" value="" id="admin_tel" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">ชื่อผู้ใช้</td>
                <td>
                    <input type="text" name="admin_user" value="" id="admin_user"/>
                </td>
                </td>

                <td class="heightform2">รหัสผ่าน</td>
                <td>
                    <input type="text" name="admin_pass" value="" id="admin_pass"/>
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
    <h3><u>ฟอร์ม แก้ไขข้อมูลผู้ดูแลระบบ</u></h3>
    <fieldset>
        <table >

            <tr>
                <td class="heightform2">รหัส</td>
                <td>
                    <input type="text" name="edit_admin_id" value=""  id="edit_admin_id" disabled/>

                </td>

                <td class="heightform2">ชื่อ</td>
                <td>
                    <input type="text" name="edit_admin_name" value="" id="edit_admin_name"/>
                </td>
            </tr>
            <tr>
                <td class="heightform2">นามสกุล</td>  
                <td><input type="text" name="edit_admin_surename" value="" id="edit_admin_surename"/></td>

                <td class="heightform2">อายุ</td>  
                <td><input type="text" name="edit_admin_age" value="" id="edit_admin_age" onKeyPress="return chkNumber(this)"/></td>
            </tr>
            <tr>
                <td class="heightform2">ที่อยู่</td>
                <td colspan="3">
                    <textarea name="edit_admin_address" id="edit_admin_address" value="" row="10" cols="47"  style=" height: 70px" ></textarea>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">เลขบัตรประชาชน</td>
                <td>
                    <input type="text" name="edit_admin_idcard" value="" id="edit_admin_idcard" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
                <td class="heightform2">เบอร์โทร</td>
                <td>
                    <input type="text" name="edit_admin_tel" value="" id="edit_admin_tel" onKeyPress="return chkNumber(this)"/>
                </td>
                </td>
            </tr>
            <tr>
                <td class="heightform2">รหัสผู้ใช้</td>
                <td>
                    <input type="text" name="edit_admin_user" value="" id="edit_admin_user"/>
                </td>
                </td>

                <td class="heightform2">รหัสผ่าน</td>
                <td>
                    <input type="text" name="edit_admin_pass" value="" id="edit_admin_pass"/>
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
                $("#admin_id").val(res.maxid)
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
        if($("#admin_id").val()==""){
        
            $("#admin_id").focus();
            return false;
        }else if($("#admin_name").val()==""){
            $("#admin_name").focus();
            return false;
        }else if($("#admin_surename").val()==""){
            $("#admin_surename").focus();
            return false;
        }else if($("#admin_age").val()==""){
            $("#admin_age").focus();
            return false;
        }else if($("#admin_address").val()==""){
            $("#admin_address").focus();
            return false;
        }else if($("#admin_idcard").val()==""){
            $("#admin_idcard").focus();
            return false;
        }else if($("#admin_tel").val()==""){
            $("#admin_tel").focus();
            return false;
        }else if($("#admin_user").val()==""){
            $("#admin_user").focus();
            return false;
        }else if($("#admin_pass").val()==""){
            $("#admin_pass").focus();
            return false;
        }
    

        else{
            var i=$("#datatable tbody tr").length;
            $.ajax({
                url:"createadmin",
                type:"POST", 
                cache:false,
                dataType:"json",
                data:"employee_id="+$("#admin_id").val()+"&name="+$("#admin_name").val()
                    +"&surename="+$("#admin_surename").val()+"&age="+$("#admin_age").val()
                    +"&id_card="+$("#admin_idcard").val()  +"&address="+$("#admin_address").val()
                    +"&tel="+$("#admin_tel").val()+"&username="+$("#admin_user").val()
                    +"&password="+$("#admin_pass").val() +"&user_type=1",
                success:function(res){
                    // if(res=="ok"){
                    i++;
                    $(".showtotal").text(i);
                    var html="<tr><td align='center'>"+i+"</td><td>"+res.employee_id+"</td><td>"+res.name+"</td><td>"+res.surename+"</td><td>"+res.age+"</td><td>"+res.id_card+"</td><td>"+res.address+"</td><td>"+res.tel+"</td><td>"+res.username+"</td><td align='center'> <input type='button' value='แก้ไข' href='javascript:void(0);' onclick='showdialogedit(\""+res.employee_id+"\");'/><input type='button' value='ลบ' href='javascript:void(0);' onclick='del(\""+res.employee_id+"\",this);'/></td></tr>";
                    $(html).appendTo("#datatable tbody");
                        
                        
                    $("#admin_id").val(""),
                    $("#admin_name").val(""),
                    $("#admin_surename").val(""),
                    $("#admin_age").val(""),
                    $("#admin_idcard").val(""),
                    $("#admin_address").val(""),
                    $("#admin_tel").val(""),
                    $("#admin_user").val(""),
                    $("#admin_pass").val("");
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
        $("#admin_id").val(""),
        $("#admin_name").val(""),
        $("#admin_surename").val(""),
        $("#admin_age").val(""),
        $("#admin_idcard").val(""),
        $("#admin_address").val(""),
        $("#admin_tel").val(""),
        $("#admin_user").val(""),
        $("#admin_pass").val("");
    });
    
    
    function del(id,obj){
        var conf=confirm('ต้องการลบหรือไม่');
        if(conf){
            $.ajax({
                url:"deladmin/"+id,
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
            url:"geteditadmin/"+id,
            type:"POST",
            dataType:"json",
             
            success:function(res){
                $("#edit_admin_id").val(res.employee_id),
                $("#edit_admin_name").val(res.name),
                $("#edit_admin_surename").val(res.surename),
                $("#edit_admin_age").val(res.age),
                $("#edit_admin_idcard").val(res.id_card),
                $("#edit_admin_address").val(res.address),
                $("#edit_admin_tel").val(res.tel),
                $("#edit_admin_user").val(res.username),
                $("#edit_admin_pass").val(res.password);

            },
            error:function(err){
                console.log("error:"+err);
            }
        });
         
    }
    var i=$("#datatable tbody tr").length;
    function edit(){
    
        if($("#edit_admin_id").val()==""){
        
            $("#edit_admin_id").focus();
            return false;
        }else if($("#edit_admin_name").val()==""){
            $("#edit_admin_name").focus();
            return false;
        }else if($("#edit_admin_surename").val()==""){
            $("#edit_admin_surename").focus();
            return false;
        }else if($("#edit_admin_age").val()==""){
            $("#edit_admin_age").focus();
            return false;
        }else if($("#edit_admin_address").val()==""){
            $("#edit_admin_address").focus();
            return false;
        }else if($("#edit_admin_idcard").val()==""){
            $("#edit_admin_idcard").focus();
            return false;
        }else if($("#edit_admin_tel").val()==""){
            $("#edit_admin_tel").focus();
            return false;
        }else if($("#edit_admin_user").val()==""){
            $("#edit_admin_user").focus();
            return false;
        }else if($("#edit_admin_pass").val()==""){
            $("#edit_admin_pass").focus();
            return false;
        }
    

        else{
    
            var html="";
   
            var strid= document.getElementById('edit_admin_id').value;
            //alert(strid);
            $.ajax({
                url:"editadmin/"+strid,
                type:"POST",
                dataType:"json",
                data:"name="+$("#edit_admin_name").val()
                    +"&surename="+$("#edit_admin_surename").val()+"&age="+$("#edit_admin_age").val()
                    +"&id_card="+$("#edit_admin_idcard").val()  +"&address="+$("#edit_admin_address").val()
                    +"&tel="+$("#edit_admin_tel").val()+"&username="+$("#edit_admin_user").val()
                    +"&password="+$("#edit_admin_pass").val() +"&user_type=1",
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

