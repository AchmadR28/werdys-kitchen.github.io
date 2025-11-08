<?php
session_start();
require 'db/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Query pemesanan berdasarkan email pelanggan
    $query = "SELECT 
                barang,
                pembeli,
                nowa,
                alamat,
                pesan,
                tanggal,
                status
              FROM pemesanan
              WHERE email = ?
              ORDER BY tanggal DESC";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = $result->fetch_all(MYSQLI_ASSOC);

    if ($orders) {
        $status_message = "";

        foreach ($orders as $order) {
            $status_message .= "Barang: " . htmlspecialchars($order['barang']) . "\n";
            $status_message .= "Pembeli: " . htmlspecialchars($order['pembeli']) . "\n";
            $status_message .= "No WA: " . htmlspecialchars($order['nowa']) . "\n";
            $status_message .= "Alamat: " . htmlspecialchars($order['alamat']) . "\n";
            $status_message .= "Pesan: " . htmlspecialchars($order['pesan']) . "\n";
            $status_message .= "Tanggal: " . htmlspecialchars($order['tanggal']) . "\n\n";
            $status_message .= "status: " . htmlspecialchars($order['status']) . "\n\n";
        }

        $status_message = urlencode($status_message);

        header("Location: index.php?page=check_order_status&status_message=$status_message");
    } else {
        $status_message = urlencode("Tidak ada pesanan ditemukan untuk email tersebut.");
        header("Location: index.php?page=check_order_status&status_message=$status_message");
    }

    exit();
}
?>
