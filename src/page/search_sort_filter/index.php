<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>\(OwO)/</title>
    <link rel="stylesheet" href="daftar-lagu.css">
    <script src="modal.js" defer></script>
    <script src="pagination.js" defer></script>
    <script src="genre-dropdown.js" defer></script>
    <!-- Font Awesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
</head>
<body class="dark-bg body">
    <nav class="nav"></nav>
    <div class="main-content">
        <div class="search-sort-filter">
            <div class="search-bar">
                <input 
                    id="search-input"
                    type="text"
                    placeholder="What do you want to listen to?"
                    value="" 
                />
                <button
                    id="search-submit"
                    type="submit" 
                >
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                    </svg>
                </button>
                
                <div class="sort">    
                    <button class="sort-button">
                        <i class="fas fa-sort-alpha-up"></i>
                    </button>
                    <input type="checked" style="display: none;" id="reverse-checkbox"/>
                </div>

                <div class="filter">
                    <button class="filter-button" id="open-modal">
                        <i class="fas fa-filter"></i>
                    </button>
                    <div class="genre-list">
                        <div class="song-genre">Pop</div>
                        <div class="song-genre">Rock</div>
                        <div class="song-genre">Metal</div>
                        <div class="song-genre">IDK</div>
                        <div class="song-genre">IDK</div>
                        <div class="song-genre">IDK</div>
                        <div class="song-genre">IDK</div>
                        <div class="song-genre">IDK</div>
                        <div class="song-genre">IDK</div>
                    </div>          
                </div>

                <div class="date">
                    <i class="far fa-calendar-alt"></i>
                </div>
                <input type="checkbox" style="display: none;" id="date-checkbox">
            </div>
        </div>

        <div class="song-list">
            <div class="song">
                <div class="grid-container">
                    <div class="number">1</div>
                    <button class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="image">
                        <div class="image-container">
                            <img
                                src="/assets/img/auth-img/feel_special.jpg"
                                alt="song-image"
                            />
                        </div>
                    </div>
                    <div class="judul">Feel Special</div>
                    <div class="penyanyi">TWICE</div>
                    <div class="blank"></div>
                    <div class="genre">idk the genre</div>
                    <div class="tahun">2019</div>
                </div>
            </div>

            <div class="song">
                <div class="grid-container">
                    <div class="number">2</div>
                    <button class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="image">
                        <div class="image-container">
                            <img
                                src="/assets/img/auth-img/feel_special.jpg"
                                alt="song-image"
                            />
                        </div>
                    </div>
                    <div class="judul">Feel Special</div>
                    <div class="penyanyi">TWICE</div>
                    <div class="blank"></div>
                    <div class="genre">idk</div>
                    <div class="tahun">2019</div>
                </div>
            </div>

            <div class="song">
                <div class="grid-container">
                    <div class="number">3</div>
                    <button class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="image">
                        <div class="image-container">
                            <img
                                src="/assets/img/auth-img/feel_special.jpg"
                                alt="song-image"
                            />
                        </div>
                    </div>
                    <div class="judul">Feel Special</div>
                    <div class="penyanyi">TWICE</div>
                    <div class="blank"></div>
                    <div class="genre">idk</div>
                    <div class="tahun">2019</div>
                </div>
            </div>
            
            <div class="song">
                <div class="grid-container">
                    <div class="number">4</div>
                    <button class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="image">
                        <div class="image-container">
                            <img
                                src="/assets/img/auth-img/feel_special.jpg"
                                alt="song-image"
                            />
                        </div>
                    </div>
                    <div class="judul">Feel Special</div>
                    <div class="penyanyi">TWICE</div>
                    <div class="blank"></div>
                    <div class="genre">idk</div>
                    <div class="tahun">2019</div>
                </div>
            </div>

            <div class="song">
                <div class="grid-container">
                    <div class="number">5</div>
                    <button class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="image">
                        <div class="image-container">
                            
                        </div>
                    </div>
                    <div class="judul">Coming Soon</div>
                    <div class="penyanyi">??</div>
                    <div class="blank"></div>
                    <div class="genre">?</div>
                    <div class="tahun">xxxx</div>
                </div>
            </div>

            <div class="song">
                <div class="grid-container">
                    <div class="number">6</div>
                    <button class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="image">
                        <div class="image-container">
                            
                        </div>
                    </div>
                    <div class="judul">Coming Soon</div>
                    <div class="penyanyi">??</div>
                    <div class="blank"></div>
                    <div class="genre">?</div>
                    <div class="tahun">xxxx</div>
                </div>
            </div>

            <div class="song">
                <div class="grid-container">
                    <div class="number">7</div>
                    <button class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="image">
                        <div class="image-container">
                            
                        </div>
                    </div>
                    <div class="judul">Coming Soon</div>
                    <div class="penyanyi">??</div>
                    <div class="blank"></div>
                    <div class="genre">?</div>
                    <div class="tahun">xxxx</div>
                </div>
            </div>

            <div class="song">
                <div class="grid-container">
                    <div class="number">8</div>
                    <button class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="image">
                        <div class="image-container">
                            
                        </div>
                    </div>
                    <div class="judul">Coming Soon</div>
                    <div class="penyanyi">??</div>
                    <div class="blank"></div>
                    <div class="genre">?</div>
                    <div class="tahun">xxxx</div>
                </div>
            </div>

            <div class="song">
                <div class="grid-container">
                    <div class="number">9</div>
                    <button class="play-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="image">
                        <div class="image-container">
                            
                        </div>
                    </div>
                    <div class="judul">Coming Soon</div>
                    <div class="penyanyi">??</div>
                    <div class="blank"></div>
                    <div class="genre">?</div>
                    <div class="tahun">xxxx</div>
                </div>
            </div>
        </div>

        <div class="page">
            <div class="pagination">
                <button class="back" id="back"><i class="fas fa-angle-double-left"></i></button>
                <button class="page-number" id="first">1</button>
                <button class="page-number" id="second">2</button>
                <button class="page-number" id="third">3</button>
                <button class="page-number" id="fourth">4</button>
                <button class="forward" id="forward"><i class="fas fa-angle-double-right"></i></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
</body>
</html>