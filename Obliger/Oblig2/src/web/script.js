/**
 * Created by Roar on 26.02.15.
 */
function showEvent() {

}

$(".athlete-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/ADTE1700/Oblig2/web/athlete.php?"+id;
    }
);

$(".spectator-row").click(function () {
        var id = $(this).prop('id');
        document.location.href = "/ADTE1700/Oblig2/web/spectator.php?"+id;
    }
);