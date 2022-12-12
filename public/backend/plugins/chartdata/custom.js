$('#chart');
$(window).on('load', function () {
    setTimeout(removeLoader, 3000);
});

function removeLoader() {
    $(".loader").fadeOut(1000, function () {
        $(".loader").remove();
    });
}

// function clock() {
//     var time = new Date(),
//         hours = time.getHours(),
//         minutes = time.getMinutes(),
//         seconds = time.getSeconds();
//     document.querySelectorAll(".clock")[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(
//         seconds);

//     function harold(standIn) {
//         if (standIn < 10) {
//             standIn = "0" + standIn;
//         }
//         return standIn;
//     }
// }
// setInterval(clock, 1000);
