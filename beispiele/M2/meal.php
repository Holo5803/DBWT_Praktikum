<?php

/**
 * Praktikum DBWT. Autoren:
 * Andreas, Hüpgen, 3679869
 * Viet Minh Duc, Nguyen, 3659300
 */
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';


$sprache = isset($_GET['sprache']) ? $_GET['sprache'] : 'de';


$texts = [
    'de' => [
        'title' => 'Gericht:',
        'description_button' => 'Beschreibung einblenden',
        'description_button_hide' => 'Beschreibung ausblenden',
        'allergens' => 'Allergene:',
        'reviews' => 'Bewertungen (Insgesamt:',
        'filter_text' => 'Filter:',
        'submit' => 'Suchen',
        'text' => 'Text',
        'author' => 'Autor',
        'stars' => 'Sterne',
        'price_intern' => 'Preis Intern',
        'price_extern'=> 'Preis Extern',
        'flop' => "Flop Bewertungen",
        'top' => "Top Bewertungen"
    ],
    'en' => [
        'title' => 'Dish:',
        'description_button' => 'Show Description',
        'description_button_hide' => 'Hide Description',
        'allergens' => 'Allergens:',
        'reviews' => 'Reviews (Total:',
        'filter_text' => 'Filter:',
        'submit' => 'Search',
        'text' => 'Text',
        'author' => 'Author',
        'stars' => 'Stars',
        'price_intern' => 'Price intern',
        'price_extern' => 'Price extern',
        'flop' => "Flop Ratings",
        'top' => "Top Ratings"
    ]
];


$currentTexts = $texts[$sprache];


$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch',
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'prices' => [
            'price_intern' => 2.90,
            'price_extern' => 3.90,
        ],
    'allergens' => [11, 13],
    'amount' => 42
];

$ratings = [
    [ 'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse.',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [ 'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [ 'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [ 'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = strtolower($_GET[GET_PARAM_SEARCH_TEXT]);
    foreach ($ratings as $rating) {
        if (strpos(strtolower($rating['text']), $searchTerm) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = (int)$_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET['type'])) {
    $type = strtolower($_GET['type']);
    if ($type == 'top') {
        $maxStars = max(array_column($ratings, 'stars'));
        foreach ($ratings as $rating) {
            if ($rating['stars'] == $maxStars) {
                $showRatings[] = $rating;
            }
        }
    } else if ($type == 'flop') {
        $minStars = min(array_column($ratings, 'stars'));
        foreach ($ratings as $rating) {
            if ($rating['stars'] == $minStars) {
                $showRatings[] = $rating;
            }
        }
    }
} else {
    $showRatings = $ratings;
}


function calcMeanStars(array $ratings) : float {
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'];
    }
    return count($ratings) > 0 ? $sum / count($ratings) : 0.0;
}

?>

<!DOCTYPE html>
<html lang="<?php echo $sprache; ?>">
<head>
    <meta charset="UTF-8"/>
    <title><?php echo $currentTexts['title'] . " " . $meal['name']; ?></title>
    <style>
        * {
            font-family: Arial, serif;

        }
        .rating {
            color: darkgray;
        }

    </style>
</head>
<body>


<a href="?sprache=de">Deutsch</a> | <a href="?sprache=en">English</a>

<h1><?php echo $currentTexts['title'] . " " . $meal['name']; ?></h1>

<h3><?php echo $currentTexts['price_intern'].": ". number_format($meal['prices']['price_intern'],2,",","."). " €"?></h3>
<h3><?php echo $currentTexts['price_extern'].": ". number_format($meal['prices']['price_extern'],2,",","."). " €"?></h3>


<?php
$showDescription = isset($_GET['showDescription']) && $_GET['showDescription'] == '1';
?>

<form method="get">
    <input type="hidden" name="sprache" value="<?php echo $sprache; ?>">
    <input type="hidden" name="showDescription" value="<?php echo $showDescription ? '0' : '1'; ?>">
    <button type="submit">
        <?php echo $showDescription ? $currentTexts['description_button_hide'] : $currentTexts['description_button']; ?>
    </button>
</form>

<?php
if ($showDescription) {
    echo "<p>{$meal['description']}</p>";
}
?>

<h3><?php echo $currentTexts['allergens']; ?></h3>
<ul>
    <?php
    if (!empty($meal['allergens'])) {
        foreach ($meal['allergens'] as $allergenId) {
            echo "<li>{$allergens[$allergenId]}</li>";
        }
    }
    ?>
</ul>

<h1><?php echo $currentTexts['reviews'] . " " . calcMeanStars($ratings) . ")"; ?></h1>
<form method="get">
    <label for="search_text"><?php echo $currentTexts['filter_text']; ?></label>
    <input id="search_text" type="text" name="search_text" value="<?php echo isset($_GET['search_text']) ? $_GET['search_text'] : ""; ?>">
    <input type="submit" value="<?php echo $currentTexts['submit']; ?>">
    <input type="hidden" name="sprache" value="<?php echo $sprache; ?>">
    <br><br>
    <label for="type">Typ:</label>
    <select id="type" name="type">
        <option value=""><?php echo $currentTexts['filter_text']; ?></option>
        <option value="top" <?php echo (isset($_GET['type']) && $_GET['type'] == 'top') ? 'selected' : ''; ?>><?php echo $currentTexts['top'] ?></option>
        <option value="flop" <?php echo (isset($_GET['type']) && $_GET['type'] == 'flop') ? 'selected' : ''; ?>><?php echo $currentTexts['flop'] ?></option>
    </select>
</form>

<table class="rating">
    <thead>
    <tr>
        <td><?php echo $currentTexts['text']; ?></td>
        <td><?php echo $currentTexts['author']; ?></td>
        <td><?php echo $currentTexts['price_intern']; ?></td>
        <td><?php echo $currentTexts['price_extern']; ?></td>
        <td><?php echo $currentTexts['stars']; ?></td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($showRatings as $rating) {
        echo "<tr>
              <td class='rating_text'>{$rating['text']}</td>
              <td class='rating_author'>{$rating['author']}</td>
              <td class='rating_stars'>{$rating['stars']}</td>
          </tr>";
    }
    ?>

    </tbody>
</table>

</body>
</html>
