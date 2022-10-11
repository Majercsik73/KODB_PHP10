<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <title> KODB_PHP10/termekek</title>
</head>

<body>
    
    <div class="card container p-3 m-3">

        <?php if($isSuccess): ?>
            <div class="alert alert-success">
            Termék létrehozása sikeres!
            </div>
        <?php endif; ?>
        <form action="/KODB_PHP10/termekek" method="POST">
            <input type="text" name="name" placeholder="Név" />
            <input type="number" name="price" placeholder="Ár" />
            <button type="submit" class="btn btn-success">Küldés</button>
        </form>
        <?php foreach ($products as $product) : ?>
            <h3>Név: <?php echo $product["name"] ?></h3>
            <p>Ár: <?php echo $product["price"] ?> ft</p>
            <hr>
        <?php endforeach; ?>
    </div>
</body>

</html>