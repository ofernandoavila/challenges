<?php global $data; ?>
<script>
    function ToggleDropDownMenu(menuId) {
        var menu = document.getElementById(menuId);

        document.querySelectorAll('.drop-down-menu').forEach(item => {
            if(item.id != menu.id) {
                if(!item.classList.contains('collapsed')) {
                    item.classList.add('collapsed');
                }
            }
        });
        
        if(menu.classList.contains('collapsed')) {
            menu.classList.remove('collapsed');
        } else {
            menu.classList.add('collapsed');
        }
    }
</script>
<header class="menu menu-header fixed align-self-center menu-mobile-spry">
        <div class="menu-container">
            <div class="column flex flex-1">
                <a href="<?= $data['config']['base_url'] ?>">
                    <h1>Community</h1>
                </a>
            </div>
            <div class="column flex flex-2">
                <div class="input-group">
                    <input type="search" name="search_top" id="search_top" placeholder="Find games, videos, arts...">
                </div>
            </div>
            <div class="column flex flex-1 align-items-end">
                <nav>
                    <ul class="menu row">
                        <?php if (isset($_SESSION['user_session'])) : ?>
                            <li class="menu-item">
                                <button class="btn btn-transparent" value="user" onclick="ToggleDropDownMenu('user-menu-dropdown')"></button>
                                <ul class="drop-down-menu collapsed" id="user-menu-dropdown">
                                    <li class="menu-item">
                                        <a href="<?= $data['config']['base_url'] ?>/profile?username=<?= $data['user']->username; ?>">
                                            <button class="btn btn-transparent" value="user">My Profile</button>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?= $data['config']['base_url'] ?>/logoff">
                                            <button class="btn btn-transparent" value="logout">Log out</button>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="menu-item"><a href="<?= $data['config']['base_url'] ?>/login"><button class="btn btn-transparent" value="user">Log In</button></a></li>
                        <?php endif; ?>
                        <li class="menu-item">
                            <button class="btn btn-transparent" value="config" onclick="ToggleDropDownMenu('settings-menu-dropdown')"></button>
                            <ul class="drop-down-menu collapsed" id="settings-menu-dropdown">
                                <li class="menu-item"><button class="btn btn-transparent" value="config">Settings</button></li>
                                <li class="menu-item"><button style="position: relative !important;" class="toggle-theme">Toggle theme</button></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <button onclick="toggleMobileMenu()" class="menu-button" value="menu"></button>
        </div>
    </header>