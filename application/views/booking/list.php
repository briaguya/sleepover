<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <a href="/sleepover/booking/modify" class="btn btn-small btn-primary"><i class="btn-icon-only icon-ok"></i>Add Booking</a>
                    <br><br>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th> Podestrian </th>
                            <th> Pod </th>
                            <th> Checkin Date/Time </th>
                            <th> Checkout Date </th>
                            <th class="td-actions"> Edit </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        foreach ($bookings as $booking) {
                            ?>
                            <tr>
                                <td> <a href="/sleepover/podestrian/modify/<?=$booking->podestrian_id?>"><img src="/sleepover/img/success-kid-thumb.png"></a> <?=$booking->podestrian?></td>
                                <td> <?=$booking->pod ?> </td>
                                <td> <?=$booking->checkin_date ?> </td>
                                <td> <?=$booking->checkout_date ?> </td>
                                <td class="td-actions">
                                    <a href="/sleepover/booking/modify/<?=$booking->booking_id?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"> </i></a>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>