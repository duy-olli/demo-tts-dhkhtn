var audioElement = document.createElement('audio');

function getTTS(text) {
    audioElement.pause();

    $.ajax({
        type: 'GET',
        url: '/',
        data: {
            text: text
        },
        success: function(base64encodeString) {
            srcString = 'data:audio/mp3;base64,' + base64encodeString
            audioElement.setAttribute('src', srcString);
            audioElement.play();
        },
        beforeSend: function() {
            $('.loading').show();
        },
        complete: function() {
            $('.loading').hide();
        }
    });
}

$(document).ready(function() {
    $('.loading').hide();

    $('.getlink').on('click', function() {
        var text = $('.keyword').val();

        return getTTS(text);
    });

    $('.keyword').keypress(function (e) {
        if (e.which == 13) {
            var text = $('.keyword').val();

            return getTTS(text);
        }
    });
});
