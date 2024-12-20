<?php
require('koneksi.php');

$sql = "SELECT 
            sm.Name AS metode_pengiriman, 
            SUM(poh.Freight) AS total_biaya_pengiriman,
            (SUM(poh.Freight) / (SELECT SUM(Freight) FROM purchasing_purchaseorderheader)) * 100 AS persentase
        FROM purchasing_purchaseorderheader poh
        JOIN purchasing_shipmethod sm 
        ON poh.ShipMethodID = sm.ShipMethodID
        GROUP BY sm.Name";

$result = mysqli_query($conn, $sql);

$hasil = array();

while ($row = mysqli_fetch_array($result)) {
    array_push($hasil, array(
        "name" => $row['metode_pengiriman'],
        "y" => floatval($row['persentase']),
        "total" => floatval($row['total_biaya_pengiriman'])
    ));
}

$data5 = json_encode($hasil);
?>
