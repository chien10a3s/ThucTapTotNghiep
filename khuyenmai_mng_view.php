<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once '../Shareds/Constants.php';
require_once Constants::$KhuyenMai_model_child_url;
require_once Constants::$KhuyenMai_mng_ctrl_child_url;
require_once '../Shareds/phantrang.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
       
        <link href="../Css/css_SP.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript">
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
                        url: "../Controls/KhuyenMai_mng_ctrl.php",
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
                                    "<th> Mã khuyến mại</th>" +
                                    "<th> Tên SP </th>" +
                                    "<th> Giá khuyến mại </th>" +
                                    "<th> Ngày bắt đầu </th>" +
                                    "<th> Ngày kết thúc </th>" +
                                    "<th> Mô tả </th>" +
                                    "<th> Sửa </th>" +
                                    "<th>Xóa  </th>" +
                                    "</tr>";
                            for (var i = 0; i < $rs.length; i++)
                            {
                                //document.getElementById("search_result").innerHTML +=
                                $("#tbl_show_data").append(
                                        "<tr>"
                                         + "<td>"
                                        + $rs[i].IDKM
                                        + "</td>"
                                        + "<td>"
                                        + $rs[i].TenSP
                                        + "</td>"
                                        + "<td>"
                                        + $rs[i].GiaKM
                                        + "</td>"
                                        + "<td>"
                                        + $rs[i].NgayBatDau
                                        + "</td>"
                                + "<td>"
                                        + $rs[i].NgayKetThuc
                                        + "</td>"
                                + "<td>"
                                        + $rs[i].MoTa
                                        + "</td>"
                                         +  "<td> <a href='?conten=abc&sub=8&id=" + $rs[i].IDKM + "&tensp="+ $rs[i].TenSP +"&giakm="+ $rs[i].GiaKM +  "&nbd="+ $rs[i].NgayBatDau + "&nkt="+ $rs[i].NgayKetThuc +"&mota="+ $rs[i].MoTa + "'>Sửa</a></td>"
                                     
                                   + "<td> <a  href='../Controls/KhuyenMai_mng_ctrl.php?id="+ $rs[i].IDKM+ "&act=2' onclick='return confirm_del();'>Xóa</a></td>"
                                        
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
    
               
                function confirm_del(){
                if(confirm("Bạn có chắc chắn muốn xóa trường này không?")===true){
                    return true;
                }else{
                    return false;
                }
            }
             function action_cancel()
            {
                 window.location = './trangchu_mng_view.php?conten=abc&sub=8';
            }
                function call_ctrl(){
                    if(  validate_txtbox()==true){
                  
                var id= document.getElementById('txt_id').value;
                var new_idsp=document.getElementById('Id_sp').value;
                  var new_giaKM=document.getElementById('txt_giaKM').value;
                var new_ngayBD=document.getElementById('dt_ngayBD').value;
                var new_ngayKT=document.getElementById('dt_ngayKT').value;
                var new_mota=document.getElementById('txt_MoTa').value;
                window.location="../Controls/KhuyenMai_mng_ctrl.php?id="+id+"&idsp="+new_idsp+"&giakm="+new_giaKM+"&ngaybd="+ new_ngayBD +"&ngaykt="+new_ngayKT+"&mota="+new_mota+"&act=3";
         
    } }
              function action_cancel()
            {
                window.location = './khuyenmai_mng_view.php';
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
            function  validate_txtbox(){
               var giakm=document.getElementById('txt_giaKM').value;
               if(giakm===''){
                   alert('Trường giá không được để trống');
                   document.getElementById('txt_giaKM').focus();
                   return false;
               } else{
                var ngaybd=document.getElementById('dt_ngayBD').value;
               if(ngaybd===''){
                   alert('Trường ngày BĐ không được để trống');
                   document.getElementById('dt_ngayBD').focus();
                   return false;
                   
               }else{
                   var ngaykt=document.getElementById('dt_ngayKT').value;
                   if(ngaykt===''){
                   alert('Trường ngày KT không được để trống');
                   document.getElementById('dt_ngayKT').focus();
                   return false;
               }else{
                   if(ngaykt < ngaybd){
                       alert('Ngày kết thúc phải lớn hơn ngày bắt đầu');
                       document.getElementById('dt_ngayKT').focus();
                       return false;
                   }
                   else{
                   return true;
               }
           }
           }
       }
   }
        </script>
        <title></title>
    </head>
    <body>
    <center>
         
        <!--Hiển thị dữ liệu trong bảng-->
        <div class="div_content" >
            <h2>Dữ liệu bảng khuyến mãi</h2>
            <?php echo @$_REQUEST['tb']?>
              <table  id="tbl_show_data" class="tbl_show_data"  border="1" cellspacing="0">
                <tr>
                    <th style=""> Mã Khuyến Mại</th>
                    <th style=""> Tên Sản Phẩm </th>
                    <th style=""> Giá Khuyến Mại </th>
                    <th style=""> Ngày Bắt Đầu </th>
                    <th style=""> Ngày Kết Thúc </th>
                    <th style=""> Mô Tả </th>
                    <th > Sửa</th>
                    <th > Xóa</th>
                </tr>

                <!--Hiển thị tùng bản ghi của dữ liệu trong bảng-->
                <?php
                $num_of_page = ceil(KhuyenMai_model::get_num_of_row_khuyenmai()/Constants::$num_on_page);
                // var_dump(ceil(NhomSP_model::get_num_of_row_NhomSP()/Constants::$num_on_page));
                $page_current=@$_REQUEST['page'];
                // validate
                if($page_current==NULL|$page_current<=0){
                    $page_current=1;
                }else{
                    if($page_current>$num_of_page){
                        $page_current=$num_of_page;
                    }
                }
                   $data = KhuyenMai_model::Load_KhuyenMai_by_paging($page_current);
//var_dump($data);

                if ($data != NULL) {
                    foreach ($data as $dt) {
                        echo "<tr>";
                        echo "<td>" . $dt['IDKM'] . "</td>";
                        echo "<td>" . $dt['TenSP'] . "</td>";
                        echo "<td>" . $dt['GiaKM'] . "</td>";
                        echo "<td>" . $dt['NgayBatDau'] . "</td>";
                        echo "<td>" . $dt['NgayKetThuc'] . "</td>";
                        echo "<td>" . $dt['MoTa'] . "</td>";
                        echo "<td> <a href='?conten=abc&sub=8&id=".$dt['IDKM'] . "&tensp=" . $dt['TenSP'] ."&idsp=" . $dt['IDSP'] . "&giakm= " . $dt['GiaKM'] . "&nbd= " . $dt['NgayBatDau'] . "&nkt= " . $dt['NgayKetThuc'] . " &mota= " . $dt['MoTa'] . "' > Sửa </a> </td>";
                        echo "<td><a href='".Constants::$KhuyenMai_mng_ctrl_child_url."?id=".$dt['IDKM']."&act=". Constants::$delete_act ."' onclick='return confirm_del();'>Xóa</a></td>";               
                        echo "</tr>";
                    }
                }
                
                ?>

            </table>
            <?php
            
             phantrang::show_page(Constants::$trangchu."?conten=abc&sub=8", $num_of_page, $page_current);
            ?>

        </div>
<!--Hiển thị điều khiển cập nhật-->
        <div class="div_search" >
             <!-- hien thi Tim kiem -->
              <h2 align="center">Tìm kiếm khuyến mãi</h2>
                <!-- hien thi  dk cap nhat-->
                <table align="center">
                    <tr>
                        <td>Nhập giá trị tìm kiếm:</td>
                        <td><input type="text" name="txt_search_val" id="txt_search_val"></td>
                    </tr>
                    <tr>
                        <td>Chọn tiêu chí tìm kiếm:</td>
                        <td>
                            <input type="radio" name="radio_search" checked value="<?php echo Constants::$search_by_ID; ?>"> Mã
                             <input type="radio" name="radio_search" value="<?php echo Constants::$search_by_NgayBD; ?>">Ngày BĐ
                              <input type="radio" name="radio_search"value="<?php echo Constants::$search_by_NgayKT; ?>">Ngày KT
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="button" value="Tìm kiếm" id ="btn_search">
                        </td>
                    </tr>
                </table>
            <h2> Thông tin khuyến mãi </h2>
            <form action="<?php echo Constants::$KhuyenMai_mng_ctrl_child_url."?act=".Constants::$insert_act; ?>" method ="POST">
                <table name="tbl_TT_KhuyenMai" id="tbl_TT_KhuyenMai">   
                    <tr>
                         <td>Tên SP:</td>
                    <td>
                        <select id="Id_sp" name="Id_sp" >
                           <?php
                            $a = @$_REQUEST['tensp'];
                            
                            $data = KhuyenMai_model::Load_IDSP();
                            if ($data != NULL) {
                                foreach ($data as $dt) {  
                                    if ($dt['TenSP'] == $a){
                                    echo "<option value=" . $dt['IDSP'] . " selected >";   
                                    }else{
                                        echo "<option value=" . $dt['IDSP'] . "  >";
                                    }
                                    echo  $dt['TenSP'] ;
                                    echo "</option>";
                                }
                            }
                          
                         
                            ?>
                        </select>
                    </td>
                    </tr>
                   
                    <tr>
                    <td>Giá khuyến mãi:</td>
                    <td><input type="text" name="txt_giaKM" id="txt_giaKM" value="<?php echo @$_REQUEST['giakm']; ?>" onkeypress="return keys(event)"></td>
                </tr>
                <tr>
                    <td>Ngày bắt đầu:</td>
                    <td><input type="date" name="dt_ngayBD" id="dt_ngayBD"  value=<?php echo @$_REQUEST['nbd'] ?>></td>
                   
           
                </tr>
                <tr>
                    <td>Ngày kết thúc:</td>
                    <td><input type="date" name="dt_ngayKT" id="dt_ngayKT" value=<?PHP echo @$_REQUEST['nkt'] ?>></td>
                </tr>
                 <tr>
                    <td>Mô tả:</td>
                    <td><input type="text" name="txt_MoTa" id="txt_MoTa" value="<?php echo @$_REQUEST['mota']; ?>"></td>
                </tr>
                    <tr>
                        <td align="right"><input type="submit" value="Thêm Mới" id="btn_themmoi" onclick="return validate_txtbox();"></td>
                        <td ><input type="button" value="Cập nhật" id="btn_update" onclick="call_ctrl();">
                            <input type="button" value="Hủy" id="btn_cancel" onclick=" action_cancel();"></td>
                    </tr>
                </table>
                <input type="hidden" value="<?php echo @$_REQUEST['id']; ?>" id="txt_id"></td>
            </form>
            
        </div>
        <?php
        // put your code here
        ?>
        </center>
    </body>
</html>
