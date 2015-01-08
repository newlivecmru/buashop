<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="utf-8">
        <title>templateAdmin</title>
        <script src="<?php echo base_url(); ?>asset/javascript/jquery-1.11.2.min.js"></script>
         <script src="<?php echo base_url(); ?>asset/javascript/jquery-1.10.2.js"></script>
          <script src="<?php echo base_url(); ?>asset/javascript/jquery-ui-1.10.4.custom.js"></script>
                   <script src="<?php echo base_url(); ?>asset/javascript/select2.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/leftmenu.css" />
             <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/select2.css" />
           <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/jquery-ui-1.10.4.custom.css" />


        <script>
            $(document).ready(function(){
                $("#nav ol li").hover(function(){
                    $("ol",this).show();
                },
                function(){
                    $("ol",this).hide();
                });
            });
            

        </script>
        <script>
            $(document).ready(function(){
                $('#cssmenu > ul > li > a').click(function() {
                    $('#cssmenu li').removeClass('active');
                    $(this).closest('li').addClass('active');	
                    var checkElement = $(this).next();
                    if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                        $(this).closest('li').removeClass('active');
                        checkElement.slideUp('normal');
                    }
                    if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                        $('#cssmenu ul ul:visible').slideUp('normal');
                        checkElement.slideDown('normal');
                    }
                    if($(this).closest('li').find('ul').children().length == 0) {
                        return true;
                    } else {
                        return false;	
                    }		
                });
            });
        </script>
    </head>

    <body>
        <div id="vrapper">
            <div id="header">
                <h1>BUA SHOP - (administrator)</h1>
            </div>
        </div>

        <div id="nav">
            <ol>
                <li><a href='#'>ออกจากระบบ</a></li>
                </li>
            </ol>
        </div>

        <div id="content">
            <div id="left-side">
                <div id='cssmenu'>
                    <ul>
                        <li class='active'><a href='index.html'><span>Home</span></a></li>
                        <li class='has-sub'><a href='#'><span>จัดการข้อมูล</span></a>
                            <ul>
                                <li><a href='<?php echo base_url(); ?>index.php/admin/employee'><span>พนักงาน</span></a></li>
                                <li><a href='<?php echo base_url(); ?>index.php/admin/product_type'><span>ประเภทสินค้า</span></a></li>
                                 <li><a href='<?php echo base_url(); ?>index.php/admin/supplier'><span>ผู้ขาย</span></a></li>
                                <li><a href='<?php echo base_url(); ?>index.php/admin/product'><span>สินค้า</span></a></li>
                                <li class='last'><a href='<?php echo base_url(); ?>index.php/admin/admins'><span>ผู้ดูแลระบบ</span></a></li>
                            </ul>
                        </li>
                        <li class='has-sub'><a href='#'><span>สินค้าคงคลัง</span></a>
                            <ul>
                                <li><a href='<?php echo base_url(); ?>index.php/admin/purchase'><span>การสั่งซื้อ</span></a></li>
                                <li><a href='<?php echo base_url(); ?>index.php/admin/receive'><span>การรับสินค้า</span></a></li>
                                <li><a href='<?php echo base_url(); ?>index.php/admin/print_purch'><span>พิมพ์ใบสั่งซื้อ</span></a></li>
                                 <li ><a href='<?php echo base_url(); ?>index.php/admin/cancel_purch'><span>ยกเลิกรายการสั่งซื้อ</span></a></li>
                                <li class='last'><a href='<?php echo base_url(); ?>index.php/admin/cancel_rec'><span>ยกเลิกรายการรับสินค้า</span></a></li>
                               
                            </ul>
                        </li>
                        <li class='has-sub'><a href='#'><span>ออกรายงาน</span></a>
                            <ul>
                                <li><a href='<?php echo base_url(); ?>index.php/admin/report_sellling'><span>การขายสินค้า</span></a></li>
                                <li><a href='<?php echo base_url(); ?>index.php/admin/report_purchase'><span>การรับสินค้า</span></a></li>
                                <li class='last'><a href='<?php echo base_url(); ?>index.php/admin/reorder_point'><span>สินค้าที่ต้องสั่งซื้อ</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
            <div id="right-side">