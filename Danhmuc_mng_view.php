
<?php
require_once '../Shareds/Constants.php';
require_once Constants::$DanhMuc_model_child_url;
require_once Constants::$DanhMuc_ctrl_child_url;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
            <style type="text/css">
            
                a
                {
                    text-decoration: none;
                }

                ul.drop
                {
                    margin: 0px;
                    padding: 0px;
                    border: 1px solid #f1f1f1;
                    width: 200px;
                    list-style: none;
                }

                ul.drop li
                {
                    height: 32px;
                    line-height: 32px;
                    border-bottom: 1px solid;
                    padding-left: 5px;
                }

                ul.drop li:hover, ul.drop a:hover
                {
                    display: block;
                    position: relative;
                    background: aqua;
                }

                ul.drop li > ul.drop
                {
                    position: absolute;
                    display: none;
                    left: 195px;
                    top: -32px;
                }

                ul.drop li:hover > ul.drop
                {
                    position: relative;
                    display:block;
                }
        </style>
    </head>
    <body>
        <?php
            $dm_mng_ctrl_obj = new DanhMuc_mng_ctrl();
            $list_menu = DanhMuc_mng_model::get_DanhMucCon(0,$_SESSION['quyen']);
            $dm_mng_ctrl_obj->show_Menu($list_menu);
        // put your code here
        ?>
    </body>
</html>
