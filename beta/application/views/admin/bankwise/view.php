
<style>
    .h4 {
        font-size : 15px !important;
    }
    .row{
      background: unset !important;
    }
</style>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Bankwise-Eligibility</li>
            </ol>
         </nav>
</div>
<div class="container-fluid px-0">
   
<form action="bank-criteria-update" method="post" id="form_d">
	  <div class="container-fluid px-0">
        <!-- Small boxes (Stat box) -->
        <div class="row m-0">
            <div class="col-md-4 mb-2 pl-0">
                <div _ngcontent-wsc-c195="" class="form-group mb-0">
                    <select _ngcontent-mir-c194="" id="loan_id" required name="loan_id" class="form-control input-lg ng-valid ng-dirty ng-touched">
                        <option _ngcontent-mir-c194="" value="0">Select loan</option>
                        <?php foreach($loan_data as $loan) { ?>
                            <option _ngcontent-mir-c194="" value="<?=$loan->id?>"><?= $loan->loan_name?></option>
                            
                        <?php } ?>
                        
                    </select>
                </div>
                
            </div>
            <?php
            if ($this->session->userdata('type') == 'admin') { ?>
                  <div class="col-md-4 mb-2">
                        <select class="form-control" id="domain_id" required name="domain_id">
                           <option _ngcontent-mir-c194="" value="0">Select Domain</option>
                           <?php foreach ($domains as $domain) { ?>
                              <option value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                           <?php } ?>
                        </select>
                  </div>
            <?php }else{?>
               <input type="hidden" name="domain_id"  class="form-control" value="<?= domain_id_get() ?>" >
            <?php }?>     
            <div class="col-md-4 mb-2 pr-0">
                <div _ngcontent-wsc-c195="" class="form-group mb-0">
                    <select _ngcontent-mir-c194="" id="bank_id" name="bank_id" required class="form-control input-lg ng-pristine ng-valid ng-touched" >
                        <option _ngcontent-mir-c194="" value="0">Select Bank</option>
                       <?php foreach($bank_data as $bank) { ?>
                            <option _ngcontent-mir-c194="" value="<?=$bank->id?>"><?=$bank->bank_name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            
        </div>
      </div>
	     
      <div class="container-fluid px-0">
         <div _ngcontent-mir-c194="" class="col-xl-12 order-xl-1 px-0 ng-star-inserted">
   <div _ngcontent-mir-c194="" class="card bg-secondary shadow ng-star-inserted">
      <div _ngcontent-mir-c194="" class="card-header bg-white border-0">
         <div _ngcontent-mir-c194="" class="row align-items-center">
            <div _ngcontent-mir-c194="" class="col-12">
               <h3 _ngcontent-mir-c194="" class="mb-0">Bank Eligibility Criteria</h3>
            </div>
         </div>
      </div>
      <div _ngcontent-mir-c194="" class="card-body">
         <mat-grid-list _ngcontent-mir-c194="" cols="2" rowheight="2:1">
          
            <mat-grid-tile _ngcontent-mir-c194="">
               <div _ngcontent-mir-c194="" class="col-md-12">
                  <div _ngcontent-mir-c194="" class="row">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Product :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" ><input type="text" id='loname' value="" class="form-control w-75 mb-3 voter"></div>
                  </div>
                  <div _ngcontent-mir-c194="" class="row">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Bank :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" ><input type="text" id='bname' value="" class="form-control w-75 mb-3 voter"></div>
                  </div>
                  <div _ngcontent-mir-c194="" class="row">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Loan Amount :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" ><input type="text" id="amt" name="loan_amount" value="" class="form-control w-75 mb-3 voter"></div>
                  </div>
                  <div _ngcontent-mir-c194="" class="row">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Age : </label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" id=""><input type="text" id='age' name="age" value="" class="form-control w-75 mb-3 voter"></div>
                  </div>
                  <div _ngcontent-mir-c194="" class="row ng-star-inserted">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Interest Rate:</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" id=""><input type="text" id='rate' name="interest_rate" value="" class="form-control w-75 mb-3 voter"></div>
                  </div>
                  
               </div>
            </mat-grid-tile>
            <mat-grid-tile _ngcontent-mir-c194="">
               <div _ngcontent-mir-c194="" class="col-md-12">
                  <div _ngcontent-mir-c194="" class="row ng-star-inserted">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Credit Score :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" id=""><input type="text" id='score' name="credit_score" value="" class="form-control w-75 mb-3 voter"></div>
                  </div>
                  <!---->
                  <div _ngcontent-mir-c194="" class="row ng-star-inserted">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Salary By Cheque :</label></div>
                     <!---->
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0 ng-star-inserted" id=""><input type="text" name="salary_by_cheque" id='sal_cheque' value="" class="form-control w-75 mb-3 voter"></div>
                     <!---->
                  </div>
                  <!---->
                  <div _ngcontent-mir-c194="" class="row ng-star-inserted">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Salary Direct Credit To Bank Account :</label></div>
                     <!---->
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0 ng-star-inserted" id=""><input type="text" id='sal_cre_acc' value="" name="salary_credit_bank" class="form-control w-75 mb-3 voter"></div>
                     <!---->
                  </div>
                  <!---->
                  <div _ngcontent-mir-c194="" class="row ng-star-inserted">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Salary In Cash :</label></div>
                     <!---->
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0 ng-star-inserted" id=""><input type="text" id='sal_cash' value="" name="salary_in_cash" class="form-control w-75 mb-3 voter">
                  <input type="hidden" id='id' value="" name="id" class="form-control w-75 mb-3 voter">
                  </div>
                     <!---->
                  </div>
                  <!----><!----><!---->
                  <div _ngcontent-mir-c194="" class="row ng-star-inserted">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194="">Processing Fees :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" id=""><input type="text" required id='processing' name="Processing_fees" value="" class="form-control w-75 mb-3 voter"></div>
                  </div>
                    <?php if($this->session->userdata('role') == 1) { ?>
                  <div _ngcontent-mir-c194="" class="row ng-star-inserted">
                     <div _ngcontent-mir-c194="" class="col-sm-6"><label _ngcontent-mir-c194=""></label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" >
                        <button type="submit" class="btn btn-primary" id="criteriaUpdate"> Submit</button></div>
                  </div>
                  <?php }?>
                  <!----><!---->
               </div>
            </mat-grid-tile>
            <!--<mat-grid-tile _ngcontent-mir-c194="">-->
               <!---->
            <!--</mat-grid-tile>-->
            <!--<mat-grid-tile _ngcontent-mir-c194="">-->
               <!----><!----><!---->
            <!--</mat-grid-tile>-->
         </mat-grid-list>
      </div>
      
               </form>
   </div>
   <!---->
   <div _ngcontent-mir-c194="">
      <div _ngcontent-mir-c194="" class="mt-4">
         <div _ngcontent-mir-c194="" class="row">
            <!----><!---->
         </div>
      </div>
   </div>

</div>
        
      </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>  
$('select').on('change', function() {
    var loan_id= $("#loan_id option:selected").val();
    var bank_id= $("#bank_id option:selected").val();
    var domain_id= $("#domain_id option:selected").val();

      if (!domain_id) {
         domain_id = $("input[name='domain_id']").val();
      }
    
    if(loan_id > 0 &&  bank_id > 0) {
         $.ajax({
              type:'POST',
              url:'bank-criteria',
              data:{'loan_id':loan_id, 'bank_id':bank_id,'domain_id':domain_id},
              success:function(result) {
                var obj = JSON.parse(result);
                if(jQuery.isEmptyObject(obj.data)) {
                  //   $('#form_d').trigger('reset');
                     $('#bname').val('');
                     $('#amt').val('');
                     $('#age').val('');
                     $('#rate').val('');
                     $('#score').val('');
                     $('#sal_cheque').val('');
                     $('#sal_cre_acc').val('');
                     $('#sal_cash').val('');
                     $('#processing').val('');
                }
                else {
                    
                 $('#loname').val(obj.data[0].loan_id);
                 $('#id').val(obj.data[0].id);
                 $('#bname').val(obj.data[0].bank_id);
                 $('#amt').val(obj.data[0].loan_amount);
                 $('#age').val(obj.data[0].age);
                 $('#rate').val(obj.data[0].interest_rate);
                 $('#score').val(obj.data[0].credit_score);
                 $('#sal_cheque').val(obj.data[0].salary_by_cheque);
                 $('#sal_cre_acc').val(obj.data[0].salary_credit_bank);
                 $('#sal_cash').val(obj.data[0].salary_in_cash);
                 $('#processing').val(obj.data[0].Processing_fees);
                 $('#update_btn').html("");
                }
              },
              error: function(){
                 alert("server errror");
                
              }
          });
        
    }
       
});

</script> 

