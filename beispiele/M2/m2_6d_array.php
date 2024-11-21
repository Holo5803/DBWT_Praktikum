<?php
/**
 * Praktikum DBWT. Autoren:
 * Andreas, Hüpgen, 3679869
 * Viet Minh Duc, Nguyen, 3659300
 */
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];
echo '<ol>';
foreach ($famousMeals as $meal) {
    echo '<li>' . $meal['name'] . '</li>';
    if(is_array($meal['winner'])) {
        for ($i=count($meal['winner'])-1; $i >= 0; $i--) {
            echo $meal['winner'][$i];
            if($i != 0){
                echo ', ';
            }

        }
    }
    else {
        echo $meal['winner'];
    }
    echo '<p></p>';
}

echo '</ol>';
function keine_Gewinner($famousMeals)
{
    $new_arr=[];
    foreach ($famousMeals as $meal) {
        foreach ((array)$meal['winner'] as $winner) {
            if (!in_array($winner, $new_arr)) {
                $new_arr[] = $winner;
            }
        }
    }

    for ($i = 2000; $i < 2020; $i++) {
        if (!in_array($i, $new_arr)) {
            echo '<p>' . $i . '</p>';
        }
    }
}

echo keine_Gewinner($famousMeals);

?>