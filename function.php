<?php
require 'db.php';

// Submit a request
function submitRequest($userId, $description) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO requests (user_id, description) VALUES (?, ?)");
    $stmt->execute([$userId, $description]);
    return $pdo->lastInsertId();  // Return the request ID
}

// Create approval records for HOD and Director
function createApproval($requestId, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO approvals (request_id, user_id) VALUES (?, ?)");
    $stmt->execute([$requestId, $userId]);
}

// Approve or Reject a request (by HOD or Director)
function approveRequest($approvalId, $status, $remarks) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE approvals SET status = ?, remarks = ? WHERE id = ?");
    $stmt->execute([$status, $remarks, $approvalId]);
}

// Get request details with approval statuses
function getRequestDetails($requestId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM requests WHERE id = ?");
    $stmt->execute([$requestId]);
    $request = $stmt->fetch();
    
    $stmt = $pdo->prepare("SELECT * FROM approvals WHERE request_id = ?");
    $stmt->execute([$requestId]);
    $approvals = $stmt->fetchAll();
    
    return ['request' => $request, 'approvals' => $approvals];
}
?>
