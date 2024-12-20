<?php
require('koneksi.php');

// Query untuk tren pembelian bulanan
$sql1 = "SELECT 
            YEAR(OrderDate) AS Tahun, 
            MONTH(OrderDate) AS Bulan, 
            SUM(TotalDue) AS TotalPembelian
         FROM purchasing_purchaseorderheader
         GROUP BY YEAR(OrderDate), MONTH(OrderDate)
         ORDER BY Tahun, Bulan";

$result1 = mysqli_query($conn, $sql1);

$tren_pembelian = array();

// Ambil data dan simpan dalam array
while ($row = mysqli_fetch_array($result1)) {
    array_push($tren_pembelian, array(
        "tahun" => $row['Tahun'],
        "bulan" => $row['Bulan'],
        "total_pembelian" => $row['TotalPembelian']
    ));
}

// Encode data ke JSON
$data3 = json_encode($tren_pembelian);
?>
