<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="#dashboard">Dashboard</a></li>
        <?php
        $bcSuggestion = array_reverse($bcSuggestion);
        foreach ($bcSuggestion as $bc) {
            if (empty($bc['alias'])) {
                echo "<li>{$bc['label']}</li>";
            } else {
                echo "<li><a href='{$bc['alias']}' class=''>{$bc['label']}</a></li>";
            }
        }
        ?>
    </ul>
</div>