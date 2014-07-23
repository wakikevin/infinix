/**
 * Created by ready1 on 7/21/14.
 */

$(document).ready(function(){

    //validate fields on submit
    $('#btnPreoder').click(function(){

        //decclare validateion object
        var validate = new Validation();

        //get posted data
        var name = document.getElementById('name');
        var telephone = document.getElementById('telephone');
        var email = document.getElementById('email');
        var color = document.getElementById('color');
        var memory = document.getElementById('memory');
        var postal = document.getElementById('postal');
        var robot = document.getElementById('robot');
        var robotTotal = document.getElementById('robotTotal');

        //check for robot

        if(validate.validate_name(name)){
            if(validate.validate_telephone(telephone)){
                if(validate.validate_email(email)){
                    if(validate.validate_empty(color)){
                        if(validate.validate_empty(memory)){
                            if(validate.validate_empty(postal)){
                                if(validate.validate_empty(robot)){
                                    if(parseInt(robot.value) == parseInt(robotTotal.value)){
                                        //submit form
                                        $.ajax({
                                            url:BASE_URL+'/ajax.php',
                                            type:'post',
                                            data:$('#frm-pre-order').serialize(),
                                            beforeSend:function(){
                                                //display error
                                                $('#notify').addClass('notify loadin');
                                                $('#notify').empty().html('Sending ....');
                                                $("#notify").stop().slideDown("slow", function(){
                                                    $('html,body').animate({
                                                            scrollTop: $("#notify")},
                                                        'slow'
                                                    );
                                                });
                                            }

                                        }).success(function(response){
                                            var data = JSON.parse(response);
                                            if(data.code == '000'){
                                                $('#frm-pre-order').hide();
                                                //display error
                                                $('#notify').removeClass('notify loadin').addClass('success');
                                                $('#notify').empty().html(data.desc);
                                                $("#notify").stop().slideDown("slow", function(){
                                                    $('html,body').animate({
                                                            scrollTop: $("#notify")},
                                                        'slow'
                                                    );
                                                });

                                            }else{

                                                //display error
                                                $('#notify').removeClass('notify loadin').addClass('notify form-error');
                                                $('#notify').empty().html(data.desc);
                                                $("#notify").stop().slideDown("slow", function(){
                                                    $('html,body').animate({
                                                            scrollTop: $("#notify")},
                                                        'slow'
                                                    );
                                                });

                                            }
                                            setTimeout("location.reload(true);", 10000);

                                        }).error(function(response){
                                            //display error
                                            $('#notify').removeClass('notify loadin').addClass('notify form-error');
                                            $('#notify').empty().html('Pre-Order Form Could Not be submitted. Please try again later');
                                            $("#notify").stop().slideDown("slow", function(){
                                                $('html,body').animate({
                                                        scrollTop: $("#notify")},
                                                    'slow'
                                                );
                                            });

                                           setTimeout("location.reload(true);", 20000);
                                        })

                                        //console.log($('#frm-pre-order').serialize());

                                    }else{
                                        //display error
                                        $('#notify').addClass('notify form-error');
                                        $('#notify').empty().html('Please Enter Correct Sum to proof you are not a Robot');
                                        $("#notify").stop().slideDown("slow", function(){
                                            $('html,body').animate({
                                                    scrollTop: $("#notify")},
                                                'slow'
                                            );
                                        });

                                    }

                                }else{

                                    //display error
                                    $('#notify').addClass('notify form-error');
                                    $('#notify').empty().html('Please Answer the security Question');
                                    $("#notify").stop().slideDown("slow", function(){
                                        $('html,body').animate({
                                                scrollTop: $("#notify")},
                                            'slow'
                                        );
                                    });

                                }
                            }else{

                                //display error
                                $('#notify').addClass('notify form-error');
                                $('#notify').empty().html('Please Enter a valid Postal Address');
                                $("#notify").stop().slideDown("slow", function(){
                                    $('html,body').animate({
                                            scrollTop: $("#notify")},
                                        'slow'
                                    );
                                });

                            }

                        }else{

                            //display error
                            $('#notify').addClass('notify form-error');
                            $('#notify').empty().html('Please Select a Valid Memory Size');
                            $("#notify").stop().slideDown("slow", function(){
                                $('html,body').animate({
                                        scrollTop: $("#notify")},
                                    'slow'
                                );
                            });

                        }

                    }else{

                        //display error
                        $('#notify').addClass('notify form-error');
                        $('#notify').empty().html('Please Select a Valid Color');
                        $("#notify").stop().slideDown("slow", function(){
                            $('html,body').animate({
                                    scrollTop: $("#notify")},
                                'slow'
                            );
                        });

                    }

                }else{

                    //display error
                    $('#notify').addClass('notify form-error');
                    $('#notify').empty().html('Please Enter a valid Email');
                    $("#notify").stop().slideDown("slow", function(){
                        $('html,body').animate({
                                scrollTop: $("#notify")},
                            'slow'
                        );
                    });

                }

            }else{

                //display error
                $('#notify').addClass('notify form-error');
                $('#notify').empty().html('Please enter a valid Telephone Number');
                $("#notify").stop().slideDown("slow", function(){
                    $('html,body').animate({
                            scrollTop: $("#notify")},
                        'slow'
                    );
                });

            }

        }else{

            //display error
            $('#notify').addClass('notify form-error');
            $('#notify').empty().html('Please Enter a Valid Name');
            $("#notify").stop().slideDown("slow", function(){
                $('html,body').animate({
                        scrollTop: $("#notify")},
                    'slow'
                );
            });

        }





    });

});
