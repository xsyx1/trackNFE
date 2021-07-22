<div id="flipkart-navbar">
    <div class="container">
        <div class="row row1">

        </div>

        <div class="row row2">
            
            <div class="col-sm-2">
                
                <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰</span>

                </h2>
                <img style="width: 80%;" src="{{ asset('images/TRACKCASH.png') }}" alt="Logo" class="img-fluid " >
            </div>
            <div class="flipkart-navbar-search smallsearch col-7 col-xs-11">
                <div class="row">
                    <input class="flipkart-navbar-input col-xs-11" type="" placeholder="Search for Products, Brands and more" name="">
                    <button class="flipkart-navbar-button col-xs-1">
                        <svg width="15px" height="15px">
                            <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 " fill="#FFFAFA"></path>
                        </svg>
                    </button>
                    
                </div>

            </div>
                <div class="row">
                    <ul class="nav pl-4">
                        <li>
                            <a href="{{ route('home') }}">
                                <i fill="#FFFAFA" class="d-flex justify-content-center fas fa-home"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}">
                                <i fill="#FFFAFA" class="d-flex justify-content-center fas fa-user-friends"></i>
                                <p>Produtos</p>
                            </a>
                        </li>
                        
                    </ul>        
            </div>

        </div>
    </div>
</div>
