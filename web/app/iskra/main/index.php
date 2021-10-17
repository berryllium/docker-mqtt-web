<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/styles/bootstrap.min.css">
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    <title>КНС Искра</title>
</head>
<body>
<h1>КНС Искра</h1>
<div class="wrap">
    <div class="left">
        <div class="title">Уровень в резервуаре</div>
        <div class="data">
            <div class="img">
                <img src="img/reservuar.jpg" alt="reservuar">
                <div id="cur1">
                    <div class="scale"><div class="current">0.99</div></div>
                    <div class="max" data-option="dangerLevelMax">300</div>
                    <div class="min" data-option="dangerLevelMin">0</div>

                </div>
            </div>
        </div>
        <div class="input-group mt-3">
            <span class="input-group-text" id="basic-addon1">Уроверь max (сантиметры) :</span>
            <input type="text" class="form-control" name="dangerLevelMax" aria-label="dangerLevelMax">
            <button class="setOption btn btn-primary">Задать</button>
        </div>
        <div class="input-group mt-3">
            <span class="input-group-text" id="basic-addon1">Уровень min (сантиметры) :</span>
            <input type="text" class="form-control" name="dangerLevelMin" aria-label="dangerLevelMin">
            <button class="setOption btn btn-primary">Задать</button>
        </div>
    </div>
    <div class="right">
        <div class="title">Насосы</div>
        <div class="data">
            <div class="block">
                <header>Насос <b>№1</b></header>
                <div class="data-block" id="pomp1">
                        <img src="img/pomp.jpeg" alt="pomp">
                        <div class="pomp">
                            <img src="img/propeller.png" alt="">
                        </div>
                </div>
            </div>
            <div class="block">
                <header>Насос <b>№2</b></header>
                <div class="data-block" id="pomp2">
                    <img src="img/pomp.jpeg" alt="pomp">
                    <div class="pomp">
                        <img src="img/propeller.png" alt="">
                    </div>
                </div>
            </div>
            <div class="block">
                <header>Насос <b>№3</b></header>
                <div class="data-block" id="pomp3">
                    <img src="img/pomp.jpeg" alt="pomp">
                    <div class="pomp">
                        <img src="img/propeller.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="/" class="back"><img src="img/back.png" alt="back"></a>
    <a href="javascript:void(0)" class="sound"><img src="img/sound_drop.png" alt="back"></a>
</div>
<audio src="alarm.mp3" id="alarm" muted></audio>
<div class="bg"><button class="setOption btn btn-primary">Войти</button></div>
</body>
</html>