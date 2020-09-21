<?php
    if($_POST){
        $iter = $_REQUEST['iter'];
        for($i=1;$i<=$iter;$i++){ ?>
            <div class="form-group">
                <label>Stream <?php echo $i; ?></label>
                <input type="text" class="form-control" id="stream_<?php echo $i; ?>" name="stream_<?php echo $i; ?>" placeholder="Enter Stream Name" required>
            </div>
<?php   } ?>
            <div class="form-group">
                <button class="btn btn-primary saveStream" value="SAVE_STREAMS">Save</button>
            </div>
            <div class="feedback"></div>

<?php    } ?>
<script>
    //Ajax Function
    function action(actionPage, params, feedbackArea='.feedback', processingArea='.processing', processingMessage='Processing'){
        var ico = '<img src="assets/img/loader.gif" title="'+processingMessage+'" height="22px" alt="IMG_PROCESS"/>';
        console.log(params);
        $.ajax({
            method: "POST",
            url: actionPage,
            data: params,
            beforeSend: function(){
                $(processingArea).html(ico + processingMessage);
                $(processingArea).show();
            },
            complete: function(){$(processingArea).hide();},
            success: function(data){$(feedbackArea).html(data);},
            error: function(){$(feedbackArea).html('Oops! Something went wrong');}
        });
    }

    $(".saveStream").click(function() {
        var ite = "<?php echo $iter; ?>" - 0;
        let k = new Array(); var params = "";
        for (var i = 1; i <= ite; i++) {
            k[i] = $("#stream_" + i).val();
            params += "stream" + i + "=" + k[i]
            params += "&";
        }
        params += "iter="+ite;
        console.log(params);
        action("components/save_stream.php",params);
    });

</script>