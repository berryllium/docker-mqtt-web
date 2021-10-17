let soundAllow = false;
$(function () {
    let ajaxPeriod = 2000
    let maxLevel = 1000
    let cur = $('#cur1 .scale')
    let pomp1 = $('#pomp1')
    let pomp2 = $('#pomp2')
    let pomp3 = $('#pomp3')
    let timer = setTimeout.bind(null, getData, ajaxPeriod)
    let alarmSound = new Audio('alarm.mp3')
    let options = {
        dangerLevelMin: 0,
        dangerLevelMax: 1000
    }

    function getData() {
        $.ajax({
            url: 'ajax.php',
            data: {action: 'getData'},
            method: 'post',
            dataType: 'json',

            success: function (data) {
                try {
                    let level = Number(data.cur1.val)
                    if (level >= options.dangerLevelMax || level <= options.dangerLevelMin) {
                        cur.addClass('danger')
                        if(soundAllow) alarmSound.play()
                    } else {
                        if(soundAllow) alarmSound.pause()
                        cur.removeClass('danger')
                    }
                    $('#cur1 .current').text((level / 1000).toFixed(2) + ' м.')
                    level = level * (100 / maxLevel)
                    if (level > 100) level = 100;
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

    $('a.sound').click(function (e){
        e.preventDefault()
        soundAllow = !soundAllow
        let src = soundAllow ?'img/sound_allow.png' : 'img/sound_drop.png'
        $(this).children('img').attr('src', src)
        if(!soundAllow)  alarmSound.pause();
    });

    $('.bg').on('click', 'button', function () {
        $('.bg').remove();
        $('a.sound').trigger('click')
    })

    $('button.setOption').click(function () {
        let el = $(this).closest('.input-group').find('input')
        let code = el.attr('name');
        let val = el.val();
        if (!val) val = 0;
        if (!code) return;
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
                if (response === 'error') {
                    alert('Ошибка!')
                } else {
                    getOption(code)
                }

            },
            error: function () {
                alert('Ошибка!')
            }
        })
    })

    function getOption(option) {
        $.ajax({
            url: 'ajax.php',
            data: {action: 'getOption', code: option},
            method: 'post',
            dataType: 'json',
            success: function (val) {
                if (val !== 'error') {
                    let label = $(`[data-option="${option}"]`)
                    options[option] = val* 10
                    $(`[name="${option}"]`).val(val)
                    label.text((val / 100).toFixed(2) + ' м.')
                    label.css('bottom', (val * 1000 / maxLevel) + '%')
                }
            },
            error: function () {
                alert('Ошибка!')
            }
        })
    }

    getOption('dangerLevelMax')
    getOption('dangerLevelMin')
    getData()
})
