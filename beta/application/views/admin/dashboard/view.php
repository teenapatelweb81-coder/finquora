<?php

 $domain_id = domain_id_get();
$adminColor = $this->db->where( array('domain_id' => $domain_id))->get('admin_color')->row_array(); ?>
<style>
.dashboardBackground{
    background: <?= (isset($adminColor['background_color'])) ? $adminColor['background_color'] : '' ; ?> !important;
}
.row{
  background: unset !important;
}
.small-box>.inner h3 {
   text-wrap: wrap;
    word-break: break-all;
}
.small-box>.small-box-footer {
    position: absolute;
    bottom: 2px;
    width: 100%;
}
</style>
<div class="container-fluid p-0 " style="background: <?= (isset($adminColor['background_color'])) ? $adminColor['background_color'] : '' ; ?>">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item "><a href="<?php echo base_url(" admin/Dashboard/ "); ?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<div class="container-fluid">
  <?php if ($this->session->flashdata('success')) {?>
  <div class="alert alert-success">
      <?php echo $this->session->flashdata('success') ?>
  </div>
  <?php }?>
  <section class="content" style=" margin-bottom: 50px; ">
    <div class="container-fluid">
      <?php if($this->session->userdata('type') == 'seo'){ ?>
<style>
body{

background:#f5f7fb;

}

.website-dashboard{

background:linear-gradient(135deg,#4f46e5,#7c3aed);

border-radius:25px;

padding:60px;

color:#fff;

overflow:hidden;

position:relative;

box-shadow:0 20px 40px rgba(79,70,229,.25);

}

.website-dashboard:before{

content:"";

position:absolute;

right:-80px;

top:-80px;

width:260px;

height:260px;

background:rgba(255,255,255,.08);

border-radius:50%;

}

.website-dashboard:after{

content:"";

position:absolute;

left:-60px;

bottom:-60px;

width:180px;

height:180px;

background:rgba(255,255,255,.05);

border-radius:50%;

}

.dashboard-badge{

display:inline-block;

padding:8px 18px;

background:rgba(255,255,255,.18);

border-radius:30px;

font-size:13px;

margin-bottom:20px;

}

.dashboard-title{

font-size:42px;

font-weight:700;

margin-bottom:20px;

}

.dashboard-title span{

color:#FFE082;

}

.dashboard-text{

font-size:18px;

opacity:.9;

line-height:1.7;

max-width:650px;

}

.btn-dashboard{

padding:12px 25px;

border-radius:12px;

margin-right:10px;

font-weight:600;

}

.dashboard-icon{

font-size:170px;

opacity:.18;

}

.info-card{

background:#fff;

padding:25px;

border-radius:18px;

box-shadow:0 10px 30px rgba(0,0,0,.08);

height:100%;

transition:.3s;

}

.info-card:hover{

transform:translateY(-8px);

}

.icon{

width:60px;

height:60px;

border-radius:15px;

display:flex;

align-items:center;

justify-content:center;

font-size:26px;

color:#fff;

margin-bottom:20px;

}

.quick-link{

display:block;

padding:12px;

margin-top:12px;

background:#f5f7fb;

border-radius:10px;

text-decoration:none;

font-weight:600;

color:#4f46e5;

transition:.3s;

}

.quick-link:hover{

background:#4f46e5;

color:#fff;

}

.activity{

padding:10px 0;

border-bottom:1px solid #eee;

}

.success{

display:inline-block;

width:10px;

height:10px;

background:#22c55e;

border-radius:50%;

margin-right:10px;

}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


<div class="container-fluid mt-4">

    <div class="website-dashboard">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <span class="dashboard-badge">
                    <i class="bi bi-globe2"></i> WEBSITE MANAGER
                </span>

                <h1 class="dashboard-title">
                    Welcome Back,
                    <span><?= $this->session->userdata('name'); ?></span> 👋
                </h1>

                <p class="dashboard-text">
                    Manage your assigned website pages with confidence.
                    Keep your content fresh, publish updates instantly,
                    and provide visitors with the best experience.
                </p>

                <div class="mt-4">

                    <!-- <a href="<?= base_url('pages'); ?>" class="btn btn-light btn-dashboard">
                        <i class="bi bi-file-earmark-text"></i>
                        Manage Pages
                    </a> -->

                    <a href="<?= rtrim(str_replace('/beta', '', base_url()), '/'); ?>" target="_blank" class="btn btn-outline-light btn-dashboard">
                        <i class="bi bi-box-arrow-up-right"></i>
                        Visit Website
                    </a>

                </div>

            </div>

            <div class="col-lg-4 text-center">

                <div class="dashboard-icon">

                    <i class="bi bi-window-stack"></i>

                </div>

            </div>

        </div>

    </div>

</div>


</div>
<?php } ?>
      <?php if ($this->session->userdata('type') == 'admin' || has_permission('Lead')) { ?>
        <div class="lead_full_body">
          <div class="row mb-2 justify-content-center">
            <div class="col-12">
              <h2 class="text-center font-weight-bold">Digital Process</h1>
            </div>
          </div>
          <div class="row mb-2 justify-content-center">
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-info">
                <div class="inner">
                  <h3><?php echo 0 + $leads; ?></h3>
                  <p>My Leads</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <a href="<?php echo base_url('admin/myleads?role=digital'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-warning">
                <div class="inner">
                  <h3>₹<?php echo 0  + $disbursemenets_lead_digital->dis; ?></h3>
                  <p>Disbursements</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url('admin/disbursement?role=digital'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-success">
                <div class="inner">
                    <h3>₹<?=0  + $payout_lead_digital->pay_amount ;?></h3>
                  <p>Payouts</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo base_url('admin/payout?role=digital'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-primary">
                <div class="inner">
                  <h3><?php echo 0 + $digital_approved; ?></h3>
                  <p>Approved</p>
                </div>
                <div class="icon">
                <i class="fa fa-thumbs-up"></i>
                </div>
                <a href="<?php echo base_url('admin/approved?role=digital'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-danger">
                <div class="inner">
                  <h3><?php echo 0 + $digital_reject; ?></h3>
                  <p>Rejected</p>
                </div>
                <div class="icon">
                <i class="fa fa-ban"></i>
                </div>
                <a href="<?php echo base_url('admin/reject?role=digital'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <!-- Referral Amount -->
            <?php if ($this->session->userdata('role') == 3 || ($this->session->userdata('role') == 1)) { ?>
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-secondary">
                  <div class="inner">
                    <h3><?php echo 0 + $referralAmount->referral_amount; ?></h3>

                    <p>Referral Amount</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="<?php echo base_url('admin/referral_data'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            <?php }?>
          </div>

          <?php 
          $check_team_parent_user_master = 0;
          if ($this->session->userdata('role') != 1) { 
            $domain_id = domain_id_get();
            $session_user_id = $this->session->userdata('user_id');
            $session_role = $this->session->userdata('role');
            $check_parent_user_master = $this->db->where('parent_id', $session_user_id)->where('parent_id_role', $session_role)->get('user_master')->row();
            $check_team_parent_user_master = $this->db->where('parent_team_id', $session_user_id)->get('user_master')->num_rows();
            $check_parent_branch_franchise = $this->db->where('parent_id', $session_user_id)->get('branch_franchise')->row();
            if (!empty($check_parent_user_master) || !empty($check_parent_branch_franchise || $check_team_parent_user_master > 0)) {  
          ?>        
            <div class="row mb-2  justify-content-center">
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-info">
                  <div class="inner">
                    <h3><?php echo 0  + $team_leads_digital; ?></h3>
                    <p>Team Leads</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                  </div>
                  <a href="<?php echo base_url('admin/myleads?role=digital&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <!-- Team Disbursements -->
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-warning">
                  <div class="inner">
                    <h3>₹<?php echo 0  + $team_disbursemenets_lead_digital->dis ?></h3>
                    <p>Team Disbursements</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="<?php echo base_url('admin/disbursement?role=digital&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <!-- Team Payouts -->
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-success">
                  <div class="inner">
                      <h3>₹<?=0  + $team_payout_lead_digital->pay_amount ?></h3> 
                    <p>Team Payouts</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="<?php echo base_url('admin/payout?role=digital&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <!-- Team Rejected -->
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-primary">
                  <div class="inner">
                    <h3><?php echo 0 + $team_approved_digital ?></h3>
                    <p>Team Approved </p>
                  </div>
                  <div class="icon">
                    <i class=" fa fa-thumbs-up"></i>
                  </div>
                  <a href="<?php echo base_url('admin/approved?role=digital&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-danger">
                  <div class="inner">
                    <h3><?php echo 0 + $team_rejects_digital + $team_rejects; ?></h3>
                    <p>Team Rejected </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-ban"></i>
                  </div>
                  <a href="<?php echo base_url('admin/reject?role=digital&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          <?php }} ?>

          <!-- Paper Process -->
          <div class="row mb-2 justify-content-center">
            <div class="col-12">
              <h2 class="text-center font-weight-bold">Paper Process</h2>
            </div>
          </div>

          <div class="row mb-2 justify-content-center">
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-info">
                    <div class="inner">
                        <h3><?php echo 0 + $paperProcessLeads; ?></h3>
                        <p>My Leads</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <a href="<?php echo base_url('admin/myleads?role=paper'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-warning text-white">
                    <div class="inner">
                        <h3>₹ <?php echo 0 + $disbursemenets_lead_paper->dis; ?></h3>
                        <p>Disbursements</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo base_url('admin/disbursement?role=paper'); ?>" class="small-box-footer  text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-success">
                    <div class="inner">
                        <h3>₹ <?=0 +  $payout_lead_paper->pay_amount ;?></h3>
                        <p>Payouts</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?php echo base_url('admin/payout?role=paper'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-primary">
                    <div class="inner">
                        <h3><?php echo 0 + $paper_approved; ?></h3>
                        <p>Approved </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-thumbs-up"></i>
                    </div>
                    <a href="<?php echo base_url('admin/approved?role=paper'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-danger">
                    <div class="inner">
                        <h3><?php echo 0 + $paper_reject; ?></h3>
                        <p>Rejected </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-ban"></i>
                    </div>
                    <a href="<?php echo base_url('admin/reject?role=paper'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
          </div>

          <?php if (!empty($check_parent_user_master) || !empty($check_parent_branch_franchise ) || $check_team_parent_user_master > 0) {  ?>
            <div class="row mb-2  justify-content-center">
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-info">
                  <div class="inner">
                    <h3><?php echo 0 + $team_leads ?></h3>
                    <p>Team Leads</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                  </div>
                  <a href="<?php echo base_url('admin/myleads?role=paper&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <!-- Team Disbursements -->
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                  <div class="small-box h-100 bg-warning">
                      <div class="inner">
                          <h3>₹<?php echo 0  + $team_disbursemenets_lead_paper->dis; ?></h3>
                          <p>Team Disbursements</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-person-add"></i>
                      </div>
                      <a href="<?php echo base_url('admin/disbursement?role=paper&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>

              <!-- Team Payouts -->
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                  <div class="small-box h-100 bg-success">
                      <div class="inner">
                          <h3>₹<?=0  + $team_payout_lead_paper->pay_amount ;?></h3>
                          <p>Team Payouts</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="<?php echo base_url('admin/payout?role=paper&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              
              <!-- Team Rejected -->
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                  <div class="small-box h-100 bg-primary">
                      <div class="inner">
                          <h3><?php echo 0 +  $team_approved; ?></h3>
                          <p>Team Approved </p>
                      </div>
                      <div class="icon">
                          <i class="fa fa-thumbs-up"></i>
                      </div>
                      <a href="<?php echo base_url('admin/approved?role=paper&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                  <div class="small-box h-100 bg-danger">
                      <div class="inner">
                          <h3><?php echo 0 + $team_rejects; ?></h3>
                          <p>Team Rejected </p>
                      </div>
                      <div class="icon">
                          <i class="fa fa-ban"></i>
                      </div>
                      <a href="<?php echo base_url('admin/reject?role=paper&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
            </div>
          <?php } ?>

        </div>
      <?php }?>

      <?php if ($this->session->userdata('type') == 'admin' || has_permission('Bank Login List')) { ?>
        <!-- Bank login process -->
        <div class="row mb-2 justify-content-center">
            <div class="col-12">
                <h2 class="text-center font-weight-bold">Bank login process</h1>
            </div>
        </div>

          <div class="row mb-2  justify-content-center">
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <!-- small box -->
              <div class="small-box h-100 bg-info">
                <div class="inner">
                  <h3><?php echo 0 +  $totalLoans; ?></h3>

                  <p>Total Loans</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <a href="<?php echo base_url('admin/loan_lead'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-warning">
                <div class="inner">
                  <h3>₹ <?php echo 0+ $disbursemenets_loan_digital->dis; ?></h3>
                  <p>Disbursements</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url('admin/loan_lead?role=disbursements'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-success">
                <div class="inner">
                  <h3>₹ <?=0 + $payout_loan_digital->pay_amount;?></h3>
                  <p>Payouts</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo base_url('admin/loan_lead?role=payout'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-primary">
                <div class="inner">
                  <h3><?php echo 0 + $digital_loan_approved; ?></h3>
                  <p>Approved </p>
                </div>
                <div class="icon">
                  <i class="fa fa-thumbs-up"></i>
                </div>
                <a href="<?php echo base_url('admin/loan_lead?role=approved'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-danger">
                <div class="inner">
                  <h3><?php echo 0 + $digital_loan_reject; ?></h3>
                  <p>Rejected </p>
                </div>
                <div class="icon">
                  <i class="fa fa-ban"></i>
                </div>
                <a href="<?php echo base_url('admin/loan_lead?role=rejected'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <?php if (!empty($check_parent_user_master) || !empty($check_parent_branch_franchise) || $check_team_parent_user_master > 0) {?>
            <div class="row mb-2  justify-content-center">
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-info">
                  <div class="inner">
                    <h3><?php echo 0 + $team_loans_digital ?></h3>
                    <p>Team Leads</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                  </div>
                  <a href="<?php echo base_url('admin/loan_lead?role=loan&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <!-- Team Disbursements -->
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-warning">
                  <div class="inner">
                    <h3>₹<?php echo 0  + $team_disbursemenets_loan_digital->dis; ?></h3>
                    <p>Team Disbursements</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="<?php echo base_url('admin/loan_lead?role=disbursements&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <!-- Team Payouts -->
              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-success">
                  <div class="inner">
                      <h3>₹<?=0  + $team_payout_loan_digital->pay_amount ;?></h3>
                      <p>Team Payouts</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="<?php echo base_url('admin/loan_lead?role=payout&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <!-- Team Rejected -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-primary">
                  <div class="inner">
                    <h3><?php echo 0 +  $team_loans_approved_digital; ?></h3>
                    <p>Team Approved </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-thumbs-up"></i>
                  </div>
                  <a href="<?php echo base_url('admin/loan_lead?role=approved&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="small-box h-100 bg-danger">
                  <div class="inner">
                    <h3><?php echo 0 + $team_loans_rejects_digital; ?></h3>
                    <p>Team Rejected </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-ban"></i>
                  </div>
                  <a href="<?php echo base_url('admin/loan_lead?role=rejected&user=team'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

            </div>
          <?php } ?>
      <?php }?>

      <?php if ($this->session->userdata('type') == 'admin' || has_permission('Instant Loans Kyc')) { ?>
        <!-- Instant Loans Kyc -->
        <div class="row mb-2 justify-content-center">
            <div class="col-12">
                <h2 class="text-center font-weight-bold">Instant Loans Kyc</h1>
            </div>
        </div>

          <div class="row mb-2  justify-content-center">
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <!-- small box -->
              <div class="small-box h-100 bg-info">
                <div class="inner">
                  <h3><?php echo 0 +  $instant_leads; ?></h3>
                  <p>Total Leads</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <a href="<?php echo base_url('admin/instantKyc'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-warning">
                <div class="inner">
                  <h3>₹ <?php echo 0+ $instantDisbursements->dis; ?></h3>
                  <p>Disbursements</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url('admin/instantKyc?role=disbursements'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-success">
                <div class="inner">
                  <h3>₹ <?=0 + $instantPayouts->pay_amount;?></h3>
                  <p>Payouts</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo base_url('admin/instantKyc?role=payout'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-primary">
                <div class="inner">
                  <h3><?php echo 0 + $instantApproved; ?></h3>
                  <p>Approved </p>
                </div>
                <div class="icon">
                  <i class="fa fa-thumbs-up"></i>
                </div>
                <a href="<?php echo base_url('admin/instantKyc?role=approved'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
              <div class="small-box h-100 bg-danger">
                <div class="inner">
                  <h3><?php echo 0 + $instantRejected; ?></h3>
                  <p>Rejected </p>
                </div>
                <div class="icon">
                  <i class="fa fa-ban"></i>
                </div>
                <a href="<?php echo base_url('admin/instantKyc?role=rejected'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
      <?php }?>
      
    </div>
  </section>
</div>
</div>
<!-- Auto Open Modal -->
<!-- Advertise Modal -->
<div class="modal fade" id="advertiseModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 30px rgba(0,0,0,0.2);">
            <!-- Modal Header with Close Button -->
            <div class="modal-header" style="border: none; padding: 15px 20px; background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); color: white;">
                <h5 class="modal-title" style="font-weight: 600; font-size: 1.5rem;">Special Offer! 🎉</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Modal Body with Ad Content -->
            <div class="modal-body" style="padding: 25px;">
                <div class="text-center mb-4">
                    <i class="fas fa-gift fa-4x mb-3" style="color: #4e73df;"></i>
                    <h4 style="color: #2c3e50; font-weight: 600;">Exclusive Deal Just For You!</h4>
                </div>
                
                <div class="text-center mb-4">
                    <?= $notification['content']?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
 $teams_parent = $this->db->get_where('user_master', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
  if (empty($teams_parent)) {
  $teams_parent = $this->db->get_where('branch_franchise', ['id' => $this->session->userdata('user_id'),'role' => $this->session->userdata('role')])->row_array();
  }
?>
<script>
$(document).ready(function() {
    $('.col-md-10').addClass('dashboardBackground');
    <?php if (!empty($notification)) { ?>
    $('#advertiseModal').modal('show');
    <?php } ?>
});
</script>