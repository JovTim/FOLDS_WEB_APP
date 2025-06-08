// ------ for edit Folder modal function ---------
$(document).ready(function () {
  let selectedStudentId = null;
  $(document).on("click", ".editButton", function () {
    const btn = $(this);

    const id = btn.data("id");
    selectedStudentId = id;
    const student_number = btn.data("studentNumber");
    const f_name = btn.data("fName");
    const m_name = btn.data("mName");
    const l_name = btn.data("lName");
    const year = btn.data("year");
    const status = btn.data("status");
    const is_enrolled = btn.data("isEnrolled");

    // for debug purpose
    console.log("Edit ID:", id);
    console.log("Edit Number:", student_number);
    console.log("Edit First:", f_name);
    console.log("Edit Middle:", m_name);
    console.log("Edit Last:", l_name);
    console.log("Edit Year:", year);
    console.log("Edit Status:", status);
    console.log("Edit Enrolled:", is_enrolled);

    $("#firstNameEdit").val(f_name);
    $("#middleNameEdit").val(m_name);
    $("#lastNameEdit").val(l_name);
    $("#studentNumberEdit").val(student_number);
    $("#yearOptionEdit").val(year);
    $("#statusOptionEdit").val(status);

    $("#editFolder").removeClass("hidden").addClass("flex");
  });

  // Close edit modal on close button click
  $("#closeEditModal").on("click", function () {
    $("#editFolder").removeClass("flex").addClass("hidden");
  });

  $("#updateChanges").on("click", function () {
    // for debug purpose
    console.log("ID: ", selectedStudentId);
    console.log("Update Number:", $("#studentNumberEdit").val());
    console.log("Update First:", $("#firstNameEdit").val());
    console.log("Update Middle:", $("#middleNameEdit").val());
    console.log("Update Last:", $("#lastNameEdit").val());
    console.log("Update Year:", $("#yearOptionEdit").val());
    console.log("Update Status:", $("#statusOptionEdit").val());
    console.log("Update Enrolled:", 1);

    const data = {
      student_number: $("#studentNumberEdit").val(),
      f_name: $("#firstNameEdit").val(),
      m_name: $("#middleNameEdit").val(),
      l_name: $("#lastNameEdit").val(),
      year: $("#yearOptionEdit").val(),
      status: $("#statusOptionEdit").val(),
      is_enrolled: 1,
    };

    $.ajax({
      url:
        "http://localhost/folds/public/api/folders.php?id=" + selectedStudentId,
      type: "PUT",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (response) {
        console.log("Updated: ", response);
        $("#editFolder").removeClass("flex").addClass("hidden");
        fetchData();
      },
      error: function (xhr, status, error) {
        console.error("Error: ", error);
      },
    });
  });
});
