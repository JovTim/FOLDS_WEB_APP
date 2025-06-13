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
    $(".error").remove();
    $("#firstName").val("");
    $("#middleName").val("");
    $("#lastName").val("");
    $("#studentNumber").val("");
    $("#yearStudent").val("");
    $("#statusFolder").val("");
  });

  function validateFolderForm() {
    $(".error").remove();

    const firstName = $("#firstName").val().trim();
    const middleName = $("#middleName").val().trim();
    const lastName = $("#lastName").val().trim();
    const studentNumber = $("#studentNumber").val().trim();
    const yearStudent = $("#yearStudent").val();
    const statusFolder = $("#statusFolder").val();

    let isValid = true;

    if (
      firstName === "" ||
      !/^[a-zA-ZñÑ\s]+$/.test(firstName) ||
      firstName.length > 100
    ) {
      isValid = false;
      $("#firstName").after(
        '<span class="error text-red-500">Invalid First Name</span>'
      );
    }

    if (
      middleName !== "" &&
      (!/^[a-zA-ZñÑ\s]*$/.test(middleName) || middleName.length > 100)
    ) {
      isValid = false;
      $("#middleName").after(
        '<span class="error text-red-500">Invalid Middle Name</span>'
      );
    }

    if (
      lastName === "" ||
      !/^[a-zA-ZñÑ\s]+$/.test(lastName) ||
      lastName.length > 100
    ) {
      isValid = false;
      $("#lastName").after(
        '<span class="error text-red-500">Invalid Last Name</span>'
      );
    }

    const studentNumberPattern = /^2\d{3}-\d-\d{4}[A-Za-z]?$/;
    if (
      studentNumber === "" ||
      !studentNumberPattern.test(studentNumber) ||
      studentNumber.length > 15
    ) {
      isValid = false;
      $("#studentNumber").after(
        '<span class="error text-red-500">Invalid Student Number (format: 2xxx-x-xxxx or optional letter)</span>'
      );
    }

    if (yearStudent === "") {
      isValid = false;
      $("#yearStudent").after(
        '<span class="error text-red-500">Year is required</span>'
      );
    }

    if (statusFolder === "") {
      isValid = false;
      $("#statusFolder").after(
        '<span class="error text-red-500">Status is required</span>'
      );
    }

    return isValid;
  }

  $(document).ready(function () {
    $("#submitFolder").on("click", function (event) {
      event.preventDefault();

      if (!validateFolderForm()) return;

      const firstName = $("#firstName").val();
      const middleName =
        $("#middleName").val().trim() === "" ? "-" : $("#middleName").val();
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

          // Clear form
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
});
