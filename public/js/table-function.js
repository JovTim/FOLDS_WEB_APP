let data = [];

// Fetch data from the API
function fetchData() {
  $.ajax({
    url: "http://localhost/folds/public/api/folders.php",
    method: "GET",
    dataType: "json",
    success: function (response) {
      data = response;
      updateTable();
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
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
                        <td class="py-3 px-4 border-b max-w-[100px]">${item.student_number.toUpperCase()}</td>
                        <td class="py-3 px-4 border-b max-w-[200px] break-words">${item.l_name.toUpperCase()}, ${item.f_name.toUpperCase()} ${item.m_name.toUpperCase()}</td>
                        <td class="py-3 px-4 border-b">YEAR ${item.year.toUpperCase()}</td>
                        <td class="py-3 px-4 border-b">
                            <select name="status" class="block w-32 border border-black rounded-none px-2 py-1">
                                <option value="1" ${
                                  item.status === "1" ? "selected" : ""
                                }>OFFICE</option>
                                <option value="2" ${
                                  item.status === "2" ? "selected" : ""
                                }>ENCODING</option>
                            </select>
                        </td>
                        <td class="border-b">
                    <button data-id="${
                      item.id
                    }" type="button" class="editButton text-white bg-black px-3 py-1.5 rounded-2xl hover:bg-white border-2 hover:border-black hover:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    </button>
                    <button data-id="${
                      item.id
                    }" type="button" class="deleteButton text-white bg-black px-3 py-1.5 rounded-2xl hover:bg-white border-2 hover:border-black hover:text-black">
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
    buttonsHtml += `<button class="px-3 py-1 border-2 border-black rounded-none mx-1 ${activeClass}" data-page="${page}">${page}</button>`;
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
  const filteredData = data.filter(
    (item) =>
      item.student_number.toLowerCase().includes(searchTerm) ||
      item.f_name.toLowerCase().includes(searchTerm) ||
      item.m_name.toLowerCase().includes(searchTerm) ||
      item.l_name.toLowerCase().includes(searchTerm)
  );
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
