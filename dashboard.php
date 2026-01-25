<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard UI</title>

    <link rel="stylesheet" href="./styles/dashboard.css" />
    <link rel="stylesheet" href="./styles/style.css" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>

<body>
    <div class="container">

        <div class="dashboard">

            <aside class="sidebar">
                <div class="logo">
                    <img class="default_logo" src="./images/logo2.png" alt="" />

                </div>

                <div class="menu-title">MENU</div>
                <div class="menu">
                    <a href="#" class="active"><i class="fa-solid fa-table-columns"></i> Dashboard</a>
                    <a href="#"><i class="fa-solid fa-users"></i> Users</a>

                    <a href="#"><i class="fa-regular fa-calendar"></i> Donations</a>
                    <a href="#"><i class="fa-solid fa-chart-line"></i> Causes</a>
                    <a href="#"><i class="fa-regular fa-envelope"></i> Messages</a>

                </div>

                <div class="menu-title" style="margin-top:30px;">GENERAL</div>
                <div class="menu">
                    <a href="#"><i class="fa-solid fa-gear"></i> Settings</a>
                    <a href="#"><i class="fa-regular fa-circle-question"></i> Help</a>
                    <a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                </div>
            </aside>

            <main class="main">
                <div class="header">

                    <!-- <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search task">
                </div> -->

                    <div class="header-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                    <div class="header-right">
                        <div class="icon-btn"><i class="fa-regular fa-envelope"></i></div>
                        <div class="icon-btn"><i class="fa-regular fa-bell"></i></div>

                        <div class="profile">
                            <div class="profile-pic">T</div>
                            <div class="profile-info">
                                Elsa Halili
                                <span>elsahalili5gmail.com</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="content">



                    <div class="table-box">
                        <div class="table-header">
                        </div>

                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Dashboard UI</td>
                                    <td>In progress</td>
                                    <td>2026-01-22</td>
                                    <td>
                                        <i class="fa-solid fa-pen edit"></i>
                                        <i class="fa-solid fa-trash delete"></i>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>API Integration</td>
                                    <td>Pending</td>
                                    <td>2026-01-18</td>
                                    <td>
                                        <i class="fa-solid fa-pen edit"></i>
                                        <i class="fa-solid fa-trash delete"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>


            </main>


        </div>
    </div>

</body>

</html>