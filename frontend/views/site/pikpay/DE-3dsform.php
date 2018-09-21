<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Pikpay 3D secure';
?>

  <div>
   3 - D Secure wird gestartet, bitte warten ...
    <form name="form" action="<?php echo $AcsUrl ?>" method="post">
      <input type="hidden" name="PaReq" value="<?php echo $PaReq ?>">
      <input type="hidden" name="TermUrl" value="<?php echo $TermUrl ?>">
      <input type="hidden" name="MD" value="<?php echo $MD ?>">
        <p>Bitte auf 'Nastavi'("Weiter") klicken um fortzufahren.</p><input id="to-asc-button" value="Nastavi" type="submit">
    </form>

    <script type="text/javascript">
    	window.onload = function(){
		  document.forms['form'].submit();
		}
    </script>
    </div>
