@extends('layouts.admin')
@section('content')
    <hr><br>
    <div class="row">
        <div class="col-md-12">
            {!! \App\Modules\Resources\Models\Forms\Forms::fieldsLists("5784b8740b4e7") !!}
            <div class="col-md-4">
                <div class="col-md-12" id="rules"></div>
                <div class="col-md-12" id="attributes"></div>
            </div>
            <div class="col-md-4">
                <div class="list-group col-md-12" id="list_rules"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-4">
                {!! \App\Modules\Resources\Models\Forms\Forms::validatorJson("5784b8740b4e7") !!}
                <div class="col-md-4"><input type="button" value="Save" id="save_json" class="btn btn-success"></div>
            </div>
        </div>
    </div>
    <hr>
    {!!  \App\Modules\Resources\Models\Forms\Forms::render("5784b8740b4e7") !!}


@stop
@section('JS')
    <script>
        $(document).ready(function () {
            var item = null;
            var i = false;
            var index = false;
            var rules, rule, json, json_string;
            $('body').on('click', '.form-items', function () {
                json_string = $('#jaon-data').attr('data-json');
                json = $.parseJSON(json_string);
                item = $(this).val();
                $('body').find('.cheker').remove();
                $(this).append('<i class="fa fa-cog fa-spin fa-3x fa-fw cheker" aria-hidden="true" style="font-size: 17px;color:#ff1a57;float: right"></i>');
                $('#attributes').empty();
                $('#list_rules').empty();
                $('#rules').html('<i class="fa fa-refresh fa-spin fa-3x fa-fw" style="color:#00f5bc" aria-hidden="true"></i>');
                var data = {"type": $(this).attr('data-type')};
                $.ajax({
                    type: "post",
                    url: "/admin/resources/form-test",
                    datatype: "json",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $("#token").val()
                    },
                    success: function (data) {
                        if (data.success) {
                            $('#rules').html(data.html);
                            var button = $('<span/>', {
                                class: "list-group-item"
                            });
                            var json_data = $.parseJSON(json_string);
                            $.each(json_data[item], function (k, v) {
                                var new_item = button.clone().append(v + '  <button class="fa fa-trash btn btn-danger delete-rule" style="float: right" data-key=' + k + ' aria-hidden="true"></button>');
//                                nwe_item.val(k)
                                $('#list_rules').append(new_item);
                            });

                        }
                    }
                });
            });
            $('body').on('change', '#validation', function () {
                var data = {"rule": $(this).find('option:selected').text()};
                $.ajax({
                    type: "post",
                    url: "/admin/resources/form-rule",
                    datatype: "json",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $("#token").val()
                    },
                    success: function (data) {
                        if (data.success) {
                            $('#attributes').html(data.html);
                        }
                    }
                });
                rule = $(this).find('option:selected').text();
                if (!json[item]) {
                    json[item] = [];
                }
                index = json[item].indexOf(rule);

                if (index < 0) {
                    if (!json[item].length) {
                        var t = rule.split(":");
                        rules = t[0];
                    }
                    $.each(json[item], function (k, v) {
                        var r = v.split(":");
                        var t = rule.split(":");
                        if (r[0] === t[0]) {
                            rules = r[0];
                            i = k;
                        }
                    });
                    if (index < 0 && i === false) {
                        var t = rule.split(":");
                        rules = t[0];
                        if (t[1]) {
                            i = 'push';
                        } else {
                            i = 'static';
                        }

                    }
                }
            });
            $('body').on('click', '#add-rule', function () {
                if (i >= 0) {
                    json[item][i] = rules + ":" + $('#rule_attr').val();
                    $('#jaon-data').attr('data-json', JSON.stringify(json));
                    $('#jaon-data').text(JSON.stringify(json));
                } else if (i === 'push') {
                    json[item].push(rules + ":" + $('#rule_attr').val());
                    $('#jaon-data').attr('data-json', JSON.stringify(json));
                    $('#jaon-data').text(JSON.stringify(json));
                } else if (i === 'static') {
                    json[item].push(rule);
                    $('#jaon-data').attr('data-json', JSON.stringify(json));
                    $('#jaon-data').text(JSON.stringify(json));
                }
                $('#rules').empty();
                $('#attributes').empty();
                item = null;
                i = false;
                index = false;
            });
            $('#save_json').on('click', function () {
                json_string = $('#jaon-data').attr('data-json');
                json = $.parseJSON(json_string);
                var data = {'id': $('#jaon-data').attr('data-id'), 'rules': json}
                $.ajax({
                    type: "post",
                    url: "/admin/resources/form-rule-save",
                    datatype: "json",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $("#token").val()
                    },
                    success: function (data) {
                        if (data.success) {
                        }
                    }
                });
            });
            $('body').on('click', '.delete-rule', function () {
                var k = $(this).attr('data-key');
                delete json[item][k];
                $('#jaon-data').attr('data-json', JSON.stringify(json));
                $('#jaon-data').text(JSON.stringify(json));
                $(this).parent().remove();
            })

        })
    </script>
@stop