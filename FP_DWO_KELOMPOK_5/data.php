<?php
require('koneksi.php');

// Query untuk mengambil total pembelian berdasarkan status pesanan
$sql = "SELECT Status, SUM(TotalDue) AS total_pembelian
FROM purchasing_purchaseorderheader
GROUP BY Status;
";

$result = mysqli_query($conn, $sql);

$hasil = array();

while ($row = mysqli_fetch_array($result)) {
    array_push($hasil, array(
        "status" => $row['Status'],
        "total_pembelian" => $row['total_pembelian']
    ));
}

$data = json_encode($hasil);
?>