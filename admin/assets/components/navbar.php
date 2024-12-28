<?php
include_once 'functions/auth-admin.php';

$userData = getUserData($conn, $_SESSION['id_user']);
?>
<!-- navbar.php -->
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> 
                    <i data-feather="align-justify"></i>
                </a>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <!-- toggle dark-mode & light-mode -->
        <div class="settingSidebar-body ps-container ps-theme-default mr-3">
            <div class="selectgroup layout-color">
                <label class="selectgroup-item toggle-switch">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">
                        <i class="fas fa-sun"></i> 
                    </span>
                </label>
                <label class="selectgroup-item toggle-switch">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">
                        <i class="fas fa-moon"></i>
                    </span>
                </label>
            </div>
        </div>

        <!-- logout -->
        <li>
            <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . '/../login.php?logout=true'; ?>" class="btn btn-primary">Logout</a>
        </li>
    </ul>
</nav>