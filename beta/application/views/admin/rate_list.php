<?php include viewPath('includes/header'); 
$seg_id = $this->uri->segment(2);

// $b = $this->db->get('company')->row_array();
// echo '<pre>';print_r($prduct_surcharge);die;
?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>


<section class="content">

 

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          <?php 
           $b = $this->db->where('id',$_GET['product'])->get('products')->row_array();
          ?>
            <h3 class="box-title">New Company Rate (<?= $b['name']?>) (<?= $_GET['type']?>)</h3>

            <div class="box-tools pull-right">
            <a href="<?php echo url('company') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to Company</a>
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">        
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
    <form class="main_form" action ="<?= base_url('company/addProduct2')?>" method="post">
      <?php 
     $data = $this->db->where('company_id',$seg_id)->get('company')->row_array();
    //  $customer_type_id = $data['type1'];
      ?>

    <input type="hidden" class="form-control" name="product_id" id="product_id"  placeholder="Code" value='<?= $_GET['product']; ?>' />
    <input type="hidden" class="form-control" name="customer_id" id="customer_id"  placeholder="Code" value='<?= $seg_id?>' />
    <input type="hidden" class="form-control" name="shipment_type" id="shipment_type"  placeholder="Code" value='<?= $_GET['type']?>' />
    <input type="hidden" class="form-control" name="customer_type_id" id="customer_type_id"  placeholder="Code" value='<?= $_GET['customer']?>' />

    <div class="">
        <div >
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fule Charges </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                           <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 form-group">
                                <div class="form-check form-check-inline">
                                      <input class="form-check-input " name="product_id" type="hidden" value="<?= $_GET['product']?>">
                                      
                                      <input class="form-check-input " type="checkbox" id="all_select" onclick="selectAllCheckboxes()">
                                      <label class="form-check-label" for="all_select" id="select-all-checkbox" >Select All</label>
                                    </div><br>
                                    <input type="hidden" name="company_id" class="form-control" id="company_id" value="<?php if(isset($product_fule['customer_id'])){ $product_fule['customer_id']; } ?>">
                                    <?php //echo '<pre>';print_r($vendor_data);die; ?>
                                  <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" <?php if(isset($product_fule['f_amount'])){ if($product_fule['f_amount'] == 1){ ?>checked <?php } }?> type="checkbox" id="f_amount" name="f_amount" value="1">
                                      <label class="form-check-label" for="f_amount">Amount</label>
                                    </div><br>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" <?php if(isset($product_fule['f_covid'])){if($product_fule['f_covid'] == 1){ ?>checked <?php }} ?> id="f_covid" name="f_covid" value="1">
                                      <label class="form-check-label" for="f_covid">Covid Charges</label>
                                    </div><br>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" <?php if(isset($product_fule['f_restrictied'])){if($product_fule['f_restrictied'] == 1){ ?>checked <?php }} ?> id="f_restrictied" name="f_restrictied" value="1" >
                                      <label class="form-check-label" for="f_restrictied">Restricted Country Charge</label>
                                    </div><br>

                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" <?php if(isset($product_fule['f_commercial'])){if($product_fule['f_commercial'] == 1){ ?>checked <?php }} ?> id="f_commercial" name="f_commercial" value="1" >
                                      <label class="form-check-label" for="f_commercial">Commercial Charge</label>
                                    </div><br>

                                  <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" id="f_oversize_w" name="f_oversize_w" value="1"   <?php if(isset($product_fule['f_oversize_w'])){if($product_fule['f_oversize_w'] == 1){ ?>checked <?php }} ?> >
                                     
                                      <label class="form-check-label" for="f_oversize_w">NON STANDARD(Weight)(Oversize)</label>
                                    </div><br>

                                     <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" id="f_oversize_d" name="f_oversize_d" value="1" <?php if(isset($product_fule['f_oversize_d'])){if($product_fule['f_oversize_d'] == 1){ ?>checked <?php }} ?> >
                                      <label class="form-check-label" for="f_oversize_d">NON STANDARD ( Dimension ) (Oversize) ( CHARGES - PER PC WISE )</label>
                                    </div><br>

                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" <?php if(isset($product_fule['f_ddp'])){if($product_fule['f_ddp'] == 1){ ?>checked <?php }} ?> id="f_ddp" name="f_ddp" value="1" >
                                      <label class="form-check-label" for="f_ddp">DDP(Duty Delivery Paid)</label>
                                    </div><br>

                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" <?php if(isset($product_fule['f_amount'])){if($product_fule['f_nonstakable'] == 1){ ?>checked <?php }} ?> id="f_nonstakable" name="f_nonstakable" value="1" >
                                      <label class="form-check-label" for="f_nonstakable">NON -STACKABLE(Fragile)</label>
                                    </div><br>

                                    <!-- <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" id="fule_charge" name="fule_charge" value="1" >
                                      <label class="form-check-label" for="fule_charge">Other Charges(with Fuel Charges)</label>
                                    </div><br> -->

                                    <!-- <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" <?php if(isset($product_fule['f_amount'])){if($product_fule['f_oversize_w'] == 1){ ?>checked <?php }} ?> id="f_oversize_w" name="f_oversize_w" value="1" >
                                      <label class="form-check-label" for="f_oversize_w">Oversize(W)</label>
                                    </div><br>

                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input entry_ids" type="checkbox" <?php if(isset($product_fule['f_amount'])){if($product_fule['f_oversize_d'] == 1){ ?>checked <?php }} ?> id="f_oversize_d" name="f_oversize_d" value="1" >
                                      <label class="form-check-label" for="f_oversize_d">Oversize(d)</label>
                                    </div><br> -->

                                 
                                    
                          </div>
                            <!-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group">
                                <label>Fule Charge in %</label>
                                <input class="form-control" value="<?= $company_data['fule_charge'];?>" type="text" name="fule_charge" id="fule_charge" placeholder="Fule Charge">
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group">
                                <label for="">Start Date</label>
                                <input class="form-control form-year" type="text"  name="fule_charge_start"  value="<?= $company_data['fule_charge_start'];?>" id="fule_charge_start" placeholder="Fule Start Date">                             
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group">
                                <label>End Date</label>
                                <input class="form-control form-year" type="text" name="fule_charge_end" id="fule_charge_end" value="<?= $company_data['fule_charge_end'];?>" placeholder="Fule End Date" >
                            </div> -->
                           
                           
                    </div>
                    </div>
                   
                    
                  

           <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= $_GET['type'];?> NON STANDARD SHIPMENT SURCHARGE  PER SHIPMENT / PER PC (SINGLE PIECE WEIGHT OR DIMENSION (L/B/H).CM .</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 form-group">
                            <label>NON STANDARD(Weight)(Oversize)(Claue 1 A)</label>
                            <!-- <input class="form-control" type="text" onKeyPress="return isNumber(event)" name="ext_weight" id="ext_weight" value="<?= isset($prduct_surcharge['ext_weight']) ? $prduct_surcharge['ext_weight']: 0.00?>" placeholder="Additional Weight"> -->
                            <?php if($_GET['type'] == 'EXPORT'){ ?>
                              <div class="row mt-3">
                                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 form-group pr-1">
                                      <label>L</label>
                                      <input class="form-control" type="number" name="export_l" placeholder="L" 
                                            value="<?= (!empty($prduct_surcharge['export_l'])) ? $prduct_surcharge['export_l']: ''; ?>" >
                                  </div>
                                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 form-group pr-1">
                                      <label>W</label>
                                      <input class="form-control" type="number" name="export_w" placeholder="W" 
                                            value="<?= (!empty($prduct_surcharge['export_w'])) ? $prduct_surcharge['export_w']: ''; ?>" >
                                  </div>
                                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 form-group pr-1">
                                      <label>H</label>
                                      <input class="form-control" type="number" name="export_h" placeholder="H" 
                                            value="<?= (!empty($prduct_surcharge['export_h'])) ? $prduct_surcharge['export_h']: ''; ?>" >
                                  </div>
                              </div>

                                      <?php }else{?>
                                        <div class="row mt-3">
                                          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 form-group pr-1">
                                            <label>L</label>
                                            <input class="form-control" type="number" name="import_l" placeholder="L" value="<?= $prduct_surcharge['import_l'];?>"  >
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 form-group pr-1">
                                              <label>W</label>
                                              <input class="form-control" type="number" name="import_w" placeholder="W" value="<?= $prduct_surcharge['import_w'];?>"  >
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 form-group pr-1">
                                            <label>H</label>
                                          <input class="form-control" type="number" name="import_h" placeholder="H" value="<?= $prduct_surcharge['import_h'];?>"  >
                                          </div>
                                      </div>
                                      <?php }?>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 form-group">
                        <?php if($_GET['type'] == 'EXPORT'){?>
                            <button type="button" class="btn btn-success btn-sm mb-1 save-remark_non_s" data-types="1" idd="<?= !empty($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Save</button>
                            <button type="button" class="btn btn-success btn-sm mb-1 edit-remark_non_s" data-types="1" idd="<?= !empty($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm mb-1 remove-remark_non_s" data-types="1" idd="<?= !empty($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Remove</button> 

                            <input type="text" placeholder="write remark" value="<?= !empty($prduct_surcharge['remark_export_w']) ? $prduct_surcharge['remark_export_w']: '' ?>" class="form-control remark_non_s<?= !empty($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>" readonly > 
                            <?php }else{?>
                               <button type="button" class="btn btn-success btn-sm mb-1 save-remark_non_s" data-types="3" idd="<?= !empty($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Save</button>
                              <button type="button" class="btn btn-success btn-sm mb-1 edit-remark_non_s" data-types="3" idd="<?= !empty($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Edit</button>
                              <button type="button" class="btn btn-danger btn-sm mb-1 remove-remark_non_s" data-types="3" idd="<?= !empty($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Remove</button> 

                              <input type="text" placeholder="write remark" value="<?= !empty($prduct_surcharge['product_id']) ? $prduct_surcharge['remark_import_w']: ''?>" class="form-control remark_non_s3<?= !empty($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>" readonly > 
                              <?php }?>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 form-group">
                            <label for="">NON STANDARD (Weight) ( Oversize ) ( CHARGES - PER PC WISE )</label>
                            <input class="form-control" type="text" onKeyPress="return isNumber(event)" min="0" name="ext_weight_charge" id="ext_weight_charge" value="<?= !empty($prduct_surcharge['ext_weight_charge']) ? $prduct_surcharge['ext_weight_charge']: 0.00?>" placeholder="Additional Weight Charge">                             
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                          <label class="mt-3">NON STANDARD(Vol. Weight)(Oversize)(Claue 2 A)</label>
                              <div class="row ">
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                  <label>L</label>
                                  <div class="d-flex align-items-center "><input class="form-control" type="number" name ="l2" placeholder="multiple" value="<?= !empty($prduct_surcharge['l2']) ? $prduct_surcharge['l2']: ''?> "><span class="pl-2">x</span></div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                      <label>W</label>
                                      <div class="d-flex align-items-center "><input class="form-control" type="number" name="w2" placeholder="multiple" value="<?php if(!empty($prduct_surcharge['w2'])){ $prduct_surcharge['w2'];}?>"><span class="pl-2">x</span></div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                    <label>H</label>
                                  <div class="d-flex align-items-center "><input class="form-control" type="number" name="h2" placeholder="multiple" value="<?php if(!empty($prduct_surcharge['h2'])){ $prduct_surcharge['h2'];}?>"><span class="pl-2">x</span></div>
                                  </div>
                                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                    <label>Divisor</label>
                                  <input class="form-control" type="number" value="<?php if(!empty($prduct_surcharge['divisor2'])){ $prduct_surcharge['divisor2'];}?>" placeholder="Divisor" name="divisor2"  >
                                </div>
                                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                    <label> Vol. Weight total</label>
                                  <input class="form-control" type="number" value="<?= !empty($prduct_surcharge['wt2']) ? $prduct_surcharge['wt2']: ''?>" placeholder="Dimension" name="wt2"  >
                                </div>
                                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                    <label>Result</label>
                                  <input class="form-control" type="number" value="<?= !empty($prduct_surcharge['result2']) ? $prduct_surcharge['result2']: ''?>" placeholder="Result" name="result2"  >
                          </div>
                          </div>
                          </div>
                          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                          <label class="mt-3">NON STANDARD(Weight)(Oversize)(Claue 3 A)</label>
                              <div class="row ">
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                  <label>L</label>
                                  <div class="d-flex align-items-center "><input class="form-control" type="number" name ="l3" placeholder="multiple" value="<?php if(!empty($prduct_surcharge['l3'])){ $prduct_surcharge['l3'];}?>"><span class="pl-2">x</span></div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                      <label>W</label>
                                      <div class="d-flex align-items-center "><input class="form-control" type="number" name="w3" placeholder="multiple" value="<?php if(!empty($prduct_surcharge['w3'])){ $prduct_surcharge['w3'];}?>"><span class="pl-2">x</span></div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                    <label>H</label>
                                  <div class="d-flex align-items-center "><input class="form-control" type="number" name="h3" placeholder="multiple" value="<?php if(!empty($prduct_surcharge['h3'])){ $prduct_surcharge['h3'];}?>"><span class="pl-2">x</span></div>
                                  </div>
                                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                    <label>Divisor</label>
                                  <input class="form-control" type="number" value="<?php if(!empty($prduct_surcharge['divisor3'])){ $prduct_surcharge['divisor3'];}?>" placeholder="Divisor" name="divisor3"  >
                                </div>
                                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                    <label> Divisor WT. total</label>
                                  <input class="form-control" type="number" value="<?= !empty($prduct_surcharge['wt3']) ? $prduct_surcharge['wt3']: ''?>" placeholder="Dimension" name="wt3"  >
                                </div>
                                  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group pr-1">
                                    <label>Result</label>
                                  <input class="form-control" type="number" value="<?= !empty($prduct_surcharge['result3']) ? $prduct_surcharge['result3']: ''?>" placeholder="Result" name="result3"  >
                          </div>
                          </div>
                          </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 form-group">
                            <label>NON STANDARD (Dimension)  (Oversize)</label>
                            <input class="form-control" type="text" onKeyPress="return isNumber(event)" name="extra_dimensional" value="<?= isset($prduct_surcharge['extra_dimensional']) ? $prduct_surcharge['extra_dimensional']: 0.00?>" id="extra_dimensional" placeholder="NON STANDARD SHIPMENT" >
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 form-group">
                          <?php if($_GET['type'] == 'EXPORT'){?>
                            <button type="button" class="btn btn-success btn-sm mb-1 save-remark_non_s" data-types="2" idd="<?= isset($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Save</button>
                            <button type="button" class="btn btn-success btn-sm mb-1 edit-remark_non_s" data-types="2" idd="<?= isset($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm mb-1 remove-remark_non_s" data-types="2" idd="<?= isset($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Remove</button> 

                            <input type="text" placeholder="write remark" value="<?= isset($prduct_surcharge['remark_export_d']) ? $prduct_surcharge['remark_export_d']: ''?> " class="form-control remark_non_s2<?= isset($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>" readonly > 
                              <?php }else{?>
                                <button type="button" class="btn btn-success btn-sm mb-1 save-remark_non_s" data-types="4" idd="<?= isset($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?> ">Save</button>
                              <button type="button" class="btn btn-success btn-sm mb-1 edit-remark_non_s" data-types="4" idd="<?= isset($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?>">Edit</button>
                              <button type="button" class="btn btn-danger btn-sm mb-1 remove-remark_non_s" data-types="4" idd="<?= isset($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?> ">Remove</button> 

                              <input type="text" placeholder="write remark" value="<?= isset($prduct_surcharge['remark_import_d']) ? $prduct_surcharge['remark_import_d']: ''?> " class="form-control remark_non_s4<?= isset($prduct_surcharge['product_id']) ? $prduct_surcharge['product_id']: 0?> " readonly > 
                              <?php }?>
                        </div>

                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 form-group">
                            <label for="">NON STANDARD ( Dimension )  (Oversize) ( CHARGES - PER PC WISE )</label>
                            <input class="form-control" type="text" onKeyPress="return isNumber(event)" min="0" name="extra_dimensional_charge" value="<?= isset($prduct_surcharge['extra_dimensional_charge']) ? $prduct_surcharge['extra_dimensional_charge']: 0.00?>" id="extra_dimensional_charge" placeholder="NON STANDARD SHIPMENT SURCHARGE">                             
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 form-group">
                            <label for="">NON -STACKABLE PALLET(Fragile) (RS)</label>
                            <input class="form-control" type="text" onKeyPress="return isNumber(event)" min="0" name="non_stackable_charge" value="<?= isset($prduct_surcharge['non_stackable_charge']) ? $prduct_surcharge['non_stackable_charge']: 0.00?>" id="non_stackable_charge" placeholder="Additional Dimensional Charge">                             
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 form-group">
                            <label for="">DDP(Duty Delivery Paid)(RS)</label>
                            <input class="form-control" type="text" onKeyPress="return isNumber(event)" min="0" name="ddp_charge" value="<?= isset($prduct_surcharge['ddp_charge']) ? $prduct_surcharge['ddp_charge']: 0.00?>" id="ddp_charge" placeholder="DDP(Duty Delivery Paid)">                             
                        </div>
                    </div>
                 </div>
             </div>

              <div class="row">
			<div class="col-xl-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"> EXPORT NON STANDARD SHIPMENT SURCHARGE PER SHIPMENT / PER PC (SINGLE PIECE WEIGHT OR DIMENSION (L/B/H).CM .</h3>
					</div>
					<div class="box-body">
     <div class="row">

    <div class="col-xl-12 form-group">
      <label class="mt-3 font-weight-bold">NON STANDARD WEIGHT TOTAL KG =CLAUSE (1)</label>

      <!-- WRAPPER -->
      <div id="non-standard-wrapper">

  <!-- CLONE ROW -->
     <div class="row non-standard-row align-items-end mb-3">

    <div class="col-xl-2 form-group pr-1">
      <label>Weight In kg (Min wt)</label>
      <input class="form-control" type="number" name="min_weight[]" placeholder="Min wt">
    </div>

    <div class="col-xl-2 form-group pr-1">
      <label>Weight In kg (Max wt)</label>
      <input class="form-control" type="number" name="max_weight[]" placeholder="Max wt">
    </div>

    <div class="col-xl-2 form-group pr-1">
      <label>Result IN (Rs)</label>
      <input class="form-control" type="number" name="result[]" placeholder="Result">
    </div>

    <!-- BUTTON COLUMN (SAME ROW, RESULT KE BAAD) -->
    <div class="col-xl-2 form-group">
      <button type="button"
              class="btn btn-primary w-100"
              onclick="addMoreFields()">
        + Add More
      </button>
    </div>

  </div>

</div>

      <div class="row mt-4">
    <div class="col-xl-12">
      <label class="font-weight-bold">
        NON STANDARD DIMENSIONAL WT. TOTAL IN KG = CLAUSE (2)
      </label>
    </div>
  </div>

  <div id="wrapper-clause-2-2">

      <div class="row non-standard-row-2-2 align-items-end mb-3">

      <div class="col-xl-2">
        <label>Min(DIMENSION.WT.TOTAL IN KG)</label>
        <input class="form-control" type="number" name="min_dimesion[]" placeholder="Min wt">
      </div>

      <div class="col-xl-2">
        <label>Max(DIMENSION.WT.TOTAL IN KG)</label>
        <input class="form-control" type="number" name="max_dimension[]" placeholder="Max wt">
      </div>

      <div class="col-xl-2">
        <label>Result IN (Rs)</label>
        <input class="form-control" type="number" name="result1[]" placeholder="Result">
      </div>

      <div class="col-xl-2">
        <button type="button"
                class="btn btn-primary w-100"
                onclick="addMoreClause2_2()">
          + Add More
        </button>
      </div>

    </div>
  </div>

</div>

 <div id="wrapper-clause-3">

    <div class="row non-standard-row-2 align-items-end mb-3">
      
  <div class="col-xl-12">
      <label class="font-weight-bold mx-3">
      CLAUSE (3) 1 HIGHEST SIDE CMS & 2 REMANING SIDE HIGHER CMS
      </label>
    </div>
  <!-- HIGHEST SIDE CMS -->
  
      <div class="col-xl-2 mx-3">
        <label>HIGHEST SIDE CMS</label>
        <input class="form-control" type="number" name="highest_side[]" placeholder="HIGHEST CMS">
      </div>

      <div class="col-xl-2">
        <label>SECOND HIGHT SIDE CMS</label>
        <input class="form-control" type="number" name="second_highest_side[]" placeholder="SECOND HIGHT CMS">
      </div>



  <!-- RESULT -->
  <div class="col-xl-2">
    <label class="fw-bold">Result (Rs)</label>
    <input type="number" class="form-control form-control-sm" name="result3_3[]" placeholder="Result">
  </div>

  <!-- BUTTON -->
 <div class="col-xl-2 action-btn-col">
  <button type="button"
          class="btn btn-primary w-100"
          onclick="addMoreClause3()">
    + Add More
  </button>
</div>

</div>



</div>

 <div id="wrapper-clause-4">
    <div class="col-xl-12">
      <label class="font-weight-bold">
      CLAUSE (4) GIRTH FORMULA DIMESIONAL CMS (L + 2girth + 2 wirth=sum cms)(2+ &2 +(Remaning)=sum in cms)
      </label>
    </div>

    <div class="row non-standard-row-2 align-items-end mb-3">
      
     <div class="col-xl-1 mx-3">
        <label>Length</label>
        <input class="form-control" type="number" name="claue4_length[]" placeholder="Inactive">
      </div>

      <div class="col-xl-1 mx-3">
        <label>Width</label>
        <input class="form-control" type="number" name="claue4_width[]" placeholder="Inactive">
      </div>

       <div class="col-xl-1">
        <label>Height</label>
        <input class="form-control" type="number" name="claue4_height[]" placeholder="Inactive">
      </div>

       <div class="col-xl-2 ms-3">
        <label>Sum In CMS(Min)</label>
        <input class="form-control" type="number" name="claue4_sum_min[]" placeholder="Inactive">
      </div>

       <div class="col-xl-2">
        <label>Sum in CMS(Max)</label>
        <input class="form-control" type="number" name="claue4_sum_max[]" placeholder="Inactive">
      </div>

      <div class="col-xl-2">
        <label>Result IN (Rs)</label>
        <input class="form-control" type="number" name="claue4_result4[]" placeholder="Result">
      </div>

  <!-- BUTTON -->
 <div class="col-xl-2 action-btn-col">
  <button type="button"
          class="btn btn-primary w-100"
          onclick="addMoreClause4()">
    + Add More
  </button>
</div>

</div>



</div>


 <div id="wrapper-clause-5">
    <div class="col-xl-12">
      <label class="font-weight-bold">
      CLAUSE (5) GIRTH FORMULA DIMESIONAL CMS=MIN WEIGHT CHARGEABLE
      </label>
    </div>

    <div class="row non-standard-row-2 align-items-end mb-3">
      
     <div class="col-xl-1 mx-3">
        <label>Length</label>
        <input class="form-control" type="number" name="claue5_length[]" placeholder="L">
      </div>

      <div class="col-xl-1 mx-3">
        <label>Width</label>
        <input class="form-control" type="number" name="claue5_width[]" placeholder="W">
      </div>

       <div class="col-xl-1">
        <label>Height</label>
        <input class="form-control" type="number" name="claue5_height[]" placeholder="H">
      </div>

       <div class="col-xl-1 mx-3">
        <label>Sum In CMS(Min)</label>
        <input class="form-control" type="number" name="claue5_sum_min[]" placeholder="Min CMS">
      </div>

       <div class="col-xl-1 mx-3">
        <label>Sum in CMS(Max)</label>
        <input class="form-control" type="number" name="claue5_sum_max[]" placeholder="Max CMS">
      </div>

      <div class="col-xl-1 mx-3">
        <label>Result IN (Rs)</label>
        <input class="form-control" type="number" name="claue5_result5[]" placeholder="Result">
      </div>

      <div class="col-xl-1 mx-3">
        <label>Weight</label>
        <input class="form-control" type="number" name="claue5_weight[]" placeholder="Weight">
      </div>


  <!-- BUTTON -->
 <div class="col-xl-2 action-btn-col">
  <button type="button"
          class="btn btn-primary w-100"
          onclick="addMoreClause5()">
    + Add More
  </button>
</div>

</div>



</div>






							<!-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 form-group">
								<label>NON STANDARD ( Dimension )  (Oversize)</label>
								<input class="form-control" type="number" name="import_sal_ext_dimensional" id="sal_ext_dimensional" placeholder="NON STANDARD SHIPMENT" value="<?= $vendor_data['import_sal_ext_dimensional'];?>"  >

							</div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 form-group">
                    <button type="button" class="btn btn-success btn-sm mb-1 save-remark_non_s" data-types="4" idd="<?php echo $vendor_data['vendor_id']; ?>">Save</button>
                    <button type="button" class="btn btn-success btn-sm mb-1 edit-remark_non_s" data-types="4" idd="<?php echo $vendor_data['vendor_id']; ?>">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm mb-1 remove-remark_non_s" data-types="4" idd="<?php echo $vendor_data['vendor_id']; ?>">Remove</button> 

                    <input type="text" placeholder="write remark" value="<?php echo $vendor_data['remark_import_d'] ?>" class="form-control remark_non_s4<?php echo $vendor_data['vendor_id']; ?>" readonly > 
                </div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 form-group">
								<label for="">NON STANDARD ( Dimension )  (Oversize) ( CHARGES - PER PC WISE )</label>
								<input class="form-control" type="number" min="0" name="import_sal_ext_dimensional_charge" id="sal_ext_dimensional_charge" placeholder="NON STANDARD SHIPMENT SURCHARGE" value="<?= $vendor_data['import_sal_ext_dimensional_charge'];?>" >                             
							</div> -->
                            <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 form-group">
                                <label for="">NON -STACKABLE PALLET(Fragile) (RS)</label>
                                <input class="form-control" type="number" min="0" name="import_sal_non_stackable_charge" id="sal_non_stackable_charge" placeholder="NON -STACKABLE PALLET" value="<?= $vendor_data['import_sal_non_stackable_charge'];?>">                             
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 form-group">
                                <label for="">DDP(Duty Delivery Paid)(RS)</label>
                                <input class="form-control" type="number" min="0" name="import_ddp_charge" value="<?= $vendor_data['import_ddp_charge'];?>" id="non_stackable_charge" placeholder="DDP(Duty Delivery Paid)">                             
                            </div> -->
						</div>
					</div>
				</div>
			</div>
		</div> 

             <div class="box">
                  <div class="box-footer">
                      <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                      <!-- <a href="<?= url(); ?>company-data-empty?product_fule_id=<?=  $product_fule['id']; ?>&prduct_surcharge_id=<?= $prduct_surcharge['id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear data?')">Clear Data</a> -->

                      <a href="<?= url('company-data-empty'); ?>?product_fule_id=<?= $product_fule['id'] ?? 0; ?>&product_surcharge_id=<?= $product_surcharge['id'] ?? 0; ?>" 
                      class="btn btn-danger" 
                      onclick="return confirm('Are you sure you want to clear data?')">
                      Clear Other Rate
                    </a>

                      
                  </div>
              </div>
                    <!-- /.box -->


             </form>
            <!-- Default box -->
        <!-- /.box-footer-->

    </div>

       


<?php echo form_open_multipart("companyrate/" . $seg_id, ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
    <div class="row">
        <div class="col-sm-12">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Basic Details</h3>
                    <!-- <button type="button" class="btn btn-primary btn-lg small" data-toggle="modal" data-target="#myModal" style="float: right;padding: 1px 15px;">Import Excel</button> -->
                   

                    <!-- <button class="btn btn-primary pull-right" type="button" id="addMember" style="float: right; margin-right:10px;" data-toggle="modal" data-target="#d_salerate">Import Excel</button> -->
                </div>

                <div class="modal fade" id="d_salerate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">International Purchase Rate Excel File</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                              

                                <form action="javascript:void(0);" method="post" id="import_int" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="formClient-Name">Excel Import</label>
                                        <input type="file" class="form-control" name="file" id="file" required autofocus />
                                        <a href="<?= base_url('assets/newcompanyRate.xlsx')?>" download="">example file</a>
                                    </div>
                                    <input type="hidden" class="form-control" name="vendor_id" value ="<?= $seg_id?>" />
                                    <input type="hidden" class="form-control" name="customer_id" value ="<?= $seg_id?>" />
                                    <input type="hidden" value="<?= $_GET['type']?>" name="mode" id="mode">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="download_salerate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabela" aria-hidden="true">
                        <div class="modal-dialog" role="documents">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabela">International Purchase Rate Excel File</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <form action="#" method="post" enctype="multipart/form-data">
                                </form>

                                <form action="javascript:void(0);" method="post" id="import_intDownload" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="formClient-Name">Excel Import</label>
                                        <input type="file" class="form-control" name="files" id="files" required autofocus />
                                        <a href="<?= base_url('assets/newcompanyRate.xlsx')?>" download="">example file</a>
                                    </div>
                                    <input type="hidden" class="form-control" name="customer_id" value ="<?= $seg_id?>"required autofocus />
                                    <input type="hidden" value="<?= $_GET['type']?>" name="mode" id="mode">
                                 
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            
                            </div>
                        </div>
                    </div>

                <div class="box-body">
                    <form class="main_form" action ="<?= base_url('companyrate/') ?><?= $seg_id?>" method="post">
                        <input type="hidden" value="<?= $seg_id?>" name="customer_id" id="customer_id">
                        <input type="hidden" value="<?= $_GET['type']?>" name="mode" id="mode">
                                  
                        <div class="row">
                          <?php 
                            $a = $this->db->where(array('product_id' => $_GET['product'],
                            'customer_id' => $seg_id,
                            'shipment_type'=>$_GET['type']))->get('customer_fulesurcharge')->row_array();

                            if (!empty($a['divisor'])) {
                              $bb = 'Editable';
                              $divisor = $a['divisor'] ; 
                            }else{
                              $a = $this->db->where('id',$_GET['product'])->get('products')->row_array();
                              $bb = 'Product';
                              $divisor = $a['divisor'] ;
                            }
                            ?>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="formClient-Name"><?= $bb;?> Divisor</label>
                                    <select class="form-control divisor_able" name="divisor" id="divisor"  data-id="<?= $seg_id?>" data-product="<?= $_GET['product']?>" data-type="<?= $_GET['type']?>" aria-required="true" required disabled>
                                    <?php 
                                        if (is_array($lookup_value)) {
                                            foreach ($lookup_value as $value) { ?>
                                                <option <?= ($value['lookup_value'] == $divisor) ? 'selected' : ''; ?> value="<?= $value['lookup_value'] ?>"><?= $value['lookup_value'] ?></option>
                                    <?php }}?> 
                                </select>
                                <button type="button" class="btn btn-success btn-sm mb-1 edit-divisor">Edit</button>
                                <button type="button" class="btn btn-success btn-sm mb-1 save-divisor">Save</button>
                                <?php if($bb == 'Editable'){?>
                                <button type="button" class="btn btn-success btn-sm mb-1 remove-divisor">Use Product Divisor</button>
                                <?php }?>

                                </div>
                            </div>

                        </div>
                    </form>



                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->

            <!-- Default box -->

            <!-- /.box -->

        </div>

    </div>

    <!-- Default box -->

        <!-- /.box-footer-->

    </div>
    <!-- /.box -->

    <?php echo form_close(); ?>

</section>

<section class="content">


    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List of Company Rates</h3>

            <div class="box-tools pull-right">
            <!-- <a href="<?= url('addrate?type=international') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>  Add Rate</a> -->
            
                <?php if (hasPermissions('add_rate')): ?>
                    <!-- <a href="<?= url('addrate') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>  Add Rate</a> -->
                <?php endif ?>

            </div>

        </div>
        <div class="box-body">
        <p class="box-title float-left">
          <?php if(!empty($zone_data)): ?>
              Created Date - <?php echo date('d-m-Y',strtotime($zone_data['entered_on'])); ?>
          <?php endif; ?>
          </p><br><br>
            <!-- <form action="<?= base_url('rate/')?><?= $seg_id?>" method="get" id="mode_filter" class="inline-block w-50">
                <div class="row">
                    <label for="formClient-Name" class="col-2"><strong>Filter :</strong></label>
                        <div class="form-group col-6">
                            <select class="form-control" name="type" id="type">
                                    <option <?= (($_GET['type'] == 0)) ? 'selected' : '' ; ?> value="0">All</option>
                                    <option <?= (($_GET['type'] == 1)) ? 'selected' : '' ; ?> value="1">Export</option>
                                    <option <?= (($_GET['type'] == 2)) ? 'selected' : '' ; ?> value="2">Import</option>
                            </select>
                        </div>
                    <div class="col-3"><button type="submit" class="btn btn-primary">Submit</button></div>
                 </div>
            </form> -->

            <!--begin: Datatable -->
            <button id="showAllButton" style='margin-bottom:10px;border: 1px solid #80808069; padding: 2px 14px;border-radius: 3px;' class="btn-primary">Show All</button>
            
            <button class="btn btn-primary pull-right" type="button" id="addMember" style="float: right; margin-bottom:10px;" data-toggle="modal" data-target="#download_salerate" >Upload Company Rate Excel</button>
            
            <table id="dataTable1" class="table table-bordered table-striped table-responsive" >
            <!--<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_2">-->
                <thead>
                    <tr>
                        <th>Sr. # <input type="checkbox" id="selectall" onclick="selectAllCheckboxes()"></th>
                        <th>Action</th>
                        <th>Status</th>
                        <!-- <th>Customer</th> -->
                        <th>Mode</th>
                        <th>Doc/Sampel</th>
                        <!-- <th>Divider</th> -->
                        <th>Rate Type</th>
                        <th>Weight</th>
                        <th>Start wt.</th>
                        <th>End wt.</th>
                        <?php for ($i=1; $i <=100 ; $i++) {  ?>
                        <th>Zone <?= $i; ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($int)) {
                        foreach ($int as $key => $value) {
                        //    $a = $this->db->get('company')->result_array();
                           

                             $a = $this->db->where(array('company_id' => $value['customer_id'],'status' => 0,'category' => 5))->get('company')->row_array();

                             $zones = $this->db->where(array('zone_id'=> $value['rate_id'],'type'=>'international'))->get('com_purchase_zone')->result_array();
                            // echo '<pre>'; print_r($value);die;
                             if($value['clr_status'] == 1){
                                $clr = 'style= "color: red;"';
                             }else{
                                $clr = 'style="color: #000;"';
                             }
                        ?>

                            <tr <?= $clr?>>
                                <td><?= ++$key ?> <input type="checkbox" class="entry_ids" name="entry_ids[]" value="<?= $value['rate_id']?>"></td>
                                <td style="display: flex;">

                                <a href="<?= url('companyrate/clr/' . $value['rate_id']).'?type=international' ?>" class="btn btn-sm btn-default" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>

                                </td>
                                <td>
                                <?php if ($value['status'] == 1){ ?>
                                    <label class="switch">
                                    <input type="checkbox" id="switchh" value="2" idd="<?= $value['rate_id']; ?>"  >
                                    <span class="slider round"></span>
                                </label>
                               
                                <?php }else{ ?>
                                    <label class="switch">
                                    <input type="checkbox"id="switchh" checked value="1" idd="<?= $value['rate_id']; ?>"  >
                                    <span class="slider round"></span>
                                </label>
                                   
                                <?php } ?>
                                </td>
                                <!-- <td><?= ($a) ? $a['company_name'] : ''?></td> -->
                                <td><?= $value['mode']?></td>
                                <td><?= $value['consignment_type']?></td>
                                <!-- <td><?= $value['divider']?></td> -->
                                <td><?= $value['rate_type']?></td>
                                <td><?= $value['weight']?></td>
                                <td><?= $value['start_weight']?></td>
                                <td><?= $value['end_weight']?></td>
                                   
                                    <?php foreach ($zones as $key => $val) {
                                        // echo '<pre>';print_r($val);die;
                                        ?>
                                        
                                            <td><?= $val['zone_value'] ?></td>
                                    <?php  } ?>
                                <?php for ($i = count($zones ); $i < 100  ; $i++) { ?>
                                <td>0</td>
                                <?php } ?>    
                                   
                                
                            </tr>
                            <?php }}?>

                            <a href="javascript:void(0);" class="btn btn-danger" id="delete-entries-btn">Delete</a> 
                </tbody>
            </table>

            <!--end: Datatable -->
        </div>


    </div>

    <?php 
    
    if ($_GET['type'] == 'EXPORT') { ?>
    <div class="row w-100">
        <div class="col-xl-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">International Other Charges (Covid Surcharge,Restricted Country Charge,Commercial Rate Type Export)</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- <button class="btn btn-primary pull-left" type="button" id="addMember"  data-toggle="modal" data-target="#exampleModal4" style="    margin-bottom: 20px;">Convert Excel</button> -->
                            <button class="btn btn-primary pull-right" type="button" id="addMember"  data-toggle="modal" data-target="#exampleModal6" style="    margin-bottom: 20px;">Export Other Charges Excel</button>
                        </div>
                        <div class="col-xl-12 form-group add-member">
                            <table id="example6" class="table table-striped table-bordered" >
                                <thead>
                                    <tr>
                                      <th>Country</th>
                                      <th>Linked Country</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php if(!empty($otherChargesexport)){ foreach ($otherChargesexport as $key =>$otherc) {

                                     $country_n = $this->db->where('id',$otherc['country_id'])->get('newcountries')->row_array();                                     
                                     if(!empty($country_n)){
                                       $cou_n=$country_n['country_name'].' ( '. $country_n['short_name'] .' )';
                                     }else{
                                        $cou_n = '';
                                     }

                                    ?>    
                                    <tr>
                                        

                                    <?php 
                                       $linked = '';
                                       $country_ids = [];
                                       if(!empty($otherc['linked'])){
                                         foreach ($otherc['linked'] as $key => $val) {
                                               $country_y = $this->db->where('id',$val['country_id'])->get('newcountries')->row_array();
                                               if(!empty($country_y)){
                                                  $no = $key+1;
                                                  $country_ids[] = $country_y['id'];
                                                  $linked .= $no.') '.$country_y['country_name'].' <a href="javascript:void(0);" class="delete-country" style="color:red" id="'.$val['country_id'].'" vendor_id="'.$val['vendor_id'].'" type="import">x</a> <br>';
                                                }else{
                                                  $linked .='';
                                                }
                                         }
                                       }
                                       $country_ids_str = implode(',', $country_ids);
                                    ?>    

                                      <td><?= $cou_n ?> 
                                      <a href="javascript:void(0);" class="btn btn-success other_rate_data" data-country ="<?= $country_ids_str?>" data-id="<?= $otherc['country_id']?>" data-entered="<?= $otherc['entered_by']; ?>"> Edit </a>
                                    </td>
                                      <td><?= $linked; ?></td>
                                        <td>
                                          <a style="margin-right: 10px" type="button" href="<?= base_url(); ?>company/otherChargeslist/<?= $otherc['country_id'] ?>?customer=<?= $company_data['company_id'] ?>&type=<?= $otherc['entered_by']; ?>" href="javascript: void(0)" class="btn btn-primary  "> View Charges </a>
                                          <a type="button" href="<?= base_url('company/deleteOtherCharges/').$otherc['country_id'].'/'.$otherc['entered_by']; ?>" onclick="return confirm('Are you sure you want to delete this charges?');" class="btn btn-danger "> Delete </a>
                                          
                                        </td>
                                    </tr>

                                <?php }} ?>                         
                                  
                                </tbody>
                            </table>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php }?>
  

 <?php if ($_GET['type'] == 'IMPORT') { ?>
    <div class="row w-100">
      <div class="col-xl-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">International Other Charges (Covid Surcharge,Restricted Country Charge,Commercial Rate Type Import)</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- <button class="btn btn-primary pull-left" type="button" id="addMember"  data-toggle="modal" data-target="#exampleModal4" style="    margin-bottom: 20px;">Convert Excel</button> -->
                            <button class="btn btn-primary pull-right" type="button" id="addMember"  data-toggle="modal" data-target="#exampleModal3" style="    margin-bottom: 20px;">Import Other Charges Excel</button>
                        </div>
                        <div class="col-xl-12 form-group add-member">
                            <table id="example6" class="table table-striped table-bordered" >
                                <thead>
                                    <tr>
                                      <th>Country</th>
                                      <th>Linked Country</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php if(!empty($otherCharges)){ foreach ($otherCharges as $key =>$otherc) {

                                     $country_n = $this->db->where('id',$otherc['country_id'])->get('newcountries')->row_array();                                     
                                     if(!empty($country_n)){
                                       $cou_n= $country_n['country_name'].' ( '. $country_n['short_name'] .' )';
                                     }else{
                                        $cou_n='';
                                     }

                                     
                                    ?>    
                                    <tr>
                                        

                                    <?php 
                                       $linked = '';
                                       $country_ids = [];
                                       if(!empty($otherc['linked'])){
                                         foreach ($otherc['linked'] as $key => $val) {
                                          
                                               $country_y = $this->db->where('id',$val['country_id'])->get('newcountries')->row_array();
                                               if(!empty($country_y)){
                                                  $no = $key+1;
                                                  $country_ids[] = $country_y['id'];
                                                  $linked .= $no.') '.$country_y['country_name'].' <a href="javascript:void(0);" class="delete-country" style="color:red" id="'.$val['country_id'].'" vendor_id="'.$val['vendor_id'].'" type="import">x</a> <br>';
                                                }else{
                                                  $linked .='';
                                                }
                                         }
                                       }
                                       $country_ids_str = implode(',', $country_ids);
                                    ?>    
                                      <td><?= $cou_n ?>
                                      <a href="javascript:void(0);" class="btn btn-success other_rate_data" data-country ="<?= $country_ids_str?>" data-id="<?= $otherc['country_id']?>" data-entered="<?= $otherc['entered_by']; ?>"> Edit </a>
                                    </td>
                                      <td><?= $linked; ?></td>

                                      <td><input type="text" placeholder="write remark" value="<?= $otherc['remarks'] ?>" class="form-control  remark<?= $otherc['rate_id']; ?>" readonly > <button type="button" class="btn btn-success btn-sm save-remark" idd="<?= $otherc['rate_id']; ?>">Save</button> <button type="button" class="btn btn-success btn-sm edit-remark" idd="<?= $otherc['rate_id']; ?>">Edit</button> <button type="button" class="btn btn-danger btn-sm remove-remark" idd="<?= $otherc['rate_id']; ?>">Remove</button> </td>

                                        <td>
                                          <a style="margin-right: 10px" type="button" href="<?= base_url(); ?>company/otherChargeslist/<?= $otherc['country_id'] ?>?customer=<?= $company_data['company_id'] ?>&type=<?= $otherc['entered_by']; ?>" href="javascript: void(0)" class="btn btn-primary  "> View Charges </a>
                                          <a type="button" href="<?= base_url('company/deleteOtherCharges/').$otherc['country_id'].'/'.$otherc['entered_by']; ?>" onclick="return confirm('Are you sure you want to delete this charges?');" class="btn btn-danger "> Delete </a>
                                         
                                        </td>
                                    </tr>

                                <?php }} ?>                         
                                  
                                </tbody>
                            </table>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>

</div>


<div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Other Charges Excel File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="import_excel6" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1">Select Excel</label>
            <input type="file" class="form-control" id="file" name="file" >
            <input type="hidden" name="customer_id" value="<?= $company_data['company_id'];?>">
            <input type="hidden" name="company_name" value="<?= $company_data['company_name'];?>">
            <input type="hidden" name="entered_by" value="export">
          
            <a href="<?= base_url('assets/othercharge.xlsx'); ?>" download="">example file</a>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Copy rate</label>
            <select class="form-control" name="copy_country_id" >
                <option value="">Select Country</option>
                
                  <?php if(!empty($otherChargesexport)){ foreach ($otherChargesexport as $key =>$otherc) {

                     $country_n = $this->db->where('id',$otherc['country_id'])->get('newcountries')->row_array();
                  
                    ?> 
                <option value="<?= $country_n['id'] ?>"><?= $country_n['country_name'] ?><?php if($country_n['short_name'] != ''){ ?> (<?= $country_n['short_name'] ?>)<?php } ?></option>
                
                <?php   } } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Country</label>
            <select style="width:100%!important" class="fav_clr" multiple name="country_id[]" id="country_idd" required>
                 <option></option>

                <option value="all">all</option>

                <?php 
                    if (!empty($newcountries2)) {
                        foreach ($newcountries2 as $key => $newcount) {
                ?>
                <option value="<?= $newcount['id'] ?>"><?= $newcount['country_name'] ?><?php if($newcount['short_name'] != ''){ ?> (<?= $newcount['short_name'] ?>)<?php } ?></option>
                
                <?php   } } ?>
            </select>
          </div>

          
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" id="clear_id" class="btn btn-danger">Clean</button>
        </form>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Other Charges Excel File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="import_excel3" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1">Select Excel</label>
            <input type="file" class="form-control" id="file" name="file" >
            <input type="hidden" name="customer_id" value="<?= $company_data['company_id'];?>">
            <input type="hidden" name="company_name" value="<?= $company_data['company_name'];?>">
            <input type="hidden" name="entered_by" value="import">
          
            <a href="<?= base_url('assets/othercharge.xlsx'); ?>" download="">example file</a>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Copy rate</label>
            <select class="form-control" name="copy_country_id" >
                <option value="">Select Country</option>
                
                  <?php if(!empty($otherCharges)){ foreach ($otherCharges as $key =>$otherc) {

                     $country_n = $this->db->where('id',$otherc['country_id'])->get('newcountries')->row_array();
                  
                    ?> 
                <option value="<?= $country_n['id'] ?>"><?= $country_n['country_name'] ?><?php if($country_n['short_name'] != ''){ ?> (<?= $country_n['short_name'] ?>)<?php } ?></option>
                
                <?php   } } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Country</label>
            <select style="width:100%!important" class="fav_clr" multiple name="country_id[]" id="country_idd" required>
                 <option></option>

                <option value="all">all</option>

                <?php 
                    if (!empty($newcountries)) {
                        foreach ($newcountries as $key => $newcount) {
                ?>
                <option value="<?= $newcount['id'] ?>"><?= $newcount['country_name'] ?><?php if($newcount['short_name'] != ''){ ?> (<?= $newcount['short_name'] ?>)<?php } ?></option>
                
                <?php   } } ?>
            </select>
          </div>

          
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" id="clear_id" class="btn btn-danger">Clean</button>
        </form>
      </div>
     
    </div>
  </div>
</div>



<!-- edit country id -->
<div class="modal fade" id="countryotherrate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form id="export_excel_other_rate" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1">Select Excel</label>
            <input type="file" class="form-control" id="file" name="file" >
            <input type="hidden" id="customer_id_other_rate" name="customer_id" value="<?= $company_data['company_id'];?>">

            <input type="hidden" id="entered_by_other_rate" name="entered_by">
            <input type="hidden" id="copy_country_id_other_rate" name="copy_country_id">
            <input type="hidden" id="country_id_other_rate" name="country_id">
            
            <a href="<?= base_url('assets/othercharge.xlsx'); ?>" download="">example file</a>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" id="clear_id1" class="btn btn-danger">Clean</button>
        </form>
      </div>
      
    </div>
  </div>
</div>

</section>
<!-- end:: Content -->
<?php include viewPath('includes/footer'); ?>
<style>
    .content-wrapper{
        background:#fff!important;
    }
</style>
<script>
$(document).ready(function() {
  var dataTable = $('#dataTable1').DataTable({
    "dom": "<'row'<'col-sm-3 text-left'l><'col-sm-3 text-center'f><'col-sm-6 text-right'B>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12'p<br/>i>>",
   
    buttons: [
            {
          
             extend: 'excel', 
             text: 'Excel',
                exportOptions: {
                    columns: [2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30] 
                },
        },
        {
             extend: 'pdf',
             orientation: 'landscape',
             text: 'PDF'
        },
         {
             extend: 'copy', 
             text: 'COPY',
             exportOptions: {
                    columns: [2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30] 
                },
        },

    ],
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
  });

  $('#showAllButton').on('click', function() {
    dataTable.page.len(-1).draw();
  });
});
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
$('#import_int').submit(function(e){
    e.preventDefault();
     var formData = new FormData(this);
    $(':input[type="submit"]').prop('disabled', true);
     $.ajax({
        url:'<?= base_url('companyrate_pur_int_import') ?>?type=<?= $_GET['type']?>&product=<?= $_GET['product']?>',
        type:'Post',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(result){
          $(':input[type="submit"]').prop('disabled', false);
          if(result.trim() == 'yes')
              {
                $('#d_salerate').modal('hide');
                 $('#import_int').trigger('reset');
                swal({
                      title: "Success",
                      text: "File Import Successfully",
                      icon: "success",
                      button: false,
                      timer: 3000
                    });
               setTimeout(function() {
                    location.reload(true);
                }, 3000);
              }else if(result.trim() == 'not')
              { 
                swal({
                      title: "Failed",
                      text: "Some Error Occured Plase Try again.",
                      icon: "error",
                      button: false,
                      timer: 3000
                    });
              }

              $('#d_salerate').modal('hide');
                 $('#import_int').trigger('reset');
                swal({
                      title: "Success",
                      text: "File Import Successfully",
                      icon: "success",
                      button: false,
                      timer: 3000
                    });
               setTimeout(function() {
                    location.reload(true);
                }, 3000);

        }

     });
  })  


  $('#import_intDownload').submit(function(e){
    e.preventDefault();
     var formData = new FormData(this);
     var divisor =$('.divisor_able').val();
    //  console.log();
     
     formData.append('divisor', divisor);

    $(':input[type="submit"]').prop('disabled', true);
     $.ajax({
        url:'<?= base_url('companyrate_pur_int_importDownload') ?>?type=<?= $_GET['type']?>&product=<?= $_GET['product']?>',
        type:'Post',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(result){
          $(':input[type="submit"]').prop('disabled', false);
          if(result.trim() == 'yes')
              {
                $('#download_salerate').modal('hide');
                 $('#import_intDownload').trigger('reset');
                swal({
                      title: "Success",
                      text: "File Import Successfully",
                      icon: "success",
                      button: false,
                      timer: 3000
                    });
               setTimeout(function() {
                    location.reload(true);
                }, 3000);
              }else if(result.trim() == 'not')
              { 
                swal({
                      title: "Failed",
                      text: "Some Error Occured Plase Try again.",
                      icon: "error",
                      button: false,
                      timer: 3000
                    });
              }
              $('#d_salerate').modal('hide');
                 $('#import_int').trigger('reset');
                swal({
                      title: "Success",
                      text: "File Import Successfully",
                      icon: "success",
                      button: false,
                      timer: 3000
                    });
               setTimeout(function() {
                    location.reload(true);
                }, 3000);

        }

     });
  })  


	$(document).ready(function() {
    var buttonAdd = $("#add-button");
    var buttonRemove = $("#remove-button");
    var className = ".dynamic-field";
    var count = 0;
    var field = "";
    var maxFields = 50;

    function totalFields() {
      return $(className).length;
    }

    function addNewField() {
      count = totalFields() + 1;
      field = $("#dynamic-field-1").clone();
      field.attr("id", "dynamic-field-" + count);
      
      // Update the label text for the new field
      field.find("label").text("Zone " + count);
      
      field.find("input").val("");
      $(className + ":last").after($(field));
    }

    function removeLastField() {
      if (totalFields() > 1) {
        $(className + ":last").remove();
      }
    }
    
    function enableButtonRemove() {
    if (totalFields() === 2) {
      buttonRemove.removeAttr("disabled");
      buttonRemove.addClass("shadow-sm");
    }
  }
    // Rest of your functions remain the same

    buttonAdd.click(function() {
      addNewField();
      enableButtonRemove();
      disableButtonAdd();
    });

    // Use event delegation for the remove button click event
    $(document).on("click", "#remove-button", function() {
      removeLastField();
      disableButtonRemove();
      enableButtonAdd();
    });
  });
</script>
<script>
        $(document).ready(function() {
            $('#filter_btn').on('change', function() {
                var filterValue = $('#filter_value').val();
               
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url("filters/filter"); ?>',
                    data: { filter_value: filterValue },
                    success: function(data) {
                        // Update UI with filtered data
                        // Example: $('#item_list').html(data);
                    }
                });
            });
        });
    </script>

<script>

     function selectAllCheckboxes() {
        var checkboxes = document.querySelectorAll('.entry_ids');
        var allChecked = true;
        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                allChecked = false;
                checkbox.checked = true;
            }
        });
        
        if (allChecked) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    }
    // $('#dataTable1').DataTable();
    $(document).on('click','#switchh',function(){
        var status = $(this).val();
        var id = $(this).attr('idd');
       
        $.ajax({
            url:'<?= base_url('companyrate_statusupdate'); ?>',
            type:'post',
            data:{status:status,id:id},
            success:function(res){
                console.log(res)
            }
        })
    })
    $(document).ready(function () {
        $('#delete-entries-btn').click(function () {
            // var entry_ids = $('.entry_ids').map(function () {
            //     return this.value;
            // }).get();
            var entry_ids = [];
            $('.entry_ids:checked').each(function() {
                entry_ids.push($(this).val());
            });


            $.ajax({
                type: 'POST',
                url: '<?= base_url('companyrate_delete_entries')?>',
                data: { entry_ids: entry_ids },
                success: function (response) {
                    alert('Entries deleted successfully');
                    location.reload();
                },
                error: function () {
                    alert('Error deleting entries');
                }
            });
        });
    });

    function selectAllCheckboxes() {
        var checkboxes = document.querySelectorAll('.entry_ids');
        var allChecked = true;
        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                allChecked = false;
                checkbox.checked = true;
            }
        });
        
        if (allChecked) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    }



</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
$(document).ready(function() {
    $('.fav_clr').select2({    
        placeholder: "Please select a country",
        width: '100%',
        border: '1px solid #e4e5e7',
    });
});

$('.fav_clr').on("select2:select", function (e) { 
    var data = e.params.data.text;
    if(data=='all'){
        $(".fav_clr > option").prop("selected","selected");
        $(".fav_clr").trigger("change");
    }
});
    

$(document).on('click','.other_rate_data',function(){
    var idd = $(this).data('id');
    var data_type = $(this).data('country');
    var data_entered = $(this).data('entered');
    $('#copy_country_id_other_rate').val(idd);
    $('#country_id_other_rate').val(data_type);
    $('#entered_by_other_rate').val(data_entered);
    $('#countryotherrate').modal('show');
  });


  $('#import_excel6').submit(function(e){
    e.preventDefault();
     var formData = new FormData(this);
    $(':input[type="submit"]').prop('disabled', true);
     $.ajax({
        url:'<?= base_url('company-other-charges') ?>',
        type:'Post',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(result){
          $(':input[type="submit"]').prop('disabled', false);
          swal({
                      title: "Success",
                      text: "File Import Successfully",
                      icon: "success",
                      button: false,
                      timer: 3000
                    });
                location.reload();
        }

     });
  })

  
  $(document).on('click','#clear_id',function(){
    $('#import_excel3').trigger('reset');
    $('#country_idd').trigger("change");
  })    

  
$('#import_excel3').submit(function(e){
    e.preventDefault();
     var formData = new FormData(this);
    $(':input[type="submit"]').prop('disabled', true);
     $.ajax({
        url:'<?= base_url('company-other-charges') ?>',
        type:'Post',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(result){
          $(':input[type="submit"]').prop('disabled', false);
          swal({
                      title: "Success",
                      text: "File Import Successfully",
                      icon: "success",
                      button: false,
                      timer: 3000
                    });
                location.reload();
        }

     });
  })


  
  
  $('#export_excel_other_rate').submit(function(e){
    e.preventDefault();
     var formData = new FormData(this);
    //  alert(formData);
    $(':input[type="submit"]').prop('disabled', true);
     $.ajax({
        url:'<?= base_url('edit-company-other-charges') ?>',
        type:'Post',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(result){
          $(':input[type="submit"]').prop('disabled', false);
          swal({
              title: "Success",
              text: "File Updated Successfully",
              icon: "success",
              button: false,
              timer: 3000
            });
        location.reload();
        }

     });
  })

    
  $(document).on('click','.delete-country',function(){
    var id = $(this).attr('id');
    var vendor_id = $(this).attr('vendor_id');
    var type = $(this).attr('type');
    if (confirm("Are you sure?")) {
        $.ajax({
            url:'<?= base_url('company/deleteCountryLink') ?>',
            type:'Post',
            data:{id:id,vendor_id:vendor_id,type:type},
            success:function(result){
              location.reload();
            }

        });
    }
    return false;    
  })


  
  $(document).on('click','.edit-remark',function(){
     var idd = $(this).attr('idd');
     $('.remark'+idd).removeAttr('readonly');
  })

  $(document).on('click','.save-remark',function(){
     var idd = $(this).attr('idd');
     var remark =$('.remark'+idd).val();
      $.ajax({
          url:'<?= base_url('company/updateRemark') ?>',
          type:'Post',
          data:{save:idd,remark:remark},
          success:function(result){
            // location.reload();
            
          }

      });
    //  $('.remark'+idd).removeAttr('readonly');
  })

  $(document).on('click','.remove-remark',function(){
     var idd = $(this).attr('idd');
     $.ajax({
          url:'<?= base_url('company/updateRemark') ?>',
          type:'Post',
          data:{remove:idd},
          success:function(result){
            $('.remark'+idd).val('');
          }

      });
    //  $('.remark'+idd).removeAttr('readonly');
  })
    
    
  $(document).on('click','.edit-divisor',function(){
     $('.divisor_able').removeAttr('disabled');
  })

  $(document).on('click','.save-divisor',function(){
     var remark =$('.divisor_able').val();
     var idd =$('.divisor_able').data('id');
     var product_id =$('.divisor_able').data('product');
     var shipment_type =$('.divisor_able').data('type');

      $.ajax({
          url:'<?= base_url('updatedivisor') ?>',
          type:'Post',
          data:{save:idd,remark:remark,product_id:product_id,shipment_type:shipment_type},
          success:function(result){
            location.reload();          
          }
      });
  })
  $(document).on('click','.remove-divisor',function(){
     var remark =$('.divisor_able').val();
     var idd =$('.divisor_able').data('id');
     var product_id =$('.divisor_able').data('product');
     var shipment_type =$('.divisor_able').data('type');

      $.ajax({
          url:'<?= base_url('updatedivisor')?>',
          type:'Post',
          data:{remove:idd,remark:remark,product_id:product_id,shipment_type:shipment_type},
          success:function(result){
            location.reload();          
          }
      });
  })

    
    </script>

    <script>
function addMoreFields() {
    let wrapper = document.getElementById('non-standard-wrapper');

    // ✅ correct selector
    let rows = wrapper.querySelectorAll(".non-standard-row");

    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }

    let lastRow = rows[rows.length - 1];
    let newRow = lastRow.cloneNode(true);

    // clear inputs
    newRow.querySelectorAll('input').forEach(input => input.value = '');

    // replace button with Remove button
    let btnContainer = newRow.querySelector('.col-xl-2:last-child');
    btnContainer.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="removeRow(this)">
          Remove
        </button>`;

    wrapper.appendChild(newRow);
}

function addMoreFields2() {
    let wrapper = document.getElementById('non-standard-wrapper2');

    // ✅ correct selector
    let rows = wrapper.querySelectorAll(".non-standard-row2");

    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }

    let lastRow = rows[rows.length - 1];
    let newRow = lastRow.cloneNode(true);

    // clear inputs
    newRow.querySelectorAll('input').forEach(input => input.value = '');

    // replace button with Remove button
    let btnContainer = newRow.querySelector('.col-xl-2:last-child');
    btnContainer.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="removeRow(this)">
          Remove
        </button>`;

    wrapper.appendChild(newRow);
}

function addMoreClause2() {
    let wrapper = document.getElementById('wrapper-clause-2');

    // ✅ correct selector
    let rows = wrapper.querySelectorAll(".non-standard-row-2");

    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }

    let lastRow = rows[rows.length - 1];
    let newRow = lastRow.cloneNode(true);

    newRow.querySelectorAll('input').forEach(input => input.value = '');

    let btnContainer = newRow.querySelector('.col-xl-2:last-child');
    btnContainer.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="removeRow(this)">
          Remove
        </button>`;

    wrapper.appendChild(newRow);
}

function addMoreClause2_2() {
    let wrapper = document.getElementById('wrapper-clause-2-2');

    // ✅ correct selector
    let rows = wrapper.querySelectorAll(".non-standard-row-2-2");

    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }

    let lastRow = rows[rows.length - 1];
    let newRow = lastRow.cloneNode(true);

    newRow.querySelectorAll('input').forEach(input => input.value = '');

    let btnContainer = newRow.querySelector('.col-xl-2:last-child');
    btnContainer.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="removeRow(this)">
          Remove
        </button>`;

    wrapper.appendChild(newRow);
}

// remove row
function removeRow(button) {
    button.closest('.row').remove();
}
</script>



<script>
function addMoreClause3() {
    let wrapper = document.getElementById("wrapper-clause-3");
    let firstRow = wrapper.querySelector(".non-standard-row-2");
       let rows = wrapper.querySelectorAll(".non-standard-row-2");
    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }

    let clone = firstRow.cloneNode(true);

    // clear inputs
    clone.querySelectorAll("input").forEach(input => {
        input.value = "";
    });

    // action button column find karo
    let actionCol = clone.querySelector(".action-btn-col");

    // button replace karo
    actionCol.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="this.closest('.non-standard-row-2').remove()">
          Remove
        </button>
    `;

    wrapper.appendChild(clone);
}

function addMoreClause3_3() {
    let wrapper = document.getElementById("wrapper-clause-3-3");
    let firstRow = wrapper.querySelector(".non-standard-row-2-3");
       let rows = wrapper.querySelectorAll(".non-standard-row-2-3");
    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }

    let clone = firstRow.cloneNode(true);

    // clear inputs
    clone.querySelectorAll("input").forEach(input => {
        input.value = "";
    });

    // action button column find karo
    let actionCol = clone.querySelector(".action-btn-col");

    // button replace karo
    actionCol.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="this.closest('.non-standard-row-2-3').remove()">
          Remove
        </button>
    `;

    wrapper.appendChild(clone);
}
</script>
<script>
function addMoreClause4() {
    let wrapper = document.getElementById("wrapper-clause-4");
    let firstRow = wrapper.querySelector(".non-standard-row-2");
       let rows = wrapper.querySelectorAll(".non-standard-row-2");
    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }

    let clone = firstRow.cloneNode(true);

    // clear all inputs
    clone.querySelectorAll("input").forEach(input => {
        input.value = "";
    });

    // action button column
    let actionCol = clone.querySelector(".action-btn-col");

    // replace button with Remove
    actionCol.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="this.closest('.non-standard-row-2').remove()">
          Remove
        </button>
    `;

    wrapper.appendChild(clone);
}

function addMoreClause4_4() {
    let wrapper = document.getElementById("wrapper-clause-4-4");
    let firstRow = wrapper.querySelector(".non-standard-row-2-4");
       let rows = wrapper.querySelectorAll(".non-standard-row-2-4");
    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }

    let clone = firstRow.cloneNode(true);

    // clear all inputs
    clone.querySelectorAll("input").forEach(input => {
        input.value = "";
    });

    // action button column
    let actionCol = clone.querySelector(".action-btn-col");

    // replace button with Remove
    actionCol.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="this.closest('.non-standard-row-2-4').remove()">
          Remove
        </button>
    `;

    wrapper.appendChild(clone);
}
</script>
<script>
function addMoreClause5() {
    let wrapper = document.getElementById("wrapper-clause-5");
    let firstRow = wrapper.querySelector(".non-standard-row-2");
       // max limit = 4
    let rows = wrapper.querySelectorAll(".non-standard-row-2");
    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }


    let clone = firstRow.cloneNode(true);

    // clear all inputs
    clone.querySelectorAll("input").forEach(input => {
        input.value = "";
    });

    // action button column
    let actionCol = clone.querySelector(".action-btn-col");

    // replace button with Remove
    actionCol.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="this.closest('.non-standard-row-2').remove()">
          Remove
        </button>
    `;

    wrapper.appendChild(clone);
}
function addMoreClause5_5() {
    let wrapper = document.getElementById("wrapper-clause-5-5");
    let firstRow = wrapper.querySelector(".non-standard-row-2-5");
       // max limit = 4
    let rows = wrapper.querySelectorAll(".non-standard-row-2-5");
    if (rows.length >= 4) {
        alert("You can add maximum 4 entries only.");
        return;
    }


    let clone = firstRow.cloneNode(true);

    // clear all inputs
    clone.querySelectorAll("input").forEach(input => {
        input.value = "";
    });

    // action button column
    let actionCol = clone.querySelector(".action-btn-col");

    // replace button with Remove
    actionCol.innerHTML = `
        <button type="button"
                class="btn btn-danger w-100"
                onclick="this.closest('.non-standard-row-2-5').remove()">
          Remove
        </button>
    `;

    wrapper.appendChild(clone);
}
</script>


