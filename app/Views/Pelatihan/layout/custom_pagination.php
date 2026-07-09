<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="Page navigation">
    <ul class="pagination mb-0">
        <?php if ($pager->hasPrevious()) : ?>
            <li>
                <a href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                    <span aria-hidden="true">Sebelumnya</span>
                </a>
            </li>
        <?php else : ?>
            <li class="disabled">
                <span aria-hidden="true">Sebelumnya</span>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="active"' : '' ?>>
                <a href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li>
                <a href="<?= $pager->getNext() ?>" aria-label="Next">
                    <span aria-hidden="true">Selanjutnya</span>
                </a>
            </li>
        <?php else : ?>
            <li class="disabled">
                <span aria-hidden="true">Selanjutnya</span>
            </li>
        <?php endif ?>
    </ul>
</nav>
