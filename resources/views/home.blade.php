<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('header')

<div class="container-fluid mt-3">
    <button type="button" class="btn btn-success m-3 float-right" data-toggle="modal" data-target="#add_user">افزودن
        کاربر
    </button>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>عکس</th>
                <th>موبایل</th>
                <th>ایمیل</th>
                <th>آدرس</th>
                <th>تاریخ ثبت</th>
                <th>تاریخ بروزرسانی</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $data)
                <tr>
                    <td class="user_id">{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>

                        @if( $data->pic == null)
                            -
                        @else
                            <img width="20%" src="/uploads/{{$data->pic}}"

                        @endif
                    </td>
                    <td>{{$data->mobile}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->address}}</td>

                    <td>{{ new Verta(\Carbon\Carbon::createFromTimestamp($data->create_time)->setTimezone('+3:30'))}}</td>
                    <td>
                        @if( $data->update_time == null)
                            -
                        @else
                            {{new Verta(\Carbon\Carbon::createFromTimestamp($data->update_time)->setTimezone('+3:30'))}}

                        @endif
                    </td>

                    {{--                    <td>{{jdate($data->create_time)}}</td>--}}
                    {{--                    <td>{{jdate($data->update_time)}}--}}
                    {{--                        @if( $data->update_time == null )--}}
                    {{--                            -
                    --}}
                    {{--                        @else {{jdate($data->update_time)}}--}}
                    {{--                    @endif--}}
                    {{--                       </td>--}}
                    <td>{{$data->description}}</td>
                    <td>
                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#view"
                                onclick="infoUser({{$data->id}})">نمایش
                        </button>
                        <button type="button" class="btn btn-secondary mt-2" data-toggle="modal" data-target="#edit"
                                onclick="updateUserView({{$data->id}})">ویرایش
                        </button>
                        {{--                        <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#delete" onclick="deleteUser({{$data->id}})">delete--}}
                        {{--                        </button>--}}
                        <a type="button" class="btn btn-danger mt-2" href="delete/{{$data->id}}">حذف</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- The Modal add user -->
        <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title fs-5">صفحه افزودن کاربر</h4>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">&times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="/submit" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 mb-3">
                                <label for="name" class="col-form-label float-right">نام</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastname" class="col-form-label float-right">نام خانوادگی</label>
                                <input type="text" class="form-control" name="lastname">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="col-form-label float-right">موبایل</label>
                                <input type="text" class="form-control" name="mobile" pattern="^09[0-9]{9}$">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="col-form-label float-right">ایمیل</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="birth_date" class="col-form-label float-right">تاریخ تولد</label>
                                <input type="text" class="form-control datepicker" name="birth_date">
                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>>تاریخ صحیح نیست</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pic" class="col-form-label float-right">عکس</label>
                                <input type="file" class="form-control" name="pic">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="col-form-label float-right">آدرس</label>
                                <textarea class="form-control" name="address"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label float-right">توضیحات</label>
                                <textarea class="form-control" name="message-text"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">ثبت</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>

                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal view -->
        <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">مشخصات کاربر</h4>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">&times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body ">
                        <img class="rounded mx-auto d-block" width="30%" src="/uploads/{{$data->pic}}">
                        <h4 class="modal-title text-center" id="nameView"></h4>
                        <div class="table-responsive">

                            <table class="table table-striped table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>موبایل</th>
                                    <th>ایمیل</th>
                                    <th>آدرس</th>
                                    <th>توضیحات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td id="mobileView"></td>
                                    <td id="emailView"></td>
                                    <td id="addressView"></td>
                                    <td id="descriptionView"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal edit -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-lg modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title fs-5">ویرایش کاربر</h4>
                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">&times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="/edit" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="col-form-label float-right">نام</label>
                                <input type="text" class="form-control" name="name" id="nameEdit" value="">
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="col-form-label float-right">نام خانوادگی</label>
                                <input type="text" class="form-control" name="lastname" id="lastnameEdit" value="">
                            </div>

                            <div class="mb-3">
                                <label for="pic" class="col-form-label float-right">عکس</label>
                                <input type="file" class="form-control" name="pic" value="">
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="col-form-label float-right">موبایل</label>
                                <input type="text" class="form-control" name="mobile" id="mobileEdit" value="">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label float-right">ایمیل</label>
                                <input type="text" class="form-control" name="email" id="emailEdit" value="">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="col-form-label float-right">آدرس</label>
                                <textarea class="form-control" name="address" id="addressEdit"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label float-right">توضیحات</label>
                                <textarea class="form-control" name="message-text" id="descriptionEdit"></textarea>
                            </div>
                            <input type="hidden" class="form-control" name="id" id="idEdit" value="">
                            <input type="hidden" class="form-control" name="update_time" id="dateEdit" value="">


                            <button type="submit" class="btn btn-primary">بروزرسانی</button>
                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">بستن</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footer')


<!-- scripts js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="/assets/bootstrap-4.3.1/bootstrap-4.3.1-dist/js/bootstrap.js"></script>
<script src="/assets/bootstrap-4.3.1/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap4.js"></script>

<script>
    function infoUser(user_id) {
        $.ajax({
            type: "POST",
            url: "{{ url('/infoUser') }}",
            data: {
                'id': user_id,
                '_token': '{{csrf_token()}}'
            },
            success: function (result) {
                $('#nameView').html(result['name'])
                $('#mobileView').html(result['mobile'])
                $('#emailView').html(result['email'])
                $('#addressView').html(result['address'])
                $('#descriptionView').html(result['description'])
                $('#pic').html(result['pic'])
                // $('#updateDate').html(result['update_time'])
                $('#view').modal('show')
                console.log(result)
            }
        });
    }

    function updateUserView(user_id) {
        console.log(user_id)
        $.ajax({
            type: "POST",
            url: "{{ url('/updateUserView') }}",
            data: {
                'id': user_id,
                '_token': '{{csrf_token()}}'
            },
            success: function (result) {
                $('#idEdit').val(result['id'])
                $('#nameEdit').val(result['name'])
                $('#mobileEdit').val(result['mobile'])
                $('#emailEdit').val(result['email'])
                $('#addressEdit').val(result['address'])
                $('#descriptionEdit').val(result['description'])
                $('#pic').val(result['pic'])
                $('#dateEdit').val(result['update_time'])
                $('#edit').modal('show')
                console.log(result['name'])
                console.log(`result`)
            }
        });
    }

    function deleteUser(user_id) {
        console.log(user_id)
        $.ajax({
            type: "POST",
            url: "{{ url('/deleteUser') }}",
            data: {
                'id': user_id,
                '_token': '{{csrf_token()}}'
            },
            success: function (result) {
                $('#idDelete').val(result['id'])

                console.log(result)
            }
        });

    }

    new DataTable('#example');


</script>
</html>


