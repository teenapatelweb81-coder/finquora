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



/*body {*/

/*  background: #f2f8ff;*/

/*  color: #263238;*/

/*  font-family: 'Noto Sans', sans-serif;*/

/*  margin: 0;*/

/*  padding: 2em 6vw;*/

/*}*/



.grid {

  display: grid;

  grid-gap: var(--card-padding);

  margin: 0 auto;

  max-width: 60em;

  padding: 0;

 

  @media (min-width: 42em) {

    grid-template-columns: repeat(3, 1fr);

  }

}



.card {

  width: 100%;

  background: #fff;

  border-radius: var(--card-radius);

  position: relative;

  

  &:hover {

    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);

  }

}



.radio {

  font-size: inherit;

  margin: 0;

  position: absolute;

  right: calc(var(--card-padding) + var(--radio-border-width));

  top: calc(var(--card-padding) + var(--radio-border-width));

}



.radio input[type=radio]:checked + label:after {

 

  background: "green";

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

  background:var(--color-green);

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

.container {

    display: flex;

  justify-content: center;

}

.payment {

    padding-left: 46%;

}

</style>

        <section>

            <div class="container">

                <?php echo form_open('/admin/network-member-payment',array('method'=>'post'));?>

                    <div class="row">

                        <div class="col-md-6">

                            <label class="card">

                            <input name="plan" class="radio" type="radio" value="<?php echo $data[0]->plan_name;?>">

                            <span class="hidden-visually">Silver</span>

                            <span class="plan-details" aria-hidden="true">

                              <span class="plan-type">Silver</span>

                              <span class="plan-cost"><?php echo $data[0]->amount;?>₹

                              <!--<span class="slash">/</span><span class="plan-cycle">mo</span>-->

                              </span>

                              <span>Pay out structure -Normal </span>

                              <span>ILD digital platfrom access- Advance</span>

                              <span>Connecter model -Yes</span>

                              <span> My team access-Yes</span>

                              <!--<span>Own UTM Link : Yes</span>-->

                              <!--<span>Branding with Your Logo & UTM Link : Yes</span>-->

                              <!--<span>Monthly Fees Rs. : 299</span>-->

                              <!--<span>12 Months Fees Rs. : 3588</span>-->

                              <!--<span>Discount On 12 Months Upfront Payment Rs. : 589</span>-->

                              <!--<span>Your Pay Rs. : Rs. 2999</span>-->

                            </span>

                          </label>      

                        </div>

                        <div class="col-md-6">

                            <label class="card">

                            <input name="plan" class="radio" type="radio" value="<?php echo $data[0]->plan2_name;?>">

                            <span class="hidden-visually">PLATINUM</span>

                            <span class="plan-details" aria-hidden="true">

                              <span class="plan-type">PLATINUM</span>

                              <span class="plan-cost"><?php echo $data[0]->amount2;?>₹

                              <!--<span class="slash">/</span><span class="plan-cycle">mo</span>-->

                              </span>

                              <span>Pay out structure -Advance</span>

                              <span>ILD digital platfrom access- Advance</span>

                              <span>Connecter model -Yes</span>

                              <span>My team access-Yes </span>

                              <span>Own UTM Link- Yes </span>

                              <span>Branding with your logo & UTM Link-Yes</span>

                              <span>Earn up to 30% Referral Pay - Out Bonus</span>

                              <!--<span>Monthly Fees Rs. : 499</span>-->

                              <!--<span>12 Months Fees Rs. : 5988</span>-->

                              <!--<span>Discount On 12 Months Upfront Payment Rs. : 989</span>-->

                              <!--<span>Your Pay Rs. : Rs. Rs. 4999</span>-->

                            </span>

                          </label>      

                            

                        </div>

                      

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

 

  