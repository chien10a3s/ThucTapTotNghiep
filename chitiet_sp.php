<!DOCTYPE html>
<!--
<?php
require_once '../Shareds/Constants.php';
require_once Constants::$SP_mng_model_child_url;
?>
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../Css/tranghienthi.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <table>
           
            <?php
            $idsp = @$_REQUEST['idsp'];
            $data = SP_model::Load_SP();
            if ($data != NULL) {
                echo "<table border ='1' width='100% '>";
                foreach ($data as $dt) {
                    echo "<tr>";
                    if ($idsp == $dt['IDSP']) {
                        
                        echo "<center>";
                        echo "<tr>";
                        echo "<td>";
                        echo "<img src='../image/" . $dt['Anh'] . "' width=200px >";
                        echo "</td>";
                        echo "<td>";
                        echo "Giá Bán :".$dt['Gia']."&nbspVNĐ"
                                ."<br>";
                        echo "Khuyến Mãi :0 VNĐ<br>";
                        
                        echo "Số Lượng Còn :";
                        if ( $dt['SoLuongCon']<=0) {
                           echo "Hết Hàng Trong Kho<br>";
                        }  else {
                            echo "$dt[SoLuongCon]&nbsp Chiếc<br>";
                            echo "<a href='../ctr/addcart.php?item=$dt[IDSP]'>Mua Hàng</a>";
                            
                        }
                                                  
                        
                        echo "</center><br>";
                        
                        echo "<td width='400px'></td>";
                        echo "</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td>";
                        echo "Cấu Hình";
                        echo "</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td>";
                        
                        echo "<li> Tên Sẩn Phẩm : " . $dt['TenSP'] . "</li>";
                        echo "<li> Kích thước : " . $dt['KichThuoc'] . "</li>";
                        echo "<li> Trọng lượng : " . $dt['TrongLuong'] . "</li>";
                        echo "<li> Âm thanh :" . $dt['AmThanh'] . "</li>";
                        echo "<li> Bộ Nhớ : " . $dt['BoNho'] . "</li>";
                        echo "<li> RAM : " . $dt['Ram'] . "</li>";
                        echo "<li> HDH : " . $dt['HDH'] . "</li>";
                        echo "<li> Thẻ Nhớ : " . $dt['TheNho'] . "</li>";
                        echo "<li> Camera : " . $dt['Camera'] . "</li>";
                        echo "<li> Pin : " . $dt['Pin'] . "</li>";
                        echo "<li> Bảo Hành :" . $dt['BaoHanh'] . "</li>";
                        echo "<li> Mô Tả" . $dt['MoTa'] . "</li>";
                        echo "</td>";
                        echo "</tr>";
                        
                       
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
            ?>
         </table>
    </body>
</html>
