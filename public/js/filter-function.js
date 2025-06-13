$(document).ready(function () {
  $("#filterButton").on("click", function () {
    $("#filterModal").removeClass("hidden").addClass("flex");
    $("body").addClass("overflow-hidden");
  });

  $("#closeFilterModal").on("click", function () {
    $("#filterModal").removeClass("flex").addClass("hidden");
    $("body").removeClass("overflow-hidden");
  });

  $("#applyFilter").on("click", function () {
    // Get selected years
    selectedYears = [];
    $("#filterModal input[type='checkbox']:checked").each(function () {
      selectedYears.push($(this).val());
    });

    // Get selected status
    selectedStatus = $("#filterModal input[name='status']:checked").val();

    // Get selected enrollment status
    selectedEnrollment = $("#filterModal input[name='folder']:checked").val();

    // Close modal
    $("#filterModal").addClass("hidden").removeClass("flex");
    $("body").removeClass("overflow-hidden");

    // Reset to first page and update table
    currentPage = 1;
    updateTable();
  });
});
