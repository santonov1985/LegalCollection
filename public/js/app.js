$(document).ready(function() {
    $('#theModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var modal = $(this);
        modal.find('.modal-body').load(button.data("remote"));
    });

    $('#theModal').on('hidden.bs.modal', function (e) {
        var modal = $(this);
        modal.find('.modal-body').empty();
    });

    $('.btn-delete').confirm({
        icon: 'fa fa-warning',
        title: 'Удаление!',
        content: 'Вы уверены что хотите удалить?',
        type: 'red',
        buttons: {
            confirm: {
                text: 'Да',
                action: function () {
                    location.href = this.$target.attr('href');
                }
            },
            cancel: {
                text: 'Нет'
            }
        }
    });

    $('.btn-restore').confirm({
        icon: 'fa fa-warning',
        title: 'Восстановление!',
        content: 'Вы уверены что хотите восстановить?',
        type: 'green',
        buttons: {
            confirm: {
                text: 'Да',
                action: function () {
                    location.href = this.$target.attr('href');
                }
            },
            cancel: {
                text: 'Нет'
            }
        }
    });
    // Скрытие кнопки поиск
    $("#search_input").on("input",() => {
        console.log("1", $("#search_input").val().length);
        if ($("#search_input").val().length > 0) {
            $("#search_btn").attr("disabled", false);
            console.log("true");
        } else {
            $("#search_btn").attr("disabled", true);
            console.log("false");
        }
    });

});
