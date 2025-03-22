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
        <h1 class="font-bold text-indigo-500 px-2 py-8 text-xl md:text-2xl">
            STUDENT FOLDERS
        </h1>

        <!-- Desktop View -->
        <div id="recipients" class="hidden md:block p-8 mt-6 rounded shadow bg-white">
            <table id="example" class="stripe hover w-full">
                <thead>
                    <tr>
                        <th>Student Number</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($student = $students->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($student['student_number']) ?></td>
                            <td><?= htmlspecialchars($student['student name']) ?></td>
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
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Mobile View -->
        <div class="block md:hidden p-4 mt-6 rounded shadow bg-white">
            <input type="text" id="mobileSearch" placeholder="Search for students..." class="w-full p-2 mb-4 border rounded"/>

            <div id="mobileList">
                <?php 
                // Reset the pointer for the result set to reuse it
                $students->data_seek(0); 
                while ($student = $students->fetch_assoc()): ?>
                    <div class="p-4 mb-4 border rounded-lg bg-gray-50 shadow-sm student-card">
                        <p><strong>Student Number:</strong> <span class="student-number"><?= htmlspecialchars($student['student_number']) ?></span></p>
                        <p><strong>Name:</strong> <span class="student-name"><?= htmlspecialchars($student['student name']) ?></span></p>
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
                    </div>
                <?php endwhile; ?>
            </div>
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
