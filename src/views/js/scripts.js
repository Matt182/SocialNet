
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //$('#image').attr('src', e.target.result);
            var img = new Image();
            img.src = e.target.result;

            cropp(e.target.result, img.width, img.height);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#input").change(
    function(){
        readURL(this);
    }
);

function cropp(result, zw, zh) {
    $('#dialog').show();
    var element = $(".demo");
    element.croppie({
            viewport: {
                width: 250,
                height: 250
            },
            boundary: {
                width: 299,
                height: 299
            }
    });
    element.croppie('bind', result);
};

function cancel() {
    $('#dialog').hide();
    $('.demo').empty();
}

function save() {
    $('.demo').croppie('result', 'canvas').then(
        function (result) {
            $('.croppie-result').remove();
            $('#picture').attr('src', result);
            $('#hiddenSrc').attr('value', result);
            $('#dialog').hide();
            $('.demo').empty();
        }
    );
}
/**
var vanilla = new Croppie($('.demo'), {
            viewport: { width: 200, height: 200 , type:'square'},
            boundary: { width: 400, height: 400 },
            showZoom: true
        });
        vanilla.bind('dac.jpg');
            vanilla.result('canvas','original').then(function (src) {
                    console.log(src);
                    $('#picture').attr('src', src);
            });
*/
