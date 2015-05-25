<ul class="navigation">
    <?php

    function leftSubMenu($menu, $url) {
        if (!empty($menu)) {
            echo "<ul>";
            foreach ($menu as $subMenu) {
                $expandable = !empty($subMenu['content']) ? "expand" : '';
                $active = $subMenu['alias'] === $url ? "active" : "";
                $newtab = '';
                $icon = '';
                if (empty($subMenu['alias'])) {
                    $alias = "#";
                } elseif (strpos($subMenu['alias'], "http") !== false || strpos($subMenu['alias'], "https") !== false) {
                    $alias = $subMenu['alias'];
                    $newtab = 'target="_blank"';
                    $icon = '<i class="icon-new-tab"></i>';
                } else {
                    $alias = Router::url("/" . $subMenu['alias'], true);
                }
                echo "<li class='{$active}'><a href='{$alias}' class='{$expandable}' {$newtab}>{$icon} " . __($subMenu['label']) . "</a>";
                leftSubMenu($subMenu['content'], $url);
                echo "</li>";
            }
            echo "</ul>";
        }
    }

    foreach ($leftSideMenuData as $menu) {
        $expandable = !empty($menu['content']) ? "expand" : '';
        $newtab = '';
        $icon = '';
        if (empty($menu['alias'])) {
            $alias = "#";
        } elseif (strpos($menu['alias'], "http") !== false || strpos($menu['alias'], "https") !== false) {
            $alias = $menu['alias'];
            $newtab = 'target="_blank"';
            $icon = '<i class="icon-new-tab"></i>';
        } else {
            $alias = Router::url("/" . $menu['alias'], true);
        }
        ?>
        <li>
            <a href="<?= $alias ?>" class="<?= $expandable ?>" <?= $newtab ?>>
                <span><?= $icon . " " . __($menu['label']) ?></span> 
                <i class="<?= $menu['icon'] ?>"></i>
            </a>
            <?php
            $tester = preg_replace("/-add|-edit(.)*/", "", $url);
            leftSubMenu($menu['content'], $tester);
            ?>
        </li>
        <?php
    }
    ?>
</ul>