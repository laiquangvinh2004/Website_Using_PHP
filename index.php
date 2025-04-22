<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Ecommerce</title>
</head>
<body>
    <h1>
        <?php
            spl_autoload_register(function($class){
                $paths = [
                    'system/libs/',
                    'app/models/'
                ];
                foreach($paths as $path) {
                    $file = $path . $class . '.php';
                    if(file_exists($file)) {
                        include_once $file;
                        return;
                    }
                }
            });
            include_once 'app/config/config.php';
            $main = new Main();
        ?>
    </h1>
</body>
</html>

<!-- Ctrl + / -->