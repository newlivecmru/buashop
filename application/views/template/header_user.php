<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="utf-8">
        <title>templateUser</title>
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
                <h1>BUA SHOP </h1>
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
                        <li class='has-sub'><a href='#'><span>ขายสินค้า</span></a>
                            <ul>
                                <li><a href='<?php echo base_url(); ?>index.php/user/selling'><span>ขายสินค้า</span></a></li>
                                <li><a href='<?php echo base_url(); ?>index.php/user/cancle_selling'><span>ยกเลิกใบเสร็จ</span></a></li>
                                <li class='last'><a href='<?php echo base_url(); ?>index.php/user/print_selling'><span>พิมพ์ใบเสร็จ</span></a></li>
                            </ul>
                        </li>

                    </ul>
                </div>

            </div>
            <div id="right-side">