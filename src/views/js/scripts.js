
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //$('#image').attr('src', e.target.result);
            var img = new Image();
            img.src = e.target.result;
            var width = img.width;
            if (width > 250) {
                var percents = 1 - 250/width;
                var onePercentW = img.width/100;
                var onePercentH = img.height/100;
                img.width = 250;
                //img.height -= onePercentH*percents;
                console.log(img.width);
            }
            cropp(e.target.result, img.width, img.height);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#input").change(function(){
    readURL(this);
});

function cropp(result, zw, zh) {
    $('#dialog').show();
    $('.demo').croppie({
        viewport: {
            width: zw-50,
            height: zw-50,
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
}

function save() {
    $('.demo').croppie('result', 'canvas', 'jpg').then(function (result) {
        $('.croppie-result').remove();
        $('#picture').attr('src', result);
        $('#hiddenSrc').attr('value', result);
        $('#dialog').hide();
    });
}
/**
function getResult(){
$('.demo').croppie('result', 'html', 'jpg').then(function (result) {
$('.croppie-result').remove();
$('#result').append(result);
});
};
*/
