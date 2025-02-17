<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::encode('Biodata Calon Karyawan'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-expand-lg navbar-dark bg-dark fixed-top']
    ]);

    $menuItems = [];

    if (!Yii::$app->user->isGuest) {
        // ✅ Menu untuk ADMIN
        if (Yii::$app->user->identity->role === 'admin') {
            $menuItems[] = ['label' => 'Data Pelamar', 'url' => ['/biodata/admin-index']];
        } else {
            // ✅ Menu untuk USER biasa
            $menuItems[] = ['label' => 'Dashboard', 'url' => ['/site/dashboard-user']];
            $menuItems[] = ['label' => 'Pendidikan', 'url' => ['/pendidikan/index']];
            $menuItems[] = ['label' => 'Pelatihan', 'url' => ['/pelatihan/index']];
            $menuItems[] = ['label' => 'Riwayat Pekerjaan', 'url' => ['/pekerjaan/index']];
        }
        
        // ✅ Dropdown Profil & Logout
        $menuItems[] = [
            'label' => Html::encode(Yii::$app->user->identity->email),
            'items' => [
                ['label' => 'Profil Saya', 'url' => ['/user/profile']],
                ['label' => 'Keluar', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
            ],
        ];
    } else {
        // ✅ Menu untuk GUEST (Belum Login)
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $menuItems,
        'encodeLabels' => false, // Agar label menu bisa berisi HTML
    ]);

    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container mt-5 pt-4">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">
                &copy; Biodata Karyawan <?= date('Y') ?>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <?= Html::a('Tentang Kami', ['/site/about'], ['class' => 'text-muted']) ?> |
                <?= Html::a('Kontak', ['/site/contact'], ['class' => 'text-muted']) ?> |
                <?= Yii::powered() ?>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
