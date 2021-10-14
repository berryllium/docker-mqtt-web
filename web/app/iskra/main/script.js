let ajaxPeriod = 1000
$(function (){
    let maxLevel = 900
    let dangerLevel = 600
    let cur = $('#cur1 .scale')
    let pomp1 = $('#pomp1')
    let pomp2 = $('#pomp2')
    let pomp3 = $('#pomp3')

    $('.max').text(Math.round(maxLevel / 100) + ' м.')
    $('.middle').text(2* Math.round(maxLevel / 300) + ' м.')
    $('.min').text(Math.round(maxLevel / 300) + ' м.')


    let timer = setTimeout.bind(null,getData, ajaxPeriod)

    function getData() {
        $.ajax({
            url: 'ajax.php',
            data: {action: 'getData'},
            method: 'post',
            dataType: 'json',

            success: function (data) {
                try {
                    let level = Number(data.cur1.val)
                    if(level > dangerLevel) {
                        cur.addClass('danger')
                    } else {
                        cur.removeClass('danger')
                    }
                    level = level * (100 / maxLevel)
                    if(level > 100) level = 100;
                    cur.height(level + '%')
                    Number(data.pusk1.val) ? pomp1.addClass('active') : pomp1.removeClass('active')
                    Number(data.pusk2.val) ? pomp2.addClass('active') : pomp2.removeClass('active')
                    Number(data.pusk3.val) ? pomp3.addClass('active') : pomp3.removeClass('active')
                } catch (e) {
                    console.log(e.name + ': ' + e.message);
                }
                timer()
            }
        })
    }


    $('button.setOption').click(function () {
        let el = $(this).closest('.input-group').find('input')
        let code = el.attr('name');
        let val = el.val();
        if(!val) val = 0;
        if(!code) return;
        $.ajax({
            url: 'ajax.php',
            data: {
                action: 'setOption',
                code: code,
                val: val,
            },
            method: 'post',
            dataType: 'json',
            success: function (response) {
                if(response === 'error') {
                    alert('Ошибка!')
                } else {
                    dangerLevel = Number(val)
                    alert('Значение присвоено!')
                }

            },
            error: function () {
                alert('Ошибка!')
            }
        })
    })

    $.ajax({
        url: 'ajax.php',
        data: {action: 'getOption',code: 'dangerLevel'},
        method: 'post',
        dataType: 'json',
        success: function (response) {
            if(response !== 'error') {
                dangerLevel = Number(response)
                $('[name="dangerLevel"]').val(dangerLevel)
            }
        },
        error: function () {
            alert('Ошибка!')
        }
    })

    getData()
})