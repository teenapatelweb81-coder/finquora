<div class="container-fluid p-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Instant loan data list</li>
        </ol>
    </nav>
</div>

<section class="content">
    <div class="container-fluid px-0">
        <div class="row m-0">
            <div class="col-12 px-0">
                <div class="card">
                    <div class="card-body">
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                        <?php endif; ?>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User name</th>
                                        <th>Customer name</th>
                                        <th>Customer phone</th>
                                        <th>Lead creation date</th>
                                        <th>Owner id</th>
                                        <th>Lead id</th>
                                        <th>Lead remarks</th>
                                        <th>Lead description</th>
                                        <th>Lead status</th>
                                        <th>Lead sub status</th>
                                        <th>Member id</th>
                                        <th>Product name</th>
                                        <th>Product infocode</th>
                                        <th>Product infosubType</th>
                                        <th>Product inforedirectURL</th>
                                        <th>Member name</th>
                                        <th>WhatsAppMessage</th>
                                        <th>Date of sale</th>
                                        <th>Direct reports id</th>
                                        <th>Direct reports name</th>
                                        <th>Member type</th>
                                        <th>Product redirect url</th>
                                       <?php  if (isset($_GET['role']) && $_GET['role'] == 'disbursements' ) { ?>
                                        <th>Disbursed</th>
                                        <?php  }elseif (isset($_GET['role']) && $_GET['role'] == 'payout' ) { ?>
                                        <th>Payouts</th>
                                        <?php  }elseif (isset($_GET['role']) && $_GET['role'] == 'approved' ) { ?>
                                        <th>Status</th>
                                        <?php  }elseif (isset($_GET['role']) && $_GET['role'] == 'rejected' ) { ?>
                                        <th>Status</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($instants as $link):
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $link->user_id ?></td>
                                            <td><?= $link->customer_name ?></td>
                                            <td><?= $link->customer_phone ?></td>
                                            <td><?= $link->lead_creation_date ?></td>
                                            <td><?= $link->owner_id ?></td>
                                            <td><?= $link->lead_id ?></td>
                                            <td><?= $link->lead_remarks ?></td>
                                            <td><?= $link->lead_description ?></td>
                                            <td><?= $link->lead_status ?></td>
                                            <td><?= $link->lead_sub_status ?></td>
                                            <td><?= $link->member_id ?></td>
                                            <td><?= $link->product_name ?></td>
                                            <td><?= $link->product_infocode ?></td>
                                            <td><?= $link->product_infosubType ?></td>
                                            <td><?= $link->product_inforedirectURL ?></td>
                                            <td><?= $link->member_name ?></td>
                                            <td><?= $link->whatsAppMessage ?></td>
                                            <td><?= $link->date_of_sale ?></td>
                                            <td><?= $link->direct_reports_id ?></td>
                                            <td><?= $link->direct_reports_name ?></td>
                                            <td><?= $link->member_type ?></td>
                                            <td><?= $link->product_redirect_url ?></td>
                                            <?php  if (isset($_GET['role']) && $_GET['role'] == 'disbursements' ) { ?>
                                             <td><?= $link->disbursed ?></td>
                                            <?php  }elseif (isset($_GET['role']) && $_GET['role'] == 'payout' ) { ?>
                                             <td><?= $link->payment_amount_paid ?></td>
                                            <?php  }elseif (isset($_GET['role']) && $_GET['role'] == 'approved' ) { ?>
                                            <td>Approved</td>
                                            <?php  }elseif (isset($_GET['role']) && $_GET['role'] == 'rejected' ) { ?>
                                            <td>Rejected</td>
                                            <?php }?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</script>