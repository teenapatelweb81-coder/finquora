
 <?php $silver = $this->db->where('domain_id', domain_id_get())->get('silver_section_1')->row_array();
  $platinum = $this->db->where('domain_id', domain_id_get())->get('plantinum_section_1')->row_array();
$domain_id = domain_id_get();
$contectUs = $this->db->where('domain_id',$domain_id)->get('contect_us')->row_array();
?>
<style>
    body {
  /* display: flex;
  justify-content: center;
  align-items: center; */
  font-family:sans-serif;
 
}
/* .credit-card { 
    width: 38%;margin:0 auto;    height: 70%;
} */
.cardhyt {
    padding:20px;
    position: relative;
}
.com_icon{
    /* background-image:url('upload/assets/images/card.jpg'); */
    background: <?php echo !empty($cardColor['background_color']) ? $cardColor['background_color'] : base_url('beta/assets/images/plantinumBanner/default.jpg'); ?>;
    /* padding: 20px; */
    background-size: cover;
    width: 100%;
    height: 269px;
    border-radius: 6px;
    top:0px;
    left: 0;
}


.cardhyt {
    background: url('<?php echo isset($cardColor['image']) && !empty($cardColor['image']) ? base_url('beta/assets/images/plantinumBanner/') . $cardColor['image'] : base_url('beta/assets/images/plantinumBanner/default.jpg'); ?>');
}
.cardhyt{
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.cardNumber{
    font-size: 31px;
    margin: 0px 0px 0px 10px;
}
@media screen and (max-width: 768px) {
    .cardNumber{
        font-size: 21px;
    }
}

  </style>
<?php if(isset($user) && $user['status'] == 1) { ?>
        <div class="row justify-content-center align-items-center m-0">
            <div class="credit-card col-md-6 col-lg-4 col-xl-4 col-12">
                <div class="card cardhyt"> 
                    <div class="com_icon">
                        <div class="imgdiv">
                            <img src="<?= base_url('beta/assets/images/logo/' . (isset($contectUs['logo']) && !empty($contectUs['logo']) ? $contectUs['logo'] : '')) ?>" alt="Logo" style=" object-fit: contain; " height="60px" width="160px">
                        </div>
                        <div style="height: 30px;"></div>
                        <div class="num">
                            <?php
                                // Ensure both variables are arrays before accessing
                                $user = is_array($user) ? $user : [];
                                $cardColor = is_array($cardColor) ? $cardColor : [];

                                // Get safe values
                                $cardNumber = isset($user['card_number']) ? $user['card_number'] : (isset($user['card_no']) ? $user['card_no'] : '');
                            
                                $cardTextColor =  (isset($cardColor['card_text_color'])) ? $cardColor['card_text_color'] : '#000000' ;

                                if (!empty($cardNumber)) {
                                    // Remove spaces and chunk into groups of 4 digits
                                    $arr = str_split(str_replace(' ', '', $cardNumber), 4);
                                    ?>
                                    <h2 class="cardNumber" style=" color: <?= htmlspecialchars($cardTextColor) ?>;">
                                        <?= implode(' ', $arr); ?>
                                    </h2>
                                <?php } ?>



                            <?php 
                                $userCreatedDate = '';
                                if (!empty($user) && is_array($user) && !empty($user['created_on'])) {
                                    $userCreatedDate = $user['created_on'];
                                }

                                $detailsTextColor = isset($cardColor['details_text_color']) ? $cardColor['details_text_color'] : '#000000'; // default black
                                ?>

                                <?php if (!empty($userCreatedDate)): ?>
                                    <p style="font-weight: 600; margin: 5px 10px; font-size: 15px; color: <?= htmlspecialchars($detailsTextColor) ?>;">
                                        <?php 
                                        if ($this->session->userdata('role') == 2) {
                                            $plan = $this->db->where('domain_id',$domain_id)->where('plan_type',2)->where('status',1)->get('plan_tbl')->row_array();
                                        }elseif ($this->session->userdata('role') == 3) {
                                            $plan = $this->db->where('domain_id',$domain_id)->where('plan_type',3)->where('status',1)->get('plan_tbl')->row_array();
                                        }else{
                                            $plan = $this->db->where('domain_id',$domain_id)->where('plan_type',1)->where('status',1)->get('plan_tbl')->row_array();
                                        }
                                        ?>
                                       VALID FROM <span style="font-size: 18px;"> <?php echo !empty($plan['validity']) ? strtoupper($plan['validity']) : ''; ?></span>
                                        <!-- <?= date('d/m/Y', strtotime($userCreatedDate)) ?>
                                        TO <?= date('d/m/Y', strtotime("$userCreatedDate +2 years")) ?> -->
                                    </p>
                                <?php else: ?>
                                    <!-- <p style="font-weight: 600; margin: 5px 10px; font-size: 15px; color: <?= htmlspecialchars($detailsTextColor) ?>;">
                                        VALIDITY LIFETIME
                                    </p> -->
                                <?php endif; ?>


                            <h4 style="margin: 11px 10px; color: <?= (isset($cardColor['card_text_color'])) ? $cardColor['card_text_color'] : '#000000' ; ?>;">Name: <span style="text-transform: capitalize;">
                                <?= !empty($user['username']) ? $user['username'] : ''; ?>
                            </span></h4>
                        </div>
                    </div>
                </div>
                <p class="lead text-center">
                    <a class="btn btn-primary btn-sm" href="<?= base_url(); ?>" role="button">Continue to Website</a>
                </p>
            </div>
        </div>
    <?php } ?>
  <script>

  </script>