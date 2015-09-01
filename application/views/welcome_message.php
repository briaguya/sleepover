<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="widget widget-table action-table" id="target-3">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Most Favorite Customer</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Name </th>
                    <th> TC no </th>
                    <th> Checkin Count </th>
                    <th> Total Paid </th>
                  </tr>
                </thead>
                <tbody>
                  <? foreach ($customer_most_paid as $k => $cust) { ?>
                  <tr>
                    <td> <? echo $cust->customer_firstname." ".$cust->customer_lastname;?> </td>
                    <td> <?=$cust->customer_TCno?> </td>
                    <td> <?=$cust->checkin_count?></td>
                    <td> <?=$cust->total_paid?></td>
                    <!--td class="td-actions"><a href="javascript:;" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"> </i></a><a href="javascript:;" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td-->
                  </tr>
                  <? } ?>
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Calendar</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div id='calendar'>
              </div>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
