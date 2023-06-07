jQuery(function($) {
  // form toggle
  function formToggle(options) {
    var $group = $('[data-form-toggle-group="' + options.toggleGroup + '"]');

    function toggleClick(e) {
      var $this = $(this);
      var selected = $this.data("form-toggle-selected");
      if (!selected) {
        // toggle off

        var saveValue = null;

        $group.each(function(i) {
          var $eachThis = $(this);
          var $eachTarget = $($eachThis.data("form-toggle"));

          if ($eachThis.data("form-toggle-selected")) {
            saveValue = $eachTarget.val();
          }

          $eachTarget
            .addClass("hidden")
            .val("")
            .attr("disabled", true);

          $eachThis
            .data("form-toggle-selected", false)
            .removeClass("order-total-toggle-on")
            .addClass("order-total-toggle-off");
        });

        // toggle on

        var $target = $($this.data("form-toggle"));

        $target
          .removeClass("hidden")
          .attr("disabled", false)
          .val(saveValue);

        $this
          .data("form-toggle-selected", true)
          .removeClass("order-total-toggle-off")
          .addClass("order-total-toggle-on");
      }
    }

    for (i = 0; i < options.toggleSelectors.length; i++) {
      $(options.toggleSelectors[i]).on("click", toggleClick);
    }
  }

  formToggle({
    toggleSelectors: [
      ".js-order-discount-fixed",
      ".js-order-discount-percent"
    ],
    toggleGroup: "orderDiscount"
  });

  formToggle({
    toggleSelectors: [
      ".js-order-commision-fixed",
      ".js-order-commision-percent"
    ],
    toggleGroup: "orderCommision"
  });
});