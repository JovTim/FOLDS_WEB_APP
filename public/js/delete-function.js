// ------ for delete Folder modal function ---------
$(document).ready(function () {
  let deleteSelectedID = null;

  // Open delete modal
  $(document).on("click", ".deleteButton", function () {
    const id = $(this).data("id");
    deleteSelectedID = id;
    console.log("Delete ID:", id);
    $("#deleteFolder").removeClass("hidden").addClass("flex");
  });

  // Close delete modal
  $("#closeDeleteModal").on("click", function () {
    $("#deleteFolder").removeClass("flex").addClass("hidden");
  });

  // Confirm delete
  $("#confirmDeleteFolder").on("click", function () {
    console.log("Folder Deleted:", deleteSelectedID);

    $.ajax({
      url:
        "http://localhost/folds/public/api/folders.php?id=" + deleteSelectedID,
      type: "DELETE",
      success: function (response) {
        console.log("Deleted: ", response);
        // Optional UI update:
        $("#deleteFolder").removeClass("flex").addClass("hidden");
        fetchData();
      },
      error: function (xhr, status, error) {
        console.error("Error: ", error);
      },
    });
  });
});
