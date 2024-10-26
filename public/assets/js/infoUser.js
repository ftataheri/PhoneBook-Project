function infoUser(user_id)
{
    console.log(user_id)
    // var user_id = id;

    $.ajax({
        type: "POST",
        // contentType: "application/json; charset=utf-8",
        url: "{{ url('/infoUser') }}",
        data: {'id': user_id,
            '_token': '{{csrf_token()}}'
        },
        success: function (result) {
            console.table({phone:"name", lastname:"Doe"});
            console.log(result)
            // do something here
        }
    });
}
