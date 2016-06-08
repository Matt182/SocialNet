
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //$('#image').attr('src', e.target.result);
            var img = new Image();
            img.src = e.target.result;
            var width = img.width;
            if (width > 250) {
                img.width = 250;
            }
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
    $('.demo').croppie({
            viewport: {
                width: 250,
                height: 250,
                type: 'square'
            },
            boundary: {
                width: zw,
                height: zh
            }
    });
    $('.demo').croppie('bind', result);
};

function cancel() {
    $('#dialog').hide();
    $('.demo').empty();
}

function save() {
    $('.demo').croppie('result', 'canvas', 'jpg').then(
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
function getResult(){
$('.demo').croppie('result', 'html', 'jpg').then(function (result) {
$('.croppie-result').remove();
$('#result').append(result);
});
};
*/
