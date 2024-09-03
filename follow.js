$(document).ready(function() {
    $(".follow").on("click", function() {
        const akapit = $(this);
        $.post("changeFollow.php", { idObserwowanego: "'" + akapit.data("obserwowany") + "'"}, function(data) {
        if (data == "sukces") {
        akapit.text((akapit.text() == "Obserwuj") ? "Przestań obserwować" : "Obserwuj");;
        }
        });
    });
});
  