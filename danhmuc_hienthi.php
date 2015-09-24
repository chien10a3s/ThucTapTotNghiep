<!DOCTYPE html>
<?php
require_once '../Shareds/Constants.php';
require_once Constants::$DanhMuc_hienthi_model_child_url;
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
        <link href="../Css/tranghienthi.css" rel="stylesheet" type="text/css"/>
</head>
<body>

    <table border="1" width="100%">
        <?php
        echo "<br>";
        echo "<center>";
        echo "<tr><td style='color:#4fbfdc;'>NHÀ SẢN XUẤT</td><tr>";
        echo "</center>";
        $data = danhmuc_hienthi_model::load_nhomSP();
        if ($data != NULL) {
            foreach ($data as $dt) {
                echo "<tr>";
                echo "<td>";
                echo "<a href='?conten=nsx&idn=".$dt['IDNhomSP']."'>";
                echo "" . $dt['TenNhomSP'] . "";
                echo "</a>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>




    <table border="1" width="100%">
<?php
echo "<br>";
echo "<center>";
echo "<tr><td style='color:#4fbfdc;'>HỖ TRỢ KHÁCH HÀNG</td></tr>";
echo "</center>";
echo "<tr><td><a href = 'http://chien10a3s@gmail.com'>Mail</a></td></tr>";
echo "<tr><td><a href = 'http://chien10a3s@gmail.com'>Yahoo</a></td></tr>";
echo "<tr><td><a href = 'http://chien10a3s@gmail.com'>FaceBook</a></td></tr>";
echo "<tr><td style='color:red;'>Điện Thoại Hỗ Trợ <br>0123456789<br>0988888888</a></td></tr>";
?>
    </table>

    <table border="1" width="100%">
        <br>
        <tr>
            <td style="color:#4fbfdc;">MUA QUA ĐIỆN THOẠI</td>
        </tr>
        <tr>
            <td><b style='color:#4fbfdc;'>Đặt hàng qua điện thoại</b><br><h6>xin vui lòng gọi (7h->21h)</h6><h3 class="color">01688363898</h3></td>
        </tr>

    </table>
    
    <table border="1">
        <br>
        <img src="../image/aa.png" width="100%" height="188px"/>
    </table>
    <table border="1">
        <br>
        <img src="../image/qc1.jpg" width="100%" height="188px"/>
    </table>
    <table border="1" width="100%">
<?php
echo "<br>";
echo "<center>";
echo "<tr><td style='color:#4fbfdc;'>Ý KIẾN KHÁCH HÀNG</td></tr>";
echo "<tr>";
echo "<td>";
require_once '../Views/phanhoi_hienthi.php';
echo "</td>";
echo "</tr>";
echo "</center>";
?>
    </table>
    

</body>
</html>
