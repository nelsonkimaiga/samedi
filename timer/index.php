<?php
session_start();

$_SESSION['page']['home_url'] = '../';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1"/>
<meta name="author" content="SAM">
<meta name="title" content="Kenyas first Gift Registry platform. No just get gifts, get the gifts you desire.">
<meta name="description" content="A Kenyan Gift registry platform for your Wedding, Baby Shower, Birthday Party or Graduation events.">
<meta name="keywords" content="Wedding gifts, gift registry, baby shower gifts, baby shower, graduation gifts, kenyan gift registry, birthday party events, registry gifts, wedding registry, baby shower registry, graduation registry">
<meta name="url" content="http://www.samedi.co.ke">
<title>Samedi Registry | Wedding Registry | Baby Shower Registry | Graduation Registry</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
<script src="build/jquery.syotimer.min.js"></script>
</head>

<body>
<?php
include('templates/top-nav.dev.php');
?>
<div align="center" style="margin-top:5%">
	<img src="<?=$_SESSION["page"]["home_url"]?>img/samedi-white.jpg" />
    <br><br>
	<div style="color:#0061C1; font-weight:bold; font-size:30px">
    	We will go live in: 
    </div>
</div>

</body>
</html>
<script type="application/javascript">
        $(document).ready(function(){
            /* Simple Timer. The countdown to 20:30 2100.05.09
            --------------------------------------------------------- */
            $('#simple_timer').syotimer({
                year: 2017,
                month: 1,
                day: 27,
                hour: 23,
                minute: 59,
				effectType: 'opacity'
            });

            /* Timer with Head and Foot. Countdown is over
            --------------------------------------------------------- */
            $('#countdowned_timer').syotimer({
                year: 1990,
                headTitle: '<h3>Timer with header and footer. Countdown is over</h3>',
                footTitle: '<i style="color: brown;">Footer of timer.</i>',
            });

            /* Callback after the end of the countdown timer */
            $('#countdowned_timer_event').syotimer({
                year: 2016,
                month: 12,
                day: 31,
                hour: 0,
                minute: 0,

                headTitle: '<h3>Timer with header and footer. Countdown is over</h3>',
                footTitle: '<i style="color: brown;">Footer of timer.</i>',
                afterDeadline: function(syotimer){
                    syotimer.bodyBlock.html('<p>The countdown is finished 00:00 2000.12.31</p>');
                    syotimer.headBlock.html('<h3>Callback after the end of the countdown timer</h3>');
                    syotimer.footBlock.html('<i style="color: brown;">Footer of timer after countdown is finished</i>');
                }
            });


            /* Periodic Timer. Period is equal 3 minutes. Effect of fading in
            --------------------------------------------------------- */
            $('#periodic_timer_minutes').syotimer({
                year: 2015,
                month: 1,
                day: 1,
                hour: 0,
                minute: 0,

                headTitle: '<h3>Periodic Timer. The countdown begins first through each 3 minutes. Effect of fading in</h3>',

                dayVisible: false,
                dubleNumbers: false,
                effectType: 'opacity',

                periodUnit: 'm',
                periodic: true,
                periodInterval: 3
            });

            /* Periodic Timer. Period is equal 10 days
            --------------------------------------------------------- */
            $('#periodic_timer_days').syotimer({
                year: 2015,
                month: 1,
                day: 1,
                hour: 20,
                minute: 0,

                headTitle: '<h3>Periodic Timer. The countdown begins first through each 10 days</h3>' +
                    '<p style="font-size: .8em; color: #666;">The date equal 20:00 2015.01.01</p>',
                dayVisible: false,

                periodic: true,
                periodInterval: 10,
                periodUnit: 'd'
            });

            /* Periodic Timer. Change options: effect type
             --------------------------------------------------------- */
            $('#change_options').syotimer({
                periodic: true,
                periodInterval: 10,
                periodUnit: 'd'
            });

            $('#change_options__effect-type').click(function() {
                var button = $(this),
                    effectTypes = ['opacity', 'none'],
                    effectIndex = parseInt( button.data('index') ),
                    nextEffectIndex = ( effectIndex === (effectTypes.length - 1) ) ? 0 : (effectIndex + 1);
                button.data('index', nextEffectIndex);
                $('#change_options').syotimer('setOption', 'effectType', effectTypes[nextEffectIndex]);
            });
            $('#change_options__double-numbers').click(function() {
                var button = $(this),
                    index = parseInt( button.data('index') ),
                    nextIndex = Math.abs(index - 1);
                button.data('index', nextIndex);
                $('#change_options').syotimer('setOption', 'doubleNumbers', nextIndex == 1);
            });
            $('#change_options__lang').click(function() {
                var button = $(this),
                    languages = ['eng', 'rus'],
                    langIndex = parseInt( button.data('index') ),
                    nextLangIndex = ( langIndex === (languages.length - 1) ) ? 0 : (langIndex + 1);
                button.data('index', nextLangIndex);
                $('#change_options').syotimer('setOption', 'lang', languages[nextLangIndex]);
            });

        });
    </script>


    <style type="text/css">
        body{
            font-family: 'Open Sans',Tahoma, serif;
            font-size: 14px;
            padding: 0 0 100px;
            background-color:#fafafa;
        }

        /* Customization Style of SyoTimer */
        .timer{
            text-align: center;

            margin: 30px auto 0;
            padding: 0 0 10px;

            border-bottom: 2px solid #80a3ca;
        }
        .timer .table-cell{
            display: inline-block;
            margin: 0 5px;

            width: 79px;
            background: url(images/timer.png) no-repeat 0 0;
        }
        .timer .table-cell .tab-val{
            font-size: 35px;
            color: #80a3ca;

            height: 81px;
            line-height: 81px;

            margin: 0 0 5px;
        }
        .timer .table-cell .tab-unit{
            font-family: Arial, serif;
            font-size: 12px;
            text-transform: uppercase;
        }

        #simple_timer.timer .table-cell.day,
        #periodic_timer_days.timer .table-cell.hour{
            width: 120px;
            background-image: url(images/timer_long.png);
        }
    </style>
</head>

<body>

    <div id="simple_timer"></div>
    
</body>
</html>