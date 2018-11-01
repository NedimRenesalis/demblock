<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

Yii::$app->user->logout();

?>
<div class="just-registered-wrapper inactive-profile-wrapper-notification">
    <div class="just-registered send-email-wrapper">
        <?php if(isset($registered)): ?>
        <p>Thanks for registering</p>
        <?php endif; ?>
        <p>Your profile is currently inactive</p>
        <p>Please check your email and activate the profile</p>
        <br>
        <p>To send activation code again, please click <button class="send-confirmation" data-key="<?php echo $user->auth_key; ?>">here</button></p>
        <br>
    </div>
    <div class="just-registered email-sent-wrapper" style="display: none">
        <p>Confirmation email has been sent successfully.</p>
        <p>Please check your email and activate the profile</p>
        <br>
        <p>To send activation code again, please click <button class="send-confirmation" data-key="<?php echo $user->auth_key; ?>">here</button></p>
        <br>
    </div>
</div>

<script>

    $(document).ready(function () {
        $(".send-confirmation").on("click", function () {
            var key = $(this).data('key');
            sendConfirmation(key);
        });

    });

    function sendConfirmation(key) {
        $.ajax({
            type: "GET",
            url: "<?php echo Yii::$app->getUrlManager()->createUrl('site/request-new-activation-key')  ; ?>",
            data: {key: key},
            success: function (response) {
                console.log(response);
                if(response == 1){
                    console.log('success');
                    $(".send-email-wrapper").hide();
                    $(".email-sent-wrapper").show();
                }
            },
            error: function (exception) {
                alert(exception);
            }
        })
        ;
    }
</script>