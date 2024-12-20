<?php
require('koneksi.php');

$sql = "SELECT 
    v.Name AS VendorName, 
    SUM(poh.TotalDue) AS TotalPembelian
FROM purchasing_purchaseorderheader poh
JOIN purchasing_vendor v ON poh.VendorID = v.BusinessEntityID
GROUP BY v.Name
ORDER BY TotalPembelian DESC
LIMIT 10; ";

$result = mysqli_query($conn, $sql);

$vendorData = array();

while ($row = mysqli_fetch_array($result)) {
    array_push($vendorData, array(
        "totalPembelian" => $row['TotalPembelian'],
        "vendorName" => $row['VendorName']
    ));
}

$data4 = json_encode($vendorData);
?>
