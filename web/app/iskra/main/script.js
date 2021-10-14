$(function (){
    let ajaxPeriod = 1500
    let maxLevel = 300
    let cur = $('#cur1 .scale')
    let pomp1 = $('#pomp1')
    let pomp2 = $('#pomp2')
    let pomp3 = $('#pomp3')
    $('.max').text(Math.round(maxLevel / 100) + ' м.')
    $('.middle').text(Math.round(maxLevel / 200) + ' м.')
    $('.min').text(Math.round(maxLevel / 300) + ' м.')

    let timer = setTimeout.bind(null,function (){
        $.ajax({
            url: 'ajax.php',
            data: {action: 'getData'},
            method: 'post',
            dataType: 'json',

            success: function (data) {
                let level = Number(data.cur1.val) * (100 / maxLevel)
                if(level > 100) level = 100;
                cur.height(level + '%')
                Number(data.pusk1.val) ? pomp1.addClass('active') : pomp1.removeClass('active')
                Number(data.pusk2.val) ? pomp2.addClass('active') : pomp2.removeClass('active')
                Number(data.pusk3.val) ? pomp3.addClass('active') : pomp3.removeClass('active')
                timer()
            }
        })
    }, ajaxPeriod)
    timer()
})