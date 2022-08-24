<div id="navbarContainer">
    <nav class="navbar">

        <!-- role ="link" alows us to make an element work as a link a tabindex="0" allows us to navigate with tab keyboard by default we can navigate with the tab keyboard on links.  -->

        <span role="link" tabindex="0" onclick="openPage('index.php')" class="logo">
            <img src="./Assets/images/icons/lion head.png" alt="">
        </span>

        <div class="group">
            <div class="navItem">
                <span role="link" tabindex="0" onclick="openPage('search.php')" class="navItemLink">
                    Search
                    <i class="fad fa-search i"></i>
                </span>
            </div>
        </div>

        <div class="group">
            <div class="navItem">
                <span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Browse</span>
            </div>

            <div class="navItem">
                <span role="link" tabindex="0" onclick="openPage('yourMusic.php')" class="navItemLink">Your music</span>
            </div>

            <div class="navItem">
                <span role="link" tabindex="0" onclick="openPage('profile.php')" class="navItemLink">Khadetou</span>
            </div>
        </div>

    </nav>
</div>