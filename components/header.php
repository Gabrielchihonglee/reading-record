<header>
    <div class="sitename">
        <a href="index.php">My Reading Record</a>
    </div>
    <nav>
        <ul>
            <li<?php if (isset($page) && $page == "index"):?> class="active"<?php endif; ?>><a href="index.php">Home</a></li>
            <li<?php if (isset($page) && $page == "stats"):?> class="active"<?php endif; ?>><a href="stats.php">Stats</a></li>
        </ul>
    </nav>
    <div class="search">
        <span class="search-input"><input type="text" name="search" placeholder="search (imaginary)">
    </div>
</header>
