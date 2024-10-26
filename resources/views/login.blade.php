@include('main')

<div id="login" class="position-fixed container-fluid">
    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12 bg-white">
            <div style="padding: 80px">
                <h4>ecrop
                    <img src="/assets/images/Vector%20(1).png">
                </h4>
                <h4>سلام به ecrop خوش آمدید </h4>
                <form style="margin-top: 50px" action="/profile" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="id" id="idUserLogin" value="">
                    <div class="form-group">
                        <label class="float-right" for="email">ایمیل</label>
                        <input type="email" class="form-control" name="email"
                               required id="emailLogin" aria-describedby="email"
                               placeholder="نام کاربری خود را وارد کنید" value="">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>ایمیل وجود ندارد</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="float-right" for="password">رمز عبور</label>
                        <input type="password" name="password" required autocomplete="new-password"
                               class="form-control" id="password" placeholder="رمز را وارد کنید" value="">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>رمز عبور صحیح نیست</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="captcha">
                            <span>{!! captcha_img('math') !!}</span>
                            <button type="button" class="btn btn-danger reload" id="reload">&#x21bb;</button>
                        </div>
                        <input type="text" class="form-control mt-2" placeholder="جمع اعداد را وارد کنید"
                               name="captcha">
                        @error('captcha')
                        <span class="invalid-feedback" role="alert">
                        <strong>رمز عبور صحیح نیست</strong>
                    </span>
                        @enderror

                    </div>
                    <div class="form-check float-right">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label mr-3" for="check">مرا بخاطر بسپار</label>
                    </div>
                    <a class="float-right mt-5 mb-3" href="#">رمز خود را فراموش کردید ؟</a>
                    <button type="submit" class="btn btn-primary btn-block" onclick="">ورود</button>
                    <button type="button" class="btn btn-outline-secondary btn-block">
                        <img width="7%" src="/assets/images/icons8-google-480.png">ورود با اکانت گوگل
                    </button>
                </form>
            </div>
        </div>
        <div class="col-8 d-none d-sm-block d-md-none d-lg-block" style="background-image: url(/assets/images/Rectangle%201.png);
     background-size: cover;
     background-position: center;
     height: 100vh;">
            <img src="/assets/images/Line.png" class="rounded mx-auto d-block " style="padding: 150px" alt="">
            <img src="/assets/images/Vector.png" class="rounded mx-auto d-block" style="padding: 30px" alt="">
            <h3 class="d-flex justify-content-center text-light">Detailed Reports</h3>
            <p class="d-flex justify-content-center text-light mt-3">Pitiful a rhetoric question ran over her cheek,
                then.</p>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="/assets/bootstrap-4.3.1/bootstrap-4.3.1-dist/js/bootstrap.js"></script>
<script src="/assets/bootstrap-4.3.1/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha)
            }
        })
    });
</script>

