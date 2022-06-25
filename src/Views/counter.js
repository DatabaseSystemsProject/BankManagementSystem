$(document).ready(function() {

    $('.counter').each(function () {
    $(this).prop('Counter',0).animate({
    Counter: $(this).text()
    }, {
    duration: 1000,
    easing: 'swing',
    step: function (now) {
    $(this).text(Math.ceil(now));
    }
    });
    });
    
    });

    // let valueDisplays = document.querySelectorAll(".counter");
    // let interval = 4000;
    // valueDisplays.forEach((valueDisplay) => {
    //   let startValue = 0;
    //   let endValue = parseInt(valueDisplay.getAttribute("data-val"));
    //   let duration = Math.floor(interval / endValue);
    //   let counter = setInterval(function () {
    //     startValue += 1;
    //     valueDisplay.textContent = startValue;
    //     if (startValue == endValue) {
    //       clearInterval(counter);
    //     }
    //   }, duration);
    // });