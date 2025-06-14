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

    if (is_enrolled == 2) {
      $("#unArchiveFolder").removeClass("hidden");
      $("#archiveFolder").addClass("hidden");
    } else {
      $("#archiveFolder").removeClass("hidden");
      $("#unArchiveFolder").addClass("hidden");
    }

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

  function validateEditFolderForm() {
    // Remove previous error messages
    $(".error").remove();

    // Get form values
    const firstName = $("#firstNameEdit").val().trim();
    const middleName = $("#middleNameEdit").val().trim();
    const lastName = $("#lastNameEdit").val().trim();
    const studentNumber = $("#studentNumberEdit").val().trim();
    const yearStudent = $("#yearOptionEdit").val();
    const statusFolder = $("#statusOptionEdit").val();

    let isValid = true;

    // Validate First Name
    if (
      firstName === "" ||
      !/^[a-zA-ZñÑ\s]+$/.test(firstName) ||
      firstName.length > 100
    ) {
      isValid = false;
      $("#firstNameEdit").after(
        '<span class="error text-red-500">Invalid First Name</span>'
      );
    }

    // Validate Middle Name (optional)
    if (
      middleName !== "" &&
      (!/^[a-zA-ZñÑ\s]*$/.test(middleName) || middleName.length > 100)
    ) {
      isValid = false;
      $("#middleNameEdit").after(
        '<span class="error text-red-500">Invalid Middle Name</span>'
      );
    }

    // Validate Last Name
    if (
      lastName === "" ||
      !/^[a-zA-ZñÑ\s]+$/.test(lastName) ||
      lastName.length > 100
    ) {
      isValid = false;
      $("#lastNameEdit").after(
        '<span class="error text-red-500">Invalid Last Name</span>'
      );
    }

    // Validate Student Number
    const studentNumberPattern = /^2\d{3}-\d-\d{4}[A-Za-z]?$/;
    if (
      studentNumber === "" ||
      !studentNumberPattern.test(studentNumber) ||
      studentNumber.length > 15
    ) {
      isValid = false;
      $("#studentNumberEdit").after(
        '<span class="error text-red-500">Invalid Student Number (format: 2xxx-x-xxxx or optional letter)</span>'
      );
    }

    // Validate Year
    if (yearStudent === "") {
      isValid = false;
      $("#yearOptionEdit").after(
        '<span class="error text-red-500">Year is required</span>'
      );
    }

    // Validate Status
    if (statusFolder === "") {
      isValid = false;
      $("#statusOptionEdit").after(
        '<span class="error text-red-500">Status is required</span>'
      );
    }

    return isValid;
  }

  $("#updateChanges").on("click", function () {
    if (!validateEditFolderForm()) return;

    const data = {
      student_number: $("#studentNumberEdit").val(),
      f_name: $("#firstNameEdit").val(),
      m_name:
        $("#middleNameEdit").val().trim() === ""
          ? "-"
          : $("#middleNameEdit").val(),
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
        console.log("Error: ", error);
        showTemporaryMessage("#errorMsg", 3000);
      },
    });
  });

  $("#archiveFolder").on("click", function () {
    console.log("Archived: ", selectedStudentId);

    const data = {
      is_enrolled: 2,
    };

    $.ajax({
      url:
        "http://localhost/folds/public/api/archive.php?id=" + selectedStudentId,
      type: "PUT",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (response) {
        console.log("Folder: ", response);
        $("#editFolder").removeClass("flex").addClass("hidden");
        $("body").removeClass("overflow-hidden");
        fetchData();
        showTemporaryMessage("#successArch", 3000);
      },
      error: function (xhr, status, error) {
        console.log("Error: ", error);
        $("#editFolder").removeClass("flex").addClass("hidden");
        $("body").removeClass("overflow-hidden");
        showTemporaryMessage("#errorMsg", 3000);
      },
    });
  });

  $("#unArchiveFolder").on("click", function () {
    console.log("Unarchived: ", selectedStudentId);

    const data = {
      is_enrolled: 1,
    };

    $.ajax({
      url:
        "http://localhost/folds/public/api/archive.php?id=" + selectedStudentId,
      type: "PUT",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (response) {
        console.log("Folder: ", response);
        $("#editFolder").removeClass("flex").addClass("hidden");
        $("body").removeClass("overflow-hidden");
        fetchData();
        showTemporaryMessage("#successUnarch", 3000);
      },
      error: function (xhr, status, error) {
        console.log("Error: ", error);
        $("#editFolder").removeClass("flex").addClass("hidden");
        $("body").removeClass("overflow-hidden");
        showTemporaryMessage("#errorMsg", 3000);
      },
    });
  });
});
