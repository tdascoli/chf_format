<?php

use CHFFormat\CHF;

require_once '../vendor/autoload.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CHF Format</title>

    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
<header data-bs-theme="dark">
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand">CHF Format</a>
            <span style="color: white;">((packagist)) ((github))</span>
        </div>
    </div>
</header>

<main class="container py-3">
    <h1>chf_format</h1>
    <p>chf_format — Format a number with grouped thousands in Swiss Francs</p>

    <h2>Description</h2>
    <div class="card w-50 mb-3">
        <div class="card-body">
            <?php highlight_string(
'<?php 
    CHF::format(
        float $num,
        array $settings = [
            "show_decimals" => true,
            "is_table" => false,
            "long" => false,
            "chf" => false,
        ],
        string $lang = "de"
    ): string 
?>');
            ?>
        </div>
    </div>
    <p>Formats a number with grouped thousands and optionally decimal digits using the rounding half up rule.</p>

    <h2>Parameters</h2>

    <h2>Return Values</h2>

    <h2>Examples</h2>
    <?php
    echo CHF::format(1200.40);
    echo '<hr />';
    echo CHF::format(120, ['show_decimals' => false]);
    echo '<hr />';
    echo CHF::format(0.45, ['show_decimals' => false, 'is_table' => true, 'long' => true], 'fr');
    echo '<hr />';
    echo CHF::format(0.45, ['chf' => true]);
    echo '<hr />';
    echo '<hr />';

    echo CHF::format(0.45, ['is_table' => true]);
    echo '<hr />';
    echo CHF::format(0.0, ['is_table' => true]);
    ?>
</main>
</body>
</html>