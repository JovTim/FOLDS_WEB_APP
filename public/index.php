<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FOLDS</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/message.js"></script>
  <!--  -->
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <link rel="stylesheet" type="text/css" href="css/styles.css">


</head>

<body>
  <?php include "includes/messages/added-success.php" ?>
  <?php include "includes/messages/update-success.php" ?>
  <?php include "includes/messages/delete-success.php" ?>
  <?php include "includes/messages/error.php" ?>
  <div class="container mx-auto p-4 pt-10 px-10 hidden md:block ">
    <?php include "includes/nav.php"; ?>
    <div class=" p-10 mx-10 border-2 border-black">
      <div class="flex justify-between">
        <div class="flex justify-start">
          <input
            type="text"
            id="searchInput"
            placeholder="Search... "
            class="border-2 p-2 rounded-none mb-4 w-64 border-black" />
          <div class="ps-1">
            <button
              type="button"
              id="filterButton"
              class="text-white bg-black px-3 py-1.5 rounded-2xl hover:bg-white border-2 hover:border-black hover:text-black cursor-pointer">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="size-6">
                <path
                  d="M18.75 12.75h1.5a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM12 6a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 6ZM12 18a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 18ZM3.75 6.75h1.5a.75.75 0 1 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM5.25 18.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 0 1.5ZM3 12a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 3 12ZM9 3.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM12.75 12a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM9 15.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
              </svg>
            </button>

            <button
              type="button"
              disabled
              class="text-white bg-black px-3 py-1.5 rounded-2xl hover:bg-white border-2 hover:border-black hover:text-black cursor-not-allowed">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="size-6">
                <path
                  fill-rule="evenodd"
                  d="M2.25 13.5a8.25 8.25 0 0 1 8.25-8.25.75.75 0 0 1 .75.75v6.75H18a.75.75 0 0 1 .75.75 8.25 8.25 0 0 1-16.5 0Z"
                  clip-rule="evenodd" />
                <path
                  fill-rule="evenodd"
                  d="M12.75 3a.75.75 0 0 1 .75-.75 8.25 8.25 0 0 1 8.25 8.25.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75V3Z"
                  clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
        <div class="">
          <!-- Add folder button -->
          <button
            type="button"
            id="addButton"
            class="text-white bg-black px-3 py-1.5 rounded-2xl hover:bg-white border-2 hover:border-black hover:text-black cursor-pointer">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-7">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
            </svg>
          </button>
        </div>
      </div>

      <table class="min-w-full bg-white text-sm">
        <thead class="border-b-2 border-black">
          <tr class="text-left">
            <th class="py-3 px-4">STUDENT NO.</th>
            <th class="py-3 px-4">FULL NAME</th>
            <th class="py-3 px-4">YEAR</th>
            <th class="py-3 px-4">STATUS</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="tableBody"></tbody>
      </table>

      <div id="pagination" class="flex justify-center mt-4"></div>
    </div>
  </div>

  <!-- Mobile screen only -->
  <div class="container w-full p-2 block md:hidden">
    <?php include "mobile.php"; ?>
  </div>

  <?php include "modals/addModal.php"; ?>
  <?php include "modals/editModal.php" ?>
  <?php include "modals/deleteModal.php" ?>
  <?php include "modals/statsModal.php" ?>
  <?php include "modals/filterModal.php" ?>

  <script src="js/table-function.js"></script>
  <script src="js/add-function.js"></script>
  <script src="js/edit-function.js"></script>
  <script src="js/delete-function.js"></script>
  <script src="js/filter-function.js"></script>

</body>

</html>