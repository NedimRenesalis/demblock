<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<p> You have received the following message
    : </p>


<?php if ($content) { ?>
    <?= $content; ?>
<?php } else { ?>
    <p> <?= Yii::t('app', 'No message content has been given'); ?> </p>
<?php } ?>

<?php $url_inbox = Url::to(['/message/inbox'], true); ?>

<p> <?= Yii::t('app', 'Use this link to get to your inbox'); ?>: <?= Html::a($url_inbox, $url_inbox); ?> </p>
