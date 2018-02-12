var tag = document.createElement('script');
tag.src = 'https://www.youtube.com/player_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
var tv,
        playerDefaults = {autoplay: 0, autohide: 1, modestbranding: 0, rel: 0, showinfo: 0, controls: 0, disablekb: 1, enablejsapi: 0, iv_load_policy: 3};
var vid = [
    {'videoId': '6OkY9aq4lBM', 'startSeconds': 515, 'endSeconds': 28500, 'suggestedQuality': 'hd720'}
],
        randomVid = Math.floor(Math.random() * vid.length),
        currVid = randomVid;

$('.hi em:last-of-type').html(vid.length);

function onYouTubePlayerAPIReady() {
    tv = new YT.Player('tv', {events: {'onReady': onPlayerReady, 'onStateChange': onPlayerStateChange}, playerVars: playerDefaults});
}

function onPlayerReady() {
    tv.loadVideoById(vid[currVid]);
}

function onPlayerStateChange(e) {
    if (e.data === 1) {
        $('#tv').addClass('active');
        $('.hi em:nth-of-type(2)').html(currVid + 1);
    } else if (e.data === 2) {
        $('#tv').removeClass('active');
        if (currVid === vid.length - 1) {
            currVid = 0;
        } else {
            currVid++;
        }
        tv.loadVideoById(vid[currVid]);
        tv.seekTo(vid[currVid].startSeconds);
    }
}

function vidRescale() {

    var w = $(window).width() + 200,
            h = $(window).height() + 200;

    if (w / h > 16 / 9) {
        tv.setSize(w, w / 16 * 9);
        $('.tv .screen').css({'left': '0px'});
    } else {
        tv.setSize(h / 9 * 16, h);
        $('.tv .screen').css({'left': -($('.tv .screen').outerWidth() - w) / 2});
    }
}

$(window).on('load resize', function () {
    vidRescale();
});

$('#mute').on('click', function () {
    $('#tv').toggleClass('mute');
    if ($('#tv').hasClass('mute')) {
        $('#mute').html("Resume"),
                tv.mute();
    } else {
        $('#mute').html("Mute"),
                tv.unMute();
    }
});


//var screenwidth = screen.width;
//
//if (screenwidth < 500) {
//    var spaces = "<br><br><br>";
//    $('#smallscreen').append(spaces);
//}


//$('.hi span:last-of-type').on('click', function () {
//    $('.hi em:nth-of-type(2)').html('~');
//    tv.pauseVideo();
//});
//play on mobile
//var myvideo = document.getElementsByTagName('video')[0];
//
//myvideo.addEventListener('loadeddata', function () {
//    console.log("** RECEIVED loadeddata **");
//    $('#tv').toggleClass('mute');
//    tv.Mute();
//    tv.unMute();
//    myvideo.play();//this first play is needed for Android 4.1+
//}, false);
//
//myvideo.addEventListener('canplaythrough', function () {
//    console.log("** RECEIVED canplaythrough **");
//    tv.Mute();
//    tv.unMute();
//    myvideo.play();//this second play is needed for Android 4.0 only
//}, false);