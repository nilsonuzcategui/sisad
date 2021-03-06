<?php
session_start();
include_once('M/funciones.php');
$sesion = $_SESSION['sisad'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SISAD | Inicio</title>
    <?php include_once('M/head.php') ?>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">S.I.S.A.D</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include_once('V/header.php') ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include_once('V/dashboard.php') ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid r-aside">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Dashboard 1</h3>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard 1</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Sales overview chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                          
                            <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                Este Inicio est?? en desarrollo y se ir?? adecuando conforme el sistema se desarrolle.
                            </div>


                                <div class="d-flex">
                                    <div>
                                        <h3 class="card-title m-b-5"><span class="lstick"></span>Sales Overview </h3>
                                        <h6 class="card-subtitle">Year 2017</h6></div>
                                    <div class="ml-auto">
                                        <ul class="list-inline">
                                            <li>
                                                <div class="d-flex">
                                                    <i class="fa fa-circle font-10 m-r-10 text-primary m-t-10"></i>
                                                    <div>
                                                        <h2 class="m-b-0">10368</h2>
                                                        <h6 class="text-muted">Earning</h6></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <i class="fa fa-circle font-10 m-r-10 text-info m-t-10"></i>
                                                    <div>
                                                        <h2 class="m-b-0">12659</h2>
                                                        <h6 class="text-muted">Expense</h6></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <i class="fa fa-circle font-10 m-r-10 text-muted m-t-10"></i>
                                                    <div>
                                                        <h2 class="m-b-0">15478</h2>
                                                        <h6 class="text-muted">Sales</h6></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="sales-overview" class="p-relative" style="height:400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Stats box -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="../assets/images/icon/income.png" alt="Income" /></div>
                                    <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Income</h6>
                                        <h2 class="m-t-0">953,000</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="../assets/images/icon/expense.png" alt="Income" /></div>
                                    <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Expense</h6>
                                        <h2 class="m-t-0">236,000</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="../assets/images/icon/assets.png" alt="Income" /></div>
                                    <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Assets</h6>
                                        <h2 class="m-t-0">987,563</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Projects of the month -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h4 class="card-title"><span class="lstick"></span>Projects of the Month</h4></div>
                                    <div class="ml-auto">
                                        <select class="custom-select b-0">
                                            <option selected="">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive m-t-20 no-wrap">
                                    <table class="table vm no-th-brd pro-of-month">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Assigned</th>
                                                <th>Name</th>
                                                <th>Priority</th>
                                                <th>Budget</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width:50px;"><span class="round">S</span></td>
                                                <td>
                                                    <h6>Sunil Joshi</h6><small class="text-muted">Web Designer</small></td>
                                                <td>Elite Admin</td>
                                                <td><span class="label label-success label-rounded">Low</span></td>
                                                <td>$3.9K</td>
                                            </tr>
                                            <tr class="active">
                                                <td><span class="round"><img src="../assets/images/users/2.jpg" alt="user" width="50"></span></td>
                                                <td>
                                                    <h6>Andrew</h6><small class="text-muted">Project Manager</small></td>
                                                <td>Real Homes</td>
                                                <td><span class="label label-info label-rounded">Medium</span></td>
                                                <td>$23.9K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-success">B</span></td>
                                                <td>
                                                    <h6>Bhavesh patel</h6><small class="text-muted">Developer</small></td>
                                                <td>MedicalPro Theme</td>
                                                <td><span class="label label-primary label-rounded">High</span></td>
                                                <td>$12.9K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-primary">N</span></td>
                                                <td>
                                                    <h6>Nirav Joshi</h6><small class="text-muted">Frontend Eng</small></td>
                                                <td>Elite Admin</td>
                                                <td><span class="label label-danger label-rounded">Low</span></td>
                                                <td>$10.9K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-warning">M</span></td>
                                                <td>
                                                    <h6>Micheal Doe</h6><small class="text-muted">Content Writer</small></td>
                                                <td>Helping Hands</td>
                                                <td><span class="label label-success label-rounded">High</span></td>
                                                <td>$12.9K</td>
                                            </tr>
                                            <tr>
                                                <td><span class="round round-danger">N</span></td>
                                                <td>
                                                    <h6>Johnathan</h6><small class="text-muted">Graphic</small></td>
                                                <td>Digital Agency</td>
                                                <td><span class="label label-info label-rounded">High</span></td>
                                                <td>$2.6K</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Activity widget find scss into widget folder-->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-7 col-xlg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <h4 class="card-title"><span class="lstick"></span>Activity</h4>
                                    <div class="btn-group ml-auto m-t-10">
                                        <a href="JavaScript:void(0)" class="icon-options-vertical link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="activity-box">
                                <div class="date-devider"><span>Today</span></div>
                                <div class="card-body">
                                    <!-- Activity item-->
                                    <div class="activity-item">
                                        <div class="round m-r-20"><img src="../assets/images/users/2.jpg" alt="user" width="50" /></div>
                                        <div class="m-t-10">
                                            <h5 class="m-b-0 font-medium">Mark Freeman <span class="text-muted font-14 m-l-10">| &nbsp; 6:30 PM</span></h5>
                                            <h6 class="text-muted">uploaded this file </h6>
                                            <table class="table vm b-0 m-b-0">
                                                <tr>
                                                    <td class="m-r-10 b-0"><img src="../assets/images/icon/zip.png" alt="user" /></td>
                                                    <td class="b-0">
                                                        <h5 class="m-b-0 font-medium ">Homepage.zip</h5>
                                                        <h6>54 MB</h6></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Activity item-->
                                    <!-- Activity item-->
                                    <div class="activity-item">
                                        <div class="round m-r-20"><img src="../assets/images/users/3.jpg" alt="user" width="50" /></div>
                                        <div class="m-t-10">
                                            <h5 class="m-b-5 font-medium">Emma Smith <span class="text-muted font-14 m-l-10">| &nbsp; 6:30 PM</span></h5>
                                            <h6 class="text-muted">joined projectname, and invited <a href="javascript:void(0)">@maxcage, @maxcage, @maxcage,<br/> @maxcage, @maxcage,+3</a></h6>
                                            <span class="image-list m-t-10">
                                                <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" class="img-circle" alt="user" width="40" /></a>
                                                <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" class="img-circle" alt="user" width="40" /></a>
                                                <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" class="img-circle" alt="user" width="40" /></a>
                                                <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" class="img-circle" alt="user" width="40" /></a>
                                                <a href="javascript:void(0)">+3</a>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Activity item-->
                                </div>
                                <div class="date-devider"><span>Yesterday</span></div>
                                <div class="card-body">
                                    <!-- Activity item-->
                                    <div class="activity-item">
                                        <div class="round m-r-20"><img src="../assets/images/users/4.jpg" alt="user" width="50" /></div>
                                        <div class="m-t-10">
                                            <h5 class="m-b-0 font-medium">David R. Jones  <span class="text-muted font-14 m-l-10">| &nbsp; 6:30 PM</span></h5>
                                            <h6 class="text-muted">uploaded this file </h6>
                                            <span>
                                                <a href="javascript:void(0)" class="m-r-10"><img src="../assets/images/big/img1.jpg" alt="user" width="60"></a>
                                                <a href="javascript:void(0)" class="m-r-10"><img src="../assets/images/big/img2.jpg" alt="user" width="60"></a>
                                                <a href="javascript:void(0)" class="m-r-10"><img src="../assets/images/big/img3.jpg" alt="user" width="60"></a>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Activity item-->
                                    <!-- Activity item-->
                                    <div class="activity-item">
                                        <div class="round m-r-20"><img src="../assets/images/users/6.jpg" alt="user" width="50" /></div>
                                        <div class="m-t-10">
                                            <h5 class="m-b-5 font-medium">David R. Jones <span class="text-muted font-14 m-l-10">| &nbsp; 6:30 PM</span></h5>
                                            <h6 class="text-muted">Commented on<a href="javascript:void(0)">Test Project</a></h6>
                                            <p class="m-b-0">It has survived not only five centuries, but also the leap into <br/> electrotypesetting, remaining essentially unchanged.</p>
                                        </div>
                                    </div>
                                    <!-- Activity item-->
                                    <!-- Activity item-->
                                    <div class="activity-item">
                                        <div class="round m-r-20"><img src="../assets/images/users/7.jpg" alt="user" width="50" /></div>
                                        <div class="m-t-10">
                                            <h5 class="m-b-0 font-medium">David R. Jones  <span class="text-muted font-14 m-l-10">| &nbsp; 6:30 PM</span></h5>
                                            <h6 class="text-muted">uploaded this file </h6>
                                            <p>It has survived not only five centuries</p>
                                            <span>
                                                <a href="javascript:void(0)" class="m-r-10"><img src="../assets/images/big/img5.jpg" alt="user" width="60"></a>
                                                <a href="javascript:void(0)" class="m-r-10"><img src="../assets/images/big/img6.jpg" alt="user" width="60"></a>
                                                <a href="javascript:void(0)" class="m-r-10"><img src="../assets/images/big/img4.jpg" alt="user" width="60"></a>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Activity item-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Little Profile widget-->
                    <div class="col-lg-5 col-xlg-4">
                        <div class="card">
                            <div class="card-body little-profile text-center">
                                <div class="pro-img m-t-20"><img src="../assets/images/users/4.jpg" alt="user"></div>
                                <h3 class="m-b-0">Angela Dominic</h3>
                                <h6 class="text-muted">Web Designer &amp; Developer</h6>
                                <ul class="list-inline soc-pro m-t-30">
                                    <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-facebook-square"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-youtube-play"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <div class="text-center bg-light">
                                <div class="row">
                                    <div class="col-6  p-20 b-r">
                                        <h4 class="m-b-0 font-medium">1099</h4><small>Followers</small></div>
                                    <div class="col-6  p-20">
                                        <h4 class="m-b-0 font-medium">603</h4><small>Following</small></div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <a href="javascript:void(0)" class="m-t-10 m-b-20 waves-effect waves-dark btn btn-success btn-md btn-rounded">Follow me</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <h4 class="card-title"><span class="lstick"></span>My Contact</h4>
                                    <div class="btn-group ml-auto m-t-10">
                                        <a href="JavaScript:void(0)" class="icon-options-vertical link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-box contact-box">
                                    <div class="message-widget contact-widget">
                                        <!-- Message -->
                                        <a href="#">
                                            <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Pavan kumar</h5> <span class="mail-desc">info@wrappixel.com</span></div>
                                        </a>
                                        <!-- Message -->
                                        <a href="#">
                                            <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Sonu Nigam</h5> <span class="mail-desc">pamela1987@gmail.com</span></div>
                                        </a>
                                        <!-- Message -->
                                        <a href="#">
                                            <div class="user-img"> <span class="round">A</span> <span class="profile-status away pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Arijit Sinh</h5> <span class="mail-desc">cruise1298.fiplip@gmail.com</span></div>
                                        </a>
                                        <!-- Message -->
                                        <a href="#">
                                            <div class="user-img"> <img src="../assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Pavan kumar</h5> <span class="mail-desc">kat@gmail.com</span></div>
                                        </a>
                                        <!-- Message -->
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Little Profile widget-->
                </div>
                <!-- ============================================================== -->
                <!-- visit charts-->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><span class="lstick"></span>Visit Separation</h4>
                                <div id="visitor" style="height:290px; width:100%;"></div>
                                <table class="table vm font-14">
                                    <tr>
                                        <td class="b-0">Mobile</td>
                                        <td class="text-right font-medium b-0">38.5%</td>
                                    </tr>
                                    <tr>
                                        <td>Tablet</td>
                                        <td class="text-right font-medium">30.8%</td>
                                    </tr>
                                    <tr>
                                        <td>Desktop</td>
                                        <td class="text-right font-medium">7.7%</td>
                                    </tr>
                                    <tr>
                                        <td>Other</td>
                                        <td class="text-right font-medium">23.1%</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h4 class="card-title"><span class="lstick"></span>Website Visit</h4>
                                    <ul class="list-inline m-b-0 ml-auto">
                                        <li>
                                            <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>Site A view</h6> </li>
                                        <li>
                                            <h6 class="text-muted text-info"><i class="fa fa-circle font-10 m-r-10"></i>Site B view</h6> </li>
                                    </ul>
                                </div>
                                <div class="text-center m-t-30">
                                    <div class="btn-group " role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-secondary">PAGEVIEWS</button>
                                        <button type="button" class="btn btn-sm btn-secondary">REFERRALS</button>
                                    </div>
                                </div>
                                <div class="website-visitor p-relative m-t-30" style="height:400px; width:100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-xlg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <div>
                                        <h4 class="card-title"><span class="lstick"></span>To Do list</h4>
                                        <h6 class="card-subtitle">List of your next task to complete</h6></div>
                                    <div class="ml-auto">
                                        <button class="pull-right btn btn-sm btn-rounded btn-success" data-toggle="modal" data-target="#myModal">Add Task</button>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- To do list widgets -->
                                <!-- ============================================================== -->
                                <div class="to-do-widget m-t-20">
                                    <!-- .modal for add task -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Task</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label>Task name</label>
                                                            <input type="text" class="form-control" placeholder="Enter Task Name"> </div>
                                                        <div class="form-group">
                                                            <label>Assign to</label>
                                                            <select class="custom-select form-control pull-right">
                                                                <option selected="">Sachin</option>
                                                                <option value="1">Sehwag</option>
                                                                <option value="2">Pritam</option>
                                                                <option value="3">Alia</option>
                                                                <option value="4">Varun</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                                        <li class="list-group-item" data-role="task">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="inputSchedule" name="inputCheckboxesSchedule">
                                                <label for="inputSchedule" class=""> <span>Schedule meeting with</span> <span class="label label-rounded label-danger pull-right">Today</span></label>
                                            </div>
                                            <ul class="assignedto">
                                                <li><img src="../assets/images/users/1.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Steave"></li>
                                                <li><img src="../assets/images/users/2.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jessica"></li>
                                                <li><img src="../assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                                <li><img src="../assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                            </ul>
                                        </li>
                                        <li class="list-group-item" data-role="task">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="inputCall" name="inputCheckboxesCall">
                                                <label for="inputCall" class=""> <span>Give Purchase report to</span> <span class="label label-info label-rounded pull-right">Yesterday</span> </label>
                                            </div>
                                            <ul class="assignedto">
                                                <li><img src="../assets/images/users/3.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                                <li><img src="../assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                                            </ul>
                                        </li>
                                        <li class="list-group-item" data-role="task">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="inputBook" name="inputCheckboxesBook">
                                                <label for="inputBook" class=""> <span>Book flight for holiday</span><span class="label label-primary label-rounded pull-right">1 week </span> </label>
                                            </div>
                                            <div class="item-date"> 26 jun 2017</div>
                                        </li>
                                        <li class="list-group-item" data-role="task">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="inputForward" name="inputCheckboxesForward">
                                                <label for="inputForward" class=""> <span>Forward all tasks</span> <span class="label label-warning label-rounded pull-right">2 weeks</span> </label>
                                            </div>
                                            <div class="item-date"> 26 jun 2017</div>
                                        </li>
                                        <li class="list-group-item" data-role="task">
                                            <div class="checkbox checkbox-info">
                                                <input type="checkbox" id="inputForward2" name="inputCheckboxesd">
                                                <label for="inputForward2" class=""> <span>Important tasks</span> <span class="label label-success label-rounded pull-right">2 weeks</span> </label>
                                            </div>
                                            <ul class="assignedto">
                                                <li><img src="../assets/images/users/1.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Assign to Steave"></li>
                                                <li><img src="../assets/images/users/2.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Assign to Jessica"></li>
                                                <li><img src="../assets/images/users/4.jpg" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Assign to Selina"></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xlg-3">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="../assets/images/big/img1.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="font-normal">Featured Hydroflora Pots Garden &amp; Outdoors</h3>
                                <span class="label label-info label-rounded">Technology</span>
                                <p class="m-b-0 m-t-20">Titudin venenatis ipsum aciat. Vestibulum ullamcorper quam. nenatis ipsum ac feugiat. Ibulum ullamcorper</p>
                                <div class="d-flex m-t-20">
                                    <button class="btn p-l-0 btn-link ">Read more</button>
                                    <div class="ml-auto align-self-center">
                                        <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart-o"></i></a>
                                        <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Right panel -->
                <!-- ============================================================== -->
                <aside class="right-side-panel">
                    <div class="row">
                        <!-- Weather Widget -->
                        <div class="col-md-12 m-t-10">
                            <h5 class="text-muted m-b-0">San Francisco, CA</h5>
                            <h3>Mon, July 14  11 AM</h3>
                            <div class="d-flex m-t-20">
                                <div class="display-5 text-info"><i class="wi wi-day-cloudy"></i></div>
                                <div class="m-l-20">
                                    <h2 class="m-b-0">72??F</h2>
                                    <h6>Clear with periodic clouds</h6>
                                </div>
                            </div>
                            <hr>
                            <table class="table">
                                <tr>
                                    <td><i class="wi wi-day-cloudy"></i> Saturday</td>
                                    <td class="text-right font-medium">65 ?? F</td>
                                </tr>
                                <tr>
                                    <td><i class="wi wi-day-sunny"></i> Sunday</td>
                                    <td class="text-right font-medium">70 ?? F</td>
                                </tr>
                                <tr>
                                    <td><i class="wi wi-day-sprinkle"></i> Monday</td>
                                    <td class="text-right font-medium">73 ?? F</td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                        <!-- End Weather Widget -->
                        <!-- Message Widget -->
                        <div class="col-md-12 m-t-10">
                            <h3 class="p-relative"><span class="lstick"></span> Message<span class="pull-right font-14  p-2 label label-rounded label-success">16</span></h3>
                            <div class="msg-widget m-t-20">
                                <!-- Message Item -->
                                <div class="msg-item">
                                    <div class="msg-body">
                                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        <span class="dwn-aro"></span>
                                    </div>
                                    <div class="m-t-20 d-flex">
                                        <div class="m-pic m-r-20"><img src="../assets/images/users/profile.png" alt="user"></div>
                                        <div class="author">
                                            <h5 class="m-b-0">Mark Freeman</h5>
                                            <p class="text-muted font-14">Today 04:12 PM</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Message Item -->
                                <div class="msg-item">
                                    <div class="msg-body">
                                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        <span class="dwn-aro"></span>
                                    </div>
                                    <div class="m-t-20 d-flex">
                                        <div class="m-pic m-r-20"><img src="../assets/images/users/4.jpg" alt="user"></div>
                                        <div class="author">
                                            <h5 class="m-b-0">Mark Freeman</h5>
                                            <p class="text-muted font-14">Today 04:12 PM</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Message Item -->
                                <div class="msg-item">
                                    <div class="msg-body">
                                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                        <span class="dwn-aro"></span>
                                    </div>
                                    <div class="m-t-20 d-flex">
                                        <div class="m-pic m-r-20"><img src="../assets/images/users/2.jpg" alt="user"></div>
                                        <div class="author">
                                            <h5 class="m-b-0">Mark Freeman</h5>
                                            <p class="text-muted font-14">Today 04:12 PM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Message Widget -->
                        <!-- twitter Widget -->
                        <div class="col-md-12 m-t-10">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="stats">
                                            <h1 class="text-white">3257+</h1>
                                            <h6 class="text-white">Twitter Followers</h6>
                                            <button class="btn btn-rounded btn-outline btn-light m-t-10 font-14">Check list</button>
                                        </div>
                                        <div class="stats-icon text-right ml-auto"><i class="fa fa-twitter display-5 op-3 text-dark"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- twitter Widget -->
                            <!-- twitter Widget -->
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="stats">
                                            <h1 class="text-white">6509+</h1>
                                            <h6 class="text-white">Facebook Likes</h6>
                                            <button class="btn btn-rounded btn-outline btn-light m-t-10 font-14">Check list</button>
                                        </div>
                                        <div class="stats-icon text-right ml-auto"><i class="fa fa-facebook display-5 op-3 text-dark"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- facebook Widget -->
                            <!-- subscribe Widget -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="stats">
                                            <h1 class="">9062+</h1>
                                            <h6 class="text-muted">Subscribe</h6>
                                            <button class="btn btn-rounded btn-outline btn-secondary m-t-10 font-14">Check list</button>
                                        </div>
                                        <div class="stats-icon text-right ml-auto"><i class="fa fa-envelope display-5 op-3 text-dark"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- twitter Widget -->
                    </div>
                </aside>
                <!-- ============================================================== -->
                <!-- End Right panel -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include_once('V/footer.php') ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    




    <?php include_once('M/food-importaciones.php') ?>
    <script src="../assets/js/dashboard1.js"></script>
</body>

</html>