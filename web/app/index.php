<?php
require_once('model.php');

/**
 * @var $tables array
 * @var $current_topic string
 */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MQTT Raspberry</title>
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="/styles/flot.css">
	<script language="javascript" type="text/javascript" src="js/flot/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/flot/jquery.canvaswrapper.js"></script>
	<script language="javascript" type="text/javascript" src="js/flot/jquery.colorhelpers.js"></script>
	<script language="javascript" type="text/javascript" src="js/flot/jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="js/flot/jquery.flot.saturated.js"></script>
	<script language="javascript" type="text/javascript" src="js/flot/jquery.flot.browser.js"></script>
	<script language="javascript" type="text/javascript" src="js/flot/jquery.flot.drawSeries.js"></script>
	<script language="javascript" type="text/javascript" src="js/flot/jquery.flot.uiConstants.js"></script>
	<script language="javascript" type="text/javascript" src="js/flot/jquery.flot.time.js"></script>
	<script language="javascript" type="text/javascript" src="js/script.js"></script>
</head>

<body>
<h1>Информация из топиков</h1>
    <form>
    <div class="select">
        <p>Выберите топик из списка</p>
        <select name="topic" id="topic">
        <option value=""></option>
            <?php foreach($tables as $table):?>
                <option value="<?=$table?>" <?=$table == $current_topic ? 'selected' : ''?>><?=$table?></option>
            <?php endforeach;?>    
        </select>
        <p>Выберите промежуток времени</p>
        <input type="datetime-local" name="from" value="<?=@$_GET['from']?>">           
        <input type="datetime-local" name="to" value="<?=@$_GET['to']?>">
        <button onclick="document.querySelector('form').submit()">Получить</button>                   
    </div>
    </form>
    <div id="content">
		<div class="demo-container"><div id="placeholder" class="demo-placeholder"></div></div>
	</div>
    <table>
    <tr>
        <th>ID</th>
        <th>Время</th>
        <th>Сообщение</th>
    </tr>
<?php if(!empty($data)):?>    
<?php foreach($data as $row):?>
    <tr>
        <td><?=$row['ID']?></td>
        <td><?=$row['DATE_INSERT']?></td>
        <td><?=$row['MESSAGE']?></td>
    </tr>
<?php endforeach;?>
<?php endif;?>
</table>
<script src="js/script.js"></script>
</body>
</html>
