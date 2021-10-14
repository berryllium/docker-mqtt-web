function getJson() {
  $.ajax({
    url: '/ajax.php',
    dataType: 'json',
    data: $('form').serialize(),
    success: function(response) {

    all_data = [{data: response}];

    // свойства графика
    var plot_conf = {
    series: {
      lines: {
        show: true,
        lineWidth: 2
      }
    },
    xaxis: {
      mode: "time",
      timeBase: "milliseconds",
      timeformat: "%d.%m %H:%M:%S"
    }
    };
      $.plot($("#placeholder"), all_data, plot_conf);
    }
  })
}

$(function(){
  getJson()
})