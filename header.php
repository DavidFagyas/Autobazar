<?php
        $menuItems = [
            'Domov' => 'index.html',
            'Dostupné autá' => 'dostupne-auta.html',
            'O nás' => 'onas.html',
            'KONTAKT' => 'kontakt.html',
        ];
        ?>
        <ul class="navbar-nav">
            <?php foreach ($menuItems as $name => $url): ?>
                <li><a class="nav-link" href="<?= htmlspecialchars($url); ?>"><?= htmlspecialchars($name); ?></a></li>
            <?php endforeach; ?>