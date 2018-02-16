<p align="center">
    <a href="http://getbootstrap.com/" target="_blank">
        <img src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" width="80px" height="80px">
    </a>
    <h1 align="center">Yii2 bootstrap widgets on Bootstrap 4</h1>
</p>


Those are ported and partially changed `yiisoft/yii2-bootstrap` widgets to use with Bootstrap v4.

It is using `twbs/bootstrap` package with Bootstrap v4 CSS/JS.

Use it similarly to `yiisoft/yii2-bootstrap` package.

> __Please feel free to create a issue / pull request if I forgot something or if you find some bugs.__

|yiisoft/yii2-bootstrap         |digitv/yii2bootstrap4              |
|-------------------------------|-----------------------------------|
|`yii\bootstrap`\Html           |`digitv\bootstrap`\Html       |
|`...`\ActiveForm               |`...`\ActiveForm                   |
|`...`\ActiveField              |`...`\ActiveField                  |
|yii\widgets\Breadcrumbs        |`...`\widgets\Breadcrumbs          |
|[* new card widget](http://getbootstrap.com/docs/4.0/components/card/)|`...`\widgets\Card|
|`...`\Alert                    |`...`\widgets\Alert                |
|`...`\Button                   |`...`\widgets\Button               |
|`...`\ButtonDropdown           |`...`\widgets\ButtonDropdown       |
|`...`\Carousel                 |`...`\widgets\Carousel             |
|`...`\Collapse                 |`...`\widgets\Collapse             |
|`...`\Dropdown                 |`...`\widgets\Dropdown             |
|`...`\Modal                    |`...`\widgets\Modal                |
|`...`\Nav                      |`...`\widgets\Nav                  |
|`...`\Navbar                   |`...`\widgets\Navbar               |
|`...`\Progress                 |`...`\widgets\Progress             |
|`...`\Tabs                     |`...`\widgets\Tabs                 |
|`...`\ToggleButtonGroup        |`...`\widgets\ToggleButtonGroup    |

Examples:

```php
<?= digitv\bootstrap\widgets\Progress::widget(['percent' => 60, 'label' => 'Test label']) ?>
```

```php
//Breadcrumbs in layout view
<?= digitv\bootstrap\widgets\Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
```

```php
<?php
//Navbar in layout view
    digitv\bootstrap\widgets\NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-dark bg-dark navbar-expand-lg fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Dropdown', 'url' => ['/site/index'], 'items' => [
            ['label' => 'First', 'url' => ['/site/index']],
            ['label' => 'Second', 'url' => '/'],
        ]],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . digitv\bootstrap\Html::beginForm(['/site/logout'], 'post')
            . digitv\bootstrap\Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . digitv\bootstrap\Html::endForm()
            . '</li>';
    }
    echo digitv\bootstrap\widgets\Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    digitv\bootstrap\widgets\NavBar::end();
?>
```