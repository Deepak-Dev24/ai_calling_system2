let ALL_CALLS = [];
let FILTERED_CALLS = [];
let callChart;


// ===== LOAD DATA =====
async function loadCDR() {
  const res = await fetch("cdr.php");
  const json = await res.json();
  ALL_CALLS = json.data || [];
FILTERED_CALLS = [...ALL_CALLS]; // COPY
renderTable(FILTERED_CALLS);
updateMetrics(FILTERED_CALLS);

}

// ===== FILTERS =====
function applyFilters() {
  const q = document.getElementById("search").value.toLowerCase();
  const selectedDate = document.getElementById("dateFilter").value;

FILTERED_CALLS = ALL_CALLS.filter(c => {

    // SEARCH FILTER
    const matchSearch =
      String(c.caller_id_number || "").toLowerCase().includes(q) ||
      String(c.destination_number || "").toLowerCase().includes(q) ||
      String(c.uuid || "").toLowerCase().includes(q);

    // DATE FILTER (FIXED)
   const matchDate = selectedDate
  ? formatIST(c.start_time).split(",")[0].split("/").reverse().join("-") === selectedDate
  : true;


    return matchSearch && matchDate;
  });

  renderTable(FILTERED_CALLS);
  updateMetrics(FILTERED_CALLS);
}

// ===== METRICS =====
function updateMetrics(calls) {
  document.getElementById("totalCalls").innerText = calls.length;

  const answered = calls.filter(c => c.hangup_disposition === "answered");
  document.getElementById("answeredCalls").innerText = answered.length;

  const totalDuration = answered.reduce(
    (sum, c) => sum + (c.duration || 0), 0
  );

  document.getElementById("avgDuration").innerText =
    answered.length ? Math.round(totalDuration / answered.length) + "s" : "0s";

  document.getElementById("answerRate").innerText =
    calls.length
      ? Math.round((answered.length / calls.length) * 100) + "%"
      : "0%";
}

// ===== TABLE =====
function renderTable(calls) {
  const tbody = document.getElementById("tableBody");
  tbody.innerHTML = "";

  if (!calls.length) {
    tbody.innerHTML = `
      <tr>
        <td colspan="7" class="text-center text-gray-400 p-10">
          No call records found
        </td>
      </tr>`;
    return;
  }

  calls.forEach(call => {
    tbody.innerHTML += `
      <tr class="border-b">
        <td class="p-2">${formatIST(call.start_time)}</td>
        <td class="p-2 capitalize">${call.call_direction}</td>
        <td class="p-2">${call.caller_id_number}</td>
        <td class="p-2">${call.destination_number}</td>
        <td class="p-2">${call.billsec}s</td>
        <td class="p-2 capitalize">${call.hangup_disposition}</td>
        <td class="p-2">₹${call.total_cost}</td>
      </tr>
    `;
  });
}
function formatIST(dateStr) {
  if (!dateStr) return "-";

  // Force UTC by appending Z
  const utcDate = new Date(dateStr + "Z");

  return utcDate.toLocaleString("en-IN", {
    timeZone: "Asia/Kolkata",
    day: "2-digit",
    month: "2-digit",
    year: "numeric",
    hour: "2-digit",
    minute: "2-digit",
    second: "2-digit",
    hour12: true
  });
}

// ===== SEARCH & DATE FILTER EVENTS =====
document.getElementById("search").addEventListener("input", applyFilters);
document.getElementById("dateFilter").addEventListener("change", applyFilters);

// ===== EXPORT CSV =====
function exportCSV() {
  if (!ALL_CALLS.length) return alert("No data to export");

  const headers = [
    "Date","Direction","From","To","Duration","Status","Cost"
  ];

 const rows = FILTERED_CALLS.map(c => [
    new Date(c.start_time).toLocaleString(),
    c.call_direction,
    c.caller_id_number,
    c.destination_number,
    c.duration,
    c.hangup_disposition,
    c.total_cost
  ].map(v => `"${String(v).replace(/"/g, '""')}"`)); // Safe CSV

  let csv = headers.join(",") + "\n";
  rows.forEach(r => csv += r.join(",") + "\n");

  const blob = new Blob([csv], { type: "text/csv" });
  const url = URL.createObjectURL(blob);

  const a = document.createElement("a");
  a.href = url;
  a.download = "call_records.csv";
  a.click();

  URL.revokeObjectURL(url);
}



// ===== INIT =====
loadCDR();



