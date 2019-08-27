<?php
/**
 * Created by PhpStorm.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

//подключаем Asset
\app\assets\CalenderAsset::register($this);
?>


<?php
if (isset($_REQUEST['date']))
{
    //Проверяем, не пришло ли чего лишнего...
    $pattern = "/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/";
    if (preg_match($pattern, $_REQUEST['date'])) {
        $date = $_REQUEST['date'];
    } else {
        die('Неправильный параметр');
    }
}
else {
    $date = date("Y-m-d");
}



$sd = explode("-", $date);
$year 	= $sd[0];
$month = $sd[1];
$day 	= $sd[2];

$dayofmonth = date('t', mktime(0, 0, 0, $month, 1, $year));

$k=array();
for($i = 1; $i<=$dayofmonth; $i++){
    $k[$i] = $i;
};

$activArr = ArrayHelper::toArray($activities);


for ($i = 0; $i < count($activArr); $i++)
{
    $a = $activArr[$i];



    foreach ($k	as $i)
    {	//Добавление 0 к дате
        if($i<10) $cd = "$year-$month-0".$i;

        else $cd = "$year-$month-$i";
    }
};

?>

<?php


// Счётчик для дней месяца
$day_count = 1;

// 1. Первая неделя
$num = 0;
for($i = 0; $i < 7; $i++)
{
    // Вычисляем номер дня недели для числа
    $dayofweek = date('w', mktime(0, 0, 0, $month, $day_count, $year));
    // Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
    $dayofweek = $dayofweek - 1;
    if($dayofweek == -1) $dayofweek = 6;

    if($dayofweek == $i)
    {
        // Если дни недели совпадают,
        // заполняем массив $week
        // числами месяца
        $week[$num][$i] = $day_count;
        $day_count++;
    }
    else
    {
        $week[$num][$i] = "";
    }
}

// 2. Последующие недели месяца
while(true)
{
    $num++;
    for($i = 0; $i < 7; $i++)
    {
        $week[$num][$i] = $day_count;
        $day_count++;
        // Если достигли конца месяца - выходим
        // из цикла
        if($day_count > $dayofmonth) break;
    }
    // Если достигли конца месяца - выходим
    // из цикла
    if($day_count > $dayofmonth) break;
}

// 3. Выводим содержимое массива $week
// в виде календаря
// Выводим таблицу
echo '<div id="calendar">';
//заголовок
$rusdays = array('ПН','ВТ','СР','ЧТ','ПТ','СБ','ВС');
$rusmonth = array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');

echo '
				<button class="col-md-1 btn btn-default" onclick="monthf(\'prev\');"><</button>
				<h3 class="col-md-10 month_year" colspan="5"><span id="month" num="'.$month.'">'.$rusmonth[$month-1].'</span>, <span id="year">'.$year.'</span></h3>
				<button class="col-md-1 btn btn-default" onclick="monthf(\'next\');">></button>
			';

echo '<table class="table">
        <thead>
            <tr>';

foreach ($rusdays as $rusday){
    echo '
                <th scope="col">'.$rusday.'</th>
           ';
}

echo '</tr>
  </thead>';

//тело календаря
for($i = 0; $i < count($week); $i++)
{
    echo "<tr>";
    for($j = 0; $j < 7; $j++)
    {
        if(!empty($week[$i][$j]))
        {

            // Если имеем дело с выбраной датой подсвечиваем ee
            if($week[$i][$j]==$day)
            {
                echo '<td class="today dayTd">';
            }
            else
            {
                echo '<td class="dayTd">';
            }


            if ($week[$i][$j] < 10)
            {
                $dateOfDay = $year.'-'.$month.'-'.'0'.$week[$i][$j];
            }
            else
                {
                $dateOfDay = $year.'-'.$month.'-'.$week[$i][$j];
            }



            echo '<div class="form-group dayCell">';

            $form=ActiveForm::begin([
                'action' => '/day/show',
                'method' => 'POST',
                'id' => 'day',
            ]);


            echo $form->field($dayModel, 'date') -> label(false) -> hiddenInput(['value' =>
                \Yii::$app->sqlFormatter->asDate($dateOfDay)]);

            echo '
                <button type="submit" class="dayButton">'.$week[$i][$j].'</button>
                   </div>';

            ActiveForm::end();


            foreach ($activArr as $activity)
            {
                if ($dateOfDay >= $activity['date_start'] && $dateOfDay <= $activity['date_end'])
                //if ($dateOfDay == $activity['date_start'])
                {
                    echo \yii\helpers\Html::a($activity['title'].'<br>', ['activity-search/view?id='.$activity['id']]);
                }
            };

            echo '</td>';
        }
        else echo "<td> </td>";
    }
    echo "</tr>";
}

echo "</table></div>";
?>
