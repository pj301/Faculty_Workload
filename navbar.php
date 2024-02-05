<style>
    .collapse a {
        text-indent: 10px;
        transition: width 0.4 ease;
        
    }

    nav#sidebar {
        background: #213440 !important; /* Set the background color */
        padding-top: 30px;
        transition: width 0.4 ease;
    }

    nav#sidebar .sidebar-list a {
        color: #ffffff; /* Set the text color */
        background-color: #213440;
        text-decoration: none; /* Remove underline */
        transition: background-color 0.3s ease; /* Add transition for smooth background color change */
        position: relative;
    }

    nav#sidebar .sidebar-list a:hover {
        background-color: #0ff15394; /* Set the background color on hover */
    }

    /* Add the following style for the active state */
    nav#sidebar .sidebar-list a.active {
        background-color: #0ff15394; /* Set the background color for the active item */
    }

    nav#sidebar .sidebar-list {
        color: #213440; /* Set the text color */
        transition: width 0.4 ease;
    }

    /* Make dropdown menu fit the width of the sidebar */
    .dropdown-menu {
        width: 100%;
        transition: width 0.4 ease;
    }

    #sidebar.collapsed {
        width: 70px; /* Set the collapsed width */
        transition: width 0.3s ease; /* Add transition for smooth width change */
    }

    #sidebar.collapsed .sidebar-list a {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0;
        transition: width 0.4 ease;
        position: relative;
    }

    #sidebar.collapsed .sidebar-list a.active {
        visibility: visible;
        font-size: 0; /* Adjust the font size as needed */
        transition: width 0.4 ease;
    }

    #sidebar.collapsed .sidebar-list a span.icon-field {
        margin-right: 0;
        font-size: 30px;
        transition: width 0.4 ease;
    }

    /* Add tooltip-like effect for collapsed sidebar icons */
    #sidebar.collapsed .sidebar-list a:before {
        content: attr(data-text);
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        background-color: #213440;
        color: #ffffff;
        border-radius: 4px;
        padding: 5px;
        font-size: 20px;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
        transform: translateX(100%);
        white-space: nowrap;
        top: 50%;
        left: 100%; /* Adjust the position as needed */
        transform: translateX(10px); /* Adjust the distance from the icon */
    }

    #sidebar.collapsed .sidebar-list a:hover:before {
        visibility: visible;
        opacity: 1;
        transform: translateX(0);
    }

    /* Add transition for smooth sidebar width change */
    #sidebar {
        transition: width 0.4s ease;
    }

    /* Add cursor pointer for better UX */
    .collapse-icon {
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #213440; /* Set the initial background color */
        transition: width 0.4 ease;
    }
    
</style>
<style>
    /* Your existing styles */

    /* Media query for small screens */
    @media (max-width: 576px) {
        .cards-container {
            grid-template-columns: 1fr; /* Change to a single column layout for small screens */
            gap: 20px; /* Adjust the gap as needed */
        }

        .Card {
            width: 100%; /* Make each card take the full width */
        }
    }

</style>

<style>
        .hamburger {
            padding: 15px;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            background-color: transparent;
        }

        .hamburger__container {
            width: 36px;
            height: 24px;
            position: relative;
        }

        .hamburger:hover .hamburger__inner {
            transform: translate(-51px, 50%);
            opacity: 0;
        }

        .hamburger:hover .hamburger__inner::before,
        .hamburger:hover .hamburger__inner::after {
            transform: translate(102px, 0);
            opacity: 0;
        }

        .hamburger.is-active .hamburger__inner {
            display: none;
        }

        .hamburger__inner {
            width: 100%;
            height: 2px;
            background-color: #fff;
            border-radius: 4px;
            position: absolute;
            transition-property: transform, opacity;
            transition-timing-function: ease;
            transition-duration: 0.4s;
            top: 50%;
            transform: translate(5px, -50%);
            opacity: 1;
        }

        .hamburger__inner::before,
        .hamburger__inner::after {
            width: 100%;
            height: 2px;
            background-color: #fff;
            border-radius: 4px;
            position: absolute;
            transition-property: transform, opacity;
            transition-timing-function: ease;
            transition-duration: 0.4s;
            content: "";
            opacity: 1;
            transform: translate(-5px, 0);
        }

        .hamburger__inner::before {
            top: -13px;
        }

        .hamburger__inner::after {
            top: 13px;
        }

        .hamburger:hover .hamburger__hidden {
            opacity: 1;
            transform: translate(0, -50%);
        }

        .hamburger:hover .hamburger__hidden::before,
        .hamburger:hover .hamburger__hidden::after {
            opacity: 1;
            transform: translate(0, 0);
        }

        .hamburger.is-active .hamburger__hidden {
            opacity: 1;
            transform: rotate(45deg);
        }

        .hamburger.is-active .hamburger__hidden::before {
            transform: translate(0, 13px) rotate(90deg);
            transform-origin: center;
        }

        .hamburger.is-active .hamburger__hidden::after {
            transform-origin: center;
            transform: translate(0, -13px) rotate(0);
        }

        .hamburger__hidden {
            opacity: 0;
            width: 100%;
            height: 2px;
            background-color: #fff;
            border-radius: 4px;
            position: absolute;
            transition-property: transform, opacity;
            transition-timing-function: ease;
            transition-duration: 0.4s;
            background-color: red;
            top: 50%;
            transform: translate(51px, -50%);
        }

        .hamburger__hidden::before,
        .hamburger__hidden::after {
            width: 100%;
            height: 2px;
            background-color: #fff;
            border-radius: 4px;
            position: absolute;
            transition-property: transform, opacity;
            transition-timing-function: ease;
            transition-duration: 0.4s;
            background-color: red;
            content: "";
            transform: translate(102px, 0);
        }

        .hamburger__hidden::before {
            top: -13px;
        }

        .hamburger__hidden::after {
            top: 13px;
        }
    </style>
<nav id="sidebar" class='mx-lt-5 bg-dark'>

<div class="hamburger-container" onclick="toggleCollapseSidebar()">
        <div class="hamburger">
            <div class="hamburger__container">
                <div class="hamburger__inner"></div>
                <div class="hamburger__hidden"></div>
            </div>
        </div>
    </div>
       
    <div class="sidebar-list">
    <a href="index.php?page=home" class="nav-item nav-home" data-text="Dashboard">
    <span class='icon-field'><i class="fa fa-home"></i></span>Dashboard
</a>
<!-- Other anchor tags with data-text attribute -->


        <!-- Manage Workload with Collapsible List -->
        <a href="javascript:void(0);" class="nav-item nav-schedule collapse-icon "data-text="Manage Workload " onclick="toggleCollapse('manageWorkloadCollapse')">
        <span class='icon-field'><i class="fa fa-tasks"></i></span> Manage Workload
            <i class="fa fa-caret-down"></i>		
        </a>
        <div class="collapse" id="manageWorkloadCollapse">
            <a href="index.php?page=colleges" class="nav-item nav-colleges"data-text="College">
                <span class='icon-field'><i class="fa fa-suitcase"></i></span> College
            </a>

            <a href="index.php?page=faculty" class="nav-item nav-faculty"data-text="Faculty List">
                <span class='icon-field'><i class="fa fa-user-tie"></i></span> Faculty List
            </a>
            <a href="index.php?page=roomlist" class="nav-item nav-roomlist"data-text="Room">
                <span class='icon-field'><i class="fa fa-building"></i></span> Room
            </a>
        </div>

        <a href="index.php?page=schedule" class="nav-item nav-schedule"data-text="Schedule">
            <span class='icon-field'><i class="fa fa-calendar-day"></i></span> Schedule
        </a>

        <a href="index.php?page=users" class="nav-item nav-users"data-text="Users">
            <span class='icon-field'><i class="fa fa-users"></i></span> Users
        </a>
    
    </div>
</nav>

<script>
    // Add 'active' class based on the current page
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active');

    // JavaScript function to toggle collapse state
    function toggleCollapse(collapseId) {
        $('#' + collapseId).toggleClass('show');

        // Store the state in local storage
        localStorage.setItem(collapseId, $('#' + collapseId).hasClass('show') ? 'open' : 'closed');
    }
    document.querySelector('.hamburger').addEventListener('click', (e) => {
            e.currentTarget.classList.toggle('is-active');
        });
        function toggleCollapseSidebar() {
    $('#sidebar').toggleClass('collapsed');
    $('#view-panel').toggleClass('collapsed');
}


    // Retrieve and apply the state from local storage
    $(document).ready(function () {
        if (localStorage.getItem('manageWorkloadCollapse') === 'open') {
            $('#manageWorkloadCollapse').addClass('show');
        }
    });
</script>

