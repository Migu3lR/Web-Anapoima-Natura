var segDelay 	= 3;

// set up the geometry
var start_angle = -0.5 * Math.PI;
var end_angle = 1.5 * Math.PI;
var arc_end_angle = start_angle;
var angle_step = 2 * Math.PI / 60;
var radius = 30;

// set up the canvas
var canvas = document.getElementById('myCanvas');
var context = canvas.getContext('2d');
context.lineWidth = 6;
context.lineCap = "round";

// the drawFrame function is called up to 60 times per second
function drawFrame() {

    // draw an arc
    context.beginPath();
    context.arc(
        canvas.width / 2,
        canvas.height / 2,
        radius,
        start_angle,
        arc_end_angle,
        false);
    context.stroke();

    // update the geometry, for use in the next call to
    // drawFrame
    arc_end_angle += angle_step;
    if (arc_end_angle > end_angle) {
        arc_end_angle = start_angle;
        radius += 10;
    }
    
    // request that drawFrame be called again, for the
    // next animation frame
    requestAnimationFrame(drawFrame);
}