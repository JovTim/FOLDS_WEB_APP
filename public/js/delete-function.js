// ------ for delete Folder modal function ---------
$(document).on("click", ".deleteButton", function () {
  const id = $(this).data("id");
  console.log("Delete ID:", id);
  $("#deleteFolder").removeClass("hidden").addClass("flex");
});

$("#closeDeleteModal").on("click", function () {
  $("#deleteFolder").removeClass("flex").addClass("hidden");
});
