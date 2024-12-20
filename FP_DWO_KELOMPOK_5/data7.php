<?php
require('koneksi.php');

// Query untuk rata-rata waktu pengiriman per vendor
$sql1 = "SELECT 
    v.Name AS VendorName, 
    AVG(DATEDIFF(ShipDate, OrderDate)) AS AvgWaktuPengiriman
FROM purchasing_purchaseorderheader poh
JOIN purchasing_vendor v ON poh.VendorID = v.BusinessEntityID
GROUP BY v.Name
ORDER BY AvgWaktuPengiriman DESC
LIMIT 10;
";

$result1 = mysqli_query($conn, $sql1);

$rata_pengiriman = array();

// Ambil data dan simpan dalam array
while ($row = mysqli_fetch_array($result1)) {
    array_push($rata_pengiriman, array(
        "vendor" => $row['VendorName'],
        "rata_pengiriman" => round($row['AvgWaktuPengiriman'], 2)
    ));
}

// Encode data ke JSON
$data7 = json_encode($rata_pengiriman);
?>
