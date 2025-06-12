// ------ for add Folder modal function ---------

$(document).ready(function () {
  $("#addButton").on("click", function () {
    $("#addFolder").removeClass("hidden").addClass("flex");
    $("body").addClass("overflow-hidden");
  });

  $("#addButtonMobile").on("click", function () {
    $("#addFolder").removeClass("hidden").addClass("flex");
    $("body").addClass("overflow-hidden");
  });

  $("#closeAddModal").on("click", function () {
    $("#addFolder").removeClass("flex").addClass("hidden");
    $("body").removeClass("overflow-hidden");
  });

  $("#submitFolder").on("click", function () {
    const firstName = $("#firstName").val();
    const middleName =
      $("#middleName").val().trim() === "" ? null : $("#middleName").val();
    const lastName = $("#lastName").val();
    const studentNumber = $("#studentNumber").val();
    const yearStudent = $("#yearStudent").val();
    const statusFolder = $("#statusFolder").val();

    $.ajax({
      url: "http://localhost/folds/public/api/folders.php",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        student_number: studentNumber,
        f_name: firstName,
        m_name: middleName,
        l_name: lastName,
        year: yearStudent,
        status: statusFolder,
      }),
      success: function (response) {
        $("#addFolder").removeClass("flex").addClass("hidden");

        showTemporaryMessage("#successAdd", 3000);

        $("#firstName").val("");
        $("#middleName").val("");
        $("#lastName").val("");
        $("#studentNumber").val("");
        $("#yearStudent").val("");
        $("#statusFolder").val("");

        $("body").removeClass("overflow-hidden");

        fetchData();
      },
      error: function (xhr, status, error) {
        $("#addFolder").removeClass("flex").addClass("hidden");
        showTemporaryMessage("#errorMsg", 3000);
      },
    });

    $("body").removeClass("overflow-hidden");
  });
});
