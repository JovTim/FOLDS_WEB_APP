<?php
include 'connection.php';
include 'api.php';

ob_start();
showFolders($conn);
$jsonData = ob_get_clean();

$students = json_decode($jsonData, true);

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
    <!--Container-->
    <div class="container w-full md:w-4/5 xl:w-3/5 mx-auto px-2">
      <!--Title-->
      <h1
        class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl"
      >
        STUDENT FOLDERS
      </h1>

      <!--Card-->
      <div id="recipients" class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table
          id="example"
          class="stripe hover"
          style="width: 100%; padding-top: 1em; padding-bottom: 1em"
        >
          <thead>
            <tr>
              <th data-priority="1">Student Number</th>
              <th data-priority="3">Name</th>
              <th data-priority="4">Year</th>
              <th data-priority="2">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($students as $student): ?>
              <tr>
            <td><?= htmlspecialchars($student['student_number']) ?></td>
            <td><?= htmlspecialchars($student['student name']) ?></td>
            <td><?php echo "Year " . $student['year']?></td>
            <td>
              <select id="status">
              <option disabled selected hidden><?php if ($student['status'] == 1) 
              {
                echo "OFFICE";
                } else {
                  echo "ENCODING";
                }
                ?></option>
              <option value="office">OFFICE</option>
              <option value="encoding">ENCODING</option>
              </select>
            </td>
        </tr>
        <?php endforeach; ?>

            <tr>
              <td>2022-8-0121</td>
              <td>McAurthur, James Dauglas</td>
              <td>Year 1</td>
              <td class="flex justify-center items-center">
              <input checked id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              </td>
            </tr>

            <tr>
              <td>2021-8-0512</td>
              <td>Piatos, Mea Aloy</td>
              <td>Year 2</td>
              <td>
                <select id="status">
                  <option disabled selected hidden>Encoding</option>
                  <option value="office">Office</option>
                  <option value="encoding">Encoding</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--/Card-->
    </div>
    <!--/container-->

    <!-- jQuery -->
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-3.4.1.min.js"
    ></script>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
      $(document).ready(function () {
        var table = $("#example")
          .DataTable({
            responsive: true,
          })
          .columns.adjust()
          .responsive.recalc();
      });
    </script>
  </body>
</html>
