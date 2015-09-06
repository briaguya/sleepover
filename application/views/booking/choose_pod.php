<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1>Choose a Pod</h1>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th> Location </th>
                            <th> Pod Name </th>
                            <th> Pod Type </th>
                            <th class="td-actions"> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        foreach ($pods as $pod) {
                            ?>
                            <tr>
                                <td> <?=$pod->location_name ?> </td>
                                <td> <?=$pod->comboname ?> </td>
                                <td> <?=$pod->pod_type ?> </td>
                                <td class="td-actions">
                                    <a href="/sleepover/booking/confirm/<?=$pod->pod_id?>" class="button btn btn-success btn-large">Book</a>
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