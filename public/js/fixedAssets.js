$(document).ready(function() {

    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        language: "ru"
    });

    $('select[name="employee"]').on('change', function () {
        let employeeId = $(this).children('option:selected').val();
        if (employeeId > 0) {
            $('select[name="status"]').val(2);
        } else {
            $('select[name="status"]').val('');
        }
    });

    $('select[name="status"]').on('change', function () {
        let statusId = $(this).children('option:selected').val();
        if (statusId == 2) {
            $('select[name="employee"]').attr('required', true);
            $('select[name="employee"]').addClass('is-invalid');
        } else {
            $('select[name="employee"]').attr('required', false);
            $('select[name="employee"]').removeClass('is-invalid');
            $('select[name="employee"]').val('');
        }
    });

    $('input[name="parent"]').on('input', function () {
        $('.inn-search').hide();
        let inn = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/fixed-assets/inventory-number/' + inn,
            success: function(result) {
                $('.inn-search').empty();

                if (result.fixedAssets) {
                    $.each(result.fixedAssets, function(i, item) {
                        $('.inn-search').append('<a href="#!" class="list-group-item list-group-item-action" data-inventory="' + item.inventory_number + '" data-company="' + item.company_id + '" onclick="takeInventory(this); return false;">' + item.inventory_number + ' - ' + item.name + ' - ' + item.company.name + '</a>');
                    });
                }

                $('.inn-search').show();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('click', function (e) {
        $('.inn-search').empty().hide();
    });

});

function takeInventory(item) {
    let number  = $(item).data('inventory');
    let company = $(item).data('company');
    $('input[name="parent"]').val(number);
    $('input[name="parent_company"]').val(company);
}
