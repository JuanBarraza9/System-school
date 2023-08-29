<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System School | <?php echo $titulo ?? '';  ?> </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/build/css/style.css">
    <link rel="stylesheet" href="/build/css/normalize.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php 
         include 'include/header.php'
    ?>
    

    <?php if($_SERVER['REQUEST_URI'] === '/'){ ?>
       <div class="">
          <?php echo $contenido; ?>
       </div>
    <?php } else { ?>
        <div class="contenido">
          <?php echo $contenido; ?>
       </div>
    <?php } ?>

    
    <?php echo $script ?? ''; ?>

   <script src="/build/js/bundle.min.js"></script>
   <?php 
         include 'include/footer.php'
    ?>
</body>
</html>