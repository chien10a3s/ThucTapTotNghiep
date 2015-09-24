<!DOCTYPE html>
<?php
require_once '../Shareds/Constants.php';
require_once Constants::$User_mng_ctrl_child_url;
require_once Constants::$User_mng_model_child_url;
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../Js/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script type="text/javascript">

            function call_control()
            {
                var id = document.getElementById("txt_iduser").value;
                var new_name = document.getElementById("txt_tenuser").value;
                var new_ngaysinh = document.getElementById("txt_ngaysinh").value;
                var new_gioitinh = document.getElementById("gioitinh").value;
                var new_diachi = document.getElementById("txt_diachi").value;
                var new_email = document.getElementById("txt_email").value;
                var new_sdt = document.getElementById("txt_sdt").value;
                var new_username = document.getElementById("txt_username1").value;
                var new_pass = document.getElementById("txt_pass").value;
                var new_nhomquyen = document.getElementById("Id_NhomQuyen").value;
                var new_trangthai = document.getElementById("txt_trangthai").value;


                window.location = "../Controls/User_mng_ctrl.php?id=" + id + "&ten=" + new_name + "&ngaysinh=" + new_ngaysinh + "&gioitinh=" + new_gioitinh + "&diachi=" + new_diachi + "&email=" + new_email + "&sdt=" + new_sdt + "&username=" + new_username + "&pass=" + new_pass + "&nhomquyen=" + new_nhomquyen + "&trangthai=" + new_trangthai + "&act=3";

            }


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

            //An hien nut Them/Upsate
            $(document).ready(function ()
            {
                var id = document.getElementById('txt_iduser').value;
                if (id.length > 0) {
                    document.getElementById('btn_update').style.display = "inline";
                    document.getElementById('btn_them').style.display = "none";
                }
                else {
                    document.getElementById('btn_them').style.display = "inline";
                    document.getElementById('btn_update').style.display = "none";
                }

            });


            function validate_txtbox()
            {

                var email = document.getElementById('txt_email');
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filter.test(email.value))
                {
                    alert('Hay nhap dia chi email hop le.\nExample@gmail.com');
                    email.focus();
                    return false;
                }

                var name = document.getElementById('txt_tenuser').value;
                var username1 = document.getElementById('txt_username1').value;
                var pass = document.getElementById('txt_pass').value;


                if (name === '') {
                    alert('Trường tên không được để trống');
                    document.getElementById('txt_tenuser').focus();
                    return false;
                }
                else if (username1 === '')
                {
                    alert('Truong ten dang nhap khong duoc de rong');
                    document.getElementById('txt_username1').focus();
                    return false;
                }
                else if (pass === '')
                {
                    alert('truong mat khau khong duoc de rong');
                    document.getElementById('txt_pass').focus();
                    return false;
                }
                else
                {
                    return true;
                }


            }
        </script>
    </head>
    <body>


        <form action="<?php echo Constants::$User_mng_ctrl_child_url . "?act=" . Constants::$insert_act; ?>" method="POST" >

            <table name="tbl_TT_us" id="tbl_TT_us" border="1" cellpading="5" cellspacing="5">
                <tr>
                    <td>Tên Người Dùng :</td>
                    <td><input type="text" name="txt_tenuser" id="txt_tenuser" value="<?php echo @$_REQUEST['ten'] ?>"></td>
                </tr>
                <tr>
                    <td>Ngày Sinh:</td>
                    <td><input type="date" name="txt_ngaysinh" id="txt_ngaysinh" value="<?php echo @$_REQUEST['ngaysinh'] ?>"></td>
                </tr>
                <tr>
                    <td>Giới tính :</td>
                    <td><select id="gioitinh" name="gioitinh">
                            <?php
                            $a = @$_REQUEST['id'];
                            $gioitinh = @$_REQUEST['gioitinh'];
                            $nam = "nam";
                            $nu = "nu";
                            $kxd = "kxd";
                            if ($a != "") {
                                if ($gioitinh == "nam") {
                                    echo "<option value=" . $nam . " selected > Nam </option>";
                                    echo "<option value=" . $nu . "> Nữ </option>";
                                    echo "<option value=" . $kxd . "> Chưa Xác Định </option>";
                                } else if ($gioitinh == "nu") {
                                    echo "<option value=" . $nu . " selected > Nữ </option>";
                                    echo "<option value=" . $kxd . "> Chưa Xác Định </option>";
                                    echo "<option value=" . $nam . "> Nam </option>";
                                } else if ($gioitinh == "kxd") {
                                    echo "<option value=" . $kxd . "selected> Chưa Xác Định </option>";
                                    echo "<option value=" . $nam . "> Nam </option>";
                                    echo "<option value=" . $nu . "> Nữ </option>";
                                } else {
                                    echo "<option value=" . $nam . "> Nam </option>";
                                    echo "<option value=" . $nu . "> Nữ </option>";
                                    echo "<option value=" . $kxd . "> Chưa Xác Định </option>";
                                }
                            } else {
                                echo "<option value=" . $nam . "> Nam </option>";
                                echo "<option value=" . $nu . "> Nữ </option>";
                                echo "<option value=" . $kxd . "> Chưa Xác Định </option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Địa chỉ :</td>
                    <td><input type="text" name="txt_diachi" id="txt_diachi" value="<?php echo @$_REQUEST['diachi'] ?>"></td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><input type="text" name="txt_email" id="txt_email" value="<?php echo @$_REQUEST['email'] ?>"></td>
                </tr>
                <tr>
                    <td>Số Điện Thoại :</td>
                    <td><input type="text" name="txt_sdt" id="txt_sdt" value="<?php echo @$_REQUEST['sdt'] ?>"   onkeypress="return keys(event)"></td>
                </tr>
                <tr>
                    <td>Tài Khoản :</td>
                    <td><input type="text" name="txt_username1" id="txt_username1" value="<?php echo @$_REQUEST['username'] ?>"></td>
                </tr>
                <tr>
                    <td>Mật Khẩu :</td>
                    <td><input type="password" name="txt_pass" id="txt_pass" value="<?php echo @$_REQUEST['pass'] ?>"></td>
                </tr>
                <tr>



                <select id="Id_NhomQuyen" name="Id_NhomQuyen" hidden >
                    <?php
                    $a = @$_REQUEST['nhomquyen'];
                    $data = User_model::LoadNhomQuyen();
                    if ($data != NULL) {
                        foreach ($data as $dt) {
                            if ($dt['IDNhomQuyen'] == $a) {
                                echo "<option value=" . $dt['IDNhomQuyen'] . " selected >";
                            } else {
                                echo "<option value=" . $dt['IDNhomQuyen'] . ">";
                            }
                            echo $dt['TenNhomQuyen'];
                            echo "</option>";
                        }
                    }
                    ?>
                </select>

                <tr>

                <select id="txt_trangthai" name="txt_trangthai" hidden>
                    <option value="1"></option>
                </select>
                </tr>
                <tr>
                    <td><input type="submit" value="Đăng kí" id="btn_them" name="btn_them" onclick="return validate_txtbox();">
                        <input type="button" value="Cập Nhật" name="update" id="btn_update" onclick="call_control();">
                    </td>
                    <td><input type="reset" value="Huỷ"></td>
                </tr>
            </table>
            <input type="hidden" name="txt_iduser" id="txt_iduser" value="<?php echo @$_REQUEST['id']; ?>">
        </form>

    </body>
</html>
