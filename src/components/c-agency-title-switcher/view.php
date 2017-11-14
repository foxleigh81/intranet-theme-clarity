<?php
use MOJ\Intranet\Agency;

$oAgency = new Agency();
$activeAgency = $oAgency->getCurrentAgency();
?>

<h1 class="o-title--page">
    <?php echo $activeAgency['label'] ?>
</h1>