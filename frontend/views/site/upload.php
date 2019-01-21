<?php
use frontend\assets\UploadAsset;
UploadAsset::register($this);
$this->title = 'demblock';
?>

<form id="upload" method="post" action="site/upload-logo-file" enctype="multipart/form-data">
    <div id="drop">Prenesite dokument ovde ili
        <a>Odaberite dokument</a>
        <input type="file" name="upl" >
    </div>
    <ul>
        <!-- The file uploads will be shown here -->
    </ul>
</form>