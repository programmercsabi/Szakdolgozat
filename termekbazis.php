<?php

session_start();

if (isset($_POST['add_to_cart'])) {

    if (isset($_SESSION['cart'])) {

        $session_array_id = array_column($_SESSION['cart'], "id");


        if (!in_array($_GET['id'], $session_array_id)) {

            $session_array = array(
                'id' => $_GET['id'],
                "name" => $_POST['name'],
                "price" => $_POST['price'],
                "quantity" => $_POST['quantity'],
            );
    
            $_SESSION['cart'][] = $session_array;
        }

    }else{

        $session_array = array(
            'id' => $_GET['id'],
            "name" => $_POST['name'],
            "price" => $_POST['price'],
            "quantity" => $_POST['quantity'],
        );

        $_SESSION['cart'][] = $session_array;
    }
}

?>
<?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] == "clearall"){
            unset($_SESSION['cart']);
        }
        if ($_GET['action'] == "remove"){

            foreach ($_SESSION['cart'] as $key => $value){
                
                if ($value['id'] == $_GET['id']){
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
    } 
    ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<style>
    body{
        width: 100vw;
        height: 100vh;
        background: url(sss.jpg);
        background-size: cover;
    }

</style>
<body class="sc">


    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center">Termékek</h2>
                    <div class="col-md-12">
                        <div class="row">


                    <?php

                    $query = "SELECT * FROM termek";
                    $result = mysqli_query($adb,$query);


                    while ($row = mysqli_fetch_array($result)) {?>
                     <div class="col-md-4">
                        <form method="post" action="?p=termekek&id=<?=$row['id'] ?>">
                            <img src="img/<?= $row['image'] ?>" style='height: 150px;'>
                            <h5 class="text-center"><?= $row['name']; ?></h5>
                            <h5 class="text-center">$<?= number_format($row['price'],2); ?></h5>
                            <input type="hidden" name="name" value="<?= $row['name']  ?>">
                            <input type="hidden" name="price" value="<?= $row['price']  ?>">
                            <input type="number" name="quantity" value="1" class="form-control">
                            <input type="submit" name="add_to_cart" class="btn btn-warning btn-block my-2" value="Kosárba">
                        </form>
                    </div>

                    <?php }



                    ?>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <h2 class="text-center">Kiválasztott Termékek</h2>
                    
                    <?php

                    $total = 0;

                    $output = "";

                    $output .= "
                    <table class='table table-bordered table-striped'>
                      <tr>
                       <th>ID</th>
                       <th>Termék neve</th>
                       <th>Termék ára</th>
                       <th>Termék db szám</th>
                       <th>Végösszeg</th>
                       <th>Action</th>
                       </tr>
                    ";

                    if (!empty($_SESSION['cart'])) {

                        foreach ($_SESSION['cart'] as $key => $value) {

                            $output .= "
                             <tr>
                               <td>".$value['id']."</td>
                               <td>".$value['name']."</td>
                               <td>".$value['price']."</td>
                               <td>".$value['quantity']."</td>
                               <td>$".number_format($value['price'] * $value['quantity'],2)."</td>
                               <td>".$value['id']."</td>
                               <td>
                                  <a href='?p=termekek&id=$_GET[id]&action=remove&id=".$value['id']."'>
                                   <button class='btn btn-danger btn-block'>Remove</button>
                                  </a>
                               </td>
                            
                            ";

                            $total = $total + $value['quantity'] * $value['price'];

                        }
                        $output .= "
                        <tr>
                         <td colspan='3'></td>
                         <td></b>Végösszeg</b></td>
                         <td>".number_format($total,2)."</td>
                         <td>
                            <a href='?p=termekek&id=$_GET[id]&action=clearall'>
                             <button class='btn btn-warning'>Clear All</button>
                            </a>
                         </td>
                        </tr>
                        ";
                    }

                    
            echo $output;
                    ?>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>