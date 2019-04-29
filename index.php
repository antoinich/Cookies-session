<?php require 'inc/head.php';
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    die;
}
if (isset($_GET['logout']) && $_GET['logout'] == 1){
    session_destroy();
    header('Location: login.php');
    die;
}
if (!empty($_GET['add_to_cart'])) {
    $item = (int)$_GET['add_to_cart'];

    if (!isset($nbOrder[$item])) {
        $nbOrder[$item] = 1;
    }

    if (isset($_COOKIE['items'])) {
        $cookieTabs = unserialize($_COOKIE['items']);

        foreach ($cookieTabs as $cookieTab) {
            if ($cookieTab['id'] === $item) {
                $nbOrder[$item] = $cookieTab['quantity'];
                $nbOrder[$item]++;

            }
        }
    }

    switch ($item) {
        case 32 :
            $nameProduct = "M&M's© cookies";
            break;
        case 36 :
            $nameProduct = "Chocolate chips";
            break;
        case 46 :
            $nameProduct = "Pecan nuts";
            break;
        case 58 :
            $nameProduct = "Chocolate cookie";
            break;
        default :
            $nameProduct = "Produit inconnu";
            break;
    }

    $cookieTabs[$item] = [
        'id' => $item,
        'description' => $nameProduct,
        'quantity' => $nbOrder[$item],
    ];

    setcookie("items", serialize($cookieTabs), time() + (0.5 * 60));
}

if (!empty($cookieTabs)) {
    $nbItemCart = 0;
    foreach ($cookieTabs as $cartItem) {
        if (!empty($cartItem['quantity'])) {
            $nbItemCart += $cartItem['quantity'];
        }
    }

    $_SESSION['nbItemCart'] = $nbItemCart;
    header('Location: index.php');
    die;
}
?>
<section class="cookies container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <figure class="thumbnail text-center">
        <img src="assets/img/product-46.jpg" alt="cookies choclate chips" class="img-responsive">
        <figcaption class="caption">
          <h3>Pecan nuts</h3>
          <p>Cooked by Penny !</p>
          <a  href="?add_to_cart=46" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add to cart
          </a>
        </figcaption>
      </figure>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <figure class="thumbnail text-center">
        <img src="assets/img/product-36.jpg" alt="cookies choclate chips" class="img-responsive">
        <figcaption class="caption">
          <h3>Chocolate chips</h3>
          <p>Cooked by Bernadette !</p>
          <a  href="?add_to_cart=36" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add to cart
          </a>
        </figcaption>
      </figure>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <figure class="thumbnail text-center">
        <img src="assets/img/product-58.jpg" alt="cookies choclate chips" class="img-responsive">
        <figcaption class="caption">
          <h3>Chocolate cookie</h3>
          <p>Cooked by Bernadette !</p>
          <a  href="?add_to_cart=58" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add to cart
          </a>
        </figcaption>
      </figure>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <figure class="thumbnail text-center">
        <img src="assets/img/product-32.jpg" alt="cookies choclate chips" class="img-responsive">
        <figcaption class="caption">
          <h3>M&M's&copy; cookies</h3>
          <p>Cooked by Penny !</p>
          <a  href="?add_to_cart=32" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add to cart
          </a>
        </figcaption>
      </figure>
    </div>
  </div>
</section>
<?php require 'inc/foot.php'; ?>
