<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Pikpay 3D secure';
?>

  <div>
    The 3 - D secure form is starting, please wait 
    <form name="form" action="<?php echo $AcsUrl ?>" method="post">
      <input type="hidden" name="PaReq" value="<?php echo $PaReq ?>">
      <input type="hidden" name="TermUrl" value="<?php echo $TermUrl ?>">
      <input type="hidden" name="MD" value="<?php echo $MD ?>">
        <p>Please click on the button 'Nastavi' to proceed.</p><input id="to-asc-button" value="Nastavi" type="submit">
    </form>

    <script type="text/javascript">
    	window.onload = function(){
		  document.forms['form'].submit();
		}
    </script>
    </div>
