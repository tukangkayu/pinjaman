$('.btn-fundraiser').click(function() {
    data = $("#form-fundraiser").serializeFormJSON();
    urlCheck = $(this).data('url-check');
    $.ajax({
        type: "POST",
        url: urlCheck,
        data: data,
        cache: false,
        success: function (data) {
            if (data.is_available == true) {
                //$("#currency-format").val($("#currency-format").autoNumeric("get"));
                $("#form-fundraiser").submit();
            } else {
                $('.text-info').show();
            }
        },
        error: function (err) {
            console.log(err)
        }
    });
})

function slugformat(input) {
    input.value = input.value.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, ''); 
    return true;
}