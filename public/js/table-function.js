let data = [];
let selectedYears = ["1", "2", "3", "4", "0"]; // Possible Years
let selectedStatus = "All"; // Possible values: "Encoding", "Office", "All"

let selectedEnrollment = "1"; // "All", "1", "2"

// Fetch data from the API
function fetchData() {
  $.ajax({
    url: "http://localhost/folds/public/api/folders.php",
    method: "GET",
    dataType: "json",
    success: function (response) {
      data = response;
      updateTable();
      updateCards();
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
      showTemporaryMessage("#errorMsg", 3000);
    },
  });
}

fetchData();

let currentPage = 1;
const rowsPerPage = 10;

function displayTable(filteredData) {
  const start = (currentPage - 1) * rowsPerPage;
  const end = start + rowsPerPage;
  const paginatedItems = filteredData.slice(start, end);

  const rowsHtml = paginatedItems
    .map(
      (item) => `
                    <tr class="text-lg">
                        <td>
                          ${
                            item.is_enrolled == 2
                              ? `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                  <path fill-rule="evenodd" d="M19.5 21a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3h-5.379a.75.75 0 0 1-.53-.22L11.47 3.66A2.25 2.25 0 0 0 9.879 3H4.5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h15Zm-6.75-10.5a.75.75 0 0 0-1.5 0v4.19l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V10.5Z" clip-rule="evenodd" />
                                </svg>`
                              : item.status == 2
                              ? `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M19.5 21a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3h-5.379a.75.75 0 0 1-.53-.22L11.47 3.66A2.25 2.25 0 0 0 9.879 3H4.5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h15ZM9 12.75a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5H9Z" clip-rule="evenodd" />
                              </svg>`
                              : ``
                          }
                        </td>
                        <td class="py-3 px-4 border-b border-gray-100 max-w-[100px] ">${item.student_number.toUpperCase()}</td>
                        <td class="py-3 px-4 border-b border-gray-100 max-w-[200px] break-words">${item.l_name.toUpperCase()}, ${item.f_name.toUpperCase()} ${item.m_name.toUpperCase()}</td>
                        <td class="py-3 px-4 border-b border-gray-100">YEAR ${item.year.toUpperCase()}</td>
                        <td class="py-3 px-4 border-b border-gray-100">
                            <select name="status"
                            data-id="${item.id}"
                            class="statusDropDown block w-32 border border-black rounded-none px-2 py-1">
                                <option value="1" ${
                                  item.status === "1" ? "selected" : ""
                                }>OFFICE</option>
                                <option value="2" ${
                                  item.status === "2" ? "selected" : ""
                                }>ENCODING</option>
                            </select>
                        </td>
                        <td class="border-b border-gray-100">
                    <button 
                    data-id="${item.id}"
                    data-student-number="${item.student_number}"
                    data-f-name="${item.f_name}"
                    data-m-name="${item.m_name}"
                    data-l-name="${item.l_name}"
                    data-year="${item.year}"
                    data-status="${item.status}"
                    data-is-enrolled="${item.is_enrolled}" 
                    type="button" 
                    class="editButton text-white bg-black px-3 py-1.5 rounded-2xl hover:bg-white border-2 hover:border-black hover:text-black cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    </button>
                    <button 
                    data-id="${item.id}"
                    type="button" class="deleteButton text-white bg-black px-3 py-1.5 rounded-2xl hover:bg-white border-2 hover:border-black hover:text-black cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    </button>
                  </td>
                    </tr>
                `
    )
    .join("");

  $("#tableBody").html(rowsHtml);
  displayPagination(filteredData.length);
}

function displayPagination(totalItems) {
  const totalPages = Math.ceil(totalItems / rowsPerPage);
  let buttonsHtml = "";

  function addPageButton(page) {
    const activeClass =
      page === currentPage ? "bg-black text-white" : "bg-white";
    buttonsHtml += `<button class="px-3 cursor-pointer py-1 border-2 border-black rounded-none mx-1 ${activeClass}" data-page="${page}">${page}</button>`;
  }

  if (totalPages <= 7) {
    for (let i = 1; i <= totalPages; i++) {
      addPageButton(i);
    }
  } else {
    addPageButton(1);
    if (currentPage > 4) {
      buttonsHtml += `<span class="px-2">...</span>`;
    }
    const startPage = Math.max(2, currentPage - 1);
    const endPage = Math.min(totalPages - 1, currentPage + 1);
    for (let i = startPage; i <= endPage; i++) {
      addPageButton(i);
    }
    if (currentPage < totalPages - 3) {
      buttonsHtml += `<span class="px-2">...</span>`;
    }
    addPageButton(totalPages);
  }

  $("#pagination").html(buttonsHtml);
}

function updateTable() {
  const searchTerm = $("#searchInput").val().toLowerCase();

  const filteredData = data.filter((item) => {
    const matchesSearch =
      item.student_number.toLowerCase().includes(searchTerm) ||
      item.f_name.toLowerCase().includes(searchTerm) ||
      item.m_name.toLowerCase().includes(searchTerm) ||
      item.l_name.toLowerCase().includes(searchTerm);

    const matchesYear = selectedYears.includes(String(item.year));

    const statusLabel =
      item.status === "1"
        ? "Office"
        : item.status === "2"
        ? "Encoding"
        : "Unknown";

    const matchesStatus =
      selectedStatus === "All" ||
      statusLabel.toLowerCase() === selectedStatus.toLowerCase();

    const matchesEnrollment =
      selectedEnrollment === "All" || item.is_enrolled === selectedEnrollment;

    return matchesSearch && matchesYear && matchesStatus && matchesEnrollment;
  });

  displayTable(filteredData);
}

$("#searchInput").on("keyup", function () {
  currentPage = 1;
  updateTable();
});

$("#pagination").on("click", "button", function () {
  currentPage = parseInt($(this).data("page"));
  updateTable();
});

// cards
function displayCards(filteredData) {
  const cardsHtml = filteredData
    .map(
      (item) => `
              <div class="border-4 rounded-none p-4 shadow-md space-y-2 bg-white
                ${
                  item.is_enrolled == 2
                    ? "border-blue-500"
                    : item.status == 2
                    ? "border-red-500"
                    : "border-black"
                }">
                <div class="flex justify-between"> 
                  <div class="text-lg font-semibold">${item.student_number.toUpperCase()}</div>
                  <div class="text-lg font-semibold">YEAR ${item.year.toUpperCase()}</div>
                </div>
                <div class="text-xl font-bold pb-1">${item.l_name.toUpperCase()}, ${item.f_name.toUpperCase()} ${item.m_name.toUpperCase()}</div>
                <select name="status"
                  data-id="${item.id}"
                  class="statusDropDown text-2xl font-semibold block w-full border border-black px-2 py-1">
                    <option value="1" ${
                      item.status === "1" ? "selected" : ""
                    }>OFFICE</option>
                    <option value="2" ${
                      item.status === "2" ? "selected" : ""
                    }>ENCODING</option>
                </select>

                <div class="flex gap-2">
                  <button
                    data-id="${item.id}"
                    data-student-number="${item.student_number}"
                    data-f-name="${item.f_name}"
                    data-m-name="${item.m_name}"
                    data-l-name="${item.l_name}"
                    data-year="${item.year}"
                    data-status="${item.status}"
                    data-is-enrolled="${item.is_enrolled}" 
                    type="button"
                    class="editButton text-white bg-black px-3 py-1.5 rounded-2xl hover:bg-white border-2 hover:border-black hover:text-black w-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                      stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582
                        16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5
                        4.5 0 0 1 1.13-1.897l8.932-8.931Zm0
                        0L19.5 7.125M18 14v4.75A2.25 2.25 0 0
                        1 15.75 21H5.25A2.25 2.25 0 0
                        1 3 18.75V8.25A2.25 2.25 0 0 1 5.25
                        6H10" />
                    </svg>
                  </button>

                  <button 
                    data-id="${item.id}"
                    type="button"
                    class="deleteButton flex items-center justify-center text-white bg-black px-3 py-1.5 rounded-2xl hover:bg-white border-2 hover:border-black hover:text-black w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                      stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" 
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 
                        19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 
                        5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 
                        .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 
                        3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 
                        51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 
                        2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                  </button>
                </div>
              </div>
            `
    )
    .join("");

  $("#cardContainer").html(cardsHtml);
}

function updateCards() {
  const searchTerm = $("#searchBox").val().toLowerCase();
  const filteredData = data.filter(
    (item) =>
      item.student_number.toLowerCase().includes(searchTerm) ||
      item.f_name.toLowerCase().includes(searchTerm) ||
      item.m_name.toLowerCase().includes(searchTerm) ||
      item.l_name.toLowerCase().includes(searchTerm)
  );
  displayCards(filteredData);
}

$("#searchBox").on("keyup", function () {
  updateCards();
});
