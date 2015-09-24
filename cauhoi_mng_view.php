<?php
require_once '../Shareds/Constants.php';
require_once '../Shareds/phantrang.php';
require_once Constants::$CauHoi_model_child_url;
require_once Constants::$CauHoi_mng_ctrl_child_url;

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../Css/css_SP.css">
        <script src="../js/jquery-2.1.1.min.js" ></script>
        <script type="text/javascript">
              $(document).ready(function ()
            {
                
                var id = document.getElementById('txt_id').value;
                if (id.length > 0) {
                    document.getElementById('btn_update').style.display = "inline";
                }
                else {
                    document.getElementById('btn_update').style.display = "none";
                }
             $("#btn_search").click(function () {
                    $search_value = $("#txt_search_val").val();
                    $search_type = $("input[name=radio_search]:checked").val();

                    $.ajax({
                        url: "../Controls/CauHoi_mng_ctrl.php",
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
                                    "<th> Mã câu hỏi</th>" +
                                    "<th> Tên câu hỏi </th>" +
                                    "<th> Sửa</th>" +
                                    "<th> Xóa </th>" +
                                    "</tr>";
                            for (var i = 0; i < $rs.length; i++)
                            {
                                //document.getElementById("search_result").innerHTML +=
                                $("#tbl_show_data").append(
                                        "<tr>"
                                        + "<td>"
                                        + $rs[i].IDCH
                                        + "</td>"
                                        + "<td>"
                                        + $rs[i].TenCH
                                        + "</td>"
                                        
     
                                    +  "<td> <a href='?conten=abc&sub=5&id=" + $rs[i].IDCH + "&ten="+ $rs[i].TenCH + "'>Sửa</a></td>"
                     
                                   + "<td> <a  href='../Controls/CauHoi_mng_ctrl.php?id="+ $rs[i].IDCH + "&act=2' onclick='return confirm_del();'>Xóa</a></td>"
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
                 window.location = './trangchu_mng_view.php?conten=abc&sub=5';
            }
            
            function confirm_del()
            {
                if (confirm("Bạn có chắc chắn xóa trường này không?") === true) {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            
             function call_ctrl()
            {
                if(  validate_txtbox()==true){
                var id = document.getElementById("txt_id").value;
                var new_name = document.getElementById("txt_Name").value;
                window.location = "../Controls/CauHoi_mng_ctrl.php?id=" + id + "&ten=" + new_name + "&act=3";
            }}
            function validate_txtbox()
            {
                var name = document.getElementById('txt_Name').value;
                if (name === '') {
                    alert('Trường tên câu hỏi không được để trống');
                    document.getElementById('txt_Name').focus();
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
    <center>
         <!--Hiển thị dl trong bảng-->
     <div class= "div_content">
         <h2>Dữ liệu bảng câu hỏi</h2>
         <?php echo @$_REQUEST['tb']?>
            <table  id="tbl_show_data" class="tbl_show_data"  border="1" cellspacing="0">
       <tr>
                    <th style="width:5%;"> Mã Câu Hỏi </th>
                    <th style="width:35%;"> Tên Câu Hỏi</th>
                    <th style="width:5%;" > Sửa</th>
                    <th style="width:5%;"> Xóa</th>
       </tr>
 <!--Hiển thị tùng bản ghi của dữ liệu trong bảng-->
                <?php
 
             $num_of_page = ceil(CauHoi_model::get_num_of_row_CauHOi() / Constants::$num_on_page);
                $page_current = @$_REQUEST['page'];
                //validate data
                if ($page_current == NULL | $page_current <= 0) {
                    $page_current = 1;
                } else {
                    if ($page_current > $num_of_page) {
                        $page_current = $num_of_page;
                    }
                }
               
              //  $data = NhaSX_model::Load_NhaSX_by_paging($page_current);
               $data = CauHoi_model::Load_CauHoi_by_paging($page_current);
                if ($data != NULL) {
                    foreach ($data as $dt) {
                        echo "<tr>";
                        echo "<td>" . $dt['IDCH'] . "</td>";
                        echo "<td>" . $dt['TenCH'] . "</td>";
                        echo "<td> <a href='?conten=abc&sub=5&id=" . $dt['IDCH'] . "&ten=" . $dt['TenCH'] . "' > Sửa </a> </td>";
                       echo "<td> <a  href='".Constants::$CauHoi_mng_ctrl_child_url."?id=".$dt['IDCH']."&act=".Constants::$delete_act."' onclick='return confirm_del();'>Xóa</a></td>";
                        echo "</tr>";
                      
                    }
                }
                ?>

              </table>
          <?php
         phantrang::show_page(Constants::$trangchu."?conten=abc&sub=5", $num_of_page, $page_current);
            ?> 
         </div>
         <!--Tìm kiếm-->
        <!--View search-->
          
        <div class="div_search">
           <h2>Tìm kiếm nhà sản xuất:</h2>
            <table>
                <tr>
                    <td>Nhập vào giá trị tìm kiếm</td>
                    <td><input type="text" name="txt_search_val" id="txt_search_val"></td>
                </tr>
                <tr>
                    <td>Lựa chọn tiêu chí tìm kiếm</td>
                    <td>
                        <!--Radio button-->
                        <input type="radio" name="radio_search" checked value="<?php echo Constants::$search_by_ID; ?>"> Mã CH
                        <input type="radio" name="radio_search" value="<?php echo Constants::$search_by_Name; ?>"> Tên CH
   
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="button"  value="Tìm kiếm" id="btn_search" >
                    </td>
                </tr>
            </table> 
          <!--Hiển thị điều khiển cập nhật-->
       
            <h2> Thông tin nhà cung cấp</h2>
            <form action="<?php echo Constants::$CauHoi_mng_ctrl_child_url."?act=".Constants::$insert_act; ?>" method ="POST">
                <table name="tbl_TT_NhaSX" id="tbl_TT_NhaSX">
                    <tr>
                        <td>Tên câu hỏi:</td>
                        <td><input type="text" name="txt_Name" id="txt_Name" value="<?php echo @$_REQUEST['ten']; ?>" ></td>
                    </tr>
                    <tr>
                        <td align="right"><input type="submit" value="Thêm Mới" onclick="return validate_txtbox();"></td>
                        <td ><input type="button" value="Cập nhật" id="btn_update" onclick=" call_ctrl();">
                             <input type="button" value="Hủy" id="btn_cancel" onclick=" action_cancel();"></td>
                    </tr>
                </table>
                <input type="hidden" value="<?php echo @$_REQUEST['id']; ?>" id="txt_id"></td>
            </form>
       
        </div>
        
         </center>
    </body>
</html>
