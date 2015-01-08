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
            <td class="heightform2"  >ประเภทสินค้า</td>
            <td>
                <select name="ddlType" id="ddlType" style="width:140px" >
                     <option  value="" ></option>
                        <? foreach ($product_type->result() as $row) { ?>
                            <option value="<?= $row->product_type_id ?>"><?= $row->product_type_des ?></option>
                        <? } ?>
                    </select>
            </td>
             <td class="heightform2"  >รหัส/ชื่อสินค้า</td>
            <td>
               <select name="ddlproduct" id="ddlproduct" style="width:180px" onchange="getchange();">
                    <option  value="" ></option>
                    <? foreach ($product->result() as $row) { ?>
                        <option value="<?= $row->product_id ?>"><?= $row->product_id . ' : ' . $row->product_des ?></option>
                    <? } ?>
                </select>
            </td>

            </td>

            <td class="heightform2" colspan="4" style=" padding-left: 20px;"  >
                <input type="button"  name="btnsearch" value="ค้นหา"  /> 

            </td>

        </tr>
    </table>
        </fieldset>
</div>
<div id="contentform" class="contentforms">
    <br/>

    <fieldset>
        <legend><b>จัดการข้อมูล</b></legend>
        <input type="button"  name="print" value="Export Excel"  />
        <div id="showdata" style=" padding-top: 10px;">
            <table border="1" class="hovertable">
                <thead>
                <th width="50">ลำดับ</th>
                <th width="120">เลขที่การขาย</th>
                <th width="100">รหัสสินค้า</th>
                <th width="150">ชื่อสินค้า</th>
                <th width="100">จำนวนที่ขาย</th>
                <th width="100">ราคา:หน่วย</th>
                <th width="100">หน่วยนับ</th>
                <th width="100">ราคารวม</th>
     

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
        $("#ddlType").select2();
        $("#ddlproduct").select2();
        $("#datestart").datepicker({dateFormat: 'yy-mm-dd'});
        $("#dateend").datepicker({dateFormat: 'yy-mm-dd'});
      
    });
 </script>

