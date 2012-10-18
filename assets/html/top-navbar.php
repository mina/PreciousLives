<div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
                <div class="container">
<?php if ($blog['blogname'] && $blog['blogurl'])  { ?>
                        <a class='brand' href='/blogs/<?=$blog['blogurl']?>'>
                                <?=$blog['blogname']?>
                        </a>
<?php } else { ?>
                        <a class='brand' href='/'>
                                Precious Lives
                        </a>
<?php } ?>
                        <div class='nav-collapse'>
                                <ul class="nav pull-left">
                                        <li>
                                                <a href='/blogs/'>Blogs</a>
                                        </li>
                                </ul>
                                <ul class="nav pull-right">
<?php if ($blog['id'] == 1) { ?>
                                        <li>
                                                <a href='http://www.twitter.com/almasrymina'>by Mina Almasry</a>
                                        </li>
<?php } ?>
<?php if (isset($_COOKIE['blog_id'])): ?>
        <?php if ($blog['personname']) : ?>
                                        <li>
                                                <a>Hi! <?=$blog['personname']?>!</a>
                                        </li>
        <?php endif; ?>
                                        <li>
                                                <a href="#" id="logout-link">Logout</a>
                                        </li>
<?php endif; ?>
                                </ul>
                        </div>
                </div>
        </div>
</div>