<?php include 'base.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JQUERY STEP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
    <link rel="stylesheet" href="../CSS/loanApp.css">
    <script src="loan.js"></script>
    <title>Loan Application</title>
</head>

<body>

</html>
<main-header></main-header>
<div class="wrapper">
    <form action="">
        <div id="wizard">
            <!-- SECTION 1 -->
            <h4></h4>
            <section>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
            </section> <!-- SECTION 2 -->
            <h4></h4>
            <section>
                <div class="form-row"> <input type="text" class="form-control" placeholder="country"> </div>
                <div class="form-row"> <input type="text" class="form-control" placeholder="zip code"> </div>
                <div class="form-row" style="margin-bottom: 18px"> <textarea name="" id="" class="form-control" placeholder="Any order note about delivery or special offer" style="height: 108px"></textarea> </div>
            </section> <!-- SECTION 3 -->
            <h4></h4>
            <section>
                <div class="product">
                    <div class="item">
                        <div class="left"> <a href="#" class="thumb"> <img src="https://i.imgur.com/yYu3Hbl.jpg" alt=""> </a>
                            <div class="purchase">
                                <h6> <a href="#">Macbook Air Laptop</a> </h6> <span>x1</span>
                            </div>
                        </div> <span class="price">$290</span>
                    </div>
                    <div class="item">
                        <div class="left"> <a href="#" class="thumb"> <img src="https://www.businessinsider.in/thumb/msid-70101317,width-600,resizemode-4,imgsize-87580/tech/ways-to-increase-mobile-phone-speed/13d0e0722dbca5aa91e16a8ae2a744e5.jpg" alt=""> </a>
                            <div class="purchase">
                                <h6> <a href="#">Mobile Phone Mi</a> </h6> <span>x1</span>
                            </div>
                        </div> <span class="price">$124</span>
                    </div>
                </div>
                <div class="checkout">
                    <div class="subtotal"> <span class="heading">Subtotal</span> <span class="total">$364</span> </div>
                </div>
            </section> <!-- SECTION 4 -->
            <h4></h4>
            <section>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                    <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                </svg>
                <p class="success">Order placed successfully. Your order will be dispacted soon. meanwhile you can track your order in my order section.</p>
            </section>
        </div>
    </form>
</div>

</body>

</html>