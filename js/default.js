/**
 * Created by ready1 on 7/21/14.
 */

//base url
//var BASE_URL = <?php echo BASE_URL; ?> ;

// onload functions
$(document).ready(function(){

    //security question generation
    setRobot();

    //alert(BASE_URL);

});

/**
 * Returns a random integer between min (inclusive) and max (inclusive)
 * Using Math.round() will give you a non-uniform distribution!
 */
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function setRobot(){

    //set the robot feature
    var random1 = getRandomInt(1,9);
    var random2 = getRandomInt(1,9);

    //set dilsplay on spans
    $('#short-math').empty().html(random1 + ' + ' + random2 + " = ");

    //set total on hidden field
    var robotSum = parseInt(random1) + parseInt(random2);
    $('#robotTotal').val(robotSum);

}