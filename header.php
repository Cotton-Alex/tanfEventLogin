<header>
    <div id = "page_top">
        <div id = "header_container">
            <div id="logo_wrap">
                <img id="header_image" src = "images/tmlogo-title.png" alt = ""/>
            </div>
            <button id="admin_btn" onclick = "window.location.href = 'admin_login.php';">Admin</button>
            <div id="number_attending">
                <?php
                if (isset($attendanceCount)) {
                    echo $attendanceCount . " in attendance";
                }
                ?>
            </div>
        </div>
    </div>
</header>
