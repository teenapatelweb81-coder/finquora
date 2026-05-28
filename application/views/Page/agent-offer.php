 <?php $silver = $this->db->where('domain_id', domain_id_get())->get('silver_section_1')->row_array();
//  print_r($silver );
  $platinum = $this->db->where('domain_id', domain_id_get())->get('plantinum_section_1')->row_array();
  $paid_status = $this->db->where('id', domain_id_get())->get('domains')->row_array();
  $card_color = $this->db->where('domain_id', domain_id_get())->get('card_color')->row_array();
  ?>
<style>


 :root {

  --card-line-height: 1.2em;

  --card-padding: 1em;

  --card-radius: 0.5em;

  --color-green: #558309;

  --color-gray: #e2ebf6;

  --color-dark-gray: #c4d1e1;

  --radio-border-width: 2px;

  --radio-size: 1.5em;

}

.grid {

  display: grid;

  grid-gap: var(--card-padding);

  margin: 0 auto;

  max-width: 60em;

  padding: 0;
}

 

  @media (min-width: 42em) {
.grid {
    grid-template-columns: repeat(3, 1fr);

  }

}



.card {

  width: 100%;

  background-color: #fff;

  border-radius: var(--card-radius);

  position: relative;
}
  

  .card:hover {

    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);

  }





.radio {

  font-size: inherit;

  margin: 0;

  position: absolute;

  right: calc(var(--card-padding) + var(--radio-border-width));

  top: calc(var(--card-padding) + var(--radio-border-width));

}



.radio input[type=radio]:checked + label:after {

 

  background-color: "green";

}



@supports(-webkit-appearance: none) or (-moz-appearance: none) { 

  .radio {

    -webkit-appearance: none;

    -moz-appearance: none;

    background: #fff;

    border: var(--radio-border-width) solid var(--color-gray);

    border-radius: 50%;

    cursor: pointer;

    height: var(--radio-size);

    outline: none;

    transition: 

      background 0.2s ease-out,

      border-color 0.2s ease-out;

    width: var(--radio-size); 



    &::after {

      border: var(--radio-border-width) solid #fff;

      border-top: 0;

      border-left: 0;

      content: '';

      display: block;

      height: 0.75rem;

      left: 25%;

      position: absolute;

      top: 50%;

      transform: 

        rotate(45deg)

        translate(-50%, -50%);

      width: 0.375rem;

    }



    &:checked {

      background: var(--color-green);

      border-color: var(--color-green);

      

    }

  }

  

  .card:hover .radio {

    border-color: var(--color-dark-gray);

    

    &:checked {

      border-color: var(--color-green);

      

    }

  }

}



.plan-details {

  border: var(--radio-border-width) solid var(--color-gray);

  border-radius: var(--card-radius);

  cursor: pointer;

  display: flex;

  flex-direction: column;

  padding: var(--card-padding);

  transition: border-color 0.2s ease-out;

}



.card:hover .plan-details {

  border-color: var(--color-dark-gray);

}



.radio:checked ~ .plan-details {

  border-color: var(--color-green);

  background-color :var(--color-green);

}



.radio:focus ~ .plan-details {

  box-shadow: 0 0 0 2px var(--color-dark-gray);

}



.radio:disabled ~ .plan-details {

  color: var(--color-dark-gray);

  cursor: default;

}



.radio:disabled ~ .plan-details .plan-type {

  color: var(--color-dark-gray);

}



.card:hover .radio:disabled ~ .plan-details {

  border-color: var(--color-gray);

  box-shadow: none;

}



.card:hover .radio:disabled {

    border-color: var(--color-gray);

  }



.plan-type {

  color: var(--color-green);

  font-size: 1.5rem;

  font-weight: bold;

  line-height: 1em;

}



.plan-cost {

  font-size: 2.5rem;

  font-weight: bold;

  padding: 0.5rem 0;

}



.slash {

  font-weight: normal;

}



.plan-cycle {

  font-size: 2rem;

  font-variant: none;

  border-bottom: none;

  cursor: inherit;

  text-decoration: none;

}



.hidden-visually {

  border: 0;

  clip: rect(0, 0, 0, 0);

  height: 1px;

  margin: -1px;

  overflow: hidden;

  padding: 0;

  position: absolute;

  white-space: nowrap;

  width: 1px;

}

.agent_container {

  display: flex;

  justify-content: center;

}

.payment {

    padding-left: 46%;

}
.credit-card {
    margin: 0 auto;
}
.cardss {
    padding:20px;
    position: relative;
}
.card img{
    height: 19%;
    border-radius: 25px;
}
.com_icon ,.com_icon_platinum {
    background: url('<?php echo isset($card_color['image']) && !empty($card_color['image']) ? base_url('beta/assets/images/plantinumBanner/') . $card_color['image'] : base_url('beta/assets/images/plantinumBanner/default.jpg'); ?>');
}
.com_icon,.com_icon1{
    color:#ffffffba;
    padding: 20px;
    background-size: cover;
    width: 100%;
    border-radius: 6px;
    top:0px;
    left: 0;
  }
.com_icon2{
   color:<?= (isset($card_color['details_text_color'])) ? $card_color['details_text_color'] : '' ; ?>;
    font-size: 12px !important;
}


</style>

        <section>

            <div class="container agent_container">

                <?php echo form_open('/agentpayment',array('method'=>'post'));?>

                    <div class="row">
                        <div class="col-md-6 22">
                          <div class="credit-card">
                              <div class="card"> 
                                <div class="com_icon">
                                  <div class="" style="font-size: 22px;font-weight: 600;color:<?= (isset($card_color['card_text_color'])) ? $card_color['card_text_color'] : '' ; ?>;" ><?= (isset($silver['card_name'])) ? $silver['card_name'] : '' ; ?></div>
                                    <div class="imgdiv">
                                      <?php
                                          $domain_id = domain_id_get();
                                          $contectUs = $this->db->where('domain_id',$domain_id)->get('contect_us')->row_array();
                                      ?>
                                      <img src="<?= base_url('beta/assets/images/logo/' . (isset($contectUs['logo']) && !empty($contectUs['logo']) ? $contectUs['logo'] : '')) ?>" alt="000" srcset="" width="200px">
                                    </div>
                                      <div class="div" style="height: 26px;"></div>
                                      <div class="num">
                                          <h2 style=" font-size: 31px;margin: 0px 0px 0px 10px;"class="com_icon2"><?= (isset($silver['card_no'])) ? $silver['card_no'] : '' ; ?></h2>
                                          <p style="font-weight: 600; margin: 5px 10px; font-size:15px; "class="com_icon2"><?= (isset($silver['validity'])) ? $silver['validity'] : '' ; ?></p>
                                          <h4 style="margin: 11px 10px; "class="com_icon2">NAME</h4>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <label class="card card-details-color">
                              <input name="plan" class="radio" type="radio" value="<?= (isset($data[0]->plan_name)) ? $data[0]->plan_name : '' ; ?>">
                              <span class="hidden-visually"><?= (isset($silver['card_name'])) ? $silver['card_name'] : '' ; ?></span>
                              <span class="plan-details p-3 p-3" aria-hidden="true">
                                <span class="plan-type">Silver</span>
                                <span class="plan-cost"><?= (isset($data[0]->amount)) ? $data[0]->amount : 0 ; ?>₹</span>
                                <span >Valid For <?= (isset($data[0]->validity)) ? $data[0]->validity : '' ; ?></span>
                                <p><?= (isset($silver['card_plan'])) ? $silver['card_plan'] : '' ; ?></p>
                              </span>
                          </label>    
                        </div>
                        <div class="col-md-6 22">
                          <div class="credit-card">
                            <div class="card"> 
                              <div class="com_icon com_icon_platinum">
                                <div class=""style="font-size: 22px;font-weight: 600; <?= (isset($platinum['card_text_color'])) ? $platinum['card_text_color'] : '' ; ?>" ><?= (isset($platinum['card_name'])) ? $platinum['card_name'] : '' ; ?></div>
                                  <div class="imgdiv">
                                    <?php
                                        $domain_id = domain_id_get();
                                        $contectUs = $this->db->where('domain_id',$domain_id)->get('contect_us')->row_array();
                                    ?>
                                    <img src="<?= base_url('beta/assets/images/logo/' . (isset($contectUs['logo']) && !empty($contectUs['logo']) ? $contectUs['logo'] :'')) ?>" alt="000" srcset="" width="200px">
                                  </div>
                                    <div class="div" style="height: 26px;"></div>
                                    <div class="num">
                                        <h2 style=" font-size: 31px;margin: 0px 0px 0px 10px;"class="com_icon2"><?= (isset($platinum['card_no'])) ? $platinum['card_no'] : '' ; ?></h2>
                                        <p style="font-weight: 600; margin: 5px 10px; font-size:15px; "class="com_icon2"><?= (isset($platinum['validity'])) ? $platinum['validity'] : '' ; ?></p>
                                        <h4 style="margin: 11px 10px; "class="com_icon2">NAME</h4>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <label class="card">
                            <input name="plan" class="radio" type="radio" value="<?= (isset($data[0]->plan2_name)) ? $data[0]->plan2_name : '' ; ?>">
                            <span class="hidden-visually"><?= (isset($platinum['card_name'])) ? $platinum['card_name'] : '' ; ?></span>
                            <span class="plan-details p-3" aria-hidden="true">
                              <span class="plan-type"><?= (isset($platinum['card_name'])) ? $platinum['card_name'] : '' ; ?></span>
                              <span class="plan-cost"><?= (isset($data[0]->amount2)) ? $data[0]->amount2 : 0 ; ?> ₹ </span>
                              <span >Valid For <?= (isset($data[0]->validity)) ? $data[0]->validity : '' ; ?></span>
                              <p><?= (isset($platinum['card_plan'])) ? $platinum['card_plan'] : '' ; ?></p>
                          </label> 
                        </div>

                      <?php  if($paid_status['payment_status'] == 'free'){?>
                      <div class="col-md-6">
                            <label class="card">
                              <input name="plan" class="radio" type="radio" value="silver_free">
                              <span class="hidden-visually">Silver</span>
                              <span class="plan-details p-3 p-3" aria-hidden="true">
                                <span class="plan-type">Silver</span>
                                <span class="plan-cost">Free</span>
                                <p><?= (isset($silver['free_card_plan'])) ? $silver['free_card_plan'] : '' ; ?></p>
                              </span>
                          </label> 
                        </div>
                        
                        <div class="col-md-6">
                            <label class="card">
                              <input name="plan" class="radio" type="radio" value="platinum_free">
                              <span class="hidden-visually">Platinum</span>
                              <span class="plan-details p-3 p-3" aria-hidden="true">
                                <span class="plan-type">Platinum</span>
                                <span class="plan-cost">Free</span>
                                <p><?= (isset($platinum['free_card_plan'])) ? $platinum['free_card_plan'] : '' ; ?></p>
                              </span>
                          </label> 
                        </div>
                    <?php }?>
                    </div>

                    <div class="row">

                        

                        <div class="payment">

                            <input type="submit" name="Pay" value="Pay Now" class="btn btn-primary" />

                            

                        </div>

                        

                    </div>

                 <?php echo form_close();?>

            </div>

        </section>

  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

   <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

  <script src="http://code.jquery.com/jquery-3.0.0.min.js"></script>

 

  