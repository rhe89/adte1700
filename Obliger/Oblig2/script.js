$(".athlete-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/oblig2/athlete/athlete.php?"+id;
    }
);

$(".spectator-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/oblig2/spectator/spectator.php?"+id;
    }
);

$(".event-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/oblig2/event/event.php?"+id;
    }
);