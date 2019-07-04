$(document).ready(function(){
    // like and unlike click
    $(".likebtn, .dislikebtn").click(function(){

        var id = this.id;   // Getting Button id
        var split_id = id.split("_");
        var text = split_id[0];
        var shop_id = split_id[1];  // postid

        // Finding click type
        var type = 0;
        if(text == "like"){
            type = 1;
        }else if(text == "dislike"){
            type = 0;
        }else if(text == "remove"){
            type = 2;
        }

        // AJAX Request
        $.ajax({
            url: 'functions/like_dislike.php',
            type: 'post',
            data: {id:shop_id,type:type},
            success: function(data){
                //alert(data);
                $("#shop_"+shop_id).fadeOut("slow");
            }
            
        });

    });
});