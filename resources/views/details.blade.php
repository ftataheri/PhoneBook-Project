@include('main')
<div class="row m-5">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <img class="rounded mx-auto d-block" width="20%" src="/assets/images/profile-pic.png">
                <h4 class="text-center m-3" id="nameService">{{$service->service_name}}</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>توضیحات</th>
                            <th>خدمات</th>
                            <th>شرایط</th>
                            <th>آدرس</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td id="descriptionService">{{$service->service_description}}</td>
                            <td id="services">{{$service->services}}</td>
                            <td id="conditionsService">{{$service->conditions}}</td>
                            <td id="addressService">{{$service->address}}</td>
                            <td>
                                <a type="button" class="btn btn-secondary mt-2" href="/receipt/{{$service->id}}">گزارشات</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<script>--}}
{{--    function infoServices(service_id) {--}}
{{--        $.ajax({--}}
{{--            type: "POST",--}}
{{--            url: "{{ url('/infoUser') }}",--}}
{{--            data: {--}}
{{--                'id': service_id,--}}
{{--                '_token': '{{csrf_token()}}'--}}
{{--            },--}}
{{--            success: function (result) {--}}
{{--                $('#nameService').html(result['service_name'])--}}
{{--                $('#descriptionService').html(result['service_description'])--}}
{{--                $('#services').html(result['services'])--}}
{{--                $('#conditionsService').html(result['conditions'])--}}
{{--                $('#addressService').html(result['address'])--}}
{{--                // $('#services').modal('show')--}}
{{--                console.log(result)--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}
