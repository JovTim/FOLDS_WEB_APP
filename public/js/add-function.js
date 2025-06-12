// ------ for add Folder modal function ---------

$(document).ready(function () {
  $("#addButton").on("click", function () {
    $("#addFolder").removeClass("hidden").addClass("flex");
  });

  $("#addButtonMobile").on("click", function () {
    $("#addFolder").removeClass("hidden").addClass("flex");
  });

  $("#closeAddModal").on("click", function () {
    $("#addFolder").removeClass("flex").addClass("hidden");
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
        console.log("Sucess: ", response);
        $("#addFolder").removeClass("flex").addClass("hidden");

        $("#firstName").val("");
        $("#middleName").val("");
        $("#lastName").val("");
        $("#studentNumber").val("");
        $("#yearStudent").val("");
        $("#statusFolder").val("");

        fetchData();
      },
      error: function (xhr, status, error) {
        console.error("Error: ", error);
      },
    });

    console.log("submitted");
  });
});
