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
});
