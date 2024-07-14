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

    <style>
        .mobile {
            display: none !important;
        }

        /* Media query for desktop screens (1024px and above) */
        @media (min-width: 1024px) {
            .desktop {
                display: block !important;
            }
            .mobile {
                display: none !important;
            }
        }

        /* Media query for mobile and tablet screens (less than 1024px) */
        @media (max-width: 1023px) {
            .desktop {
                display: none !important;
            }
            .mobile {
                display: block !important;
            }
        }
    </style>

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
                        <div class="header-fill hidden-xl">
                            <div class="toggle-icn" id="navbar-toggle">
                                <svg class="Icon Icon--nav" role="presentation" width="20px" viewBox="0 0 20 14"><path d="M0 14v-1h20v1H0zm0-7.5h20v1H0v-1zM0 0h20v1H0V0z" fill="currentColor"></path></svg>
                            </div>
                        </div>
                        <div class="header-fill left-fill" id="nav-left">
                            <div class="close-div hidden-xl">
                                <div class="btn-close" id="nav-close-btn"></div>
                            </div>
                            <ul class="nav-ul">
                                <li>
                                    <a href="https://fratelliwines.in/">Home</a>
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
                                <li class="active">
                                    <a href="{{ url('/') }}">Investor</a>
                                </li>
                                <li class="hidden-xl">
                                    <a href="https://fratelliwines.in/account">Account</a>
                                </li>
                            </ul>
                            <div class="nav-ft hidden-xl">
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
                        </div>
                        <a href="https://fratelliwines.in/" class="header-logo">
                            <img src="{{ url('website/images/Fratelli_Logo_Black.webp') }}" width="150px;" alt="Fratelli">
                        </a>
                        <div class="header-fill right-fill">
                            <ul>
                                <li class="hidden-lg hidden-md hidden-sm hidden-xs">
                                    <a href="https://fratelliwines.in/account">
                                        <span>Account</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/search">
                                        <span class="hidden-lg hidden-md hidden-sm hidden-xs">Search</span>
                                        <span class="hidden-xl"><svg class="Icon Icon--search" width="18px" role="presentation" viewBox="0 0 18 17"><g transform="translate(1 1)" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square"><path d="M16 16l-5.0752-5.0752"></path><circle cx="6.4" cy="6.4" r="6.4"></circle></g></svg></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://fratelliwines.in/cart">
                                        <span class="hidden-lg hidden-md hidden-sm hidden-xs">Cart (0)</span>
                                        <span class="hidden-xl"><svg class="Icon Icon--cart" width="17px" role="presentation" viewBox="0 0 17 20"><path d="M0 20V4.995l1 .006v.015l4-.002V4c0-2.484 1.274-4 3.5-4C10.518 0 12 1.48 12 4v1.012l5-.003v.985H1V19h15V6.005h1V20H0zM11 4.49C11 2.267 10.507 1 8.5 1 6.5 1 6 2.27 6 4.49V5l5-.002V4.49z" fill="currentColor"></path></svg></span>
                                    </a>
                                </li>
                                <li class="hidden-lg hidden-md hidden-sm hidden-xs">
                                    <a href="https://fratelliwines.in/pages/contact">
                                        <span>Contact</span>
                                    </a>
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
                            <form id="newletter-form" class="ad-form">
                                <div class="ad-form-group" id="main-body">
                                    <input type="email" id="newsletter_email" placeholder="Enter your email address" class="ad-input">

                                </div>
                                <div class="btn-sc">
                                    <button id="submit-form" type="submit" class="btn btn-primary">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ft-copyright">
                        <a class="ft-copyright-link" href="https://fratelliwines.in/">© Fratelli Wines</a>
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
                        <p>As the sun set on a warm afternoon in 2006, the seeds of a new dream bloomed to life - <b>Fratelli</b>. Brought together by love and driven forward by passion, <b>Fratelli</b> is symbolic of a vision manifested by three families who aspired to tell stories through the art of winemaking.</p>
                        <p>Crowned <b>Fratelli</b>, which means ‘brothers’ in Italian, the collaboration was birthed as the Secci brothers from Italy joined hands with the Sekhri and Mohite-Patil brothers from India.</p>
                        <p>
                            <img src="{{ url('website/images/home-page_1500x.webp') }}" alt="">
                        </p>
                        <p>Committed to bringing new life to wine culture through a blend of Indian terroir and Italian craft, <b>Fratelli's</b> vineyards have become the birthplace of award winning varietals.</p>
                        <p>Under the guiding hand of Piero Masi, a master winemaker from Tuscany, the estate has been developing an eclectic and select range of wines since 2007. The house of <b>Fratelli</b> continues to thrive, forging bonds through every glass of exquisite wine, turning friends into family.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal - Who we are E -->

        <!-- Modal - Board Composition S -->
        <div class="modal fade boardCompositionModal" id="boardCompositionModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content no-footer">
                    <div class="modal-header">
                        <h6 class="modal-title">Board Composition</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="profile-main">
                            <div class="pro-list">
                                <div class="pro-img">
                                    <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Gaurav Sekhri">
                                </div>
                                <div class="pro-content">
                                    <span class="title">Mr. Gaurav Sekhri</span>
                                    <span class="info">Chairman and Managing Director</span>
                                    <p>Mr. Gaurav Sekhri has done his Bachelor of Business Administration(BBA) from Richmond College, London(UK). He is promotor director of the company "Tinna Trade Ltd" and currently heading the TINNA group as the Managing Director. Mr. Gaurav Sekhri has experience of over 22 years in Trading business. He possesses key expertise in the business of commodity trading and other business verticals, including cargo handling operations & warehousing. He has chaired 'Sunflower Seed Promotion Council of SEA (Solvent Extractors Association) of India' & 'SEA Bio Diesel Promotion Council'. He has been member of with various reputed associations- The Soybean Processors Association of India' (SOPA), 'Confederation of Indian Industry (CII) & National Committee on Agriculture', 'National Committee a Bio Fuels', Confederation of Indian Industry (CII), National Committee on Agriculture.</p>
                                </div>
                            </div>
                            <div class="pro-list">
                                <div class="pro-img">
                                    <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Adhiraj Amar Sarin">
                                </div>
                                <div class="pro-content">
                                    <span class="title">Mr. Adhiraj Amar Sarin</span>
                                    <span class="info">Independent Director</span>
                                    <p>Mr. Adhiraj Sarin has done B. Tech, Electrical and Electronics Engineering from IIT Kanpur. He has vast experience in commodity business. He has been Managing Director in 'Bunge India', Specialty Engineering Company 'Tube Investments Of India', 'Bombay Dyeing Textiles' & 'Hindustan Lever Limited'. He was CEO of Louis Dreyfus Commodities India. He is currently working as Corporate advisor with 'Master & Little'.</p>
                                </div>
                            </div>
                            <div class="pro-list">
                                <div class="pro-img">
                                    <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Ashish Madan">
                                </div>
                                <div class="pro-content">
                                    <span class="title">Mr. Ashish Madan</span>
                                    <span class="info">Independent Director</span>
                                    <p>Mr. Ashish Madan has done B.A. Eco (H), MFC, (University of Delhi). He has about 20 years' experience in trade finance. He is member of Managing Committee of Adam Smith Associates Pvt. Ltd. He has previously worked with Esanda Finance (ANZ Banking Group), and Batlivala & Karani.</p>
                                </div>
                            </div>
                            <div class="pro-list">
                                <div class="pro-img">
                                    <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="MS. Sanvali Kaushik">
                                </div>
                                <div class="pro-content">
                                    <span class="title">MS. Sanvali Kaushik</span>
                                    <span class="info">Independent Director</span>
                                    <p>Ms. Sanvali Kaushik is a post graduate in marketing and financial management and has more than 20 years of experience in commodity physical trade and derivatives in India. Ms.Kaushik was the CEO of NCDEX Spot Exchange Ltd. She has been part of the FICCI study group of Terminal Markets of USA and studied the US models of agri business and capacity building by USAID. She has also been part of the various committees for commodity grading, assaying and Forward Markets Commission and the Government of India on various commodity derivates related issues. She has also been part of the Technical Group that led the FCI and Government of India to hedge for the first time on CBOT.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal - Board Composition E -->

        <!-- Modal - Management Profile S -->
        <div class="modal fade managementProfileModal" id="managementProfileModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content no-footer">
                    <div class="modal-header">
                        <h6 class="modal-title">Management Profile</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="profile-main">
                            <div class="pro-list">
                                <div class="pro-img">
                                    <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Gaurav Sekhri">
                                </div>
                                <div class="pro-content">
                                    <span class="title">Mr. Gaurav Sekhri</span>
                                    <span class="info">Chairman and Managing Director</span>
                                    <p>Mr. Gaurav Sekhri has done his Bachelor of Business Administration(BBA) from Richmond College, London(UK). He is promotor director of the company "Tinna Trade Ltd" and currently heading the TINNA group as the Managing Director. Mr. Gaurav Sekhri has experience of over 22 years in Trading business. He possesses key expertise in the business of commodity trading and other business verticals, including cargo handling operations & warehousing. He has chaired 'Sunflower Seed Promotion Council of SEA (Solvent Extractors Association) of India' & 'SEA Bio Diesel Promotion Council'. He has been member of with various reputed associations- The Soybean Processors Association of India' (SOPA), 'Confederation of Indian Industry (CII) & National Committee on Agriculture', 'National Committee a Bio Fuels', Confederation of Indian Industry (CII), National Committee on Agriculture.</p>
                                </div>
                            </div>
                            <div class="pro-list">
                                <div class="pro-img">
                                    <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Adhiraj Amar Sarin">
                                </div>
                                <div class="pro-content">
                                    <span class="title">Mr. Adhiraj Amar Sarin</span>
                                    <span class="info">Independent Director</span>
                                    <p>Mr. Adhiraj Sarin has done B. Tech, Electrical and Electronics Engineering from IIT Kanpur. He has vast experience in commodity business. He has been Managing Director in 'Bunge India', Specialty Engineering Company 'Tube Investments Of India', 'Bombay Dyeing Textiles' & 'Hindustan Lever Limited'. He was CEO of Louis Dreyfus Commodities India. He is currently working as Corporate advisor with 'Master & Little'.</p>
                                </div>
                            </div>
                            <div class="pro-list">
                                <div class="pro-img">
                                    <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Ashish Madan">
                                </div>
                                <div class="pro-content">
                                    <span class="title">Mr. Ashish Madan</span>
                                    <span class="info">Independent Director</span>
                                    <p>Mr. Ashish Madan has done B.A. Eco (H), MFC, (University of Delhi). He has about 20 years' experience in trade finance. He is member of Managing Committee of Adam Smith Associates Pvt. Ltd. He has previously worked with Esanda Finance (ANZ Banking Group), and Batlivala & Karani.</p>
                                </div>
                            </div>
                            <div class="pro-list">
                                <div class="pro-img">
                                    <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="MS. Sanvali Kaushik">
                                </div>
                                <div class="pro-content">
                                    <span class="title">MS. Sanvali Kaushik</span>
                                    <span class="info">Independent Director</span>
                                    <p>Ms. Sanvali Kaushik is a post graduate in marketing and financial management and has more than 20 years of experience in commodity physical trade and derivatives in India. Ms.Kaushik was the CEO of NCDEX Spot Exchange Ltd. She has been part of the FICCI study group of Terminal Markets of USA and studied the US models of agri business and capacity building by USAID. She has also been part of the various committees for commodity grading, assaying and Forward Markets Commission and the Government of India on various commodity derivates related issues. She has also been part of the Technical Group that led the FCI and Government of India to hedge for the first time on CBOT.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal - Management Profile E -->

        <!-- Modal - Media S -->
        <div class="modal fade mediaModal" id="mediaModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content no-footer">
                    <div class="modal-header">
                        <h6 class="modal-title folderName"></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion-main subFolderBody">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal - Media E -->

        <!-- Offcanvas - Who we are S -->
        <div class="offcanvas offcanvas-bottom offcanvas-lg" tabindex="-1" id="WhoWeAreOffoffcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">{{ $settings->title }}</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <p>As the sun set on a warm afternoon in 2006, the seeds of a new dream bloomed to life - <b>Fratelli</b>. Brought together by love and driven forward by passion, <b>Fratelli</b> is symbolic of a vision manifested by three families who aspired to tell stories through the art of winemaking.</p>
                <p>Crowned <b>Fratelli</b>, which means ‘brothers’ in Italian, the collaboration was birthed as the Secci brothers from Italy joined hands with the Sekhri and Mohite-Patil brothers from India.</p>
                <p>
                    <img src="{{ url('website/images/home-page_1500x.webp') }}" alt="">
                </p>
                <p>Committed to bringing new life to wine culture through a blend of Indian terroir and Italian craft, <b>Fratelli's</b> vineyards have become the birthplace of award winning varietals.</p>
                <p>Under the guiding hand of Piero Masi, a master winemaker from Tuscany, the estate has been developing an eclectic and select range of wines since 2007. The house of <b>Fratelli</b> continues to thrive, forging bonds through every glass of exquisite wine, turning friends into family.</p>
            </div>
        </div>
        <!-- Offcanvas - Who we are E -->

        <!-- Offcanvas - Board Composition S -->
        <div class="offcanvas offcanvas-bottom offcanvas-lg" tabindex="-1" id="boardCompositionWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Board Composition</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <div class="profile-main">
                    <div class="pro-list">
                        <div class="pro-img">
                            <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Gaurav Sekhri">
                        </div>
                        <div class="pro-content">
                            <span class="title">Mr. Gaurav Sekhri</span>
                            <span class="info">Chairman and Managing Director</span>
                            <p>Mr. Gaurav Sekhri has done his Bachelor of Business Administration(BBA) from Richmond College, London(UK). He is promotor director of the company "Tinna Trade Ltd" and currently heading the TINNA group as the Managing Director. Mr. Gaurav Sekhri has experience of over 22 years in Trading business. He possesses key expertise in the business of commodity trading and other business verticals, including cargo handling operations & warehousing. He has chaired 'Sunflower Seed Promotion Council of SEA (Solvent Extractors Association) of India' & 'SEA Bio Diesel Promotion Council'. He has been member of with various reputed associations- The Soybean Processors Association of India' (SOPA), 'Confederation of Indian Industry (CII) & National Committee on Agriculture', 'National Committee a Bio Fuels', Confederation of Indian Industry (CII), National Committee on Agriculture.</p>
                        </div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-img">
                            <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Adhiraj Amar Sarin">
                        </div>
                        <div class="pro-content">
                            <span class="title">Mr. Adhiraj Amar Sarin</span>
                            <span class="info">Independent Director</span>
                            <p>Mr. Adhiraj Sarin has done B. Tech, Electrical and Electronics Engineering from IIT Kanpur. He has vast experience in commodity business. He has been Managing Director in 'Bunge India', Specialty Engineering Company 'Tube Investments Of India', 'Bombay Dyeing Textiles' & 'Hindustan Lever Limited'. He was CEO of Louis Dreyfus Commodities India. He is currently working as Corporate advisor with 'Master & Little'.</p>
                        </div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-img">
                            <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Ashish Madan">
                        </div>
                        <div class="pro-content">
                            <span class="title">Mr. Ashish Madan</span>
                            <span class="info">Independent Director</span>
                            <p>Mr. Ashish Madan has done B.A. Eco (H), MFC, (University of Delhi). He has about 20 years' experience in trade finance. He is member of Managing Committee of Adam Smith Associates Pvt. Ltd. He has previously worked with Esanda Finance (ANZ Banking Group), and Batlivala & Karani.</p>
                        </div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-img">
                            <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="MS. Sanvali Kaushik">
                        </div>
                        <div class="pro-content">
                            <span class="title">MS. Sanvali Kaushik</span>
                            <span class="info">Independent Director</span>
                            <p>Ms. Sanvali Kaushik is a post graduate in marketing and financial management and has more than 20 years of experience in commodity physical trade and derivatives in India. Ms.Kaushik was the CEO of NCDEX Spot Exchange Ltd. She has been part of the FICCI study group of Terminal Markets of USA and studied the US models of agri business and capacity building by USAID. She has also been part of the various committees for commodity grading, assaying and Forward Markets Commission and the Government of India on various commodity derivates related issues. She has also been part of the Technical Group that led the FCI and Government of India to hedge for the first time on CBOT.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offcanvas - Board Composition E -->

        <!-- Offcanvas - Management Profile S -->
        <div class="offcanvas offcanvas-bottom offcanvas-lg" tabindex="-1" id="ManagementProfileOffoffcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Management Profiles</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <div class="profile-main">
                    <div class="pro-list">
                        <div class="pro-img">
                            <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Gaurav Sekhri">
                        </div>
                        <div class="pro-content">
                            <span class="title">Mr. Gaurav Sekhri</span>
                            <span class="info">Chairman and Managing Director</span>
                            <p>Mr. Gaurav Sekhri has done his Bachelor of Business Administration(BBA) from Richmond College, London(UK). He is promotor director of the company "Tinna Trade Ltd" and currently heading the TINNA group as the Managing Director. Mr. Gaurav Sekhri has experience of over 22 years in Trading business. He possesses key expertise in the business of commodity trading and other business verticals, including cargo handling operations & warehousing. He has chaired 'Sunflower Seed Promotion Council of SEA (Solvent Extractors Association) of India' & 'SEA Bio Diesel Promotion Council'. He has been member of with various reputed associations- The Soybean Processors Association of India' (SOPA), 'Confederation of Indian Industry (CII) & National Committee on Agriculture', 'National Committee a Bio Fuels', Confederation of Indian Industry (CII), National Committee on Agriculture.</p>
                        </div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-img">
                            <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Adhiraj Amar Sarin">
                        </div>
                        <div class="pro-content">
                            <span class="title">Mr. Adhiraj Amar Sarin</span>
                            <span class="info">Independent Director</span>
                            <p>Mr. Adhiraj Sarin has done B. Tech, Electrical and Electronics Engineering from IIT Kanpur. He has vast experience in commodity business. He has been Managing Director in 'Bunge India', Specialty Engineering Company 'Tube Investments Of India', 'Bombay Dyeing Textiles' & 'Hindustan Lever Limited'. He was CEO of Louis Dreyfus Commodities India. He is currently working as Corporate advisor with 'Master & Little'.</p>
                        </div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-img">
                            <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="Mr. Ashish Madan">
                        </div>
                        <div class="pro-content">
                            <span class="title">Mr. Ashish Madan</span>
                            <span class="info">Independent Director</span>
                            <p>Mr. Ashish Madan has done B.A. Eco (H), MFC, (University of Delhi). He has about 20 years' experience in trade finance. He is member of Managing Committee of Adam Smith Associates Pvt. Ltd. He has previously worked with Esanda Finance (ANZ Banking Group), and Batlivala & Karani.</p>
                        </div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-img">
                            <img src="https://w7.pngwing.com/pngs/1000/665/png-transparent-computer-icons-profile-s-free-angle-sphere-profile-cliparts-free-thumbnail.png" alt="MS. Sanvali Kaushik">
                        </div>
                        <div class="pro-content">
                            <span class="title">MS. Sanvali Kaushik</span>
                            <span class="info">Independent Director</span>
                            <p>Ms. Sanvali Kaushik is a post graduate in marketing and financial management and has more than 20 years of experience in commodity physical trade and derivatives in India. Ms.Kaushik was the CEO of NCDEX Spot Exchange Ltd. She has been part of the FICCI study group of Terminal Markets of USA and studied the US models of agri business and capacity building by USAID. She has also been part of the various committees for commodity grading, assaying and Forward Markets Commission and the Government of India on various commodity derivates related issues. She has also been part of the Technical Group that led the FCI and Government of India to hedge for the first time on CBOT.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offcanvas - Management Profile E -->

        <!-- Offcanvas - Media S -->
        <div class="offcanvas offcanvas-bottom offcanvas-lg" tabindex="-1" id="MediaoffcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title folderName" id="offcanvasBottomLabel">Media</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <div class="accordion-main subFolderBody">

                </div>
            </div>
        </div>
        <!-- Offcanvas - Media E -->

        <script src="{{ url('website/js/custom.js') }}"></script>
        <script>
            $(document).ready(function(){

                $('.open-folder').click(function(e){
                    var folder = $(this).attr('folder');

                    $.get('{{ url("get-files/") }}/'+folder, function(response){
                        $('.folderName').html(response.folderName);
                        $('.subFolderBody').html(response.files);
                        // $('#mediaModal').modal('show');
                    });
                });

                $('#newletter-form').submit(function(e){
                    e.preventDefault();

                    var email = $('#newsletter_email').val();

                    if(email == ""){
                        $('#main-body').append('<span id="newsletter-message" style="color:red;">Please enter your email address</span>');
                        setTimeout(function(){
                            $('#newsletter-message').remove();
                        }, 5000);
                        return;
                    }

                    $.post('{{ route("send-newsletter") }}', {
                        email: email,
                        _token: "{{ csrf_token() }}"
                    }, function(responser){
                        $('#main-body').append('<span id="newsletter-message">Subscribed successfully</span>');
                        $('#newletter-form')[0].reset();

                        setTimeout(function(){
                            $('#newsletter-message').remove();
                        }, 5000);
                    });
                })
            });
        </script>
    </body>
</html>
