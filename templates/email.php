<h1>Поздравляем с победой</h1>
<p>Здравствуйте, <?= htmlspecialchars($winner_name);?></p>
<p>Ваша ставка для лота <a href="http://<?= $host; ?>/lot.php?id=<?= $lot_id; ?>"><?= htmlspecialchars($lot_name);?></a> победила.</p>
<p>Перейдите по ссылке <a href="http://<?= $host; ?>/my_bets.php">мои ставки</a>,
    чтобы связаться с автором объявления</p>
<small>Интернет Аукцион "YetiCave"</small>