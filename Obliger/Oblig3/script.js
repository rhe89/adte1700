$(".athlete-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/oblig3/athlete/athlete.php?"+id;
    }
);

$(".spectator-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/oblig3/spectator/spectator.php?"+id;
    }
);

$(".event-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/oblig3/event/event.php?"+id;
    }
);

$("#admin-menu-toggle").click(function() {
    $("#admin-menu").slideToggle();
});