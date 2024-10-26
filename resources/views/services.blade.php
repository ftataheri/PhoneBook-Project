@include('main')

<div class="row m-5">
    @foreach($category as $key => $data)
        <div class="col-sm-4">
            <div class="card m-2">
                <div class="card-body">
{{--                    <a href="/services/{{$data->id}}" class="card-title">{{$data->service_name}}</a>--}}

                    @if($data->parent_id != 0)
                        <a href="/details/{{$data->id}}" class="card-title">{{$data->service_name}}</a>

                    @else
                        <a href="/services/{{$data->id}}" class="card-title">{{$data->service_name}}</a>

                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
