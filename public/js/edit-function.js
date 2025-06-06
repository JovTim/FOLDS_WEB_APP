// ------ for edit Folder modal function ---------
$(document).on("click", ".editButton", function () {
  const id = $(this).data("id");
  console.log("Edit ID:", id);
  $("#editFolder").removeClass("hidden").addClass("flex");
});

$("#closeEditModal").on("click", function () {
  $("#editFolder").removeClass("flex").addClass("hidden");
});
