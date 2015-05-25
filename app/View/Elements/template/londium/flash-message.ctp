<div id="flash-block">
    <?= $this->Session->flash("danger",array("element"=>"template/{$template}/flash/danger")); ?>
    <?= $this->Session->flash("success",array("element"=>"template/{$template}/flash/success")); ?>
    <?= $this->Session->flash("warning",array("element"=>"template/{$template}/flash/warning")); ?>
    <?= $this->Session->flash("info",array("element"=>"template/{$template}/flash/info")); ?>
</div>