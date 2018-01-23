function FormAction(FormSelector){
    $(FormSelector).on('submit',function(event) {
        event.preventDefault();
        event.stopPropagation();
        var Form = $(this);

        console.log(JSON.stringify(Form.serialize()));
        console.log(Form.attr('action'));

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: Form.attr('action'),
            data: Form.serialize(),
            //contentType: "application/json; charset=utf-8",
            success: function (data) {
                console.log(data);

                /*if(data.status){
                    var childs = FormSelector + ' .form-control';
                    $(childs).val('');
                }
                console.log(JSON.stringify(data));
                AlertSetup(data.message);*/
            },
            error: function (jqXHR) {
               /* AlertSetup('Network Error', 'Something went wrong');*/
                console.log('Error: '+ JSON.stringify(jqXHR));
            }
        });
    });
}
$(document).ready(function () {
    FormAction('#form-careerpress');
});
