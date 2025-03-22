<?php
include 'connection.php';
include 'crud.php';

$db = new db_con($conn);
$students = $db->fetchdata();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en" class="antialiased">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>FOLDS — Student Folder Management</title>
    <meta name="description" content="(Formerly Tailwind Toolbox) " />
    <meta name="keywords" content="" />
    <link
      href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel=" stylesheet"
    />
    <!--Replace with your tailwind.css once created-->

    <!--Regular Datatables CSS-->
    <link
      href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"
      rel="stylesheet"
    />
    <!--Responsive Extension Datatables CSS-->
    <link
      href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"
      rel="stylesheet"
    />

    <style>
      /*Overrides for Tailwind CSS */

      /*Form fields*/
      .dataTables_wrapper select,
      .dataTables_wrapper .dataTables_filter input {
        color: #4a5568;
        /*text-gray-700*/
        padding-left: 1rem;
        /*pl-4*/
        padding-right: 1rem;
        /*pl-4*/
        padding-top: 0.5rem;
        /*pl-2*/
        padding-bottom: 0.5rem;
        /*pl-2*/
        line-height: 1.25;
        /*leading-tight*/
        border-width: 2px;
        /*border-2*/
        border-radius: 0.25rem;
        border-color: #edf2f7;
        /*border-gray-200*/
        background-color: #edf2f7;
        /*bg-gray-200*/
      }

      html, body {
    position: relative;
    z-index: 1;
}

      /*Row Hover*/
      table.dataTable.hover tbody tr:hover,
      table.dataTable.display tbody tr:hover {
        background-color: #ebf4ff;
        /*bg-indigo-100*/
      }

      /*Pagination Buttons*/
      .dataTables_wrapper .dataTables_paginate .paginate_button {
        font-weight: 700;
        /*font-bold*/
        border-radius: 0.25rem;
        /*rounded*/
        border: 1px solid transparent;
        /*border border-transparent*/
      }

      /*Pagination Buttons - Current selected */
      .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        color: #fff !important;
        /*text-white*/
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1),
          0 1px 2px 0 rgba(0, 0, 0, 0.06);
        /*shadow*/
        font-weight: 700;
        /*font-bold*/
        border-radius: 0.25rem;
        /*rounded*/
        background: #667eea !important;
        /*bg-indigo-500*/
        border: 1px solid transparent;
        /*border border-transparent*/
      }

      /*Pagination Buttons - Hover */
      .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: #fff !important;
        /*text-white*/
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1),
          0 1px 2px 0 rgba(0, 0, 0, 0.06);
        /*shadow*/
        font-weight: 700;
        /*font-bold*/
        border-radius: 0.25rem;
        /*rounded*/
        background: #667eea !important;
        /*bg-indigo-500*/
        border: 1px solid transparent;
        /*border border-transparent*/
      }

      /*Add padding to bottom border */
      table.dataTable.no-footer {
        border-bottom: 1px solid #e2e8f0;
        /*border-b-1 border-gray-300*/
        margin-top: 0.75em;
        margin-bottom: 0.75em;
      }

      input[type="checkbox"] {
        width: 24px;
        height: 24px;
      }

      /*Change colour of responsive icon*/
      table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before,
      table.dataTable.dtr-inline.collapsed
        > tbody
        > tr
        > th:first-child:before {
        background-color: #667eea !important;
        /*bg-indigo-500*/
      }
    </style>
  </head>

  <body class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
    <div class="container w-full md:w-4/5 xl:w-3/5 mx-auto px-2">

        <?php include 'insert_form.php' ?> 

        <!-- Desktop View -->
        <div id="recipients" class="hidden md:block p-8 mt-6 rounded shadow bg-white">
        <div class="pb-5">
        <button
              type="button"
              class="text-white bg-blue-700 inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
            >
              <svg
                class="mr-1 -ml-1 w-6 h-6"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              Add Folder
            </button>
        </div>
            <table id="example" class="stripe hover w-full">
                <thead>
                    <tr>
                        <th>Student Number</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($student = $students->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($student['student_number']) ?></td>
                            <td><?= htmlspecialchars(strtoupper($student['student name'])) ?></td>
                            <td>Year <?= htmlspecialchars($student['year']) ?></td>
                            <td>
                                <select id="status">
                                    <option disabled selected hidden>
                                        <?= $student['status'] == 1 ? "OFFICE" : "ENCODING" ?>
                                    </option>
                                    <option value="office">OFFICE</option>
                                    <option value="encoding">ENCODING</option>
                                </select>
                            </td>
                            <td style="display: flex; gap: 8px;">
                            <button type="button"
                                class="text-white bg-green-500 inline-flex items-center hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2">
                                <svg class="w-[28px] h-[28px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                                </svg>
                            </button>

                            <button type="button"
                                class="text-white bg-red-500 inline-flex items-center hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2">
                                <svg class="w-[28px] h-[28px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Mobile View -->
<div class="block md:hidden p-4 mt-6 rounded shadow bg-white">
<div class="pb-5">
        <button
              type="button"
              class="text-white bg-blue-700 inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
            >
              <svg
                class="mr-1 -ml-1 w-6 h-6"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              Add Folder
            </button>
        </div>
    <input type="text" id="mobileSearch" placeholder="Search for students..." class="w-full p-2 mb-4 border rounded"/>

    <div id="mobileList">
        <?php 
        // Reset the pointer for the result set to reuse it
        $students->data_seek(0); 
        while ($student = $students->fetch_assoc()): ?>
            <div class="p-4 mb-4 border rounded-lg bg-gray-50 shadow-sm student-card">
                <p><strong>Student Number:</strong> <span class="student-number"><?= htmlspecialchars($student['student_number']) ?></span></p>
                <p><strong>Name:</strong> <span class="student-name"><?= htmlspecialchars(strtoupper($student['student name'])) ?></span></p>
                <p><strong>Year:</strong> Year <?= htmlspecialchars($student['year']) ?></p>
                <p><strong>Status:</strong> 
                    <select id="status" class="border rounded px-2 py-1">
                        <option disabled selected hidden>
                            <?= $student['status'] == 1 ? "OFFICE" : "ENCODING" ?>
                        </option>
                        <option value="office">OFFICE</option>
                        <option value="encoding">ENCODING</option>
                    </select>
                </p>
                <div class="flex gap-2 mt-3">
                    <button type="button"
                        class="text-white bg-green-500 inline-flex items-center hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <svg class="w-[28px] h-[28px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <button type="button"
                        class="text-white bg-red-500 inline-flex items-center hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <svg class="w-[28px] h-[28px] text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>

            </div>
        <?php endwhile; ?>
    </div>
</div>

    <!-- jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#example").DataTable({ responsive: false });

            $(".student-card").hide();

            $("#mobileSearch").on("keyup", function () {
                var searchText = $(this).val().toLowerCase();
                if (searchText.length > 0) {
                    $(".student-card").each(function () {
                        var studentNumber = $(this).find(".student-number").text().toLowerCase();
                        var studentName = $(this).find(".student-name").text().toLowerCase();
                        $(this).toggle(studentNumber.includes(searchText) || studentName.includes(searchText));
                    });
                } else {
                    $(".student-card").hide();
                }
            });
        });
    </script>
</body>
</html>
