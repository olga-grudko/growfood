<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>
<body>
<div class="">
    <div id="messages"></div>

    {{ Form::open(['id' => 'orderForm']) }}
    <div class="form-group">
        <label for="name">Имя</label>
        {{Form::text('name',null,  ['class' => 'form-control', 'id' => 'name'])}}

    </div>
    <div class="form-group">
        <label for="phone">Телефон</label>
        {{Form::text('phone',null,  ['class' => 'form-control', 'id' => 'phone'])}}
    </div>
    <div class="form-group">
        <label class="form-check-label" for="tarif">Тариф</label>
        {{Form::select('tarif', $tarifs, null, ['class' =>"form-control", 'id' => 'tarif'])}}
    </div>
    <div class="form-group">
        <label class="form-check-label" for="delivery_day">День</label>
        {{Form::select('delivery_day', $deliveryDays, null, ['class' =>"form-control", 'id' => 'delivery_day'])}}
    </div>
    {{Form::button('Отправить', [
            'type' => 'submit',
            'class'=> 'btn btn-primary',
            'id' => 'orderSend'
    ])}}
    {{ Form::close() }}

    <script>
        $(function () {

            $("form").on('submit', (function (event) {

                event.preventDefault();

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                $.ajax({

                    type: "{{\Illuminate\Http\Request::METHOD_POST}}",

                    url: "{{route('order.create')}}",

                    data: $(this).serialize(),

                    success: function (data) {
                        $('#messages').append('<div class="bg-success alert-success">Сохранено!</div');
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON.errors;
                        $('#messages').text('');
                        $.each(errors, function (key, value) {
                            $('#messages').append('<div class="alert alert-danger">' + value + '</div');
                        });
                    }
                })

                return false;

            }));

            $('#tarif').on('change', function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "{{\Illuminate\Http\Request::METHOD_POST}}",

                    url: "{{route('order.change.tarif')}}",

                    data: {
                        '_token' : "{{csrf_token()}}",
                        'tarif' : $('#tarif option:selected').val(),
                    },

                    success: function (data) {
                        $('#delivery_day').children().remove();
                        $.each(data, function (id, day) {
                            $('#delivery_day').append('<option selected value="'+ id+'" >' + day + '</option>');
                        });
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON.errors;
                        $('#messages').text('');
                        $.each(errors, function (key, value) {
                            $('#messages').append('<div class="alert alert-danger">' + value + '</div');
                        });
                    }
                })

            });

            $('#delivery_day').on('change', function(){

                $.ajax({
                    type: "{{\Illuminate\Http\Request::METHOD_POST}}",

                    url: "{{route('order.change.delivery.day')}}",

                    data: {
                        '_token' : "{{csrf_token()}}",
                        'delivery_day' : $('#delivery_day option:selected').val(),
                    },

                    success: function (data) {
                        $('#tarif').children().remove();

                        $.each(data.tarifs, function (id, name) {
                            console.log(id, name);
                            $('#tarif').append('<option value="'+ id+'" >' + name + '</option>');
                        });

                        $("#tarif [value='"+data.tarifDay+"']").attr("selected", "selected");
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON.errors;
                        $('#messages').text('');
                        $.each(errors, function (key, value) {
                            $('#messages').append('<div class="alert alert-danger">' + value + '</div');
                        });
                    }
                })
            })

        })
    </script>
</div>
</body>
</html>
