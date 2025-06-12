// ------ for edit Folder modal function ---------
$(document).ready(function () {
  let selectedStudentId = null;
  $(document).on("click", ".editButton", function () {
    $("body").addClass("overflow-hidden");
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
    $("body").removeClass("overflow-hidden");
  });

  $("#updateChanges").on("click", function () {
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
        $("#editFolder").removeClass("flex").addClass("hidden");
        $("body").removeClass("overflow-hidden");

        showTemporaryMessage("#successUpdate", 3000);
        fetchData();
      },
      error: function (xhr, status, error) {
        $("body").removeClass("overflow-hidden");
        $("#editFolder").removeClass("flex").addClass("hidden");
        showTemporaryMessage("#errorMsg", 3000);
      },
    });
  });

  $(document).on("change", ".statusDropDown", function () {
    const selectedStatusValue = $(this).val();
    const id = $(this).data("id");

    const data = {
      status: selectedStatusValue,
    };

    $.ajax({
      url: "http://localhost/folds/public/api/status.php?id=" + id,
      type: "PUT",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (response) {
        console.log("Status Changed: ", response);
        fetchData();
      },
      error: function (xhr, status, error) {
        showTemporaryMessage("#errorMsg", 3000);
      },
    });
  });
});
