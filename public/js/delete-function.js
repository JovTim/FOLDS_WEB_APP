// ------ for delete Folder modal function ---------
$(document).ready(function () {
  let deleteSelectedID = null;

  // Open delete modal
  $(document).on("click", ".deleteButton", function () {
    const id = $(this).data("id");
    deleteSelectedID = id;
    $("#deleteFolder").removeClass("hidden").addClass("flex");
    $("body").addClass("overflow-hidden");
  });

  // Close delete modal
  $("#closeDeleteModal").on("click", function () {
    $("#deleteFolder").removeClass("flex").addClass("hidden");
    $("body").removeClass("overflow-hidden");
  });

  // Confirm delete
  $("#confirmDeleteFolder").on("click", function () {
    $.ajax({
      url: "api/folders.php?id=" + deleteSelectedID,
      type: "DELETE",
      success: function (response) {
        // Optional UI update:
        $("#deleteFolder").removeClass("flex").addClass("hidden");
        $("body").removeClass("overflow-hidden");

        showTemporaryMessage("#successRemove", 3000);

        fetchData();
      },
      error: function (xhr, status, error) {
        $("#deleteFolder").removeClass("flex").addClass("hidden");
        $("body").removeClass("overflow-hidden");
      },
    });
  });
});
