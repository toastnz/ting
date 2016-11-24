(function ($) {

    const $ting  = $('#ting');
    const $tings = $('.js-tings');

    const api = {
        createTing  : `admin/ting/createTing`,
        updateTing  : `admin/ting/updateTing`,
        destroyTing : `admin/ting/destroyTing`,
        reorderTings: `admin/ting/reorderTings`,
        saveTing    : `admin/ting/saveTing`,
    };

    $ting.on('click', '#Form_TingForm_action_cancelTing', function (e) {
        e.preventDefault();
        $('.ting--form').remove();
    });

    $ting.on('click', '#Form_TingForm_action_saveTing', function () {
        let $this = $(this);
        let $form = $this.closest('form');

        $.ajax({
            url    : api.saveTing,
            data   : {
                Type    : $this.attr('data-type'),
                tingID  : parseInt($this.attr('data-ting-id')),
                formData: $form.serialize()
            },
            success: function (response) {
                console.log(response);
                $('.ting--form').remove();
            }
        });
    });

    $ting.on('click', '.js-update-ting', function () {
        let $this = $(this);
        $.ajax({
            url    : api.updateTing,
            data   : {
                Type  : $this.attr('data-type'),
                tingID: parseInt($this.attr('data-ting-id'))
            },
            success: function (response) {
                $tings.append(response);
            }
        });
    });

    $ting.on('click', '.js-create-ting', function () {
        let $this = $(this);
        $.ajax({
            url    : api.createTing,
            data   : {
                ParentID: parseInt($this.attr('data-parentID')),
                Type    : $this.attr('data-type'),
            },
            success: function (response) {
                $tings.append(response);
            }
        });
    });

    $ting.on('click', '.js-destroy-ting', function () {
        let $this = $(this);
        $.ajax({
            url       : api.destroyTing,
            data      : {
                Type  : $this.attr('data-type'),
                tingID: parseInt($this.attr('data-ting-id'))
            }, success: function (response) {
                if (response == 'success') {
                    $this.closest('.ting').remove();
                }
            }
        });
    });

    dragula([document.getElementById('tings')], {}).on('drop', function () {
        updateTingOrder();
    });

    function updateTingOrder() {
        let order = [];
        $tings.find('.js-ting').each(function () {
            order.push($(this).attr('data-id'));
        });
        $.ajax({
            dataType  : 'json',
            url       : api.reorderTings,
            data      : {
                Order: order
            }, success: function (response) {
                console.log(response);
            }
        });
    }

}(jQuery));




