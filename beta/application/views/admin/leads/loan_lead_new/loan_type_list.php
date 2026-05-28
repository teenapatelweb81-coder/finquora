
<style>
    .h4 {
        font-size : 15px !important;
    }
</style>


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Loan Type List</li>
           </ol>
         </nav>
</div>
<div class="container">
   
<form action="bank-criteria-update" method="post" id="form_d">
    <div class="row">
    <div class="col-md-12">
	 <section class="content">
	  <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- <div class="row">
            <div class="col-md-4">
                <div _ngcontent-wsc-c195="" class="form-group">
                    <select _ngcontent-mir-c194="" id="loan_id" required name="loan_id" class="form-control input-lg ng-valid ng-dirty ng-touched">
                        <option _ngcontent-mir-c194="" value="0">Select loan</option>
                        <?php foreach($loan_data as $loan) { ?>
                            <option _ngcontent-mir-c194="" value="<?=$loan->id?>"><?= $loan->loan_name?></option>
                            
                        <?php } ?>
                        
                    </select>
                </div>
                
            </div>
            <div class="col-md-4 ">
                <div _ngcontent-wsc-c195="" class="form-group">
                    <select _ngcontent-mir-c194="" id="bank_id" name="bank_id" required class="form-control input-lg ng-pristine ng-valid ng-touched" >
                        <option _ngcontent-mir-c194="" value="0">Select Bank</option>
                       <?php foreach($bank_data as $bank) { ?>
                            <option _ngcontent-mir-c194="" value="<?=$bank->id?>"><?=$bank->bank_name?></option>
                            
                        <?php } ?>
                    </select>
                </div>
                
            </div>
            
        </div> -->
      </div>
	     
      <div class="container-fluid">
         <div _ngcontent-mir-c194="" class="col-xl-12 order-xl-1 pt-3 ng-star-inserted">
   <div _ngcontent-mir-c194="" class="card bg-secondary shadow ng-star-inserted">
      <!-- <div _ngcontent-mir-c194="" class="card-header bg-white border-0">
         <div _ngcontent-mir-c194="" class="row align-items-center">
            <div _ngcontent-mir-c194="" class="col-12">
               <h3 _ngcontent-mir-c194="" class="mb-0">Bank Eligibility Criteria</h3>
            </div>
         </div>
      </div> -->
      <div _ngcontent-mir-c194="" class="card-body">
         <mat-grid-list _ngcontent-mir-c194="" cols="2" rowheight="2:1">
          
            <mat-grid-tile _ngcontent-mir-c194="">
               <div _ngcontent-mir-c194="" class="col-md-12">
                  <div _ngcontent-mir-c194="" class="row">
                     <div _ngcontent-mir-c194="" class="col-sm-3"><label _ngcontent-mir-c194=""> Bank Name :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" ><input type="text" id='name' value="<?= $data->bank_name?>" class="form-control w-75 mb-3 voter" disabled>
                    </div>
                  </div>
                  <div _ngcontent-mir-c194="" class="row">
                     <div _ngcontent-mir-c194="" class="col-sm-3"><label _ngcontent-mir-c194=""> Loan Type  :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" ><input type="text" id='number' value="<?= $data->loan_type?>" class="form-control w-75 mb-3 voter" disabled>
                    </div>
                  </div>

                  <div _ngcontent-mir-c194="" class="row">
                     <div _ngcontent-mir-c194="" class="col-sm-3"><label _ngcontent-mir-c194=""> Link  :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" ><input type="text" id='number' value="<?= $data->link?>" class="form-control w-75 mb-3 voter" disabled>
                    </div>
                  </div>
                  
                  <div _ngcontent-mir-c194="" class="row">
                     <div _ngcontent-mir-c194="" class="col-sm-3"><label _ngcontent-mir-c194="">Description :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" ><input disabled type="text" id="amt" name="loan_amount" value="<?= $data->descriptions?>" class="form-control w-75 mb-3 voter"></div>
                  </div>

                  <div _ngcontent-mir-c194="" class="row">
                     <div _ngcontent-mir-c194="" class="col-sm-3"><label _ngcontent-mir-c194=""> Image  :</label></div>
                     <div _ngcontent-mir-c194="" class="col-sm-6 h4 font-weight-bold mb-0" ><img src="<?= base_url('')?><?= $data->image?>" width="150px">
                    </div>
                  </div>

                 
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
    </section>
        </div>
    </div>
</div>



