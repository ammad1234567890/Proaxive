$(document).ready(function () {
  //  var base_url="http://172.16.1.250:82/proaxive_clone/public/";
    var base_url="http://proaxive.my/portal/public/";
    $("#travel_no").change(function () {
        $("#travel_purpose").val("");
        $("#destination").val("");
        $("#destination_id").val("");
       // $("#on_account_of").val("");
       // $("#on_account_of_id").val("");
        if ($("#travel_no").val() != '') {
            var user_type = $("#user").val();
            if (user_type == "hr") {
                var route = "../../travel_details";
            }
            if (user_type == "customer") {
                var route = base_url+"/travel_details";
            }
            $.ajax({
                url: route,
                type: 'post',
                data: {id: $("#travel_no").val(), _token: $("input[name='_token']").val()},
                success: function (data) {
                    if (data['status'] == true) {
                        $("#travel_purpose").val(data['data']['purpose']);
                        $("#destination").val(data['data']['Destination']);
                        $("#destination_id").val(data['data']['Destination_id']);
                        //  $("#on_account_of").val(data['data']['on_account_of']);
                        //   $("#on_account_of_id").val(data['data']['on_account_of_id']);
                    }
                }
            });
        }
    });

    $("#employee").change(function () {
        $.ajax({
            url: '../../get_travel_id',
            type: 'post',
            data: {id: $("#employee").val(), _token: $("input[name='_token']").val()},
            success: function (data) {
                var option = "<option label='Select' value='' selected='selected'>Choose one</option>";
                for (var i = 0; i < data.length; i++) {
                    option += `<option value='` + data[i]['id'] + `'>` + data[i]['request_no'] + `</option>`;
                }
                $("#travel_no").html(option);
            }
        });
    });
    $("#add_more_expense").click(function () {
        var table_tr = $(".expense_row").children().clone();
        table_tr.find('.expense_type').prop('required', true);
        table_tr.find('.expense_date').prop('required', true);
        table_tr.find('.expense_Description').prop('required', true);
        table_tr.find('.expense_receipt_number').prop('required', true);
        table_tr.find('.expense_amount').prop('required', true);
        table_tr.find(".expense_type").attr('name', "expense_types[]");
        table_tr.find(".expense_date").attr('name', "expense_date[]");
        table_tr.find(".expense_Description").attr('name', "expense_Description[]");
        table_tr.find(".expense_receipt_number").attr('name', "expense_receipt_number[]");
        table_tr.find(".expense_amount").attr('name', "expense_amount[]");
        $(".table_rows").append(table_tr);
        var dateToday = new Date();
        $('.expense_date').datetimepicker({
            timepicker: false,
            format: 'd-m-Y',
            formatDate: 'Y/m/d',
            // minDate: dateToday,
            scrollMonth: false,
            scrollInput: false
        });
    });
   // $("#add_more_expense").click();
    $('.table_rows').delegate('.remove_btn', 'click', function () {
        $(this).parent().parent().remove();
        count_amount();
    });

    $('.table_rows').delegate('.expense_amount', 'keyup', function () {
        count_amount();
    });
    $('.table_rows').delegate('.expense_amount', 'blur', function () {
        $(this).val(accounting.formatMoney($(this).val(), {symbol: "", format: "%v %s"}));
    });
    $("#expense_type_list").change(function () {
        $("#travel_purpose").val('');
        $("#destination").val('');
      //  $("#on_account_of").val('');
        if ($("#expense_type_list").val() == "general expense") {
            $("#travel_div").hide()
            $("#travel_no").prop('required', false);
            $("#travel_purpose").prop('readonly', false);
            $("#destination").prop('readonly', false);
            //   $("#on_account_of").prop('readonly', false);
        }
        if ($("#expense_type_list").val() == "travel expense") {
            $("#travel_div").show()
            $("#travel_no").prop('required', true);
            $("#travel_purpose").prop('readonly', true);
            $("#destination").prop('readonly', true);
            //  $("#on_account_of").prop('readonly', true);
        }
    });
    function count_amount() {
        var amount = $("input[name='expense_amount[]']").map(function () {
            return $(this).val();
        }).get();
        var total = 0;
        for (var i = 0; i < amount.length; i++) {
            if (amount[i] != "") {
                total += parseFloat(amount[i].replace(/[,]/gi, ''));
            }
        }
        $("#total_amount").val(accounting.formatMoney(total, {symbol: "", format: "%v %s"}));
    }
    $("#expense_currency").change(function () {
        $('.currency_type_span').html("(" + $("#expense_currency option:selected").text() + ")");
    });

    $("form").submit(function () {
        $('.btn_disable_submit').prop('disabled', true);
        $('.btn_text').html('please wait');
    });

    $("#submit_approval").click(function () {
        $('#approve_status').val(4);
        $('#status_form').submit();
        $('.btn_disable_submit').prop('disabled', true);
        $(this).html('please wait');
    })
    $("#submit_rejected").click(function () {
        $('#approve_status').val(3);
        $('#status_form').submit();
        $('.btn_disable_submit').prop('disabled', true);
        $(this).html('please wait');
    })
});
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46) {
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
    }
    return true;
}