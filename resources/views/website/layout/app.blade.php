<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonts S -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Fonts E -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Styling CSS S -->
    <link rel="stylesheet" href="{{ url('website/css/reset.css') }}">
    <link rel="stylesheet" href="{{ url('website/css/main.css') }}">
    <!-- Styling CSS E -->

    <!-- Font Awesome S -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome E -->
</head>
    @php
        $settings = \App\Models\AdminSettings::where('slug', 'about_us')->first();
    @endphp
    <body>
        <div id="wrapper">
            <header class="header-main">
                <div class="container-fluid">
                    <div class="header-wrapper">
                        <div class="header-fill">
                            <ul>
                                <li class="active">
                                    <a href="javascript:void(0)">Home</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/blogs/our-story">Story</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/pages/shop">Shop</a>
                                </li>
                                <li>
                                    <a href="https://estate.fratelliwines.in/">Estate</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/blogs/our-journal">Journal</a>
                                </li>
                            </ul>
                        </div>
                        <div class="header-logo">
                            <img src="{{ url('website/images/Fratelli_Logo_Black.webp') }}" width="150px;" alt="Fratelli">
                        </div>
                        <div class="header-fill">
                            <ul>
                                <li>
                                    <a href="https://fratelliwines.in/account">Account</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/search">Search</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/cart">Cart (0)</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/pages/contact">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <div class="banner-main">
                <div class="container">
                    <div class="page-title-bar">
                        <h1 class="title">Investor relations</h1>
                    </div>
                </div>
            </div>

            @yield('content')

            <footer class="footer-main">
                <div class="container-fluid">
                    <div class="ft-inner">
                        <div class="ft-block ft-block-text">
                            <h3 class="ft-title">About the shop</h3>
                            <p>Cultivating a landmark wine region from India, on the world map.</p>
                            <ul class="social-links">
                                <li>
                                    <a href="https://www.instagram.com/fratelliwines/" target="_blank">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/tiltwine/" target="_blank">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/Fratelli.Vineyard" target="_blank">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/channel/UClkkBMyG8o8VOMBPhjUUahg" target="_blank">
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="ft-block ft-block-links">
                            <h3 class="ft-title">Quick links</h3>
                            <ul class="nav-links">
                                <li>
                                    <a href="https://fratelliwines.in/pages/contact">Contact</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/pages/store-locator">Store locator</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/blogs/our-story">Our story</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/blogs/our-journal">Our journal</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/policies/terms-of-service">Terms & conditions</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/policies/shipping-policy">Shipping policy</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/policies/refund-policy">Returns & refund policy</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/policies/privacy-policy">Privacy policy</a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/pages/investor-policy">Investor policy</a>
                                </li>
                            </ul>
                        </div>
                        <div class="ft-block ft-block-newsletter">
                            <h3 class="ft-title">Newsletter</h3>
                            <p>Subscribe to receive updates, access to exclusive deals, and more.</p>
                            <form action="" class="ad-form">
                                <div class="ad-form-group">
                                    <input type="text" placeholder="Enter your email address" class="ad-input">
                                </div>
                                <div class="btn-sc">
                                    <button class="btn btn-primary">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Modal - Who we are S -->
        <div class="modal fade whoWeAreModal" id="whoWeAreModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content no-footer">
                    <div class="modal-header">
                        <h6 class="modal-title">{{ $settings->title }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>{!! $settings->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal - Who we are E -->

        <!-- Modal - Media S -->
        <div class="modal fade mediaModal" id="mediaModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content no-footer">
                    <div class="modal-header">
                        <h6 class="modal-title" id="folderName"></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion-main" id="subFolderBody">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal - Media E -->

        <script src="{{ url('website/js/custom.js') }}"></script>
        <script>
            $(document).ready(function(){

                $('.open-folder').click(function(e){
                    var folder = $(this).attr('folder');

                    $.get('{{ url("get-files/") }}/'+folder, function(response){
                        $('#folderName').html(response.folderName);
                        $('#subFolderBody').html(response.files);
                        $('#mediaModal').modal('show');
                    });
                })
            });
        </script>
    </body>
</html>
