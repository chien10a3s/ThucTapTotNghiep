<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once '../Shareds/Constants.php';
require_once Constants::$HoaDon_model_child_url;
require_once Constants::$HoaDon_mng_ctrl_child_url;
require_once '../Shareds/phantrang.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../Css/css_SP.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript">
             function call_ctrl(){
                 
                var id = document.getElementById('txt_id').value;
                var new_tthai=document.getElementById('txt_trangthai').value;
                window.location="../Controls/HoaDon_mng_ctrl.php?id="+id+"&idtt="+new_tthai+ "&act=3";
         
    } 
    
             $(document).ready(function(){
                var id=document.getElementById('txt_id').value;
                if(id.length>0){
                    document.getElementById('btn_update').style.display="inline";
                }else{
                      document.getElementById('btn_update').style.display="none";
                }
                $("#btn_search").click(function () {
                    $search_value = $("#txt_search_val").val();
                    $search_type = $("input[name=radio_search]:checked").val();

                    $.ajax({
                        url: "../Controls/HoaDon_mng_ctrl.php",
                        type: "POST",
                        data:
                                {
                                    "search_val": $search_value,
                                    "search_type": $search_type,
                                    "act": "4",
                                },
                        success: function (r)
                        {
                            $rs = $.parseJSON(r);
                            document.getElementById("tbl_show_data").innerHTML =
//                            $.("#tbl_search_rs").html(
                                    "<tr>" +
                                    "<th> Mã hóa đơn</th>" +
                                    "<th> Tên khách hàng</th>" +
                                    "<th> Trạng Thái </th>" +
                                    "<th> Mã khuyến mại </th>" +
                                    "<th> Tổng tiền </th>" +
                                    "<th> Ngày lập </th>" +
                                     "<th> Sửa </th>" +
                                  
                                    "</tr>";
                            for (var i = 0; i < $rs.length; i++)
                            {
                                $("#tbl_show_data").append(
                                        "<tr>"
                                        + "<td>"
                                        + $rs[i].IDHD
                                        + "</td>"
                                        + "<td>"
                                        + $rs[i].TenUser
                                        + "</td>"
                                         + "<td>"
                                        + $rs[i].TrangThai
                                        + "</td>"
                                        + "<td>"
                                        + $rs[i].IDKM
                                        + "</td>"
                                        + "<td>"
                                        + $rs[i].TongTien
                                        + "</td>"
                                       + "<td>"
                                        + $rs[i].NgayLap
                                        + "</td>"
                                  +  "<td> <a href='?conten=abc&sub=4&id=" + $rs[i].IDHD + "&idkh=="+ $rs[i].IDKH +"&trangthai="+ $rs[i].TrangThai + "&tenkh="+ $rs[i].TenUser + "'>Sửa</a></td>"                               
                               // echo "<td> <a href='?id=".$dt['IDHD'] . "&idkh=".$dt['IDKH'] . "&trangthai=" . $dt['TrangThai'] . "&tenkh=" . $dt['TenUser'] . "' > Sửa </a> </td>";
                                        + "</tr>");
                            }
                            ;
                        },
                        error: function ()
                        {
                            
                            alert('Có lỗi xảy ra');
                        }

                    });
                });
                      });
                       function action_cancel()
            {
                  window.location = './trangchu_mng_view.php?conten=abc&sub=4';
            }
        </script>
    </head>
    <body>
        <center>
         
        <!--Hiển thị dữ liệu trong bảng-->
        <div class="div_content" >
            <h2>Dữ liệu bảng Hóa đơn</h2>
               <?php echo @$_REQUEST['tb']?>
              <table  id="tbl_show_data" class="tbl_show_data"  border="1" cellspacing="0">
                <tr>
                    <th style=""> Mã Hóa Đơn</th>
                    <th style=""> Tên Khách hàng</th>
                    <th style=""> Trạng Thái </th>
                    <th style=""> Mã KM </th>
                    <th style=""> Tổng Tiền </th>
                    <th style=""> Ngày Lập </th>
                    <th > Sửa</th>
                </tr>

                <!--Hiển thị tùng bản ghi của dữ liệu trong bảng-->
                <?php
               $num_of_page = ceil(HoaDon_model::get_num_of_row_hd()/Constants::$num_on_page);
                
                $page_current=@$_REQUEST['page'];
                // validate
                if($page_current==NULL|$page_current<=0){
                    $page_current=1;
                }else{
                    if($page_current>$num_of_page){
                        $page_current=$num_of_page;
                    }
                }
                   $data = HoaDon_model::Load_hd_by_paging($page_current);
                if ($data != NULL) {
                    foreach ($data as $dt) {
                        echo "<tr>";
                        echo "<td>" . $dt['IDHD'] . "</td>";
                        echo "<td>" . $dt['TenUser'] . "</td>";
                        echo "<td>" . $dt['TrangThai'] . "</td>";
                        echo "<td>" . $dt['IDKM'] . "</td>";
                        echo "<td>" . $dt['TongTien'] . "</td>";
                        echo "<td>" . $dt['NgayLap'] . "</td>";
                      
                        echo "<td> <a href='?conten=abc&sub=4&id=".$dt['IDHD'] . "&idkh=".$dt['IDKH'] . "&trangthai=" . $dt['TrangThai'] . "&tenkh=" . $dt['TenUser'] . "' > Sửa </a> </td>";
                       
                        echo "</tr>";
                    }
                }
                
                ?>

            </table>
            <?php
             phantrang::show_page(Constants::$trangchu."?conten=abc&sub=4", $num_of_page, $page_current);
            ?>

        </div>
        <!--Hiển thị điều khiển cập nhật-->
        <div class="div_search" >
             <!-- hien thi Tim kiem -->
               <h2 align="center">Tìm kiếm hóa đơn </h2>
                <table align="center">
                    <tr>
                        <td>Nhập tìm kiếm:</td>
                        <td><input type="text" name="txt_search_val" id="txt_search_val"></td>
                    </tr>
                    <tr>
                        <td>Chọn tìm kiếm:</td>
                        <td>
                            <input type="radio" name="radio_search" checked value="<?php echo Constants::$search_by_ID; ?>"> Mã
                                 <input type="radio" name="radio_search"  value="<?php echo Constants::$search_by_Name; ?>"> Tên KH
                                 
                             <input type="radio" name="radio_search" value="<?php echo Constants::$search_by_NgayBD; ?>">Ngày Lập
                              
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="button" value="Tìm kiếm" id ="btn_search">
                        </td>
                    </tr>
                </table>
                
            <h2> Thông tin hóa đơn </h2>
            <form action="<?php echo Constants::$KhuyenMai_mng_ctrl_child_url."?act=".Constants::$insert_act; ?>" method ="POST">
                <table name="tbl_TT_KhuyenMai" id="tbl_TT_KhuyenMai">   
                    <tr>
                        <td>Mã hóa đơn:</td>
                         <td><input type="text" disabled="" name="txt_id" id="txt_id" value="<?php echo @$_REQUEST['id']; ?>"></td>
                    </tr>
                    <tr>
                         <td>Tên khách hàng:</td>
                         <td><input type="text" name="txt_tenKH" disabled="" id="txt_tenKH" value="<?php echo @$_REQUEST['tenkh']; ?>"></td>
                    </tr>
                    <tr>
                    <td>Trạng Thái :</td>
                    <td><select id="txt_trangthai" name="txt_trangthai">
<?php
$a = @$_REQUEST['id'];
$trangthai = @$_REQUEST['trangthai'];
$hd = 0;
$khd = 1;
if ($a != "") {
    if ($trangthai == 1) {
        echo "<option value=" .$khd  . " selected > Đã xử lí </option>";
        echo "<option value=" . $hd . "> Chưa xử lí </option>";
    } else if ($trangthai == 0) {
        echo "<option value=" . $hd . " selected > Chưa xử lí </option>";
        echo "<option value=" . $khd  . "> Đã xử lí </option>";
    } else {
        echo "<option value=" . $khd  . "> Đã xử lí </option>";
        echo "<option value=" . $hd. "> Chưa xử lí </option>";
    }
} else {
    echo "<option value=" . $khd . "> Đã xử lí </option>";
    echo "<option value=" . $hd. "> Chưa xử lí </option>";
}
?>

                        </select></td>
                </tr>
           
                    <tr>
  
                        <td ><input type="button" value="Cập nhật" id="btn_update" onclick="call_ctrl();">
                            <input type="button" value="Hủy" id="btn_cancel" onclick=" action_cancel();"></td>
                    </tr>
                </table>
                <input type="hidden" value="<?php echo @$_REQUEST['id']; ?>" id="txt_id"></td>
            </form>
            
        </div>
        </center>
        <?php
        // put your code here
        ?>
    </body>
</html>
