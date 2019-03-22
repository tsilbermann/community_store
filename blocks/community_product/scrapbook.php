<?php defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Support\Facade\Application;

$app = Application::getFacadeApplication();
$bt = $controller->getBlockObject()->getBlockTypeObject();
$ci = $app->make('helper/concrete/urls');
$csm = $app->make('cs/helper/multilingual');
?>
<p style="padding-top: 5px;">
    <img style="vertical-align: baseline; max-width: 16px; margin-right: 5px; display: inline-block;" src="<?= $ci->getBlockTypeIconURL($bt) ?>"/> <strong><?= $csm->t($product->getName(), 'productName', $product->getID()); ?>
        <?php $sku = $product->getSKU();
        if ($sku) { ?>
            (<?= $sku; ?>)
        <?php } ?>
    </strong>
</p>
<div class="cs-product-scrapbook-wrapper">
    <?= $product->getImageThumb(); ?>
    <ul style="font-size: 90%">
        <?php if (!$product->isActive()) { ?>
            <li><em><?= t('Inactive'); ?></em></li>
        <?php } ?>

        <?php if ($product->allowCustomerPrice()) { ?>
            <li><em><?= t('Allow customer to enter price'); ?></em></li>
        <?php } ?>

        <li><em>
            <?php
            $salePrice = $product->getSalePrice();
            if (isset($salePrice) && "" != $salePrice) {
                $formattedSalePrice = $product->getFormattedSalePrice();
                $formattedOriginalPrice = $product->getFormattedOriginalPrice();
                echo t('On Sale%s', ':&nbsp;') . $formattedSalePrice;
                echo '&nbsp;' . t('was') . '&nbsp;';
                echo '<span style="text-decoration: line-through">' . $formattedOriginalPrice . '</span>';
            } else {
                $formattedPrice = $product->getFormattedPrice();
                echo t('Price%s', ':&nbsp;');
                echo $formattedPrice;
            } ?>
            </em></li>

        <?php if ($product->isFeatured()) { ?>
        <li><em><?= t('Featured Product'); ?></em></li>
        <?php } ?>

    </ul>
</div>
<style>
    .cs-product-scrapbook-wrapper > img {
        float: left;
    }

    .cs-product-scrapbook-wrapper > img + ul {
        float: left;
    }
</style>