// ------ for add Folder modal function ---------
$("#addButton").on("click", function () {
  $("#addFolder").removeClass("hidden").addClass("flex");
});
$("#closeAddModal").on("click", function () {
  $("#addFolder").removeClass("flex").addClass("hidden");
});
