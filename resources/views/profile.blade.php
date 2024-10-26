@include('header')
<link type="text/css" rel="stylesheet" href="/assets/css/persianDatepicker.css" />


<div class="container mt-3">
    <h5>سلام {{$admin->name}}
        <img width="5%" src="/uploads/{{$admin->pic}}">

    </h5>

    <div class="col-md-6 mb-3">
        <label for="birth_date" class="col-form-label float-right">تاریخ تولد</label>
        <input type="text" class="form-control" name="birth_date" id="input1">
        <span id="span1"></span>
    </div>

</div>
@include('footer')


<!-- scripts js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="/assets/bootstrap-4.3.1/bootstrap-4.3.1-dist/js/bootstrap.js"></script>
<script src="/assets/bootstrap-4.3.1/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/assets/js/persianDatepicker.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#input1, #span1").persianDatepicker({
            months: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
            dowTitle: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه"],
            shortDowTitle: ["ش", "ی", "د", "س", "چ", "پ", "ج"],
            showGregorianDate: !1,
            persianNumbers: !0,
            formatDate: "YYYY/MM/DD",
            selectedBefore: !1,
            selectedDate: null,
            startDate: null,
            endDate: null,
            prevArrow: '\u25c4',
            nextArrow: '\u25ba',
            theme: 'default',
            alwaysShow: !1,
            selectableYears: null,
            selectableMonths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
            cellWidth: 25, // by px
            cellHeight: 20, // by px
            fontSize: 13, // by px
            isRTL: !1,
            calendarPosition: {
                x: 0,
                y: 0,
            },
            onShow: function () { },
            onHide: function () { },
            onSelect: function () { },
            onRender: function () { }
        });
    });
</script>



