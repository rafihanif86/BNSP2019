<?php
    include "connection.php";

    $id=$_GET["id"];
    
    if($id != null){
        $delete_vendor=mysql_query("DELETE FROM biodata where id = $id;",$conn);
        echo "<script>alert('Data Berhasil Dihapus')
            location.replace('index.php')</script>";
    }else{
        echo "<script>alert('Data Gagal Dihapus')
        location.replace('index.php')</script>";
    }
?>