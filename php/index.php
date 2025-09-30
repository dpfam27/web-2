<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>INS3064 - Introduction to Information Systems</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>PHP Variables Demo</h1>
            <div class="result">
                <?php
                $x = 10;
                $y = 11;
                echo "x: ". $x ,"<br/>";
                echo "y: ". $y ,"<br/>";
                echo "x/y: " .($x/$y) ,"<br/>";
                echo "x%y: " .($x%$y) ,"<br/>";
                echo "x++: " .($x++) ,"<br/>";
                echo "++y: " .(++$y) ,"<br/>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>