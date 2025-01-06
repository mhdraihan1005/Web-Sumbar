<?php
include 'koneksi.php';

if (isset($_GET['query'])) {
    $search_query = $_GET['query'];
    $sql = "SELECT nama_menu, deskripsi FROM menu WHERE nama_menu LIKE ? OR deskripsi LIKE ?";
    $stmt = $conn->prepare($sql);
    $like_query = "%" . $search_query . "%";
    $stmt->bind_param("ss", $like_query, $like_query);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = [];
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    echo json_encode($response);
}
?>
