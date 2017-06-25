
const burst = new mojs.Burst({
  left: 0, top: 0,
  radius:   { 0: 30 },
  count:    5,
  children: {
    shape:        'circle',
    radius:       10,
    fill:       [ 'deeppink', 'cyan', 'yellow' ],
    strokeWidth:  5,
    duration:     1000
  }
});

document.addEventListener( 'click', function (e) {
  burst
    .tune({ x: e.pageX, y: e.pageY })
    .setSpeed(3)
    .replay();
} );
