$(function() {
    $('.fotorama').fotorama({
        width: 360,
        height: 485,
        transition: "crossfade",
        click: false,
        nav: "thumbs",
        navwidth: 360,
        thumbwidth: 80,
        thumbheight: 80,
        thumbmargin: 15,
        thumbborderwidth: 1,
        allowfullscreen: true,
        hash: true,
        loop: true
    });
})
