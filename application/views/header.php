<!DOCTYPE html>
<html>
  <head>
    <title><?=$title?></title>
    <meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="/sleepover/css/bootstrap.min.css" rel="stylesheet">
	<link href="/sleepover/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
	        rel="stylesheet">
	<link href="/sleepover/css/font-awesome.css" rel="stylesheet">
	<link href="/sleepover/css/style.css" rel="stylesheet">
	<link href="/sleepover/css/pages/dashboard.css" rel="stylesheet">
	<link href="/sleepover/css/pages/signin.css" rel="stylesheet" type="text/css">
  <link href="/sleepover/js/guidely/guidely.css" rel="stylesheet">


	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
  </head>
  <body style="margin-bottom: 50px;">
  <div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="/sleepover"><i class="icon-home"></i> sleepover</a>
      <?
        if(UID){?>
          <div class="nav-collapse">
            <ul class="nav pull-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                  class="icon-user"></i> <?=FULL_NAME?> (<?=USERNAME?>) <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="/sleepover/login/logout">Logout</a></li>
                  </ul>
                </li>
              </ul>
          </div>
          <!--/.nav-collapse --> 
      <? } ?>
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<?
  if(UID)
{?>
      <div class="subnavbar">
        <div class="subnavbar-inner">
          <div class="container">
            <ul class="mainnav">
              <li <? if($page == "calendar"){ echo 'class="active"'; } ?>><a href="/sleepover/calendar"><i class="icon-calendar"></i><span>Calendar</span> </a> </li>
              <li <? if($page == "reservation"){ echo 'class="active"'; } ?>><a href="/sleepover/reservation"><i class="icon-list-alt"></i><span>Booking</span> </a> </li>
              <li <? if($page == "podestrian"){ echo 'class="active"'; } ?>><a href="/sleepover/podestrian"><i class="icon-user"></i><span>Podestrians</span> </a> </li>
              <li class="dropdown <? if($page == "pod" || $page == "room_type"){ echo 'active'; } ?>"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-home"></i><span>Pods</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/sleepover/pod">Pods</a></li>
                  <li><a href="/sleepover/pod_type">Pod Types</a></li>
                </ul>
              </li>
              <li <? if($page == "team_member"){ echo 'class="active"'; } ?>><a href="/sleepover/team_member"><i class="icon-user"></i><span>Team Members</span> </a> </li>
            </ul>
          </div>
          <!-- /container --> 
        </div>
        <!-- /subnavbar-inner --> 
      </div>
<? } ?>
<!-- /subnavbar -->