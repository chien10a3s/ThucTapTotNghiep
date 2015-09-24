<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once '../Shareds/Constants.php';
require_once Constants::$SP_mng_model_child_url;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <script src="../js/jquery-2.1.1.min.js" ></script> 
        <script type="text/javascript">
            //bat su kien chi cho phep nhap so
            function keys(e)
            {
                var keyword = null;
                if (window.event)
                {
                    keyword = window.event.keyCode;
                } else
                {
                    keyword = e.which; //NON IE;
                }
                if (keyword < 48 || keyword > 57)
                {
                    if (keyword == 48 || keyword == 127)
                    {
                        return;
                    }
                    return false;
                }
            }
            //su kien nut them va nut update 
            $(document).ready(function ()
            {
                var id = document.getElementById('txt_id').value;
                if (id.length > 0) {
                    document.getElementById('btn_update').style.display = "inline";
                    document.getElementById('btn_them').style.display = "none";
                }
                else {
                    document.getElementById('btn_them').style.display = "inline";
                    document.getElementById('btn_update').style.display = "none";
                }

            });
            //cac truong khong duoc de rong

            function validate_txtbox()
            {
                var name = document.getElementById('txt_name').value;
                var price = document.getElementById('txt_price').value;
                var soluong = document.getElementById('txt_soluongcon').value;

                if (name === '') {
                    alert('Trường tên không được để trống');
                    document.getElementById('txt_name').focus();
                    return false;
                }
                else if (price === '')
                {
                    alert('Truong Gia khong duoc de rong');
                    document.getElementById('txt_price').focus();
                    return false;
                }
                else if (soluong === '')
                {
                    alert('truong so luong khong duoc de rong');
                    document.getElementById('txt_soluongcon').focus();
                    return false;
                }
                else
                {
                    return true;
                }
            }

            //update san pham
            function call_ctr()
            {
                var id = document.getElementById("txt_id").value;
                var new_name = document.getElementById("txt_name").value;
                var new_IDNhomSP = document.getElementById("Id_nhomSP").value;
                var new_price = document.getElementById("txt_price").value;
                var new_image = document.getElementById("txt_image").value;
                var new_IDNhaSX = document.getElementById("Id_nhaSX").value;
                var new_soluongcon = document.getElementById("txt_soluongcon").value;
                var new_kichthuoc = document.getElementById("txt_kichthuoc").value;
                var new_trongluong = document.getElementById("txt_trongluong").value;
                var new_amthanh = document.getElementById("txt_amthanh").value;
                var new_bonho = document.getElementById("txt_bonho").value;
                var new_ram = document.getElementById("txt_ram").value;
                var new_HDH = document.getElementById("txt_HDH").value;
                var new_thenho = document.getElementById("txt_thenho").value;
                var new_camera = document.getElementById("txt_camera").value;
                var new_pin = document.getElementById("txt_pin").value;
                var new_baohanh = document.getElementById("txt_baohanh").value;
                var new_mota = document.getElementById("txt_mota").value;
                window.location = "../Controls/SP_mng_ctrl.php?id=" + id + "&ten=" + new_name + "&ID_NhomSP=" + new_IDNhomSP + "&price=" + new_price + "&image=" + new_image + "&ID_NhaSX=" + new_IDNhaSX + "&soluongcon=" + new_soluongcon + "&kichthuoc=" + new_kichthuoc + "&trongluong=" + new_trongluong + "&amthanh=" + new_amthanh + "&bonho=" + new_bonho + "&ram=" + new_ram + "&HDH=" + new_HDH + "&thenho=" + new_thenho + "&camera=" + new_camera + "&pin=" + new_pin + "&baohanh=" + new_baohanh + "&mota=" + new_mota + "&act=3";
            }
        </script>
    </head>
    <body>
    <center>
        <form action="<?php echo Constants::$SP_mng_ctrl_child_url . "?act=" . Constants::$insert_act; ?>" method="POST" enctype="multipart/form-data">
            <table name="tbl_TT_SP" id="tbl_TT_SP" border="1" cellpading="5" cellspacing="5">            
                <tr>
                    <td>Tên Sản Phẩm :</td>
                    <td><input type="text" name="txt_name" id="txt_name" value="<?php echo @$_REQUEST['ten']; ?>"></td>
                </tr>
                <tr>
                    <td>Tên Nhóm SP</td>
                    <td>
                        <select id="Id_nhomSP" name="Id_nhomSP">
                            <?php
                            $a = @$_REQUEST['ID_NhomSP'];
                            
                            $data = SP_model::Load_ID_Nhom_SP();
                            if ($data != NULL) {
                                foreach ($data as $dt) {
                                    if ($dt['TenNhomSP'] == $a) {
                                        echo "<option value=" . $dt['IDNhomSP'] . " selected >";
                                    } else {
                                        echo "<option value=" . $dt['IDNhomSP'] . ">";
                                    }
                                    echo  $dt['TenNhomSP'] ;
                                    echo "</option>";
                                }
                            }
                            //echo $a;
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Giá :</td>
                    <td><input type="text" name="txt_price" id="txt_price" value="<?php echo @$_REQUEST['price']; ?>" onkeypress="return keys(event)"></td>
                </tr>
                <tr>
                    <td>Ảnh :</td>
                    <td><input type="file" name="txt_image" id="txt_image" value="<?php echo @$_REQUEST['image']; ?>"></td>
                </tr>
                <tr>
                    <td>Tên nhà Sản Xuất :</td>
                    <td>
                        <select id="Id_nhaSX" name="Id_nhaSX" >
                            <?php
                            $a = @$_REQUEST['ID_NhaSX'];
                            $data = SP_model::Load_ID_NhaSX();
                            if ($data != NULL) {
                                foreach ($data as $dt) {
                                    if ($dt['TenNSX'] == $a) {
                                        echo "<option value=" . $dt['IDNhaSX'] . " selected >";
                                    } else {
                                        echo "<option value=" . $dt['IDNhaSX'] . ">";
                                    }
                                    echo  $dt['TenNSX'] ;
                                    echo "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Số Lượng còn :</td>
                    <td><input type="text" name="txt_soluongcon" id="txt_soluongcon" value="<?php echo @$_REQUEST['soluongcon']; ?>" onkeypress="return keys(event)"></td>
                </tr>
                <tr>
                    <td>Kích Thước</td>
                    <td><input type="text" name="txt_kichthuoc" id="txt_kichthuoc" value="<?php echo @$_REQUEST['kichthuoc']; ?>"></td>
                </tr>
                <tr>
                    <td>Trọng lượng :</td>
                    <td><input type="text" name="txt_trongluong" id="txt_trongluong" value="<?php echo @$_REQUEST['trongluong']; ?>"></td>
                </tr>
                <tr>
                    <td>Âm Thanh :</td>
                    <td><input type="text" name="txt_amthanh" id="txt_amthanh" value="<?php echo @$_REQUEST['amthanh']; ?>"></td>
                </tr>
                <tr>
                    <td>Bộ Nhớ Trong :</td>
                    <td><input type="text" name="txt_bonho" id="txt_bonho" value="<?php echo @$_REQUEST['bonho']; ?>"></td>
                <tr>
                    <td>RAM :</td>
                    <td><input type="text" name="txt_ram" id="txt_ram" value="<?php echo @$_REQUEST['ram']; ?>"></td>
                </tr>
                <tr>
                    <td>Hệ Điều Hành :</td>
                    <td><input type="text" name="txt_HDH" id="txt_HDH" value="<?php echo @$_REQUEST['HDH']; ?>"></td>
                </tr>
                <tr>
                    <td>Thẻ Nhớ :</td>
                    <td><input type="text" name="txt_thenho" id="txt_thenho" value="<?php echo @$_REQUEST['thenho']; ?>"></td>
                </tr>
                <tr>
                    <td>Camera :</td>
                    <td><input type="text" name="txt_camera" id="txt_camera" value="<?php echo @$_REQUEST['camera']; ?>"></td>
                </tr>
                <tr>
                    <td>Pin :</td>
                    <td><input type="text" name="txt_pin" id="txt_pin" value="<?php echo @$_REQUEST['pin']; ?>"></td>
                </tr>
                <tr>
                    <td>Bảo Hành :</td>
                    <td><input type="text" name="txt_baohanh" id="txt_baohanh" value="<?php echo @$_REQUEST['baohanh']; ?>"></td>
                </tr>
                <tr>
                    <td>Mô tả :</td>
                    <td><input type="text" name="txt_mota" id="txt_mota" value="<?php echo @$_REQUEST['mota']; ?>"></td>               
                </tr>
                <tr>
                    <td align='right'><input type="submit" name="Submit" id="btn_them" value="Thêm" onclick="return validate_txtbox();"></td>
                    <td><input type="button" name="update" id="btn_update" value="Update" onclick="call_ctr();">
                        <input type="reset" name="reset" id="btn_huy" value="Huỷ"></td>
                </tr>

            </table>
            <input type="hidden" value="<?php echo @$_REQUEST['id']; ?>" id="txt_id" >
        </form>

        <tr>

            <?php
            echo "<h4 align='right'><a href='" . Constants::$SP_mng_view_child_url . "' _blank>Trở Về Trang Chủ</a></h4>";
            ?>


    </center>
</body>
</html>
