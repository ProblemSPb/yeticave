<section class="lot-item container">
    <h2><?= $lot['name']; ?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src=<?= $lot['img_link']; ?> width="730" height="548" alt=<?= $lot['category name']; ?>>
            </div>
            <p class="lot-item__category">Категория: <span><?= $lot['category name']; ?></span></p>
            <p class="lot-item__description"><?= $lot['description']; ?></p>
        </div>

        <div class="lot-item__right">

            <div class="lot-item__state">
                
                <!-- Вызов функции по расчету, сколько часов и минут до конца аукциона-->
                <?php 
                $auc_end_hr = auction_end($lot['end_date']);
                
                // если осталось меньше часа, то будет выделено красным
                // добавление блоку класса timer--finishing
                $timer_finishing = "";
                if($auc_end_hr[0] < 1) {
                $timer_finishing = "timer--finishing";
                }
                ?>
            <div class="lot-item__timer timer <?= $timer_finishing; ?>">
            <?php echo($auc_end_hr[0].":".$auc_end_hr[1]); ?>
            </div>

                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?= price_format($last_bid); ?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= price_format($lot['bid_step']); ?></span>
                    </div>
                </div>
                <!-- Поле ставки не отобразится, если пользователь не залогинен -->
                <!-- А также, если это лот пользователя, если время аукциона истекло, если последняя ставка принадлежит этому пользователю -->
                <?php if (isset($_SESSION['user']) && ($_SESSION['user']['user_id'] != $lot['userID']) && ($_SESSION['user']['user_id'] != $last_bid_user) && (strtotime('now')  < strtotime($lot['end_date']))) : ?>
                <form class="lot-item__form" action="lot.php?id=<?= $lot['id']; ?>" method="post" autocomplete="off">
                    <p class="lot-item__form-item form__item <?php if (count($errors)) : ?> form__item--invalid <?php endif; ?>">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="text" name="cost" placeholder="<?= price_format($lot['bid_step']); ?>">
                        <span class="form__error"><?= $errors['cost'] ?? ""; ?></span>
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
                <?php endif; ?>
            </div>

            <div class="history">
                <h3>История ставок (<span><?= count($bids);?></span>)</h3>
                <table class="history__list">
                    <?php foreach ($bids as $key => $value) : ?>
                    <tr class="history__item">
                        <td class="history__name"><?= $value['name'];?></td>
                        <td class="history__price"><?= price_format($value['sum_price']); ?></td>
                        <td class="history__time"><?= $value['bid_date'];?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</section>
