<ul class="stats-list">
<?php foreach ($actions as $a): ?>
<?php
$name = $a['name'];
$title = $a['title'];
?>
    <li><a class="<?php if($this->action->Id == $name): ?>active<?php endif; ?>" href="<?php echo $this->createUrl("$this->uniqueId/$name/id/$encId") ?>"><?php echo $title; ?></a></li>
<?php endforeach; ?>
</ul>