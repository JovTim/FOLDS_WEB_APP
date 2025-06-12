function showTemporaryMessage(selector, duration) {
  $(selector).removeClass("hidden").addClass("flex");
  setTimeout(function () {
    $(selector).removeClass("flex").addClass("hidden");
  }, duration);
}
