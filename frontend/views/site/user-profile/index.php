<?php
use yii\helpers\Url;
?>
<!-- Start contact information -->
<h3>
    Contact information
</h3>

<div>
   Email: <?php echo $contactInfo->Email; ?>
    <span>
         [<?php echo ($model->status == 10) ? 'Verified' : 'Not Verified';  ?>]
    </span>
</div>
<div>
    Alternative Email: <?php echo $contactInfo->AlternativeEmail; ?>
</div>
<div>
    Social Links:
    <?php if($contactInfo->Facebook == "none"
          && $contactInfo->Twitter == "none"
           && $contactInfo->Instagram == "none") echo 'none';?>
    <?php if($contactInfo->Facebook != "none"): ?>
        <div>Facebook: <?php echo $contactInfo->Facebook; ?></div>
    <?php endif; ?>
    <?php if($contactInfo->Twitter != "none"): ?>
        <div>Twitter: <?php echo $contactInfo->Twitter; ?></div>
    <?php endif; ?>
    <?php if($contactInfo->Instagram != "none"): ?>
        <div>Instagram: <?php echo $contactInfo->Instagram; ?></div>
    <?php endif; ?>
</div>
<div>
    Fax: <?php echo $contactInfo->Fax; ?>
</div>

<div>
    Telephone: <?php echo ($contactInfo->Phone == '') ? 'none' : $contactInfo->Phone; ?>
</div>

<div>
    Mobile: <?php echo $contactInfo->Mobile; ?>
</div>

<div>
    <a href="<?= Url::to('edit-user-contact-details'); ?>">Edit</a>
</div>
<!-- End contact information -->