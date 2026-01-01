<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Call Records Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 p-6">

<!-- Header -->
<div class="flex justify-between items-center mb-6">
  <h1 class="text-xl font-semibold">Call Records</h1>
 <form action="logout.php" method="POST">
    <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">
        Logout
    </button>
</form>
</div>
<!-- Summary Cards -->
<div class="grid grid-cols-4 gap-4 mb-6">
  <div class="bg-white p-4 rounded shadow">
    <p class="text-sm text-gray-500">Total Calls</p>
    <p class="text-2xl font-bold" id="totalCalls">0</p>
  </div>

  <div class="bg-white p-4 rounded shadow">
    <p class="text-sm text-gray-500">Answered Calls</p>
    <p class="text-2xl font-bold" id="answeredCalls">0</p>
  </div>

  <div class="bg-white p-4 rounded shadow">
    <p class="text-sm text-gray-500">Avg Call Duration</p>
    <p class="text-2xl font-bold" id="avgDuration">0s</p>
  </div>

  <div class="bg-white p-4 rounded shadow">
    <p class="text-sm text-gray-500">Answer Rate</p>
    <p class="text-2xl font-bold" id="answerRate">0%</p>
  </div>
</div>

<!-- Search + Actions -->
<div class="flex justify-between mb-4">
 
  <input id="search" placeholder="Search by phone number, call ID or DID..."
    class="border px-3 py-2 rounded w-1/2">
  <div>
    <input type="date" id="dateFilter" class="border rounded px-3 py-2">
    <button onclick="exportCSV()" class="border px-4 py-2 rounded mr-2">Export CSV</button>
  </div>
  
</div>




<!-- Table -->
<div class="bg-white rounded shadow p-4">
  <table class="w-full text-sm">
    <thead class="border-b">
      <tr>
        <th class="text-left p-2">Date</th>
        <th class="text-left p-2">Direction</th>
        <th class="text-left p-2">From</th>
        <th class="text-left p-2">To</th>
        <th class="text-left p-2">Duration</th>
        <th class="text-left p-2">Status</th>
        <th class="text-left p-2">Cost</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      <tr>
        <td colspan="7" class="text-center text-gray-400 p-10">
          No call records found
        </td>
      </tr>
    </tbody>
  </table>
</div>
<script src="funtion.js" ></script>
</body>
</html>
