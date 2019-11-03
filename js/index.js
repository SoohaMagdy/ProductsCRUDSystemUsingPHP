
const instance = new TypeIt('#replaceStrings', {
  strings: ['developer'],
  //-- Other options...
}).go();

new TypeIt('#replaceStrings', {
  strings: ["Developer", "Designer"],
  speed: 50,
  breakLines: false,
  waitUntilVisible: true
}).go();

var waypoint = new Waypoint({
  element: document.getElementById('new-operator'),
  handler: function(direction) {
    notify(this.id + ' hit')
  }
})

$(function () {
  $('.count-num').rCounter();
});
$(function () {
  $('.count-num').rCounter({
    duration: 30
  });
});

$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    items:1,
    nav:true,

  });
});