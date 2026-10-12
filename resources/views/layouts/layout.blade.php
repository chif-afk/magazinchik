<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}">

    <title>@yield('title', 'Laravel Shop')</title>
</head>
<body>

@include('layouts.navbar')

<div class="wrapper mt-5">
    <div class="container">
        <div class="row">

            @yield('content')

        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /wrapper -->

<!-- Modal -->
<div class="modal fade cart-modal" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Корзина</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><a href="product.html"><img src="{{ asset('assets/front/img/1.jpg') }}" alt="CORT AD810M Акустическая гитара"></a></td>
                        <td><a href="product.html">CORT AD810M Акустическая гитара</a></td>
                        <td>2 799</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td><a href="product.html"><img src="{{ asset('assets/front/img/2.jpg') }}" alt="Crafter D6/N Акустическая гитара"></a></td>
                        <td><a href="product.html">Crafter D6/N Акустическая гитара</a></td>
                        <td>12 626</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Товаров: 3 <br> Сумма: 28 051 руб.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Оформить заказ</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/front/js/main.js') }}"></script>
</body>
</html>
