@include('main')
<div class="container-fluid mt-3">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>موبایل</th>
                <th>آدرس</th>
            </tr>
            </thead>
            <tbody>
            @foreach($category as $key => $data)
                <tr>
                    <td>{{$data->first_name}}</td>
                    <td>{{$data->last_name}}</td>
                    <td>{{$data->phone_number}}</td>
                    <td>{{$data->address}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- scripts js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="/assets/bootstrap-4.3.1/bootstrap-4.3.1-dist/js/bootstrap.js"></script>
<script src="/assets/bootstrap-4.3.1/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
</html>
