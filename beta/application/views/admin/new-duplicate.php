<?php include viewPath('includes/header');?>
<?php 

// echo '<pre>';print_r($booking_c);die;?>
<style>
    .row-1{
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    /* margin-right: -15px; */
    /* margin-left: -15px; */

    }
    .box-title{
        color:#008838;
        font-size: 20px !important;
    }
    .box.box-primary {
        border-top-color: #3c8dbc;
        background: #cfb00e9e;
        border-radius: 19px;
    }
    .content_All{
        color: #c52242;
    }
    .form-control, .input-group .input-group-addon{
        background: #ede7e7fa;
    } 
    .input-group .input-group-addon{
        line-height: 36px;
        padding: 0 10px;
    }
    @media (min-width: 1200px) {
    .modal-xl {
        max-width: 1400px !important;
    }
}
 #able_all{
    display: none;
 }
 table.text-center td {
    vertical-align: bottom;
}
.modal-dialog-scrollable .modal-content {
    overflow-y: auto !important;
}
.manually_sale ,.manually_sale[readonly],.manually_vendor,.manually_vendor[readonly] {
    background: #c7c9cb ;
    pointer-events: none;
}
</style>

<?php if(isset($_GET['id'])){ ?>
    <style>
    .box.box-primary {
        border-top-color: #3c8dbc;
        background: #E6E6FA !important;
        border-radius: 19px;
    }
    </style>
    <?php } ?>
<?php


$hsncatss = '';
if (!empty($hsncats)) {
    foreach($hsncats as $hsn) {
        $hsncatss .= '<option value="' . $hsn['hsncode_id'] . '">' . $hsn['hsn_name'] . '</option>';
    }
}

$type_hsn = '';
if (!empty($types)) {
    foreach($types as $val) {
        $type_hsn .= '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
    }
}


// $gst = $this->db->get("gstmaster")->row();
// echo '<pre>';
// print_r($gst);die;
$vendor_list = "";
if (!empty($vendors)) {
    foreach ($vendors as $ven) {
        $vendor_list .= "<option value='" . $ven['vendor_id'] . "'>" . $ven['vendor_name'] . " </option>";
    }
}


$vendor_list_product = "";
if (!empty($vendors)) {
    foreach ($vendors as $ven) {

        $set='';
        if (!empty($_GET['id'])) {
            if ($ven['vendor_id'] == $booking_d['vendor_list']) {
                $set= 'selected'; 
            }else{
                $set='';
            }
        }
        $vendor_list_product .= "<option ".$set." value='" . $ven['vendor_id'] . "'>" . $ven['vendor_name'] . " </option>";
    }
}

$web_agent_name_vendor = "";
if (!empty($vendors)) {
    foreach ($vendors as $ven) {

        $set='';
        if (!empty($_GET['id'])) {
            if ($ven['vendor_id'] == $booking_d['web_agent_name']) {
                $set= 'selected'; 
            }else{
                $set='';
            }
        }
        $web_agent_name_vendor .= "<option ".$set." value='" . $ven['vendor_id'] . "'>" . $ven['vendor_name'] . " </option>";
    }
}

$additional_agent_name = "";
if (!empty($vendors)) {
    foreach ($vendors as $ven) {

        $set='';
        if (!empty($_GET['id'])) {
            if ($ven['vendor_id'] == $booking_d['additional_agent_name']) {
                $set= 'selected'; 
            }else{
                $set='';
            }
        }
        $additional_agent_name .= "<option ".$set." value='" . $ven['vendor_id'] . "'>" . $ven['vendor_name'] . " </option>";
    }
}

$ecom_agent_name = "";
if (!empty($vendors)) {
    foreach ($vendors as $ven) {

        $set='';
        if (!empty($_GET['id'])) {
            if ($ven['vendor_id'] == $booking_d['ecom_agent_name']) {
                $set= 'selected'; 
            }else{
                $set='';
            }
        }
        $ecom_agent_name .= "<option ".$set." value='" . $ven['vendor_id'] . "'>" . $ven['vendor_name'] . " </option>";
    }
}

$sub_vendor_list = "";
if (!empty($subvendors)) {
    foreach ($subvendors as $ven) {

        $set='';
        if (!empty($_GET['id'])) {
            if ($ven['vendor_id'] == $booking_d['sub_customer_list']) {
                $set= 'selected'; 
            }else{
                $set='';
            }
        }
        $sub_vendor_list .= "<option  ".$set." value='" . $ven['vendor_id'] . "'>" . $ven['vendor_name'] . " </option>";
    }
}

$ecmom_list = "";
if (!empty($ecom)) {
    foreach ($ecom as $ecomitem) {
        $ecmom_list .= "<option value='" . $ecomitem['id'] . "'>" . $ecomitem['ecom_name'] . " </option>";
    }
}
$hsnCoder = "";
if (!empty($hsncode)) {
    foreach ($hsncode as $hsn_code) { 
        $hsnCoder .=  "<option value='". $hsn_code['hsn_code'] ."'>". $hsn_code['hsn_code']."</option>";
 } } 

 $hsncode_abc= "";
if (!empty($hsncode)) {
    foreach ($hsncode as $hsn_code2) { 
        $hsncode_abc .=  "<option value='". $hsn_code2['hsn_code'] ."'>". str_replace('"','', $hsn_code2['hsn_details'])."</option>";
        
 } }

$product_list = "";
if (!empty($products)) {
    foreach ($products as $product) {
        $set='';
        if (!empty($_GET['id'])) {
            if ($product['id'] == $booking_d['product_id']) {
                $set= 'selected'; 
            }else{
                $set='';
            }
        }
        $product_list .= "<option ".$set." data='" . $product['shipment_type'] ."' value='" . $product['id'] . "'>" . $product['name'] . " </option>";
    }
}

$currency_dropdown = "";
if (!empty($currencies)) {
    foreach ($currencies as $currency) {
        $currency_dropdown .= "<option value='" . $currency['code'] . "'>" .$currency['country'] .', ' . $currency['currency'] . " (" . $currency['symbol'] . ")" . "</option>";
    }
}

$countries_dropdown = "";
if (!empty($countries)) {
    foreach ($countries as $country) {
        if ($country['short_name'] == '') {
            $sett= 'selected'; 
        }else{
            $sett='';
        }
        $countries_dropdown .= "<option ".$sett." data-value='" . $country['id'] . "' value='" . $country['country_name'] . "'>" . $country['country_name'] . " (" . $country['short_name'] . ")" . "</option>";
    }
}


$companies_dropdown = "";
if (!empty($companies)) {
    foreach ($companies as $company) {

// echo '<pre>';print_r($company);die;
        $set='';
        if (!empty($_GET['id'])) {
            // if ($company['company_id'] == $booking_c['customer_name']) {
                if ($company['company_id'] == $booking_c_d['customer_name']) {
                $set= 'selected'; 
            }else{
                $set='';
            }
        }

        if (!empty($booking['customer_name']) && $company['company_id'] == $booking['customer_name']) {
            $set = 'selected';
        }
        
        $companies_dropdown .= "<option ".$set." value='" . $company['company_id'] . "' price_per_kg='" . $company['price_per_kg'] . "' data-com_name='" . $company['company_name'] . "' data-type_name='" . $company['type1'] . "'  data-gstno='" . $company['gst'] . "'   data-account_no='" . $company['account_no'] . "'  data-customer_address='" . $company['address'] . "'  data-state='" . $company['state'] . "' >" . $company['company_name'] . "</option>";
    }
}

$users_dropdown = "";
if (!empty($users)) {
    foreach ($users as $user) {
        $users_dropdown .= "<option value='" . $user->id . "' >" . $user->name . "</option>";
    }
}
$agent_dropdown = "";
if (!empty($agents)) {
    foreach ($agents as $agent) {
        $set='';
        if (!empty($_GET['id'])) {
            if ($agent['id'] == $booking_d['main_agent_name']) {
                $set= 'selected'; 
            }else{
                $set='';
            }
        }
        $agent_dropdown .= "<option ".$set." value='" . $agent['id'] . "' data='" . $agent['agent_awb_no'] . "'>" . $agent['name'] . "</option>";
    }
}
$lookupdetail_dropdown = "";
if (!empty($lookupdetails)) {
    foreach ($lookupdetails as $lookup) {
        $lookupdetail_dropdown .= "<option value='" . $lookup['lookup_value'] . "'>" . $lookup['lookup_value'] . "</option>";
    }
}
$cft_dropdown = "";
if (!empty($cftdetails)) {
    foreach ($cftdetails as $cft) {
        $cft_dropdown .= "<option value='" . $cft['id'] . "'>" . $cft['value'] . "</option>";
    }
}
$payment_mode_dropdown = "";
if (!empty($payment_mode)) {
    foreach ($payment_mode as $payment_mod) {
        $set='';
        if (!empty($_GET['id'])) {
            if ($payment_mod['name'] == $booking_d['payment_mode']) {
                $set= 'selected'; 
            }else{
                $set='';
            }
        }
        $payment_mode_dropdown .= "<option ".$set."  value='" . $payment_mod['id'] . "'>" . $payment_mod['name'] . "</option>";
    }
}
$shipment_dropdown = "";
if (!empty($shipmentDetails)) {
    foreach ($shipmentDetails as $shipmentDe) {
        $setc='';
        if (!empty($_GET['id'])) {
            if ($shipmentDe['name'] == $booking_d['shipment_type']) {
                $setc= 'selected'; 
            }else{
                $setc='';
            }
        }
        $shipment_dropdown .= "<option ".$setc." value='" . $shipmentDe['name'] . "'>" . $shipmentDe['name'] . "</option>";
    }
}
?>
<form action="<?= base_url('company/new');?>" id="newMaster" method="post" enctype="multipart/form-data">
<section class="content content_All">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                    <h3 class="box-title">Edit AWB List</h3>
                </div>  
                <div class="box-body addBillEntry-box-1" id="box-body">
                <div class="row" style="align-items: end;">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="text" placeholder="SEARCH AWB ORBIT " class="form-control pull-right validate[required]"  value="" name="search">
                            </div>
                        </div>
                    </div>  
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="text" placeholder="SEARCH VENDER" class="form-control pull-right validate[required]"  value="" name="search_vendor">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
                        <div class="form-group">
                            <a href="" class="btn btn-success" id="deleteshipp" title="search" style="margin-top: 20px; font-size: 14px">search
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pl-3">
                <div>
                    <input type="radio" class="form-check-input content_All_location" id="International" name="location" <?= ($_GET['location'] == 'International') ? 'checked': ''; ?>  value="International"> 
                    <label class="form-check-label content_All " for="International">International</label>
                </div>
                <div class="">
                    <input type="radio" class="form-check-input content_All_location" id="Domastic" name="location"  <?= ($_GET['location'] == 'Domastic') ? 'checked': ''; ?> value="Domastic"> 
                    <label class="form-check-label content_All " for="Domastic">Domastic</label>
                </div>
                <div>
                    <input type="radio" class="form-check-input content_All_location" id="" name="location" <?= ($_GET['location'] == 'Local') ? 'checked': ''; ?> value="Local"> 
                    <label class="form-check-label content_All " for="Local">Locall</label>
                </div>
                </div>

            </div> 
        </div>
    </div>
        <div class="col-xl-12 col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Shipment Details</h3>
                    </div>  
                    <!-- /.box-header -->
                    <!-- form start -->
                    <!-- <form role="form"> -->
                    <div class="box-body addBillEntry-box-1" id="box-body">
                        <div class="row" >
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label>Booking Date Type<span class="required" aria-required="true">*</span></label>
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right validate[required]"
                                        id="datepicker"
                                        value="<?php echo !empty($_GET['id'])? date('d/m/Y',strtotime(str_replace('-', '/', $booking['booking_date']))):"" ?>"
                                        name="booking_date">
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12" style="">
                                <div class="form-group">
                                    <label>Booking ID<span class="required" aria-required="true">*</span></label>
                                    <div class="input-group date">
                                        <input class="form-control" type="text" name="booking_id" id="booking_id"  value="<?php echo  !empty($_GET['id'])? $booking['booking_id']: $booking_id ?>" <?php if(isset($_GET['id'])){  echo 'readonly'; } ?>>
                                        <input type="hidden" name="update_id"
                                        value="<?php if(isset($_GET['id'])){  echo $_GET['id']; } ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <div class="input-group">
                                       <input type="text" name="start_date" placeholder="start date" class="form-control datepicker" value="<?php if(!empty($_GET['id'])){ echo date('d/m/Y',strtotime(str_replace('-', '/', $booking['start_date']))); }else{ echo date('d/m/Y'); }  ?>">
                                       <input type="hidden" name="awb" value="International" class="rate_class" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">Time</label>
                                    <div class="input-group">
                                    <input type="time" name="end_date" placeholder="end date" class="form-control " value="<?php if(!empty($_GET['id'])){ echo $booking['end_date']?$booking['end_date']:''; }else{ echo date('H:i'); } ?>">
                                    </div>
                                </div>
                            </div>               
                            <div class="col-xl-3 c3l-lg-3 col-md-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <div class="form-check">
                                       
                                        <input type="radio" class="form-check-input ship_type export_shipment" id="ship_type" name="ship_type" <?= (!empty($booking['shipment_type']) && $booking['shipment_type'] == 'EXPORT' ) ? 'checked' : 'checked'; ?>  value="EXPORT">EXPORT 
                                        <label class="form-check-label" for="radio1"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input ddu_shipment" id="ddu" name="ddu" <?= (!empty($booking['ddu']) && $booking['ddu'] == 'DDU' ) ? 'checked' : 'checked'; ?>   value="DDU">DDU
                                        <label class="form-check-label" for="radio2"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input stacakable_shipment" id="stacakable"checked name="stacakable" <?= (!empty($booking['stacakable']) && $booking['stacakable'] == 'stacakable' ) ? 'checked' : ''; ?> value="Stacakable">Stacakable
                                        <label class="form-check-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input non_commercial_shipment" id="stacakable"checked name="commercial"  <?= (!empty($booking['commercial']) && $booking['commercial'] == 'commercial' ) ? 'checked' : ''; ?> value="non_commercial">Non Commercial 
                                        <label class="form-check-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input gernalcargo_shipment" id="gernalcargo"checked name="dgrcargo"  <?= (!empty($booking['dgrcargo']) && $booking['dgrcargo'] == 'gernalcargo' ) ? 'checked' : ''; ?> value="gernalcargo">Genaral Cargo
                                        <label class="form-check-label"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input ship_type import_shipment" id="ship_type" name="ship_type" <?= (!empty($booking['shipment_type']) && $booking['shipment_type'] == 'IMPORT' ) ? 'checked' : ''; ?> value="IMPORT">IMPORT
                                        <label class="form-check-label" for="radio1"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input ddp_shipment" id="ddp" name="ddu" <?= (!empty($booking['ddu']) && $booking['ddu'] == 'DDP' ) ? 'checked' : ''; ?> value="DDP">DDP
                                        <label class="form-check-label" for="radio2"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input non_stacakable_shipment"  id="nonstacakable" name="stacakable" <?= (!empty($booking['stacakable']) && $booking['stacakable'] == 'Non Stacakable' ) ? 'checked' : ''; ?> value="Non Stacakable">Non Stacakable(Fragile)
                                        <label class="form-check-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input commercial_shipment" id="stacakable" name="commercial"  <?= (!empty($booking['commercial']) && $booking['commercial'] == 'commercial' ) ? 'checked' : ''; ?> value="commercial">Commercial 
                                        <label class="form-check-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input dgrcargo dgrcargo_shipment" id="gernalcargo dgrcargo" name="dgrcargo"  <?= (!empty($booking['dgrcargo']) && $booking['dgrcargo'] == 'dgrcargo' ) ? 'checked' : ''; ?> value="dgrcargo">DGR Cargo (Dangerous Goods)
                                        <label class="form-check-label"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12"> 
                                <div class="form-group">
                                <div class="form-check">
                                       
                                        <label class="form-check-label" for="radio1"></label>
                                    </div>
                                    <div class="form-check">
                                      
                                        <label class="form-check-label" for="radio2"></label>
                                    </div>
                                    <div class="form-check">
                                        
                                        <label class="form-check-label"></label>
                                    </div>
                                    <div class="form-check">

                                    <input type="radio" class="form-check-input"  id="self_clearance" name="commercial"  <?= (!empty($booking['self_clearance']) && $booking['self_clearance'] == 'self_clearance' ) ? 'checked' : ''; ?> value="self_clearance">SELF CLEARANCE(Commercial)

                                        <!-- <input type="radio" class="form-check-input" checked id="self_clearance" name="commercial"  <?= (!empty($booking['self_clearance']) && $booking['self_clearance'] == 'self_clearance' ) ? 'checked' : ''; ?> value="self_clearance">SELF CLEARANCE(Commercial) -->
                                        <label class="form-check-label"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12"> </div> -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12"> 
                                <div class="form-group">
                                    <label for="">Remark</label>
                                    <textarea class="form-control" name="non_commercial_remark" placeholder="Remark"> <?= (!empty($booking['non_commercial_remark'])) ?  $booking['non_commercial_remark'] : '' ?> </textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="">Special Note (In Invoice)</label>
                                    <textarea class="form-control" name="special_note"><?php echo !empty($_GET['id'])? $booking['special_note']:"" ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

            <!-- FIRST BOX END -->

        <div class="col-xl-12 col-lg-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer (Account Holder)/ Shipper Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <!-- <form role="form"> -->
                    <div class="box-body addBillEntry-box-3">
                        <div class="row align-items-baseline" >
                            
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">Customer /Company / Account Holder<span class="required" aria-required="true">*</span></label>
                                        <select class="form-control customer_name validate[required]" name="customer_name" id="customer_name" required="">
                                        <option value="">Select Company</option>
                                        <?php echo $companies_dropdown; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">State <span class="required" aria-required="true">*</span></label>
                                    <input class="form-control validate[required]" type="text" name="customer_state" id="customer_state" required="" aria-required="true" readonly  value="<?php echo  !empty($_GET['id'])? $booking_c_d['customer_state']:"" ?>">
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">A/C Code <span class="required" aria-required="true">*</span></label>
                                    <input class="form-control validate[required]" type="text" name="customer_account_code" id="customer_account_code" required="" aria-required="true"  value="<?php echo  !empty($_GET['id'])? $booking_c_d['account_no']:"" ?>" >
                                </div>
                            </div>
                            <?php
                            // echo '<pre>';print_r($booking_c_d);die;

                            ?>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select name="customer_type" id="customer_type" class="form-control">
                                        <option value=""> Select Type</option>
                                        <?php
                                        $type = $this->db->select('*')->get('customer_type')->result_array();
                                        foreach ($type as $key => $value) {   ?>    
                                        <option <?php if(!empty($_GET['id'])){ if($booking_c_d['customer_type'] == $value['id']){ echo "selected"; }} ?>  value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?php  }?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">Orbit User<span class="required" aria-required="true">*</span></label>
                                    <select class="form-control" id="orbit_user" name="orbit_user">
                                        <option value="0">Orbit User</option>
                                        <?= $users_dropdown; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">Customer /Company / Name<span class="required" aria-required="true">*</span></label>
                                    <textarea class="form-control validate[required]" type="text" id="customer_account_name" required="" aria-required="true" name="customer_account_name" > <?php echo  !empty($_GET['id'])? $booking_c_d['customer_account_name']:"" ?></textarea>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <label for="">Address<span class="required" aria-required="true">*</span></label>
                                <textarea class="form-control validate[required]" name="customer_address" required="" id="customer_address" aria-required="true"><?php echo  !empty($_GET['id'])? $booking_c_d['address']:"" ?></textarea>
                            </div>
                            
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">Send Reference </label>
                                    <textarea class="form-control" name="customer_send_reference" id="customer_send_reference" type="text"><?php echo  !empty($_GET['id'])? $booking_c_d['send_reference']:"" ?></textarea>
                                </div>
                            </div>

                            

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label for="">AWB series Type<span class="required" aria-required="true">* (required)</span></label>
                                    <select class="form-control validate[required]" name="customer_other_detail" id="customer_other_detail">
                                        <option <?php (!empty($_GET['id']) && ($booking_c_d['send_reference'] == 'Offline')) ? 'selected' :'' ; ?> value="Offline" selected="true">Offline/Manual</option>
                                        <option <?php (!empty($_GET['id']) && ($booking_c_d['send_reference'] == 'predefined')) ? 'selected' :'' ; ?>  value="predefined">Predefined Online</option>
                                    </select>
                                </div>
                            </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <label>AWB No.<span class="required" aria-required="true">*</span> </label>
                                    <div class="input-group date">
                                    <input type="text" class="form-control pull-right validate[required]" id="awb_no" 
                                        value="<?php echo  !empty($_GET['id'])? $booking_c_d['awb_no']:''; ?>"
                                        name="awb_no_new" <?php if(!empty($_GET['id'])){ echo 'readonly'; } ?>>
                                    <input type="hidden" name="awb_no_id" value="">
                                    <input type="hidden" name="awb_no" value="<?= $lastbooking['awb_no'] ?? ''; ?>">
                                </div>
                                <span id="aws_msg"></span>
                            </div>
                            </div>

                        

                        <!-- <script>
                            $('#customer_name').on('change', function() {
                                checkAWBNo() ;

                            });
                            
                     $(document).ready(function () {
                                function checkAWBNo() {
                                    let awbNo = $('#awb_no').val(); 
                                    
                                    if (awbNo !== '') {
                                        $.ajax({
                                            url: '<?= base_url("company/check_awb_no_exists"); ?>', 
                                            type: 'POST',
                                            data: { awb_no: awbNo },
                                            dataType: 'json',
                                            success: function (response) {
                                                if (response.exists) {
                     
                                             $('#awb_no').val(response.next_awb_number);  
                                           if ($('#awb_no_message').length === 0) {
                                                 $('#awb_no').after('<span id="awb_no_message" style="color: red; font-size: 12px;">This AWB number already exists. Updated to: ' + response.next_awb_number + '</span>');
                                           } else {
                             
                                             $('#awb_no_message').text('This AWB number already exists. Updated to: ' + response.next_awb_number);
                                              }
                                            } else {
                                            
                                                $('#awb_no_message').remove();
                                            }
                                            },
                                            error: function () {
                                                console.error('Error checking AWB number.');
                                            }
                                        });
                                    }
                                }

                                // Check every second
                                setInterval(checkAWBNo, 3000);
                            });

                        </script> -->

                        <style>
                        .is-invalid {
                            border: 1px solid red;
                        }
                        </style>

                            <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12"></div> -->

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 showawsst" style="display: none;">
                            <div class="form-group">
                                <label>AWB No Start Date<span class="required" aria-required="true">*</span></label>
                                <div class="input-group date">
                                    <input type="text" class="form-control pull-right validate[required]" name="st_awb_no" id="st_awb_no" value="<?php echo  !empty($_GET['id'])? $booking_c_d['st_awb_no']:"" ?>" readonly="">
                                </div>
                            </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 showawsst" style="display: none;">
                                <div class="form-group">
                                    <label>AWB No End Date<span class="required" aria-required="true">*</span></label>
                                     <div class="input-group date">
                                        <input type="text" class="form-control pull-right validate[required]" name="end_awb_no" id="end_awb_no" value="<?php echo  !empty($_GET['id'])? $booking_c_d['end_awb_no']:"" ?>" readonly="">
                                    </div>
                                <!-- /.input group -->
                                </div>
                             </div>
                            


                                    </div>
                                </div>
                            </div>
                    </div>
                        <!-- /.box-body -->
                        <!-- </form> -->
               
                <!-- /.box -->


                <div class="col-xl-12 col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product Details</h3>
                    </div>  
                    <!-- /.box-header -->
                    <!-- form start -->
                    <!-- <form role="form"> -->
                    <div class="box-body addBillEntry-box-1" id="box-body">
                        <div class="row" style="align-items: end;">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="">Products<span class="required" aria-required="true">*</span></label>
                                    <select class="form-control product_idss" name="product_id" id="product_id" required="">
                                            <option value="">Select Product</option>
                                            <?php echo $product_list; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <div class="form-group">
                                    <label for="">Shipment Type<span class="required" aria-required="true">*</span></label>
                                    <select class="form-control" id="shipment_type" name="shipment_type">
                                            <option value="">Select</option>
                                            <?php echo $shipment_dropdown; ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label for="">Zone</label>
                                    <input type="text" class="form-control" name="zone_id" id="zone_lbl"
                                            value="<?php echo  !empty($_GET['id'])? $booking_d['zone_id']:"" ?>"
                                            readonly>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3"></div>

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label for="">Vendor Name <span class="required" aria-required="true">*</span>
                                    </label>
                                    <!-- <label>Select</label> -->
                                    <input type="number" class="form-control product-name validate[required]"  name="product_name" id="product_name" style="display: none" />

                                    <select class="form-control customer-list" name="customer_list" id="vendors_list">
                                            <option value="">Select vendors</option>
                                            <?= $vendor_list_product; ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="">Vendor State<span class="required " aria-required="true">*</span></label>
                                    <input type="text" class="form-control vendor_states" readonly name="vendor_states" id="vendor_states" value="<?php echo  !empty($_GET['id'])? $booking_d['vendor_states']:"" ?>">
                                </div>
                            </div>            
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="">Vendor AWB No.<span class="required " aria-required="true">*</span></label>
                                    <input type="text" class="form-control vendor_awb" name="vendor_awb" id="vendor_awb" value="<?php echo  !empty($_GET['id'])? $booking_d['vendor_awb']:"" ?>">
                                </div>
                            </div>
                              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                    <label for="">Sub Vendor Name <span class="required" aria-required="true">*</span>
                                    </label>
                                    <!-- <label>Select</label> -->
                                    <input type="number" class="form-control product-name validate[required]"  name="product_name" id="product_name" style="display: none" />

                                    <select class="form-control sub-customer-list" name="sub_customer_list" id="sub_vendors_list">
                                            <option value="">Select Sub Vendors</option>
                                            <?= $sub_vendor_list; ?>
                                    </select>
                                </div>
                            </div>             
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="">Sub Vendor State<span class="required " aria-required="true">*</span></label>
                                    <input type="text" class="form-control sub_vendor_state" name="sub_vendor_state" id="sub_vendor_state" value="<?php echo  !empty($_GET['id'])? '':"" ?>">
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="">Sub Vendor AWB No.<span class="required " aria-required="true">*</span></label>
                                    <input type="text" class="form-control vendor_awb" name="sub_vendor_awb" id="vendor_awb" value="<?php echo  !empty($_GET['id'])? $booking_d['sub_vendor_awb']:"" ?>">
                                </div>
                            </div>


                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                    <div class="form-group">
                                        <label for="">Web Agent Name <span class="required" aria-required="true">*</span>
                                        </label>
                                        <select class="form-control partner-lists validate[required]"
                                                    name="web_agent_name" id="web_agent_name">
                                                    <option value=''>Select web agent</option>
                                                    <?= $web_agent_name_vendor; ?>
                                                </select>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                    <div class="form-group">
                                        <label for="">Web Agent AWB No</label>
                                        <input type="text" class="form-control agent-awb-no validate[required] web_agent_awb_no"
                                                    name="web_agent_awb_no"
                                                    value="<?php echo  !empty($_GET['id'])? $booking_d['web_agent_awb_no']:"" ?>"
                                                    id="web_agent_awb_no" />
                                    </div>
                                </div>
                                <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3"></div> -->

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                    <div class="form-group">
                                        <label for="">Additional Agent Name</label>
                                        <select class="form-control partner-list" name="additional_agent_name">
                                            <option value="">Please select agent</option>
                                                    <?= $additional_agent_name; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                    <div class="form-group">
                                        <label for="">Additional Agent AWB No.</label>
                                        <input type="text" class="form-control agent-awb-no" name="additional_agent_awb_no" value="<?php echo  !empty($_GET['id'])? $booking_d['additional_agent_awb_no']:"" ?>">
                                    </div>
                                </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6"></div>
                                
                            
                            

                            <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 " style="margin-top:14px;">
                                <div class="form-group">
                                    <input type="button" class="btn btn-primary add-ecomm-agent mr-3" value="eComm Agent" id="1">
                                    <input type="button" class="btn btn-success add-ecomm-agent valid" style="border-radius: 50%;" value="+" id="1" aria-invalid="false">
                                </div>
                            </div> -->
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                    <div class="form-group">
                                        <label for="">Ecomm Agent Name</label>
                                        <select class="form-control partner-list" name="ecom_agent_name">
                                            <option value="">Please select agent</option>
                                            <?= $ecom_agent_name; ?>
                                        </select>
                                    </div>
                                </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <div class="form-group">
                                    <label for="">Tracking #</label>
                                    <input type="text" class="form-control " name="tracking" value="<?php echo  !empty($_GET['id'])? $booking_d['tracking']:"" ?>">
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <div class="form-group">
                                    <label for="">Order Id</label>
                                    <input type="text" class="form-control " name="order_id" value="<?php echo  !empty($_GET['id'])? $booking_d['order_id']:"" ?>">
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <div class="form-group">
                                    <label for="">Received Date</label>
                                    <input type="date" class="form-control datepicker" name="received_date" value="<?php if(!empty($_GET['id']) && !empty($booking_d['received_date'])){echo $booking_d['received_date'];} ?>">
                                </div>
                            </div>
                           
                            
                        </div>
            </div>
            </div>
            </div>


                    <!-- Form Element sizes -->
       
            <div class="col-xl-6 col-lg-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Actual Shipper (Sender)</h3>
                    </div>  
                    <!-- /.box-header -->
                    <!-- form start -->
                    <!-- <form role="form"> -->
                    <div class="box-body addBillEntry-box-1" id="box-body">
                        <div class="row">
                            
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                <div class="form-group">
                                    <label>Shipper<span class="required" aria-required="true">*</span></label>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                        <select class="form-control shiper-dropdown" name="actual_shiper"
                                            id="actual_shiper">
                                            <option value="">Select shiper</option>
                                        </select>
                                    </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6 mb-3">
                                   <div class="form-group">
                                        <a href="" class="btn btn-danger" id="deleteshipper" title="Active/Inactive"
                                            style=" font-size: 14px">Delete Saved Shipper
                                        </a>
                                    </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Person Name ( Actual Shipper - Sender Name  ) </label>
                                        <input type="text" name="actual_shiper_person_name"
                                            id="actual_shiper_person_name" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($booking_s['name'])? $booking_s['name']:"" ?>" >
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Company's Name</label>
                                        <input type="text" id="actual_shiper_company" class="form-control pull-right validate[required]" value="<?php echo  !empty($_GET['id']) && !empty($booking_s['company'])? $booking_s['company']:"" ?>" name="actual_shiper_company">
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Address -1 </label>
                                        <input type="text" class="form-control pull-right validate[required]" value="<?php echo  !empty($_GET['id']) && !empty($booking_s['address'])? $booking_s['address']:"" ?>" name="actual_shiper_address" id="actual_shiper_address">
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Address -2 </label>
                                        <input type="text" class="form-control pull-right validate[required]" value="<?php echo  !empty($_GET['id']) && !empty($booking_s['address2'])? $booking_s['address2']:"" ?>" name="actual_shiper_address2" id="actual_shiper_address2">
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Address -3 </label>
                                        <input type="text" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($booking_s['address3'])? $booking_s['address3']:"" ?>" name="actual_shiper_address3" id="actual_shiper_address3" <?php echo  !empty($_GET['id']) && !empty($booking_s['address3'])? $booking_s['address3']:"" ?>>
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Pin Code / Postal Code <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($booking_s['pincode'])? $booking_s['pincode']:"" ?>" name="actual_shiper_pincode" id="actual_shiper_pincode">
                                </div>
                            </div>
                              <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 pl-0 mb-3">
                                <div class="form-group">
                                    <label for="">City</label>
                                        <input type="text" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($booking_s['city']) ? $booking_s['city']:"" ?>" name="actual_shiper_city" id="actual_shiper_city">
                                </div>
                            </div>
                              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pl-0 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">State</label>
                                        <input type="text" class="form-control" name="actual_shiper_state"
                                               value="<?php echo  !empty($_GET['id']) && !empty($booking_s['state'])? $booking_s['state']:"" ?>" id="actual_shiper_state" <?php echo  !empty($_GET['id']) && !empty($booking_s['state'])? $booking_s['state']:"" ?>>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <select class="form-control countries-dropdown" name="actual_shiper_country" id="actual_shiper_country">
                                            <option value="">Please select country</option>
                                            <?php //echo $countries_dropdown; ?>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Mobile Number<span class="required" aria-required="true">*</span></label>
                                         <input class="form-control" type="number" name="actual_shiper_mobile"
                                            id="actual_shiper_mobile" value="<?php echo  !empty($_GET['id']) && !empty($booking_s['mobile'])? $booking_s['mobile']:"" ?>">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 pl-0 mb-3">
                                <div class="form-group">
                                    <label for="">Telephone</label>
                                          <input class="form-control" type="number" name="actual_shiper_phone"
                                            id="actual_shiper_phone" value="<?php echo  !empty($_GET['id']) && !empty($booking_s['phone'])? $booking_s['phone']:"" ?>">
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pl-0 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Email</label>
                                        <input class="form-control" type="text" name="actual_shiper_email_id" id="actual_shiper_email_id" value="<?php echo  !empty($_GET['id']) && !empty($booking_s['email_id'])? $booking_s['email_id']:"" ?>">
                                </div>
                            </div>
                     </div>

                        <div class="border-top pt-2">
                            <h3 class="box-title pt-3" style="font-size: 17px !important;">KYC file</h3>
                        </div> 
                            <!-- <div class="row customer_records">
                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
                                        <div class="form-group">
                                            <label for="">Select Doucment Type</label>
                                            <select name="kyc_files_type" class="form-control">
                                                    <option value=""> Select Document Type</option>
                                                    <?php 
                                                    if (!empty($kycs)) {
                                                        foreach ($kycs as $key => $kyc) {
                                                    ?>
                                                    <option value="<?= $kyc['id'] ?>"><?= $kyc['name'] ?></option>
                                                    <?php
                                                        } }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 pl-0 col-12">
                                        <div class="form-group">    
                                            <label for="">Document No</label>
                                            <input type="text" name="kyc_doc_no" class="form-control" placeholder="Document Number" />
                                        </div>
                                    </div>
                                
                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
                                        <div class="form-group">
                                            <input type="file" name="kyc_files" class="form-control" />
                                        </div>
                                    </div>


                            </div> -->

                            <div class="row customer_records document-container">
                            <?php if(isset($company_kyc_documents) && !empty($company_kyc_documents)){
                             foreach($company_kyc_documents as $company_kyc_document ){ ?>
    <div class="document-row">
        <div class="row">
           
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <div class="form-group">
                    <label for="">Select Document Type</label>
                    <select name="kyc_files_type[]" class="form-control">
                        <option value="">Select Document Type</option>
                        <?php 
                        if (!empty($kycs)) {
                            foreach ($kycs as $key => $kyc) {
                        ?>
                        <option value="<?= $kyc['id'] ?>" <?php if($company_kyc_document['name'] == $kyc['id']){ echo 'selected';}?>><?= $kyc['name'] ?></option>
                        <?php
                            } 
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 pl-0 col-12">
                <div class="form-group">
                    <label for="">Document No</label>
                    <input type="text" name="kyc_doc_no[]" class="form-control mt-4" placeholder="Document Number" value="<?php if($company_kyc_document['document_no']){echo $company_kyc_document['document_no'];} ?>" />
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                <label for="">File</label>
                <input type="file" name="kyc_files[]" class="form-control image-input mt-4" data-index="0" />
                <input type="hidden" name="kyc_files_hidden[]" class="form-control image-input mt-4" data-index="0" value="<?=$company_kyc_document['document_name']?>"/>
                </div>
               
            </div>

            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-7 col-12 mt-5">
                <!-- <img class="preview_image preview_image_0" src="" alt="Image Preview" style="max-width: 100%; max-height: 100px; display: none;" /> -->
                <a class="preview_image preview_image_0" href="" target="_blank" style="display: none; font-size: 20px;">
                    <i class="fa fa-eye"></i>
                </a>
                <a class="" href="<?= base_url('assets/uploads/company_kyc_documents/').$company_kyc_document['document_name']; ?>" target="_blank" style="font-size: 20px;">
                    <i class="fa fa-eye"></i>
                </a>



            </div>

        </div>
       
    </div>
    <?php }}else{ ?>

    <div class="document-row">
        <div class="row">
           
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <div class="form-group">
                    <label for="">Select Document Type</label>
                    <select name="kyc_files_type[]" class="form-control">
                        <option value="">Select Document Type</option>
                        <?php 
                        if (!empty($kycs)) {
                            foreach ($kycs as $key => $kyc) {
                        ?>
                        <option value="<?= $kyc['id'] ?>"><?= $kyc['name'] ?></option>
                        <?php
                            } 
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 pl-0 col-12">
                <div class="form-group">
                    <label for="">Document No</label>
                    <input type="text" name="kyc_doc_no[]" class="form-control mt-4" placeholder="Document Number" value="" />
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="form-group">
                <label for="">File</label>
                <input type="file" name="kyc_files[]" class="form-control image-input mt-4" data-index="0" />
                </div>
               
            </div>

            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-7 col-12 mt-5">
                <!-- <img class="preview_image preview_image_0" src="" alt="Image Preview" style="max-width: 100%; max-height: 100px; display: none;" /> -->
                <!-- <a class="preview_image preview_image_0" href="" target="_blank" style="display: none; font-size: 20px;">
                    <i class="fa fa-eye"></i>
                </a> -->
                



            </div>

        </div>
       
    </div>
    <?php } ?>
</div>
<div class="form-group text-right">
    <button type="button" id="incrementBtn" class="btn btn-primary add-document-row">Add Row</button>
</div>

                            
                            <div class="kyc_types"></div>

                            <!-- <div class="row ">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <button type="button" class="btn btn-success" id="add_more_kyc" style="font-size: 14px">Add More</button>
                                </div>
                            </div> -->
                        
                        <div class="row align-items-end">
                            <!-- <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7col-12 mb-3">
                                <div class="form-group">    
                                    <label for="">Doucment Type </label>
                                        <input type="text" class="form-control pull-right validate[required]"  value="" name="document_type">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 p-0 col-12 mb-3">
                                <div class="form-group">    
                                    <label for="">File</label>
                                        <input type="text" class="form-control pull-right validate[required]"  value="" name="fileupload">
                                </div>
                            </div> -->
                            
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Special Remark</label>
                                        <input type="text" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($booking_s['actual_remark'])? $booking_s['actual_remark']:"" ?>" name="actual_remark">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-xl-6 col-lg-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Consignee / Receiver Details</h3>
                    </div>  
                    <!-- /.box-header -->
                    <!-- form start -->
                    <!-- <form role="form"> -->
                    <div class="box-body addBillEntry-box-1" id="box-body">
                        <div class="row" style="align-items: end;">
                            
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 mb-3">
                                <div class="form-group">
                                    <label>Consignee<span class="required" aria-required="true">*</span></label>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                 <select class="form-control consignee-dropdown" name="consignee_receiver" id="consignee_receiver">
                                    <option value="">Select consignee</option>
                                    <?php echo  (!empty($_GET['id']) && isset($booking_c['customer_name']) && isset($booking_c['name']))? '<option value="'.$booking_c['customer_name'].'">'.$booking_c['name'].'</option>':"" ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6 mb-3">
                                    <div class="form-group">
                                        <a href="" class="btn btn-danger" id="deleteconsigee" title="Active/Inactive" style="font-size: 14px">Delete Saved Shipper
                                        </a>
                                    </div>
                                </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
                                <div class="form-group">
                                    <label for="">Person Name ( Consignee - Receiver Name  ) </label>
                                        <input class="form-control validate[required]" type="text" name="consignee_person_name"
                                    id="consignee_person_name"  value="<?php echo  !empty($_GET['id']) && !empty($booking_c['name'])? $booking_c['name']:"" ?>">
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
                                <div class="form-group">
                                    <label for="">Company's Name</label>
                                        <input  class="form-control" type="text" name="consignee_company" id="consignee_company" value="<?php echo  !empty($_GET['id']) && !empty($booking_c['company'])? $booking_c['company']:"" ?>">
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
                                <div class="form-group">
                                    <label for="">Address -1 </label>
                                        <input class="form-control validate[required]"   name="consignee_address"
                                    id="consignee_address" value="<?php echo  !empty($_GET['id']) && !empty($booking_c['address'])? $booking_c['address']:"" ?>">
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
                                <div class="form-group">
                                    <label for="">Address -2 </label>
                                        <input class="form-control validate[required]"   name="consignee_address2"
                                    id="consignee_address2" value="<?php echo  !empty($_GET['id']) && !empty($booking_c['address2'])? $booking_c['address2']:"" ?>">
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12">
                                <div class="form-group">
                                    <label for="">Address -3 </label>
                                        <input class="form-control validate[required]"   name="consignee_address3"
                                    id="consignee_address3" value="<?php echo  !empty($_GET['id']) && !empty($booking_c['address3'])? $booking_c['address3']:"" ?>">
                                </div>
                            </div>
                              <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Pin Code / Postal Code <span class="required" aria-required="true">*</span></label>
                                       <input class="form-control validate[required] checkCity" type="number"
                                            name="consignee_pincode" id="dest_pincode"
                                            value="<?php echo  !empty($_GET['id']) && !empty($booking_c['pincode'])? $booking_c['pincode']:"" ?>">
                                </div>
                            </div>
                              <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 pl-0  mb-3">
                                <div class="form-group">
                                    <label for="">City</label>
                                        <input type="text" class="form-control" name="consignee_city"
                                            id="consignee_city" 
                                            value="<?php echo  !empty($_GET['id']) && !empty($booking_c['city'])? $booking_c['city']:"" ?>">
                                </div>
                            </div>
                              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pl-0 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">State</label>
                                        <input type="text" class="form-control" name="consignee_state"
                                            id="consignee_state"
                                            value="<?php echo  !empty($_GET['id']) && !empty($booking_c['state'])? $booking_c['state']:"" ?>">
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                    <div class="form-group">
                                        <select class="form-control consignee-countries-dropdown validate[required]"
                                            name="consignee_country" id="consignee_country" required="">
                                            <option value="">Select country</option>
                                            <?php //echo $countries_dropdown; ?>
                                        </select>
                                    </div>
                                </div>
                        
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Mobile Number<span class="required" aria-required="true">*</span></label>
                                        <input class="form-control" type="number" name="consignee_mobile" id="consignee_mobile" value="<?php echo  !empty($_GET['id']) && !empty($booking_c['mobile'])? $booking_c['mobile']:"" ?>">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 pl-0 mb-3">
                                <div class="form-group">
                                    <label for="">Telephone</label>
                                         <input class="form-control" type="number" name="consignee_telephone" id="consignee_telephone" value="<?php echo  !empty($_GET['id']) && !empty($booking_c['phone'])? $booking_c['phone']:"" ?>">
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pl-0 col-12  mb-3">
                                <div class="form-group">
                                    <label for="">Email</label>
                                        <input class="form-control" type="text" name="consignee_email_id"  id="consignee_email_id" value="<?php echo  !empty($_GET['id']) && !empty($booking_c['email_id'])? $booking_c['email_id']:"" ?>">
                                </div>
                            </div>
                     </div>

                        <div class="border-top pt-2">
                            <h3 class="box-title pt-3" style="font-size: 17px !important;">Consignee Tax ID(VAT, EORI, etc.,) </h3>
                        </div> 
                        <div class="row align-items-end">
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">ID TYPE</label>
                                        <input type="text" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($consignee_type_no['id_type'])? $consignee_type_no['id_type']:"" ?>" name="id_type">
                                </div>
                            </div>
                             <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 pl-0 col-12 mb-3">
                                <div class="form-group">    
                                    <label for="">ID Number</label>
                                        <input type="text" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($consignee_type_no['id_number'])? $consignee_type_no['id_number']:"" ?>" name="id_number">
                                </div>
                            </div><div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12 mb-3">
                                <div class="form-group">
                                        <input type="text" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($consignee_type_no['id_type_1'])? $consignee_type_no['id_type_1']:"" ?>" name="id_type_1">
                                </div>
                            </div>
                             <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 pl-0 col-12 mb-3">
                                <div class="form-group">   
                                        <input type="text" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($consignee_type_no['id_number_1'])? $consignee_type_no['id_number_1']:"" ?>" name="id_number_1">
                                </div>
                            </div>
                            
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                <div class="">
                                    <!-- <label for="">Brouse</label> -->
                                        <input type="file" class="form-control pull-right validate[required]"  value="" name="consignee_file">
                                </div>
                            </div>
                            
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <div class="form-group">
                                    <label for="">Special Remark</label>
                                        <input type="text" class="form-control pull-right validate[required]"  value="<?php echo  !empty($_GET['id']) && !empty($consignee_type_no['consignee_remark'])? $consignee_type_no['consignee_remark']:"" ?>" name="consignee_remark">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

          

            
            <div class="col-xl-12 col-lg-12">
                <div class="box box-primary">
                    
                    <div class="box-body addBillEntry-box-1" id="box-body">
                        <div class="row align-items-end" >
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <input type="button" class="btn btn-primary  valid " value="Weight Calculator ( Sales ) " aria-invalid="false">
                                        <input type="button" class="btn btn-success  valid" style="border-radius: 50%;" value="+" aria-invalid="false">
                                    </div>
                                </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <button type="button" class="btn btn-primary" data-toggle="modal" style="float:right;" data-target="#weight_calculator2" data-backdrop="false">Example Weight Calculator</button>
                            <button type="button"  class="btn btn-primary add_package" modaltype="saleweight" style="float:right;margin-right: 7px;">Add Sale Weight</button>&nbsp;
                            <button type="button"   class="btn btn-primary add_package" modaltype="vender" style="float:right;margin-right: 7px;">Add <span id="change_name"> Vendor</span> </button>
                            <!-- <button type="button"   class="btn btn-primary " modaltype="girth" style="margin-left:-21px;">Add <span id="change_name"> Girth</span> </button> -->
                             <button type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#girthModal"
        style="margin-left:-21px;">
    Add Girth
</button>
                            
                           

                           
                       
                            
                            </div>

                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                <div class="form-group">
                                    <label for="">No. Of Box<span class="required" aria-required="true">*</span></label>
                                    <input class="form-control validate[required] valid" id="total_pieces" type="number" min="1" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['pieces'])? $weight_calculation_pv['pieces']:"1" ?>" name="pieces" aria-invalid="false">
                                    <input type="hidden"  id="weight_required"  value="<?php echo !empty($_GET['id']) ? $_GET['id']:"0" ?>">
                                </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-group">
                                    <label for="">Dimension converter-Metric System </label>
                                        <!-- <select id = "unit_wid" name="c_unit[]" class = "form-control  conv "> -->
                                        <!-- <select id = "unit_wid" name="c_unit" class = "form-control  conv ">
                                            <option value = "cm" selected = "selected" <?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['c_unit']) && $weight_calculation_pv['c_unit'] == 'cm'? 'selected':"selected" ?>> CM </option>
                                            <option value = "mm" <?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['c_unit']) && $weight_calculation_pv['c_unit'] == 'mm'? 'selected':"" ?>> MM </option>
                                            <option value = "cft" <?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['c_unit']) && $weight_calculation_pv['c_unit'] == 'cft'? 'selected':"" ?>> CFT </option>
                                            <option value = "in" <?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['c_unit']) && $weight_calculation_pv['c_unit'] == 'in'? 'selected':"" ?>> IN </option>
                                            <option value = "ft" <?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['c_unit']) && $weight_calculation_pv['c_unit'] == 'ft'? 'selected':"" ?>> FT </option>
                                        </select> -->
                                        <select id="unit_wid" name="c_unit" class="form-control conv">
                                        <?php
                                        $units = ['cm' => 'CM', 'mm' => 'MM', 'cft' => 'CFT', 'in' => 'IN', 'ft' => 'FT'];
                                        $selectedUnit = (!empty($_GET['id']) && !empty($weight_calculation_pv['c_unit'])) ? $weight_calculation_pv['c_unit'] : 'cm'; // Default to 'cm'

                                        foreach ($units as $value => $label) {
                                            $selected = ($value == $selectedUnit) ? 'selected' : '';
                                            echo "<option value='$value' $selected>$label</option>";
                                        }
                                        ?>
                                    </select>

                                    </div>
                                </div>
                                
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-group">
                                    <label for="">Vendor/Subvendor Divisor </label>
                                    <input type="text" class=" form-control" name="divisor" id="divisor"  value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['divisor'])? $weight_calculation_pv['divisor']:"" ?>">
                                          <!-- <select class="form-control " name="divisor" id="divisor" aria-required="true"> -->
                                            <!-- <option value="">Select Divisor</option> -->
                                        <!-- </select> -->
                                    </div>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-group">
                                    <label for=""><span id="divisor_name"></span> Divisor </label>
                                    <input type="text" class="empty_all_data form-control" name="product_divisor" id="product_divisor" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['product_divisor'])? $weight_calculation_pv['product_divisor']:"" ?>">
                                    </div>
                            </div>



                            
                            <!-- <div id="weight_calculator" class="w-100">
                              
                           
                            </div> -->


                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label for="">Manifest Weight (Kg) (Agent / Set Weight)<span class="required" aria-required="true">*</span>
                                         <input type="button" class="btn btn-success  valid" style="border-radius: 50%;" value="+" aria-invalid="false">
                                    </label>
                                    <input class="form-control" type="text" placeholder="0" name="manifest_weight" id="manifest_weight" style="display:none;" value="0">
                                </div>
                             </div>
                             </div>
                               <div class="row m-0">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                     <h3 class="box-title">Weight Calculator:Product ( Sale ) </h3>
                                    </div>
                                        <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div> -->
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Total : Vol.Weight Kg.</label>
                                                <div class="input-group date">
                                                    <!-- <div class="input-group-addon"></div> -->
                                                    <input type="text" readonly class=" empty_all_data form-control pull-right validate[required]"  readonly value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['svolumetric_weight'])? $weight_calculation_pv['svolumetric_weight']:"0" ?>" name="svolumetric_weight" id="svolumetric_weight">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="">
                                            <div class="form-group">
                                                <label>Total : Acutal wt.</label>
                                                <div class="input-group date">
                                                    <input class="form-control empty_all_data" readonly type="text" name="sactual_weight" id="sactual_weight"  value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['sactual_weight'])? $weight_calculation_pv['sactual_weight']:"0" ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group" >
                                                <label for="">Total :  Billing Weight</label>
                                                <div class="input-group">
                                                    <input type="text" name="sbilling_weight" id="sbilling_weight" readonly  class="form-control empty_all_data datepicker" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['sbilling_weight'])? $weight_calculation_pv['sbilling_weight']:"0" ?>">
                                                </div>
                                            </div>
                                        </div>
                                      
                          </div>

                           <div class="row m-0">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                        <h3 class="box-title"> Weight Calculator:Vendor ( Purchase )</h3>
                                    </div>
                             
                                        <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div> -->
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Total : Vol.Weight Kg.</label>
                                                <div class="input-group date">
                                                    <!-- <div class="input-group-addon"></div> -->
                                                    <input type="text" readonly class="form-control empty_all_data pull-right validate[required]"  value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['volumetric_weight'])? $weight_calculation_pv['volumetric_weight']:"0" ?>" name="volumetric_weight" id="volumetric_weight">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="">
                                            <div class="form-group">
                                                <label>Total : Acutal wt.</label>
                                                <div class="input-group date">
                                                    <input class="form-control empty_all_data" readonly type="text" name="actual_weight" id="actual_weight"  value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['actual_weight'])? $weight_calculation_pv['actual_weight']:"" ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group" >
                                                <label for="">Total :  Billing Weight</label>
                                                <div class="input-group">
                                                    <input type="text" readonly name="billing_weight" id="billing_weight"  class="form-control empty_all_data datepicker" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['billing_weight'])? $weight_calculation_pv['billing_weight']:"0" ?>">
                                                </div>
                                            </div>
                                        </div>
                                      
                          </div>
                     </div>
                 </div>
             </div>
             
           
                          
                <div class="col-xl-12 col-lg-12 p-0">
                <div class="box box-primary">
                    <div class="box-header with-border ">
                        <h3 class="box-title manually_calculate_box">Amount Calculation : Product ( Sale ) - <span class="text-danger" id="show_type"></span></h3> 
                        
                            <button type="button" class="btn btn-primary float-right " id="manually_calculate">Manual Calculate</button>
                            <input type="hidden" id="manually_fuel_get" value ="0"> 
                           
                    </div>  
                    
                    <div class="box-body addBillEntry-box-1" id="box-body">
                        <div class="row" style="align-items: center;">
                        
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Heading</label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Amount<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Fuel<br> <span id="fuel_surcharges_ps">0</span> % <span class="required" aria-required="true">*</span></label>
                                         <input type="hidden" id="fuel_sale" name="fuel_sale" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['fuel_sale'])? $weight_calculation_pv['fuel_sale']:"0" ?>">
                                         <input type="hidden" id="f_amount">
                                         <input type="hidden" id="f_covid">  
                                         <input type="hidden" id="f_restrictied">  
                                         <input type="hidden" id="f_ddp">  
                                         <input type="hidden" id="f_oversize_w">  
                                         <input type="hidden" id="f_oversize_d">  
                                         <input type="hidden" id="f_nonstakable">  
                                         <input type="hidden" id="f_commercial"> 

                                         <input type="hidden" id="active_status" value="0"> 
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Sub Total<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">CGST<br><span id="v_cgst">0</span> %<span class="required" aria-required="true">*</span></label>
                                        <input type="hidden" id="cgst_sale" name="cgst_sale" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['cgst_sale'])? $weight_calculation_pv['cgst_sale']:"0" ?>">
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">SGST<br><span id="v_sgst">0</span> %<span class="required" aria-required="true">*</span></label>
                                        <input type="hidden" id="sgst_sale" name="sgst_sale" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['sgst_sale'])? $weight_calculation_pv['sgst_sale']:"0" ?>">
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">IGST<br><span id="v_igst">0</span> %<span class="required" aria-required="true">*</span></label>
                                        <input type="hidden" id="igst_sale" name="igst_sale" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['igst_sale'])? $weight_calculation_pv['igst_sale']:"0" ?>">
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Grand Total<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">HSN Code*(Billing)<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">HSN (Heading)<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Remark<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Currency </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="currency_amount" id="" value="INR" >
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12"></div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                            <label for="">Amount (Freight)<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="empty_all_data form-control validate[required,custom[number] valid base_amount  manually_sale"  id="base_amount" type="text" placeholder="" name="amount_f_amount"   aria-invalid="false" value="<?php echo !empty($_GET['id']) && !empty($product_sale['amount_f_amount'])? $product_sale['amount_f_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="empty_all_data form-control validate[required,custom[number] fuel_charge_amount manually_sale"  type="text" placeholder="0"  name="amount_fuel"  id="fuel_surcharge" value="<?php echo !empty($_GET['id']) && !empty($product_sale['amount_fuel'])? $product_sale['amount_fuel']:"0" ?>">
                                            <input class="fuel_charge_amount_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($product_sale['fuel_charge_amount_per'])? $product_sale['fuel_charge_amount_per']:"0" ?>" name="fuel_charge_amount_per"  id="fuel_charge_amount_per">

                                            <input class="form-control validate[required,custom[number]" type="hidden" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['fuel_surchargess'])? $product_sale['fuel_surchargess']:"0" ?>" name="fuel_surchargess"  id="fuel_surchargess">
                                        </div>

                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control validate[required,custom[number] empty_all_data sub_total_amount manually_sale"  type="text"  readonly placeholder="0"  name="amount_sub_total" value="<?php echo !empty($_GET['id']) && $product_sale['amount_sub_total']? $product_sale['amount_sub_total']:"0" ?>" >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input  style="background: rgb(199, 201, 203);"class="form-control validate[required,custom[number] cgst_amount empty_all_data" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['amount_sub_total']:"0" ?>"value="<?php echo !empty($_GET['id'])? $product_sale['amount_cgst']:"0" ?>" name="amount_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control validate[required,custom[number]  empty_all_data sgst_amount" type="text" readonly placeholder="0"  name="amount_sgst"  value="<?php echo !empty($_GET['id'])? $product_sale['amount_sgst']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_amount" type="text" readonly placeholder="0"  name="amount_igst"  value="<?php echo !empty($_GET['id'])? $product_sale['amount_igst']:"0" ?>" >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_amount" type="text" readonly placeholder="0"  value="<?php echo !empty($_GET['id'])? $product_sale['amount_grand_total']:"0" ?>"  name="amount_grand_total"  >
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="empty_all_data form-control validate[required,custom[number] valid manually_sale " type="text" placeholder="0"  value="<?php echo !empty($_GET['id']) && !empty($product_sale['amount_hsn_code_bill'])? $product_sale['amount_hsn_code_bill']:"" ?>"  name="amount_hsn_code_bill" id="hsn_code_amount">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_sale" name="amount_hsn_heading" id="hsn_details" value="<?php echo !empty($_GET['id']) && !empty($product_sale['amount_hsn_heading'])? $product_sale['amount_hsn_heading']:"" ?>">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                        <textarea class="form-control empty_all_data" name="amount_remark" id="" rows="" cols=""><?php echo !empty($_GET['id']) && !empty($product_sale['amount_remark'])? $product_sale['amount_remark']:"" ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Covid Charge </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text"  placeholder="" name="covid_carge_amount" id="covid_charge" value="<?php echo !empty($_GET['id']) && !empty($product_sale['covid_carge_amount'])? $product_sale['covid_carge_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_covid manually_sale" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['covid_carge_fuel'])? $product_sale['covid_carge_fuel']:"0" ?>" name="covid_carge_fuel"  id="fuel_surcharge1">
                                            <input class="fuel_charge_covid_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($product_sale['fuel_charge_covid_per'])? $product_sale['fuel_charge_covid_per']:"0" ?>" name="fuel_charge_covid_per"  id="fuel_charge_covid_per">

                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_covid manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['covid_carge_sub_total']:"0" ?>" name="covid_carge_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input  style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_covid" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['covid_carge_cgst']:"0" ?>" name="covid_carge_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_covid" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['covid_carge_sgst']:"0" ?>" name="covid_carge_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_covid" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['covid_carge_igst']:"0" ?>" name="covid_carge_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_covid" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['covid_carge_grand_total']:"0" ?>" name="covid_carge_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="empty_all_data form-control validate[required,custom[number] valid manually_sale" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['hsn_code_covid'])? $product_sale['hsn_code_covid']:"" ?>" name="hsn_code_covid" id="hsn_code_covid">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data manually_sale" name="covid_carge_hsn" id="hsn_heading_covid_charge" value="<?php echo !empty($_GET['id']) && !empty($product_sale['covid_carge_hsn'])? $product_sale['covid_carge_hsn']:"" ?>" >
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                        <textarea  type="text" class="form-control empty_all_data " name="covid_carge_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($product_sale['covid_carge_remark'])? $product_sale['covid_carge_remark']:"" ?>" ></textarea>
                                        </div>
                                    </div>


                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Restricted Country Charge <span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text"  placeholder="" name="restrict_country_charge_amount" id="res_charge" value="<?php echo !empty($_GET['id'])? $product_sale['restrict_country_charge_amount']:"0" ?>">
                                        </div>
                                    </div>

                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_res_charge manually_sale" type="text" placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['restrict_country_charge_fuel']:"0" ?>" name="restrict_country_charge_fuel"  id="restrict_country_charge_fuel">
                                            <input class="fuel_charge_res_charge_per" type="hidden" value="<?php echo !empty($_GET['id'])? $product_sale['covid_carge_grand_total']:"0" ?>" name="fuel_charge_res_charge_per"  id="fuel_charge_res_charge_per">

                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_res_charge manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['restrict_country_charge_sub_total']:"0" ?>" name="restrict_country_charge_sub_total" id="restrict_country_charge_fuel">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_res_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['restrict_country_charge_cgst']:"0" ?>" name="restrict_country_charge_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"  class="form-control empty_all_data validate[required,custom[number] sgst_res_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['restrict_country_charge_sgst']:"0" ?>" name="restrict_country_charge_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_res_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['restrict_country_charge_igst']:"0" ?>" name="restrict_country_charge_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_res_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id'])? $product_sale['restrict_country_charge_grand_total']:"0" ?>" name="restrict_country_charge_grand_total"  >
                                        </div>
                                    </div>

                                     
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="empty_all_data form-control validate[required,custom[number] valid manually_sale" type="text" id="hsn_code_res_charge" name="restrict_country_hsn_code" value="<?php echo !empty($_GET['id']) && !empty($product_sale['restrict_country_hsn_code'])? $product_sale['restrict_country_hsn_code']:"" ?>"> 
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data manually_sale" name="restrict_country_charge_hsn_headding" id="hsn_heading_res_charge" value="<?php echo !empty($_GET['id']) && !empty($product_sale['restrict_country_charge_hsn_headding'])? $product_sale['restrict_country_charge_hsn_headding']:"" ?>" >
                                        </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <textarea type="text" class="form-control empty_all_data " name="restrict_country_charge_remark" id="" value="" ><?php echo !empty($_GET['id']) && !empty($product_sale['restrict_country_charge_remark'])? $product_sale['restrict_country_charge_remark']:"" ?></textarea>
                                        </div>
                                    </div>

                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Commercial Charge <span class="required" aria-required="true">*</span></label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text"  placeholder="" name="commercial_charge_amount" id="com_charge" value="<?php echo !empty($_GET['id']) && !empty($product_sale['commercial_charge_amount'])? $product_sale['commercial_charge_amount']:"0" ?>">
                                            </div>
                                        </div>
                                     
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_com_charge manually_sale"  type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['commercial_charge_fuel'])? $product_sale['commercial_charge_fuel']:"" ?>" name="commercial_charge_fuel" id="commercial_charge_fuel" >
                                                <input class="fuel_charge_com_charge_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($product_sale['fuel_charge_com_charge_per'])? $product_sale['fuel_charge_com_charge_per']:"0" ?>" name="fuel_charge_com_charge_per"  id="fuel_charge_com_charge_per">

                                            </div>
                                         </div>
                                         <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] sub_total_com_charge manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['commercial_charge_sub_total'])? $product_sale['commercial_charge_sub_total']:"0" ?>" name="commercial_charge_sub_total">
                                            </div>
                                        </div>

                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] cgst_com_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['commercial_charge_cgst'])? $product_sale['commercial_charge_cgst']:"0" ?>" name="commercial_charge_cgst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_com_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['commercial_charge_sgst'])? $product_sale['commercial_charge_sgst']:"0" ?>" name="commercial_charge_sgst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_com_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['commercial_charge_igst'])? $product_sale['commercial_charge_igst']:"0" ?>" name="commercial_charge_igst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] grand_total_com_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['commercial_charge_grand_total'])? $product_sale['commercial_charge_grand_total']:"0" ?>" name="commercial_charge_grand_total"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text" id="hsn_code_commercial_charge"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['hsn_code_commercial_charge'])? $product_sale['hsn_code_commercial_charge']:"0" ?>" name="hsn_code_commercial_charge">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data manually_sale" name="commercial_charge_hsn_headding" id="hsn_heading_commercial_charge" value="<?php echo !empty($_GET['id']) && !empty($product_sale['commercial_charge_hsn_headding'])? $product_sale['commercial_charge_hsn_headding']:"" ?>" >
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <textarea type="text" class="form-control empty_all_data " name="commercial_charge_remark" id="" value="" ><?php echo !empty($_GET['id']) && !empty($product_sale['commercial_charge_remark'])? $product_sale['commercial_charge_remark']:"" ?></textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Non standard (Weight) (Oversize)(cl 1) </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data ext_weight_charge" type="text" id="ext_weight_charge" name="non_stnd_weight_oversize_amount" placeholder="additional_charge" value="0">
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_ext_weight_charge" type="text" placeholder="0" value="0" name="non_stnd_weight_oversize_fuel"  id="fuel_surcharge9">
                                            <input class="fuel_charge_ext_weight_charge_per" type="hidden" value="0" name="fuel_charge_ext_weight_charge_per"  id="fuel_charge_ext_weight_charge_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_ext_weight_charge" type="text" placeholder="0" value="0" name="non_stnd_weight_oversize_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] cgst_ext_weight_charge" type="text" placeholder="0" value="0" name="non_stnd_weight_oversize_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sgst_ext_weight_charge" type="text" placeholder="0" value="0" name="non_stnd_weight_oversize_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] igst_ext_weight_charge" type="text" placeholder="0" value="0" name="non_stnd_weight_oversize_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_ext_weight_charge" type="text" placeholder="0" value="0" name="non_stnd_weight_oversize_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control empty_all_data" name="non_stnd_weight_oversize_hsn_code_billing" id="" aria-required="true">
                                                <option value="">Select Product</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data" name="non_stnd_weight_oversize_hsn_headding" id="" value="" >
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data" name="non_stnd_weight_oversize_hsn_remark" id="" value="" >
                                        </div>
                                    </div> -->

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Non standard (Weight) (Oversize) Result </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data manually_sale" type="text" id="non_stnd_weight_oversize_amount_cl" name="non_stnd_weight_oversize_amount_cl" placeholder="additional_charge" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stnd_weight_oversize_amount_cl'])? $product_sale['non_stnd_weight_oversize_amount_cl']:"0" ?>">
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_ext_weight_charge_cl manually_sale" type="text"  placeholder="0" value="0" name="non_stnd_weight_oversize_fuel"  id="non_stnd_weight_oversize_fuel">
                                            <input class="fuel_charge_ext_weight_charge_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($product_sale['fuel_charge_ext_weight_charge_per'])? $product_sale['fuel_charge_ext_weight_charge_per']:"0" ?>" name="fuel_charge_ext_weight_charge_per"  id="fuel_charge_ext_weight_charge_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_ext_weight_charge_cl manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stnd_weight_oversize_sub_total'])? $product_sale['non_stnd_weight_oversize_sub_total']:"0" ?>" name="non_stnd_weight_oversize_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_ext_weight_charge_cl" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stnd_weight_oversize_cgst'])? $product_sale['non_stnd_weight_oversize_cgst']:"0" ?>" name="non_stnd_weight_oversize_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_ext_weight_charge_cl" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stnd_weight_oversize_sgst'])? $product_sale['non_stnd_weight_oversize_sgst']:"0" ?>" name="non_stnd_weight_oversize_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_ext_weight_charge_cl" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stnd_weight_oversize_igst'])? $product_sale['non_stnd_weight_oversize_igst']:"0" ?>" name="non_stnd_weight_oversize_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_ext_weight_charge_cl" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stnd_weight_oversize_grand_total'])? $product_sale['non_stnd_weight_oversize_grand_total']:"0" ?>" name="non_stnd_weight_oversize_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text" id="hsn_code_non_standard" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['hsn_code_non_standard'])? $product_sale['hsn_code_non_standard']:"0" ?>" name="hsn_code_non_standard">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data manually_sale" name="non_stnd_weight_oversize_hsn_headding" id="hsn_heading_non_standard" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stnd_weight_oversize_hsn_headding'])? $product_sale['non_stnd_weight_oversize_hsn_headding']:"" ?>" >
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12"> 
                                        <div class="form-group">
                                            <textarea type="text" class="form-control empty_all_data " name="non_stnd_weight_oversize_hsn_remark" id="hsn_heading_non_standard" value="" ><?php echo !empty($_GET['id']) && !empty($product_sale['non_stnd_weight_oversize_hsn_remark'])? $product_sale['non_stnd_weight_oversize_hsn_remark']:"" ?></textarea>
                                        </div>
                                    </div>

                                    <!-- <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Non standard (Dimension) (Oversize)<span class="required" aria-required="true">*</span></label>                                         
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data non_stackable_charge" type="text" id="non_stackable_charge"  name="non_stnd_dimension_oversize_amount" readonly placeholder="non_stackable_charge" value="0">
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_non_stackable_charge" type="text" placeholder="0" value="0" name="non_stnd_dimension_oversize_fuel"  >
                                            <input class="fuel_charge_non_stackable_charge_per" type="hidden" value="0" name="fuel_charge_non_stackable_charge_per"  id="fuel_charge_non_stackable_charge_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_non_stackable_charge" type="text" placeholder="0" value="0" name="non_stnd_dimension_oversize_sub_total" >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] cgst_non_stackable_charge" type="text" placeholder="0" value="0" name="non_stnd_dimension_oversize_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sgst_non_stackable_charge" type="text" placeholder="0" value="0" name="non_stnd_dimension_oversize_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] igst_non_stackable_charge" type="text" placeholder="0" value="0" name="non_stnd_dimension_oversize_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_non_stackable_charge" type="text" placeholder="0" value="0" name="non_stnd_dimension_oversize_grand_total"  >
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg1 col-md1 col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control empty_all_data" name="non_stnd_dimension_oversize_hsn_code_billing" id="" aria-required="true">
                                                <option value="">Select Product</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data" name="non_stnd_dimension_oversize_hsn_headding" id="" value="" >
                                        </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data" name="non_stnd_dimension_oversize_remark" id="" value="" >
                                        </div>
                                    </div> -->
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">DDP(Duty Delivery Paid)<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data ddp_charge manually_sale" type="text" name="duty_delivery_paid_amount" id="ddp_charge" placeholder="dimensional_charge " value="<?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_amount'])? $product_sale['duty_delivery_paid_amount']:"0" ?>">
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_ddp_charge manually_sale" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_fuel'])? $product_sale['duty_delivery_paid_fuel']:"0" ?>" name="duty_delivery_paid_fuel"  id="duty_delivery_paid_fuel">
                                            <input class="fuel_charge_ddp_charge_per" type="hidden" value="0" name="fuel_charge_ddp_charge_per"  id="fuel_charge_ddp_charge_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_ddp_charge manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_sub_total'])? $product_sale['duty_delivery_paid_sub_total']:"0" ?>" name="duty_delivery_paid_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] cgst_ddp_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_cgst'])? $product_sale['duty_delivery_paid_cgst']:"0" ?>" name="duty_delivery_paid_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] sgst_ddp_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_sgst'])? $product_sale['duty_delivery_paid_sgst']:"0" ?>" name="duty_delivery_paid_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_ddp_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_igst'])? $product_sale['duty_delivery_paid_igst']:"0" ?>" name="duty_delivery_paid_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_ddp_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_grand_total'])? $product_sale['duty_delivery_paid_grand_total']:"0" ?>" name="duty_delivery_paid_grand_total"  >
                                        </div>
                                    </div>
                                     
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                         <div class="form-group">
                                         <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text" id="hsn_code_ddp" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_hsn_code_billing'])? $product_sale['duty_delivery_paid_hsn_code_billing']:"0" ?>" name="duty_delivery_paid_hsn_code_billing">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data manually_sale" name="duty_delivery_paid_hsn_heading" id="hsn_heading_ddp" value="<?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_hsn_heading'])? $product_sale['duty_delivery_paid_hsn_heading']:"" ?>" >
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <textarea type="text" class="form-control empty_all_data " name="duty_delivery_paid_remark" id="" value="" ><?php echo !empty($_GET['id']) && !empty($product_sale['duty_delivery_paid_remark'])? $product_sale['duty_delivery_paid_remark']:"" ?></textarea>
                                        </div>
                                    </div>
                                  
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Non-stackable (Fragile)<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data extra_dimensional_charge manually_sale" type="text" id="extra_dimensional_charge" name="non_stackable_frgle_amount" placeholder="dimensional_charge" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_amount'])? $product_sale['non_stackable_frgle_amount']:"0" ?>">
                                        </div>
                                    </div>

                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_extra_dimensional_charge manually_sale" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_fuel'])? $product_sale['non_stackable_frgle_fuel']:"0" ?>" name="non_stackable_frgle_fuel"  id="non_stackable_frgle_fuel">
                                            <input class="fuel_charge_extra_dimensional_charge_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($product_sale['fuel_charge_extra_dimensional_charge_per'])? $product_sale['fuel_charge_extra_dimensional_charge_per']:"0" ?>" name="fuel_charge_extra_dimensional_charge_per"  id="fuel_charge_extra_dimensional_charge_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_extra_dimensional_charge manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_sub_total'])? $product_sale['non_stackable_frgle_sub_total']:"0" ?>" name="non_stackable_frgle_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] cgst_extra_dimensional_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_cgst'])? $product_sale['non_stackable_frgle_cgst']:"0" ?>" name="non_stackable_frgle_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] sgst_extra_dimensional_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_sgst'])? $product_sale['non_stackable_frgle_sgst']:"0" ?>" name="non_stackable_frgle_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_extra_dimensional_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_igst'])? $product_sale['non_stackable_frgle_igst']:"0" ?>" name="non_stackable_frgle_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_extra_dimensional_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_grand_total'])? $product_sale['non_stackable_frgle_grand_total']:"0" ?>" name="non_stackable_frgle_grand_total"  >
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text" id="hsn_code_non_stackable" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_hsn_code_billing'])? $product_sale['non_stackable_frgle_hsn_code_billing']:"0" ?>" name="non_stackable_frgle_hsn_code_billing">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control empty_all_data manually_sale" name="non_stackable_frgle_hsn_heading" id="hsn_heading_non_stackable" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_hsn_heading'])? $product_sale['non_stackable_frgle_hsn_heading']:"" ?>" >
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <textarea type="text" class="form-control empty_all_data " name="non_stackable_frgle_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($product_sale['non_stackable_frgle_remark'])? $product_sale['amount_fuel']:"" ?>" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Other Charges (with Fuel Charges) <span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data other_charge manually_sale" type="text" placeholder="" name="other_charge_with_fuel_chrg_amount" id="other_charge" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_with_fuel_chrg_amount'])? $product_sale['other_charge_with_fuel_chrg_amount']:"0" ?>">
                                        </div>
                                    </div>
                                     
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_other_charge manually_sale" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_with_fuel_chrg_fuel'])? $product_sale['other_charge_with_fuel_chrg_fuel']:"0" ?>" name="other_charge_with_fuel_chrg_fuel"  id="other_charge_with_fuel_chrg_fuel">
                                            <input class="fuel_charge_other_charge_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($product_sale['fuel_charge_other_charge_per'])? $product_sale['fuel_charge_other_charge_per']:"0" ?>" name="fuel_charge_other_charge_per"  id="fuel_charge_other_charge_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] other_charge_with_fuel_chrg_sub_total manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['sub_total'])? $product_sale['sub_total']:"0" ?>" name="sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_other_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_with_fuel_chrg_cgst'])? $product_sale['other_charge_with_fuel_chrg_cgst']:"0" ?>" name="other_charge_with_fuel_chrg_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_other_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_with_fuel_chrg_sgst'])? $product_sale['other_charge_with_fuel_chrg_sgst']:"0" ?>" name="other_charge_with_fuel_chrg_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_other_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_with_fuel_chrg_igst'])? $product_sale['other_charge_with_fuel_chrg_igst']:"0" ?>" name="other_charge_with_fuel_chrg_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_other_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_with_fuel_chrg_grand_total'])? $product_sale['other_charge_with_fuel_chrg_grand_total']:"0" ?>" name="other_charge_with_fuel_chrg_grand_total"  >
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                    <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text" id="hsn_code_other_charges" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_with_fuel_chrg_hsn_code_billing'])? $product_sale['other_charge_with_fuel_chrg_hsn_code_billing']:"0" ?>" name="other_charge_with_fuel_chrg_hsn_code_billing">
                                     </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control empty_all_data manually_sale" name="other_charge_with_fuel_chrg_hsn_heading" id="hsn_heading_other_charges" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_with_fuel_chrg_hsn_heading'])? $product_sale['other_charge_with_fuel_chrg_hsn_heading']:"" ?>" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <textarea type="text" class="form-control empty_all_data " name="other_charge_with_fuel_chrg_remark" id="" value="" ><?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_with_fuel_chrg_remark'])? $product_sale['other_charge_with_fuel_chrg_remark']:"" ?></textarea>
                                     </div>
                                    </div>                                     
                                    
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Other Charges (without Fuel Charges) <span class="required" aria-required="true"></span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data other_charge_without manually_sale" type="text"  placeholder="" id="other_charge_without" name="other_charge_without_fuel_chrg_amount" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_amount'])? $product_sale['other_charge_without_fuel_chrg_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data fuel_charge_other_charge_without manually_sale" type="text"  placeholder="" name="other_charge_without_fuel_chrg_fuel" id="other_charge_without_fuel_chrg_fuel" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_fuel'])? $product_sale['other_charge_without_fuel_chrg_fuel']:"0" ?>">
                                        </div>
                                    </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] sub_total_other_charge_without manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['sub_total'])? $product_sale['sub_total']:"0" ?>" name="sub_total"  >
                                                <input class="sub_total_other_charge_without_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_sub_total'])? $product_sale['other_charge_without_fuel_chrg_sub_total']:"0" ?>" name="other_charge_without_fuel_chrg_sub_total"  id="sub_total_other_charge_without_per">
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_other_charge_without" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_cgst'])? $product_sale['other_charge_without_fuel_chrg_cgst']:"0" ?>" name="other_charge_without_fuel_chrg_cgst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] sgst_other_charge_without" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_sgst'])? $product_sale['other_charge_without_fuel_chrg_sgst']:"0" ?>" name="other_charge_without_fuel_chrg_sgst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_other_charge_without" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_igst'])? $product_sale['other_charge_without_fuel_chrg_igst']:"0" ?>" name="other_charge_without_fuel_chrg_igst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] grand_total_other_charge_without" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_grand_total'])? $product_sale['other_charge_without_fuel_chrg_grand_total']:"0" ?>" name="other_charge_without_fuel_chrg_grand_total" >
                                            </div>
                                        </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text" id="hsn_code_other_charges_without_fuel" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_hsn_code_billing'])? $product_sale['other_charge_without_fuel_chrg_hsn_code_billing']:"0" ?>" name="other_charge_without_fuel_chrg_hsn_code_billing">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control empty_all_data manually_sale" name="other_charge_without_fuel_chrg_hsn_heading" id="hsn_heading_other_charges_without_fuel" value="<?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_hsn_heading'])? $product_sale['other_charge_without_fuel_chrg_hsn_heading']:"" ?>" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <textarea type="text" class="form-control empty_all_data " name="other_charge_without_fuel_chrg_remark" id="" value="" ><?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_remark'])? $product_sale['other_charge_without_fuel_chrg_remark']:"" ?></textarea>
                                     </div>
                                    </div>
                                  
                                    
                                    
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Service Charge 1 (Non taxable) <span class="required" aria-required="true">*</span></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] service_charge manually_sale" id="service_charge" type="text" placeholder="0"  name="service_charge_non_taxable_amount" value="<?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_amount'])? $product_sale['service_charge_non_taxable_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_service_charge manually_sale" id="service_charge_non_taxable_fuel" type="text" placeholder="0"  name="service_charge_non_taxable_fuel" value="<?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_fuel'])? $product_sale['service_charge_non_taxable_fuel']:"0" ?>">
                                            <input class="fuel_charge_service_charge_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($product_sale['fuel_charge_service_charge_per'])? $product_sale['fuel_charge_service_charge_per']:"0" ?>" name="fuel_charge_service_charge_per"  id="fuel_charge_service_charge_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_service_charge manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_sub_total'])? $product_sale['service_charge_non_taxable_sub_total']:"0" ?>" name="service_charge_non_taxable_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] cgst_service_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_cgst'])? $product_sale['service_charge_non_taxable_cgst']:"0" ?>" name="service_charge_non_taxable_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] sgst_service_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_sgst'])? $product_sale['service_charge_non_taxable_sgst']:"0" ?>" name="service_charge_non_taxable_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_service_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_igst'])? $product_sale['service_charge_non_taxable_igst']:"0" ?>" name="service_charge_non_taxable_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_service_charge" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_grand_total'])? $product_sale['service_charge_non_taxable_grand_total']:"0" ?>" name="service_charge_non_taxable_grand_total"  >
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                    <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text" id="hsn_code_service_charge1"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_hsn_code_billing'])? $product_sale['service_charge_non_taxable_hsn_code_billing']:"0" ?>" name="service_charge_non_taxable_hsn_code_billing">
                                     </div>
                                    </div>
                                    
                                    

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control empty_all_data manually_sale" name="service_charge_non_taxable_hsn_heading" id="hsn_heading_service_charge1" value="<?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_hsn_heading'])? $product_sale['service_charge_non_taxable_hsn_heading']:"" ?>" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <textarea type="text" class="form-control empty_all_data " name="service_charge_non_taxable_remark" id="" value="" ><?php echo !empty($_GET['id']) && !empty($product_sale['service_charge_non_taxable_remark'])? $product_sale['service_charge_non_taxable_remark']:"" ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Service Charge 2 (Non taxable) <span class="required" aria-required="true">*</span></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] service_charge3 manually_sale" id="service_charge3" type="text" placeholder="0"  name="booking_product_amount" value="<?php echo !empty($_GET['id']) && !empty($product_sale['booking_product_amount'])? $product_sale['booking_product_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_service_charge3 manually_sale" id="service_charge3S" type="text" placeholder="0"  name="booking_product_fuel" value="<?php echo !empty($_GET['id']) && !empty($product_sale['booking_product_fuel'])? $product_sale['booking_product_fuel']:"0" ?>" id="booking_product_fuel">
                                            <input class="fuel_charge_service_charge3_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($product_sale['fuel_charge_service_charge3_per'])? $product_sale['fuel_charge_service_charge3_per']:"0" ?>" name="fuel_charge_service_charge3_per"  id="fuel_charge_service_charge3_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_service_charge3 manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['booking_product_sub_total'])? $product_sale['booking_product_sub_total']:"0" ?>" name="booking_product_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] cgst_service_charge3" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['booking_product_cgst'])? $product_sale['booking_product_cgst']:"0" ?>" name="booking_product_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] sgst_service_charge3" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['booking_product_sgst'])? $product_sale['booking_product_sgst']:"0" ?>" name="booking_product_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_service_charge3" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['booking_product_igst'])? $product_sale['booking_product_igst']:"0" ?>" name="booking_product_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_service_charge3" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['booking_product_grand_total'])? $product_sale['booking_product_grand_total']:"0" ?>" name="booking_product_grand_total"  >
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                    <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text" id="hsn_code_service_charge2" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['booking_product_hsn_code_billing'])? $product_sale['booking_product_hsn_code_billing']:"0" ?>" name="booking_product_hsn_code_billing">
                                     </div>
                                    </div>
                                    
                                    

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control empty_all_data manually_sale" name="booking_product_hsn_heading" id="hsn_heading_service_charge2" value="<?php echo !empty($_GET['id']) && !empty($product_sale['booking_product_hsn_heading'])? $product_sale['booking_product_hsn_heading']:"" ?>" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="" ><?php echo !empty($_GET['id']) && !empty($product_sale['other_charge_without_fuel_chrg_grand_total'])? $product_sale['booking_product_remark']:"" ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Total<span class="required" aria-required="true">*</span></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] service_charge manually_sale" id="p_total" type="text" placeholder="0"  name="product_total_amount" value="<?php echo !empty($_GET['id']) && !empty($product_sale['product_total_amount'])? $product_sale['product_total_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] service_charge manually_sale" id="total_fuel" type="text" placeholder="0"  name="product_total_fuel" value="<?php echo !empty($_GET['id']) && !empty($product_sale['product_total_fuel'])? $product_sale['product_total_fuel']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] manually_sale" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['product_total_sub_total'])? $product_sale['product_total_sub_total']:"0" ?>" name="product_total_sub_total"  id="sub_totals">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number]" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['product_total_cgst'])? $product_sale['product_total_cgst']:"0" ?>" name="product_total_cgst"  id="cgst_total">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number]" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['product_total_sgst'])? $product_sale['product_total_sgst']:"0" ?>" name="product_total_sgst"  id="sgst_total">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number]" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['product_total_igst'])? $product_sale['product_total_igst']:"0" ?>" name="product_total_igst"  id="igst_total">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number]" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($product_sale['product_total_grand_total'])? $product_sale['product_total_grand_total']:"0" ?>" name="product_total_grand_total"  id="grand_totals">
                                        </div>
                                    </div>
                                     
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            
                                        </div>
                                    </div>
                                   

                            </div>
                            </div>
                             </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 p-0">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="manually_calculate_box2">Amount Calculation :Vendor ( Purchase ) - <span class="text-danger" id="show_type2"></span> </h3>
                        <input type="hidden" name="amount_calculation_type" id="amount_calculation_type" value="">
                        <button type="button" class="btn btn-primary float-right " id="manually_calculate2">Manual Calculate</button>
                            <input type="hidden" id="manually_fuel_get2" value ="0"> 
                    </div>  
                    
                    <div class="box-body addBillEntry-box-1" id="box-body">
                        <div class="row" style="align-items: center;">
                        
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Heading</label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Amount<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Fuel <span id="fuel_surcharges_ps2">0</span> % <span class="required" aria-required="true">*</span></label>
                                         <input type="hidden" id="fuel_vendor" name="fuel_vendor" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['fuel_vendor'])? $weight_calculation_pv['fuel_vendor']:"0" ?>">
                                         <input type="hidden" id="f_amount_v">
                                         <input type="hidden" id="f_covid_v">  
                                         <input type="hidden" id="f_restrictied_v">  
                                         <input type="hidden" id="f_ddp_v">  
                                         <input type="hidden" id="f_oversize_w_v">  
                                         <input type="hidden" id="f_oversize_d_v">  
                                         <input type="hidden" id="f_nonstakable_v">  
                                         <input type="hidden" id="f_commercial_v"> 
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Sub Total<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">CGST<br><span id="v_cgst2">0</span> %<span class="required" aria-required="true">*</span></label>
                                        <input type="hidden" id="cgst_vendor" name="cgst_vendor" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['cgst_vendor'])? $weight_calculation_pv['cgst_vendor']:"0" ?>">

                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">SGST<br><span id="v_sgst2">0</span> %<span class="required" aria-required="true">*</span></label>
                                        <input type="hidden" id="sgst_vendor" name="sgst_vendor" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['sgst_vendor'])? $weight_calculation_pv['sgst_vendor']:"0" ?>">
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">IGST<br><span id="v_igst2">0</span> %<span class="required" aria-required="true">*</span></label>
                                        <input type="hidden" id="igst_vendor" name="igst_vendor" value="<?php echo !empty($_GET['id']) && !empty($weight_calculation_pv['igst_vendor'])? $weight_calculation_pv['igst_vendor']:"0" ?>">
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Grand Total<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">HSN Code*(Billing)<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">HSN (Heading)<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <label for="">Remark<span class="required" aria-required="true">*</span></label>
                                           
                                        </div>
                                    </div> 


                            </div>        
                            <div class="row" style="align-items: center;">
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Currency </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="vendor_currency_amount" id="" value="INR" >
                                        </div>
                                    </div>
                            </div>        
                            <div class="row" style="align-items: center;">
                                     
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                            <label for="">Amount (Freight)<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] valid base_amount2 manually_vendor" id="base_amount2" type="text" placeholder="" name="vendor_amount_fright_amount"  value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_amount_fright_amount'])? $vendor_sale['vendor_amount_fright_amount']:"0" ?>" aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_amount2 manually_vendor" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_amount_fright_fuel'])? $vendor_sale['vendor_amount_fright_fuel']:"0" ?>" name="vendor_amount_fright_fuel"  id="fuel_surcharge">
                                            <input class="fuel_charge_amount2_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['fuel_charge_amount2_per'])? $vendor_sale['fuel_charge_amount2_per']:"0" ?>" name="fuel_charge_amount2_per"  id="fuel_charge_amount2_per">
                                        </div>

                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_amount2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_amount_fright_sub_total'])? $vendor_sale['vendor_amount_fright_sub_total']:"0" ?>" name="vendor_amount_fright_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_amount2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_amount_fright_cgst'])? $vendor_sale['vendor_amount_fright_cgst']:"0" ?>" name="vendor_amount_fright_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_amount2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_amount_fright_sgst'])? $vendor_sale['vendor_amount_fright_sgst']:"0" ?>" name="vendor_amount_fright_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_amount2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_amount_fright_igst'])? $vendor_sale['vendor_amount_fright_igst']:"0" ?>" name="vendor_amount_fright_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_amount2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_amount_fright_grand_total'])? $vendor_sale['vendor_amount_fright_grand_total']:"0" ?>" name="vendor_amount_fright_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_amount'])? $vendor_sale['vendor_hsn_code_amount']:"0" ?>" name="vendor_hsn_code_amount" id="vendor_hsn_code_amount">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_vendor" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>" name="amount_hsn_heading" id="vendor_hsn_heading_amount" >
                                     </div>
                                    </div>
                                    <div class="form-group">
                                    <textarea type="text" class="form-control empty_all_data" name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                    </div>


                                </div>        
                                <div class="row" style="align-items: center;">
                                 

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Covid Charge </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] covid_charge2 manually_vendor" type="text"  placeholder="" name="vendor_covid_charge_amount" id="covid_charge2" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_covid_charge_amount'])? $vendor_sale['vendor_covid_charge_amount']:"0" ?>">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_covid2 manually_vendor" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_covid_charge_fuel'])? $vendor_sale['vendor_covid_charge_fuel']:"0" ?>" name="vendor_covid_charge_fuel"  id="fuel_surcharge1">
                                            <input class="fuel_charge_covid2_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['fuel_charge_covid2_per'])? $vendor_sale['fuel_charge_covid2_per']:"0" ?>" name="fuel_charge_covid2_per"  id="fuel_charge_covid2_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_covid2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_covid_charge_sub_total'])? $vendor_sale['vendor_covid_charge_sub_total']:"0" ?>" name="vendor_covid_charge_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_covid2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_covid_charge_cgst'])? $vendor_sale['vendor_covid_charge_cgst']:"0" ?>" name="vendor_covid_charge_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_covid2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_covid_charge_sgst'])? $vendor_sale['vendor_covid_charge_sgst']:"0" ?>" name="vendor_covid_charge_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_covid2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_covid_charge_igst'])? $vendor_sale['vendor_covid_charge_igst']:"0" ?>" name="vendor_covid_charge_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_covid2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_covid_charge_grand_total'])? $vendor_sale['vendor_covid_charge_grand_total']:"0" ?>" name="vendor_covid_charge_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text" id="vendor_hsn_code_covid_charge"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_covid_charge'])? $vendor_sale['vendor_hsn_code_covid_charge']:"0" ?>" name="vendor_hsn_code_covid_charge">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_covid_charge" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                     </div>
                                    </div>
                                    <div class="form-group">
                                    <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                     </div>

                           

                                </div>        
                                <div class="row" style="align-items: center;">
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Restricted Country Charge <span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] res_charge2 manually_vendor" type="text"  placeholder="" name="vendor_restricted_country_charge_amount" id="res_charge2" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_restricted_country_charge_amount'])? $vendor_sale['vendor_restricted_country_charge_amount']:"0" ?>">
                                        </div>
                                    </div>

                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_res_charge2 manually_vendor" type="text" placeholder="0" value="0" name="vendor_restricted_country_charge_fuel"  >
                                            <input class="fuel_charge_res_charge2_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['fuel_charge_res_charge2_per'])? $vendor_sale['fuel_charge_res_charge2_per']:"0" ?>" name="fuel_charge_res_charge2_per"  id="fuel_charge_res_charge2_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_res_charge2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_restricted_country_charge_sub_total'])? $vendor_sale['vendor_restricted_country_charge_sub_total']:"0" ?>" name="vendor_restricted_country_charge_sub_total" >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_res_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_restricted_country_charge_cgst'])? $vendor_sale['vendor_restricted_country_charge_cgst']:"0" ?>" name="vendor_restricted_country_charge_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input  style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] sgst_res_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_restricted_country_charge_sgst'])? $vendor_sale['vendor_restricted_country_charge_sgst']:"0" ?>" name="vendor_restricted_country_charge_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_res_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_restricted_country_charge_igst'])? $vendor_sale['vendor_restricted_country_charge_igst']:"0" ?>" name="vendor_restricted_country_charge_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_res_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_restricted_country_charge_grand_total'])? $vendor_sale['vendor_restricted_country_charge_grand_total']:"0" ?>" name="vendor_restricted_country_charge_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text"  placeholder="0" id="vendor_hsn_code_res_charge" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_res_charge'])? $vendor_sale['vendor_hsn_code_res_charge']:"0" ?>" name="vendor_hsn_code_res_charge">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_res_charge" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                     </div>
                                    </div>
                                    <div class="form-group">
                                    <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="vendor_hsn_heading_res_charge" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                     </div>


                                </div>        
                                <div class="row" style="align-items: center;">
                                    
                                     
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Commercial Charge <span class="required" aria-required="true">*</span></label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] com_charge2 manually_vendor" type="text"  placeholder="" name="vendor_commercial_charge_amount" id="com_charge2" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_commercial_charge_amount'])? $vendor_sale['vendor_commercial_charge_amount']:"0" ?>">
                                            </div>
                                        </div>
                                     
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_com_charge2 manually_vendor"  type="text" placeholder="0" value="0" name="vendor_commercial_charge_fuel" >
                                                <input class="fuel_charge_com_charge2_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['fuel_charge_com_charge2_per'])? $vendor_sale['fuel_charge_com_charge2_per']:"0" ?>" name="fuel_charge_com_charge2_per"  id="fuel_charge_com_charge2_per">
                                            </div>
                                         </div>
                                         <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] sub_total_com_charge2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_commercial_charge_sub_total'])? $vendor_sale['vendor_commercial_charge_sub_total']:"0" ?>" name="vendor_commercial_charge_sub_total">
                                            </div>
                                        </div>

                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_com_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_commercial_charge_cgst'])? $vendor_sale['vendor_commercial_charge_cgst']:"0" ?>" name="vendor_commercial_charge_cgst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] sgst_com_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_commercial_charge_sgst'])? $vendor_sale['vendor_commercial_charge_sgst']:"0" ?>" name="vendor_commercial_charge_sgst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_com_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_commercial_charge_igst'])? $vendor_sale['vendor_commercial_charge_igst']:"0" ?>" name="vendor_commercial_charge_igst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] grand_total_com_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_commercial_charge_grand_total'])? $vendor_sale['vendor_commercial_charge_grand_total']:"0" ?>" name="vendor_commercial_charge_grand_total"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text" id="vendor_hsn_code_Commercial_Charge"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_Commercial_Charge'])? $vendor_sale['vendor_hsn_code_Commercial_Charge']:"0" ?>" name="vendor_hsn_code_Commercial_Charge">
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_Commercial_Charge" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                            </div>
                                         </div>

                                        <div class="form-group">
                                        <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                        </div>
                                    </div>

                                    
                                    <!-- <div class="row" style="align-items: center;">
                                 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Non standard (Weight) (Oversize)(cl 1) </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data ext_weight_charge2" type="text" id="vendor_non_stnd_weight_oversize_amount" name="vendor_non_stnd_weight_oversize_amount" placeholder="additional_charge" value="0">
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_ext_weight_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_weight_oversize_fuel"  id="fuel_surcharge9">
                                            <input class="fuel_charge_ext_weight_charge2_per" type="hidden" value="0" name="fuel_charge_ext_weight_charge2_per"  id="fuel_charge_ext_weight_charge2_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_ext_weight_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_weight_oversize_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] cgst_ext_weight_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_weight_oversize_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sgst_ext_weight_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_weight_oversize_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] igst_ext_weight_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_weight_oversize_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_ext_weight_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_weight_oversize_grand_total"  >
                                        </div>
                                    </div>
                                </div>         -->
                                    <div class="row" style="align-items: center;">
                                 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Non standard (Weight) (Oversize) Result</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data ext_weight_charge_cl2 manually_vendor" type="text" id="vendor_non_stnd_weight_oversize_amount_new" name="vendor_non_stnd_weight_oversize_amount_new" placeholder="additional_charge" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stnd_weight_oversize_amount_new'])? $vendor_sale['vendor_non_stnd_weight_oversize_amount_new']:"0" ?>">
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_ext_weight_charge_cl2 manually_vendor" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stnd_weight_oversize_fuel'])? $vendor_sale['vendor_non_stnd_weight_oversize_fuel']:"0" ?>" name="vendor_non_stnd_weight_oversize_fuel"  id="fuel_surcharge9">
                                            <input class="fuel_charge_ext_weight_charge2_per" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['fuel_charge_ext_weight_charge2_per'])? $vendor_sale['fuel_charge_ext_weight_charge2_per']:"0" ?>" name="fuel_charge_ext_weight_charge2_per"  id="fuel_charge_ext_weight_charge2_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_ext_weight_charge_cl2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stnd_weight_oversize_sub_total'])? $vendor_sale['vendor_non_stnd_weight_oversize_sub_total']:"0" ?>" name="vendor_non_stnd_weight_oversize_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_ext_weight_charge_cl2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stnd_weight_oversize_cgst'])? $vendor_sale['vendor_non_stnd_weight_oversize_cgst']:"0" ?>" name="vendor_non_stnd_weight_oversize_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] sgst_ext_weight_charge_cl2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stnd_weight_oversize_sgst'])? $vendor_sale['vendor_non_stnd_weight_oversize_sgst']:"0" ?>" name="vendor_non_stnd_weight_oversize_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] igst_ext_weight_charge_cl2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stnd_weight_oversize_igst'])? $vendor_sale['vendor_non_stnd_weight_oversize_igst']:"0" ?>" name="vendor_non_stnd_weight_oversize_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_ext_weight_charge_cl2" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stnd_weight_oversize_grand_total'])? $vendor_sale['vendor_non_stnd_weight_oversize_grand_total']:"0" ?>" name="vendor_non_stnd_weight_oversize_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text" id="vendor_hsn_code_non_standard_Result"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_non_standard_Result'])? $vendor_sale['vendor_hsn_code_non_standard_Result']:"0" ?>" name="vendor_hsn_code_non_standard_Result">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_non_standard_Result" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                     </div>
                                    </div>
                                    <div class="form-group">
                                    <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                    </div>

                                </div>        
                                <!--  <div class="row" style="align-items: center;">
                                     
                                   <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Non standard (Dimension) (Oversize)<span class="required" aria-required="true">*</span></label>                                         
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data non_stackable_charge2" type="text" id="non_stackable_charge2"  name="vendor_non_stnd_dimension_oversize_amount" placeholder="non_stackable_charge" value="0">
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_non_stackable_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_dimension_oversize_fuel"  >
                                            <input class="fuel_charge_non_stackable_charge2_per" type="hidden" value="0" name="fuel_charge_non_stackable_charge2_per"  id="fuel_charge_non_stackable_charge2_per">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_non_stackable_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_dimension_oversize_sub_total" >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] cgst_non_stackable_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_dimension_oversize_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sgst_non_stackable_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_dimension_oversize_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] igst_non_stackable_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_dimension_oversize_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_non_stackable_charge2" type="text" placeholder="0" value="0" name="vendor_non_stnd_dimension_oversize_grand_total"  >
                                        </div>
                                    </div>
                                </div>         -->
                                <div class="row" style="align-items: center;">
                                      
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">DDP(Duty Delivery Paid)<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data ddp_charge2 manually_vendor" type="text" name="vendor_duty_delivery_paid_amount " id="ddp_charge2" placeholder="dimensional_charge " value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_duty_delivery_paid_amount'])? $vendor_sale['vendor_duty_delivery_paid_amount']:"0" ?>">
                                        </div>
                                    </div>
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_ddp_charge2 manually_vendor" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_duty_delivery_paid_fuel'])? $vendor_sale['vendor_duty_delivery_paid_fuel']:"0" ?>" name="vendor_duty_delivery_paid_fuel"  id="fuel_surcharge4">
                                            <input class="fuel_charge_ddp_charge2_par" type="hidden" value="0" name="fuel_charge_ddp_charge2_par"  id="fuel_charge_ddp_charge2_par">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_ddp_charge2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_duty_delivery_paid_sub_total'])? $vendor_sale['vendor_duty_delivery_paid_sub_total']:"0" ?>" name="vendor_duty_delivery_paid_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] cgst_ddp_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_duty_delivery_paid_cgst'])? $vendor_sale['vendor_duty_delivery_paid_cgst']:"0" ?>" name="vendor_duty_delivery_paid_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_ddp_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_duty_delivery_paid_sgst'])? $vendor_sale['vendor_duty_delivery_paid_sgst']:"0" ?>" name="vendor_duty_delivery_paid_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_ddp_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_duty_delivery_paid_igst'])? $vendor_sale['vendor_duty_delivery_paid_igst']:"0" ?>" name="vendor_duty_delivery_paid_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_ddp_charge2" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_duty_delivery_paid_grand_total'])? $vendor_sale['vendor_duty_delivery_paid_grand_total']:"0" ?>" name="vendor_duty_delivery_paid_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" id="vendor_hsn_code_ddp" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_ddp'])? $vendor_sale['vendor_hsn_code_ddp']:"0" ?>" name="vendor_hsn_code_ddp">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_ddp" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                     </div>
                                    </div>
                                    <div class="form-group">
                                    <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                        </div>

                                     
                                </div>        
                                <div class="row" style="align-items: center;">                                  
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Non-stackable (Fragile)<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data extra_dimensional_charge2 manually_vendor" type="text" id="extra_dimensional_charge2" name="vendor_non_stackable_frgle_amount" placeholder="dimensional_charge" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stackable_frgle_amount'])? $vendor_sale['vendor_non_stackable_frgle_amount']:"0" ?>">
                                            
                                        </div>
                                    </div>

                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_extra_dimensional_charge2 manually_vendor" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stackable_frgle_fuel'])? $vendor_sale['vendor_non_stackable_frgle_fuel']:"0" ?>" name="vendor_non_stackable_frgle_fuel"  id="fuel_surcharge5">
                                            <input class="fuel_charge_extra_dimensional_charge2_par" type="hidden" value="0" name="fuel_charge_extra_dimensional_charge2_par"  id="fuel_charge_extra_dimensional_charge2_par">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_extra_dimensional_charge2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stackable_frgle_sub_total'])? $vendor_sale['vendor_non_stackable_frgle_sub_total']:"0" ?>" name="vendor_non_stackable_frgle_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);"class="form-control empty_all_data validate[required,custom[number] cgst_extra_dimensional_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stackable_frgle_cgst'])? $vendor_sale['vendor_non_stackable_frgle_cgst']:"0" ?>" name="vendor_non_stackable_frgle_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input  style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_extra_dimensional_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stackable_frgle_sgst'])? $vendor_sale['vendor_non_stackable_frgle_sgst']:"0" ?>" name="vendor_non_stackable_frgle_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_extra_dimensional_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stackable_frgle_igst'])? $vendor_sale['vendor_non_stackable_frgle_igst']:"0" ?>" name="vendor_non_stackable_frgle_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_extra_dimensional_charge2" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_non_stackable_frgle_grand_total'])? $vendor_sale['vendor_non_stackable_frgle_grand_total']:"0" ?>" name="vendor_non_stackable_frgle_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text" id="vendor_hsn_code_non-stackable"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_non_stackable'])? $vendor_sale['vendor_hsn_code_non_stackable']:"0" ?>" name="vendor_hsn_code_non_stackable">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_non-stackable" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                     </div>
                                    </div>
                                    <div class="form-group">
                                    <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                    </div>


                                </div>        
                                <div class="row" style="align-items: center;">
                                 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Other Charges (with Fuel Charges) <span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data other_charge2 manually_vendor" type="text"  placeholder="" name="vendor_other_charge_with_fuel_charge_amount" id="other_charge2" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_with_fuel_charge_amount'])? $vendor_sale['vendor_other_charge_with_fuel_charge_amount']:"0" ?>">
                                        </div>
                                    </div>
                                     
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_other_charge2 manually_vendor" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_with_fuel_charge_fuel'])? $vendor_sale['vendor_other_charge_with_fuel_charge_fuel']:"0" ?>" name="vendor_other_charge_with_fuel_charge_fuel"  id="fuel_surcharge6">
                                            <input class="fuel_charge_other_charge2_par" type="hidden" value="0" name="fuel_charge_other_charge2_par"  id="fuel_charge_other_charge2_par">
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_other_charge2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_with_fuel_charge_sub_total'])? $vendor_sale['vendor_other_charge_with_fuel_charge_sub_total']:"0" ?>" name="vendor_other_charge_with_fuel_charge_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_other_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_with_fuel_charge_cgst'])? $vendor_sale['vendor_other_charge_with_fuel_charge_cgst']:"0" ?>" name="vendor_other_charge_with_fuel_charge_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_other_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_with_fuel_charge_sgst'])? $vendor_sale['vendor_other_charge_with_fuel_charge_sgst']:"0" ?>" name="vendor_other_charge_with_fuel_charge_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_other_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_with_fuel_charge_igst'])? $vendor_sale['vendor_other_charge_with_fuel_charge_igst']:"0" ?>" name="vendor_other_charge_with_fuel_charge_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_other_charge2" type="text"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_with_fuel_charge_grand_total'])? $vendor_sale['vendor_other_charge_with_fuel_charge_grand_total']:"0" ?>" name="vendor_other_charge_with_fuel_charge_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text" id="vendor_hsn_code_other_charges"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_other_charges'])? $vendor_sale['vendor_hsn_code_other_charges']:"0" ?>" name="vendor_hsn_code_other_charges">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_other_charges" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                     </div>
                                    </div>
                                     <div class="form-group">
                                     <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                     </div>


                                </div>        
                                <div class="row" style="align-items: center;">
                                 
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Other Charges (without Fuel Charges) <span class="required" aria-required="true"></span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data other_charge_without2 manually_vendor" type="text"  placeholder="" id="other_charge_without" name="vendor_other_charge_without_fuel_charge_amount" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_without_fuel_charge_amount'])? $vendor_sale['vendor_other_charge_without_fuel_charge_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data fuel_charge_other_charge_without2 manually_vendor" type="text"  placeholder="" name="vendor_other_charge_without_fuel_charge_fuel" id="other_charge_withouts" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_without_fuel_charge_fuel'])? $vendor_sale['vendor_other_charge_without_fuel_charge_fuel']:"0" ?>">
                                            <input class="fuel_charge_other_charge_without2_par" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['fuel_charge_other_charge_without2_par'])? $vendor_sale['fuel_charge_other_charge_without2_par']:"0" ?>" name="fuel_charge_other_charge_without2_par"  id="fuel_charge_other_charge_without2_par">
                                        </div>
                                    </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] sub_total_other_charge_without2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_without_fuel_charge_sub_total'])? $vendor_sale['vendor_other_charge_without_fuel_charge_sub_total']:"0" ?>" name="vendor_other_charge_without_fuel_charge_sub_total"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_other_charge_without2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_without_fuel_charge_cgst'])? $vendor_sale['vendor_other_charge_without_fuel_charge_cgst']:"0" ?>" name="vendor_other_charge_without_fuel_charge_cgst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_other_charge_without2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_without_fuel_charge_sgst'])? $vendor_sale['vendor_other_charge_without_fuel_charge_sgst']:"0" ?>" name="vendor_other_charge_without_fuel_charge_sgst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_other_charge_without2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_without_fuel_charge_igst'])? $vendor_sale['vendor_other_charge_without_fuel_charge_igst']:"0" ?>" name="vendor_other_charge_without_fuel_charge_igst"  >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control empty_all_data validate[required,custom[number] grand_total_other_charge_without2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_other_charge_without_fuel_charge_grand_total'])? $vendor_sale['vendor_other_charge_without_fuel_charge_grand_total']:"0" ?>" name="vendor_other_charge_without_fuel_charge_grand_total" >
                                            </div>
                                        </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text" id="vendor_hsn_code_other_charges_without_fuel"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_other_charges_without_fuel'])? $vendor_sale['vendor_hsn_code_other_charges_without_fuel']:"0" ?>" name="vendor_hsn_code_other_charges_without_fuel">
                                            </div>  
                                       </div>
                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                            <div class="form-group">
                                            <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_other_charges_without_fuel" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                        </div>

                                </div>        
                                <div class="row" style="align-items: center;">                                
                                    
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Service Charge 1 (Non taxable) <span class="required" aria-required="true">*</span></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] service_charge2 manually_vendor" id="service_charge2" type="text" placeholder="0"  name="vendor_service_charge_non_taxable_amount" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_service_charge_non_taxable_amount'])? $vendor_sale['vendor_service_charge_non_taxable_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_service_charge2 manually_vendor" id="service_chargeS" type="text" placeholder="0"  name="vendor_service_charge_non_taxable_fuel" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_service_charge_non_taxable_fuel'])? $vendor_sale['vendor_service_charge_non_taxable_fuel']:"0" ?>">
                                            <input class="fuel_charge_service_charge2_par" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['fuel_charge_service_charge2_par'])? $vendor_sale['fuel_charge_service_charge2_par']:"0" ?>" name="fuel_charge_service_charge2_par"  id="fuel_charge_service_charge2_par">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_service_charge2 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_service_charge_non_taxable_sub_total'])? $vendor_sale['vendor_service_charge_non_taxable_sub_total']:"0" ?>" name="vendor_service_charge_non_taxable_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_service_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_service_charge_non_taxable_cgst'])? $vendor_sale['vendor_service_charge_non_taxable_cgst']:"0" ?>" name="vendor_service_charge_non_taxable_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_service_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_service_charge_non_taxable_sgst'])? $vendor_sale['vendor_service_charge_non_taxable_sgst']:"0" ?>" name="vendor_service_charge_non_taxable_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_service_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_service_charge_non_taxable_igst'])? $vendor_sale['vendor_service_charge_non_taxable_igst']:"0" ?>" name="vendor_service_charge_non_taxable_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_service_charge2" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_service_charge_non_taxable_grand_total'])? $vendor_sale['vendor_service_charge_non_taxable_grand_total']:"0" ?>" name="vendor_service_charge_non_taxable_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text" id="vendor_hsn_code_service_charge1"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_service_charge1'])? $vendor_sale['vendor_hsn_code_service_charge1']:"0" ?>" name="vendor_hsn_code_service_charge1">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_service_charge1" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                     </div>
                                    </div>
                                    <div class="form-group">
                                    <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                        </div>


                                </div>  
                                      
                                <div class="row" style="align-items: center;">                                
                                    
                                     <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Service Charge 2 (Non taxable) <span class="required" aria-required="true">*</span></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] service_charge4 manually_vendor" id="service_charge4" type="text" placeholder="0"  name="booking_vendor_amount" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_vendor_amount'])? $vendor_sale['booking_vendor_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] fuel_charge_service_charge4 manually_vendor" id="service_chargeS" type="text" placeholder="0"  name="booking_vendor_fuel" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_vendor_fuel'])? $vendor_sale['booking_vendor_fuel']:"0" ?>">
                                            <input class="fuel_charge_service_charge4_par" type="hidden" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['fuel_charge_service_charge4_par'])? $vendor_sale['fuel_charge_service_charge4_par']:"0" ?>" name="fuel_charge_service_charge4_par"  id="fuel_charge_service_charge4_par">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] sub_total_service_charge4 manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_vendor_sub_total'])? $vendor_sale['booking_vendor_sub_total']:"0" ?>" name="booking_vendor_sub_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] cgst_service_charge4" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_vendor_cgst'])? $vendor_sale['booking_vendor_cgst']:"0" ?>" name="booking_vendor_cgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] sgst_service_charge4" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_vendor_sgst'])? $vendor_sale['booking_vendor_sgst']:"0" ?>" name="booking_vendor_sgst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number] igst_service_charge4" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_vendor_igst'])? $vendor_sale['booking_vendor_igst']:"0" ?>" name="booking_vendor_igst"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] grand_total_service_charge4" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_vendor_grand_total'])? $vendor_sale['booking_vendor_grand_total']:"0" ?>" name="booking_vendor_grand_total"  >
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                        <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text" id="vendor_hsn_code_service_charge2"  placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_hsn_code_service_charge2'])? $vendor_sale['vendor_hsn_code_service_charge2']:"0" ?>" name="vendor_hsn_code_service_charge2">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                    <div class="form-group">
                                        <input type="text " class="form-control empty_all_data manually_vendor" name="amount_hsn_heading" id="vendor_hsn_heading_service_charge2" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['amount_hsn_heading'])? $vendor_sale['amount_hsn_heading']:"" ?>">
                                     </div>
                                    </div>
                                    <div class="form-group">
                                    <textarea type="text" class="form-control empty_all_data " name="booking_product_remark" id="" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['booking_product_remark'])? $vendor_sale['booking_product_remark']:"" ?>" ></textarea>
                                        </div>


                                </div>        
                                <div class="row" style="align-items: center;">
                                 
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Total<span class="required" aria-required="true">*</span></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] service_charge manually_sale manually_vendor" id="p_total3" type="text" placeholder="0"  name="vendor_total_amount" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_total_amount'])? $vendor_sale['vendor_total_amount']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] service_charge manually_vendor" id="total_fuel3" type="text" placeholder="0"  name="vendor_total_fuel" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_total_fuel'])? $vendor_sale['vendor_total_fuel']:"0" ?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number] manually_vendor" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_total_sub_total'])? $vendor_sale['vendor_total_sub_total']:"0" ?>" name="vendor_total_sub_total"  id="sub_totals3">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number]" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_total_cgst'])? $vendor_sale['vendor_total_cgst']:"0" ?>" name="vendor_total_cgst"  id="cgst_total3">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number]" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_total_sgst'])? $vendor_sale['vendor_total_sgst']:"0" ?>" name="vendor_total_sgst"  id="sgst_total3">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input style="background: rgb(199, 201, 203);" class="form-control empty_all_data validate[required,custom[number]" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_total_igst'])? $vendor_sale['vendor_total_igst']:"0" ?>" name="vendor_total_igst"  id="igst_total3">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
                                        <div class="form-group">
                                            <input class="form-control empty_all_data validate[required,custom[number]" type="text" readonly placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($vendor_sale['vendor_total_grand_total'])? $vendor_sale['vendor_total_grand_total']:"0" ?>" name="vendor_total_grand_total"  id="grand_totals3">
                                        </div>
                                    </div>
                                   
                                   
                            </div>
                            </div>
                             </div>
                            </div>    

                            <div class="col-xl-12 col-lg-12 p-0">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Sale/Vendor Comparison Screen </h3>
                                    </div> 
                                    <div class="box-body addBillEntry-box-1" id="box-body">
                                        <div class="row" style="align-items: center;">
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 ml-1"></div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                <label for="" id="">Amount</label>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                <label for="" id="comparison_fule">Fule</label>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-2">
                                                <div class="form-group">
                                                    <label id ="comparison_subtotal">Subtotal</label>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-2"></div>

                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 ml-1"><label id ="">Sale</label></div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_sale_amount'])? $sv_comparison['comparison_sale_amount']:"0" ?>" name="comparison_sale_amount"  id="comparison_sale_amount">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_sale_fule'])? $sv_comparison['comparison_sale_fule']:"0" ?>" name="comparison_sale_fule"  id="comparison_sale_fule">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-2">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_sale_sub_total'])? $sv_comparison['comparison_sale_sub_total']:"0" ?>" name="comparison_sale_sub_total"  id="comparison_sale_sub_total">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-2"></div>

                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 ml-1"><label id ="">Vendor</label></div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_vendor_amount'])? $sv_comparison['comparison_vendor_amount']:"0" ?>" name="comparison_vendor_amount"  id="comparison_vendor_amount">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_vendor_fule'])? $sv_comparison['comparison_vendor_fule']:"0" ?>" name="comparison_vendor_fule"  id="comparison_vendor_fule">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-2">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_vendor_sub_total'])? $sv_comparison['comparison_vendor_sub_total']:"0" ?>" name="comparison_vendor_sub_total"  id="comparison_vendor_sub_total">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-2"></div>
                                            
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 ml-1"><label id ="">Profit/Loss</label></div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_pl_amount'])? $sv_comparison['comparison_pl_amount']:"0" ?>" name="comparison_pl_amount"  id="comparison_pl_amount">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_pl_fule'])? $sv_comparison['comparison_pl_fule']:"0" ?>" name="comparison_pl_fule"  id="comparison_pl_fule">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-2">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_pl_sub_total'])? $sv_comparison['comparison_pl_sub_total']:"0" ?>" name="comparison_pl_sub_total"  id="comparison_pl_sub_total">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-2"></div>
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 ml-1"><label id ="">Profit/Loss in %</label></div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_pl_amount_percentage'])? $sv_comparison['comparison_pl_amount_percentage']:"0" ?>" name="comparison_pl_amount_percentage"  id="comparison_pl_amount_percentage">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_pl_fule_percentage'])? $sv_comparison['comparison_pl_fule_percentage']:"0" ?>" name="comparison_pl_fule_percentage"  id="comparison_pl_fule_percentage">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-2">
                                                <div class="form-group">
                                                    <input class="form-control empty_all_data validate[required,custom[number]" type="text" placeholder="0" value="<?php echo !empty($_GET['id']) && !empty($sv_comparison['comparison_pl_sub_total_percentage'])? $sv_comparison['comparison_pl_sub_total_percentage']:"0" ?>" name="comparison_pl_sub_total_percentage"  id="comparison_pl_sub_total_percentage">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>   



                        <!-- <div class="col-xl-12 col-lg-12 p-0">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">AUTO AGENT ( VENDOR ) RATE </h3>
                            </div> 
                            <div class="box-body addBillEntry-box-1" id="box-body">
                            <div class="row" style="align-items: center;">
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                    <input type="button" class="btn btn-success  valid mb-3" style="border-radius: 50%;" value="+" aria-invalid="false">    
                                        
                                    </div>
                                </div>
                               <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                    <label for="">Sale <span class="required" aria-required="true">*</span></label>
                                    <label for="" id="grand_totalss4"> </label>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                    <label for="">Purchace ( VENDOR ) <span class="required" aria-required="true">*</span></label>
                                    <label for="" id="grand_totalss5"> </label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                    <label for="">profit / loss (Amount) <span class="required" aria-required="true">*</span></label><br>
                                    <label id ="profitss12"></label>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                    <label for="">profit / loss (%)<span class="required" aria-required="true">*</span></label>
                                    </div>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Total : Billing Weight ( Higer )<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data valid" id="vendor_purchase_weight1" name="vendor_purchase_weight" value="0" readonly="true" aria-invalid="false">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Total : Vendor Billing Weight (SET WEIGHT)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="billing_weight1" value="0" >
                                     </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Amount ( Freight ) <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_amount"  name="vendor_amount" value="0" readonly="true">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Amount ( Freight ) <span class="required" aria-required="true">*</span></label>                                        
                                        <input type="text" class="form-control empty_all_data grand_total_amount2" name="" value="0" >
                                     </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Covid Charge <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_covid"  value="0" name="vendor_purchase_covid" readonly="true">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Covid Charge <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_covid2 " name=""  value="0" >
                                        
                                     </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Restricted Country Charge<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_res_charge"  name="vendor_purchase_restricted" value="0" readonly="true">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Restricted Country Charge<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_res_charge2" name=""  value="0" >
                                        
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Commercial Charge<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_com_charge" name="vendor_purchase_commercial" value="0" readonly="true">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Commercial Charge<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_com_charge2" name="" value="0" >
                                     </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Non standard (Weight) (Oversize)</label>
                                        <input type="text" class="form-control empty_all_data grand_total_ext_weight_charge" name="vendor_ext_weight_charge" value="0" readonly="true">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">NON STANDARD (Weight) (Oversize)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_ext_weight_charge2" name="" value="0" >
                                     </div>
                                    </div> -->

                                    <!-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">NON STANDARD ( Dimension ) (Oversize)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_non_stackable_charge" name="vendor_non_stackable_charge" value="0" readonly="true">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">NON STANDARD ( Dimension ) (Oversize)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_non_stackable_charge" name="" value="0" >
                                     </div>
                                    </div> -->

                                    <!-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">DDP(Duty Delivery Paid)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_ddp_charge2"  name="vendor_ddp_charge" value="0">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">DDP(Duty Delivery Paid)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_ddp_charge2" name="" value="0" >
                                     </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">NON -STACKABLE (Fragile)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_extra_dimensional_charge"  name="vendor_extra_dimensional_charge" value="0">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">NON -STACKABLE (Fragile)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_extra_dimensional_charge2" name=""  value="0" >
                                     </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Other Charges (with Fuel Charges)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_other_charge"  name="vendor_other_charge" value="0" readonly="true">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Other Charges (with Fuel Charges)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_other_charge2" name="" value="0" >
                                     </div>
                                    </div>

                                   

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Other Charges (without Fuel Charges)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_other_charge_without"  name="vendor_other_charge_without" value="0" readonly="true">
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Other Charges (without Fuel Charges)<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data grand_total_other_charge_without2" name=""  value="0" >
                                     </div>
                                    </div>

                                   

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group">
                                        <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                     </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <label for="">Service Charge (Non taxable)<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control empty_all_data grand_total_service_charge" name="vendor_purchase_service_charge" value="0" readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <label for="">Service Charge (Non taxable)<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control empty_all_data grand_total_service_charge2" name="" value="0" >
                                        </div>
                                    </div>


                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                    <div class="form-group"> -->
                                        <!-- <label for="">Bill Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control empty_all_data" name="" id="" value="" > -->
                                     <!-- </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                        <div class="form-group"> -->
                                            <!-- <label for="">Bill No <span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control empty_all_data" name="" id="" value="" > -->
                                        <!-- </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                        <div class="form-group"> -->
                                            <!-- <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control empty_all_data" name="" id="" value="" > -->
                                        <!-- </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group"> -->
                                            <!-- <label for="">Service Charge (Non taxable)<span class="required" aria-required="true">*</span></label> -->
                                            <!-- <input type="text" class="form-control empty_all_data grand_total_service_charge3" name="vendor_purchase_service_charge" value="0" readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                        <div class="form-group"> -->
                                            <!-- <label for="">Service Charge (Non taxable)<span class="required" aria-required="true">*</span></label> -->
                                            <!-- <input type="text" class="form-control empty_all_data grand_total_service_charge4" name="" value="0" >
                                        </div>
                                    </div>


                                    
                                    

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <label for="">Total<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control empty_all_data" id="grand_totals4" name="vendor_purchase_gross_total" value="0" readonly="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg- col-md-2 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <label for="">Total<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control empty_all_data" name="" id="grand_totals5" value="0" >
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <input type="text" class="form-control empty_all_data" name="" id="" value="" >
                                        </div>
                                    </div> -->

                        <!-- </div>
                        </div>
                        </div>
                        </div> -->
                        <div class="col-xl-12 col-lg-12 p-0">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Payment Mode </h3>
                            </div> 
                            <div class="box-body addBillEntry-box-1" id="box-body">
                                <div class="row" style="align-items: center;">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary  valid w-100 mb-1" value="Payment Mode " aria-invalid="false">
                                                <select class="form-control empty_all_data" name="payment_mode" id="" aria-required="true">
                                                    <option value="">Payment Mode </option>
                                                    <?php foreach($payment_modes as $payment_mode){ ?>

                                                        <option value="<?php echo $payment_mode['id']; ?>"
                                                            <?php 
                                                                // Check if $payment_mode_details['name'] is not set and default to 'Credit'
                                                                
                                                                // If $payment_mode_details['name'] is set and matches $payment_mode['name']
                                                                if (isset($payment_mode_details['name']) && $payment_mode['id'] === $payment_mode_details['name']) {
                                                                    echo 'selected="selected"';
                                                                }elseif (!isset($payment_mode_details['name']) && $payment_mode['name'] == 'Credit') {
                                                                    echo 'selected="selected"';
                                                                } 
                                                            ?>>
                                                            <?php echo $payment_mode['name']; ?>
                                                        </option>



                                                        
                                                    <?php }?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                    <div class="form-group">
                                            <label for="">Payment Detail</label>
                                            <input type="text" class="form-control empty_all_data" name="payment_detail" id="" value="<?php if(isset($_GET['id']) && isset($payment_mode_details['detail'])){ echo $payment_mode_details['detail'];} ?>" >
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <label for="">Payment Note<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control empty_all_data" name="payment_note" id="" value="<?php if(isset($payment_mode_details['note'])){ echo $payment_mode_details['note'];} ?>" >
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                                                            <?php 
                    $total_amount = 0;
                if (isset($all_data) && !empty($all_data)) {
               
            ?>

<div class="col-xl-12 col-lg-12 p-0">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Proforma Invoice ( Hsn code ) ( Box Wise )</h3>
                    </div>  
                    
                    <div class="box-body addBillEntry-box-1" id="box-body">
                                <div class="row" style="align-items: end;">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        
                                        <!-- <div class="form-group">
                                            <label for="">Purpose Mode<span class="required" aria-required="true">*</span></label>
                                            <input class="form-control empty_all_data" type="text" name="" id="">
                                                    </div>
                                                    </div> -->
                                            <!-- <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            ADD DATA
                                            </button> -->
                                            <!-- <button type="button" class="btn btn-primary mt-2" id="openModalBtn" data-target="#hsnCodeModal"  data-toggle="modal">ADD DATA</button> -->
                                            <div class="" id="hsnCodeModal" tabindex="-1" role="dialog" aria-labelledby="hsnCodeModalLabel" aria-hidden="true">
                                                <div class="" role="document">
                                                    <div class="">

                                                        <!-- <div class="modal-header d-flex justify-content-between">
                                                            <h5 class="modal-title" id="exampleModalLabel">Performa Invoice Entry</h5>
                                                            <div class="">
                                                            Date- <?php //echo date('d-m-Y h:i: A', strtotime($hsn_date['date'])); ?>

                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="pl-3" aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>-->
                                                        
                                                        <div class="">
                                                       



<?php  foreach ($all_data as $key => $all) { ?>
    <div class="d-flex justify-content-between m-0">
                                                            <div class="">
                                                                    <div class="form-group box_increment d-flex align-items-center">
                                                                        <label class="w-100 text-center" for="">Box No.</label>
                                                                        <input value="<?= $all?>" type="number" class="form-control  box-number "  name="" >
                                                                        <input type="hidden" class="form-control"  name="booking_id_hsn" id="booking_id_hsn" value="">
                                                                        <input type="hidden" class="form-control"  name="unique_id" id="unique_id" value="<?php echo  !empty($_GET['id'])? $booking['booking_id']: $booking_id ?>">
                                                                          <?php 
                                                    if ($all && $all == 1) { ?>
                                                                                                <label class="w-100 text-center" for="">Currency.</label>

                                                    <?php 
                                                    if ($all) {
                                                        $hsnCurrency = $this->db->where(['box'=> $all,'unique_id'=> $_GET['id'] ])->get('company_hsn_code')->row_array();
                                                    }

                                                        ?>
                                                                        <select class="form-control  manifest_currency" name="box[1][manifest_currency][]">
                                                                            <option>Select</option>
                                                                            <?php foreach($manifest_currencies as $currency){ ?>
                                                                            <option value="<?php echo $currency['id']; ?>" <?php if((isset($hsnCurrency) && !empty($hsnCurrency)) && ($currency['id'] == $hsnCurrency['manifest_currency'])) { echo 'selected'; } ?>><?php echo $currency['currency']; ?></option>
                                                                            <?php }  ?>
                                                                        </select>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <div class="form-group text-right pr-3">
                                                                        <?php if($key == 0){ ?>
                                                                        <button type="button" class="btn btn-secondary add-row1" value> Add New Box</button>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
            <div class="added-row"  id="<?= $key?>" >
    

                        <div  class=" row-1 mb-3" id="row-1 " style="border-bottom: 1px solid #80808038;">

                        <?php 
                            if ($all) {
                                $box = $this->db->where(['box'=> $all,'unique_id'=> $_GET['id'] ])->get('company_hsn_code')->result_array();
                            foreach ($box as $key => $val) {
                                $total_amount += (int)$val['amount'] + (int)$val['amount_maually'];
                        ?>
                    
                        <input type="hidden" class="form-control empty_all_data " name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][box_no][]" value="<?= $all;?>">
                   
                       
                        <!-- <input type="hidden" class="form-control empty_all_data " name="box[<?= $val['id']?>][id][]" value="<?= $val['id'];?>">
                        <input type="hidden" class="form-control empty_all_data " name="unique_id" value="<?= $val['unique_id'];?>">
                        <input type="hidden" class="form-control empty_all_data " name="type" value="edit"> -->

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                <div class="form-group">
                                    <label for="">Category <span class="required" aria-required="true">*</span></label>
                                    <select class="form-control hsn-cat" id="hsn-cataa<?= $key?>" data-id="aa<?= $key?>" name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][hsncat][]">
                                        <option value="">Select</option>
                                        <?php foreach ($hsncats as $hsn) : ?>
                                            <option value="<?php echo $hsn['hsncode_id']; ?>" <?php echo ($val['hsncat'] == $hsn['hsncode_id']) ? 'selected' : ''; ?>>
                                                <?php echo $hsn['hsn_name']; ?>
                                            </option>
                                    <?php endforeach; ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4  <?php if($all != 1){ echo 'row-'.$all; }?>">
                                <div class="form-group">
                                    <label for=""> Sub Category <span class="required" aria-required="true">*</span></label>
                                    <select class="form-control empty_all_data hsn-details " data-id="aa<?= $key?>" id="hsn-detailsaa<?= $key?>" name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][sub_category][]">
                                        <option value="">Select</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                <div class="form-group">
                                    <label for="">HSN Code</label>
                                    <input type="text" readonly class="form-control empty_all_data hsn-code" id="hsn-codeaa<?= $key?>" name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][hsn_code][]" value="<?= $val['hsn_code']?>">
                                </div>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                    <div class="form-group">
                                    <label for="">Type</label>
                                    <select class="form-control validate[required] type_hsn" data-id="<?= $all?>" name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][type][]" id="type<?= $val['id']?>">
                                        <?php foreach ($types as $type) : ?>
                                            <option value="<?php echo $type['id']; ?>" <?php echo ($val['type'] == $type['id']) ? 'selected' : ''; ?>>
                                                <?php echo $type['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                    <div class="form-group">
                                        <label for="">Rate</label>
                                        <input type="text" class="form-control empty_all_data rate_hsn" data-id="aa<?= $key?>"  name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][rate][]"  id="rate_hsnaa<?= $key?>"  value="<?= $val['rate']?>">
                                    </div>
                                </div>
                            <div class="col-xl-1 col-lg-1 col-md-2 col-sm-1 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" class="form-control empty_all_data quantity_hsn" data-id="aa<?= $key?>"  name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][quantity][]"  id="quantity_hsnaa<?= $key?>"  value="<?= $val['quantity']?>">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                <div class="form-group">
                                    <label for="">Amount<span class="required" aria-required="true">*</span></label>
                                    <input type="text" readonly class="form-control empty_all_data amount_hsn" data-id="aa<?= $key?>"  id="amount_hsnaa<?= $key?>" name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][amount][]" value="<?= $val['amount']?>">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control cat_main" name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][hsncat_manually][]" placeholder ="add Category" id="hsn-cata<?= $all?>" data-id=" <?= $all?>" value="<?= $val['hsncat_maually']?>" >
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                        <div class="form-group">
                                            <input type="text" placeholder ="add SubCategory" class="form-control hsn_main" name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][sub_category_manually][]" id="amount_hsn<?= $all?>" data-id="<?= $all?>"  value="<?= $val['sub_category_maually']?>">
                                        </div>
                                    </div>
                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                        <div class="form-group">
                                        <input type="text" class="form-control empty_all_data hsn-code" id="hsn-codea<?= $all?>" name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][hsn_code_manually][]"  value="<?= $val['hsn_code_maually']?>">
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                    <div class="form-group">
                                    <input type="text" class="form-control empty_all_data hsn-code" id="type_manually<?= $all?> " name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][type_manually][]" value="<?= $val['type_maually']?>">
                                    </div>
                                </div>
                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control empty_all_data rate_hsn" data-id ="aa<?= $key. $all?>"  name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][rate_manually][]"  id="rate_hsnaa<?= $key . $all?>"  value="<?= $val['rate_maually']?>">
                                    </div>
                                </div>
                            <div class="col-xl-1 col-lg-1 col-md-2 col-sm-1 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                <div class="form-group">
                                    <input type="text" class="form-control empty_all_data quantity_hsn" data-id ="aa<?= $key . $all?>"  name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][quantity_manually][]"  id="quantity_hsnaa<?= $key. $all?>"   value="<?= $val['quantity_maually']?>">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 <?php if($all != 1){ echo 'row-'.$all; }?>">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control empty_all_data amount_hsn" data-id ="aa<?= $key. $all?>"  id="amount_hsnaa<?= $key. $all?>" name="box[<?php if($key == 0){echo $all; }else{echo '00'.($key+1);}?>][amount_manually][]"  value="<?= $val['amount_maually']?>">
                                </div>
                            </div>
                            
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 <?php if($all != 1){ echo 'row-'.$all; }?>">
                            <div class="form-group">
                            <?php if($key !== 0) { ?>
                                <button type="button" class="btn btn-danger" onclick="deleteRow(<?= $all?>)"   id ="row<?= $all?>" data-id="<?= $all?>" >Delete</button>
                                <?php } ?>
                            </div>
                        </div>
                            <?php }}?>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 p-0">
                                    <div class="form-group text-right">
                                    <button type="button" id="incrementBtn" class="btn btn-primary add-row" data-box="<?= $all?>">Add Row</button>
                                    <!-- <button type="button" class="btn btn-danger delete-row"   data-id="<?= $val['id']?>" >Delete All</button> -->
                                        <!-- <button type="button" class="btn btn-danger delete-row">-</button> -->
                                    </div>
                                </div>
                        </div>
                        </div>
                        <?php } ?>

                        <div id="dynamic-rows-container"></div>
                                                                        
                                                                        <h4 class="text-dark text-right pr-3">Total Amount - <span id="total_amount" ><?= $total_amount ?></span></h4>
                                                                        </div>
            
                                                                </div>
                                                            </div>
                                                        </div>
            
                                                    </div>
                                                </div>
                                            </div>
   
              </div> 
            </div>   
                        <?php } else { ?>
                            <div class="col-xl-12 col-lg-12 p-0">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Proforma Invoice ( Hsn code ) ( Box Wise )</h3>
                    </div>  
                    
                    <div class="box-body addBillEntry-box-1" id="box-body">
                                <div class="row" style="align-items: end;">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        
                                        <!-- <div class="form-group">
                                            <label for="">Purpose Mode<span class="required" aria-required="true">*</span></label>
                                            <input class="form-control empty_all_data" type="text" name="" id="">
                                                    </div>
                                                    </div> -->
                                            <!-- <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            ADD DATA
                                            </button> -->
                                            <!-- <button type="button" class="btn btn-primary mt-2" id="openModalBtn" data-target="#hsnCodeModal"  data-toggle="modal">ADD DATA</button> -->
                                            <div class="" id="hsnCodeModal" tabindex="-1" role="dialog" aria-labelledby="hsnCodeModalLabel" aria-hidden="true">
                                                <div class="" role="document">
                                                    <div class="">

                                                        <!-- <div class="modal-header d-flex justify-content-between">
                                                            <h5 class="modal-title" id="exampleModalLabel">Performa Invoice Entry</h5>
                                                            <div class="">
                                                            Date- <?php //echo date('d-m-Y h:i: A', strtotime($hsn_date['date'])); ?>

                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="pl-3" aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>-->
                                                        
                                                        <div class="">
                                                            <div class="d-flex justify-content-between m-0">
                                                            <div class="">
                                                                    <div class="form-group box_increment d-flex align-items-center">
                                                                        <label class="w-100 text-center" for="">Box No.</label>
                                                                        <input value="1" type="number" class="form-control  box-number "  name="box[1][box_no][]" >
                                                                        <input type="hidden" class="form-control"  name="booking_id_hsn" id="booking_id_hsn" value="">
                                                                        <input type="hidden" class="form-control"  name="unique_id" id="unique_id" value="<?php echo  !empty($_GET['id'])? $booking['booking_id']: $booking_id ?>">

                                                                                                                                                <label class="w-100 text-center" for="">Currency.</label>
                                                                        <select class="form-control  manifest_currency" name="box[1][manifest_currency][]">
                                                                            <option>Select</option>
                                                                            <?php foreach($manifest_currencies as $currency){ ?>
                                                                            <option value="<?php echo $currency['id']; ?>"><?php echo $currency['currency']; ?></option>
                                                                            <?php }  ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group box_increment d-flex align-items-center">

                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <div class="form-group text-right pr-3">
                                                                        <button type="button" class="btn btn-secondary add-row1" value> Add New Box</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div  class="row-1 mb-3" id="row-1 " style="border-bottom: 1px solid #80808038;">
                                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                                                    <div class="form-group">
                                                                        <label for="">Category <span class="required" aria-required="true">*</span></label>
                                                                        <select class="form-control hsn-cat" id="hsn-cat0" data-id="0" name="box[1][hsncat][]">
                                                                            <option value="">Select</option>
                                                                            <?= $hsncatss;?>    
                                                                            </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                                                    <div class="form-group">
                                                                        <label for=""> Sub Category <span class="required" aria-required="true">*</span></label>
                                                                        <select class="form-control empty_all_data hsn-details " data-id="0" id="hsn-details0" name="box[1][sub_category][]">
                                                                            <option value="">Select</option>
                                                                            </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                                                                    <div class="form-group">
                                                                        <label for="">HSN Code</label>
                                                                        <input type="text" readonly class="form-control empty_all_data hsn-code" id="hsn-code0" name="box[1][hsn_code][]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                                                                        <div class="form-group">
                                                                        <label for="">Type</label>
                                                                        <select class="form-control validate[required] type_hsn" data-id ="0" name="box[1][type][]" id="type0">
                                                                                <?= $type_hsn?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                                                                        <div class="form-group">
                                                                            <label for="">Rate</label>
                                                                            <input type="text" class="form-control empty_all_data rate_hsn" data-id ="0"  name="box[1][rate][]" value="0" id="rate_hsn0">
                                                                        </div>
                                                                    </div>
                                                                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-1">
                                                                    <div class="form-group">
                                                                        <label for="">Quantity</label>
                                                                        <input type="text" class="form-control empty_all_data quantity_hsn" data-id ="0"  name="box[1][quantity][]" value="0" id="quantity_hsn0">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                                                    <div class="form-group">
                                                                        <label for="">Amount<span class="required " aria-required="true">*</span></label>
                                                                        <input type="text" readonly class="form-control empty_all_data amount_hsn" data-id ="0"  id="amount_hsn0" name="box[1][amount][]" value="0">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control cat_main" name="box[1][hsncat_manually][]" placeholder ="add Category" value="" id="amount_hsn0" data-id=" 0" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                                                            <div class="form-group">
                                                                                <input type="text" placeholder ="add SubCategory" class="form-control hsn_main" name="box[1][sub_category_manually][]" value="" id="amount_hsn0" data-id="0" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                                                                            <div class="form-group">
                                                                            <input type="text" class="form-control empty_all_data hsn-code" id="hsn-codea0" name="box[1][hsn_code_manually][]">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                                                                        <div class="form-group">
                                                                        <input type="text" class="form-control empty_all_data hsn-code" id="type_manually0 " name="box[1][type_manually][]">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control empty_all_data rate_hsn" data-id ="a0"  name="box[1][rate_manually][]" value="0" id="rate_hsna0">
                                                                        </div>
                                                                    </div>
                                                                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-1">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control empty_all_data quantity_hsn" data-id ="a0"  name="box[1][quantity_manually][]" value="0" id="quantity_hsna0">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                                                    <div class="form-group">
                                                                        <input type="text" readonly class="form-control empty_all_data amount_hsn" data-id ="a0"  id="amount_hsna0" name="box[1][amount_manually][]" value="0">
                                                                    </div>
                                                                </div>
                                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 p-0">
                                                                        <div class="form-group text-right">
                                                                        <button type="button" id="incrementBtn" class="btn btn-primary add-row" data-box="1">Add Row</button>
                                                                            <!-- <button type="button" class="btn btn-danger delete-row">-</button> -->
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                           
                                                                                
                                                            <div id="dynamic-rows-container"></div>
                                                                        
                                                            <h4 class="text-dark text-right pr-3">Total Amount - <span id="total_amount" >0</span></h4>
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

<!-- Modal -->
<!-- <div class="modal fade bd-example-modal-lg" id="openModalBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> -->
   



                                <!-- Button trigger modal -->


<!-- Modal -->
<!-- <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
                                            <div class="row-1" style="align-items: end;">
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-group  ">
                                                    <label for="">Box No.</label>
                                                    <input type="number" class="form-control empty_all_data box-number" name="box_no[]" value="1">
                                                </div>
                                                
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                                <div class="form-group">
                                                    <label for="">Sub Category <span class="required" aria-required="true">*</span></label>
                                                    <select class="form-control empty_all_data" id="shipment_type" name="sub_category[]">
                                                        <option value="">Select</option>
                                                       Your options here -->
                                                    <!-- </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="form-group">
                                                    <label for="">HSN Code</label>
                                                    <select class="form-control empty_all_data hsn-code" name="hsn_code[]">
                                                        <option value="">Select Product</option>
                                                           </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="form-group">
                                                    <label for="">Quantity</label>
                                                    <input type="text" class="form-control empty_all_data quantity" name="quantity[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="form-group">
                                                    <label for="">Amount<span class="required " aria-required="true">*</span></label>
                                                    <input type="text" class="form-control empty_all_data amount" name="amount[]" value="">
                                                </div>
                                            </div>


                                              <div id="dynamic-rows-container" class="row-1" style="align-items: end;"></div>

                                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12"></div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mb-1 "></div>
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1 mb-1 ">
                                                <div class="form-group">
                                                    <label class="mb-3">Total<span class="required" aria-required="true">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5 mb-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control empty_all_data total" name="total[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mb-3">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-secondary add-row">+</button>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                      

                                          
                    </div>
                </div>
            </div>



         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div> -->
  </div> 
</div>  

<?php } ?>




<div class="col-xl-12 col-lg-12 p-0">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Performa Invoice Aditional Details</h3>
                    </div>  
                    
                    <div class="box-body addBillEntry-box-1" id="box-body">
                                <div class="row" style="align-items: end;">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        
                                        <!-- <div class="form-group">
                                            <label for="">Purpose Mode<span class="required" aria-required="true">*</span></label>
                                            <input class="form-control empty_all_data" type="text" name="" id="">
                                                    </div>
                                                    </div> -->
                                            <!-- <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            ADD DATA
                                            </button> -->
                                            <!-- <button type="button" class="btn btn-primary mt-2" id="openModalBtn" data-target="#hsnCodeModal"  data-toggle="modal">ADD DATA</button> -->
                                            <div class="" id="hsnCodeModal" tabindex="-1" role="dialog" aria-labelledby="hsnCodeModalLabel" aria-hidden="true">
                                                <div class="" role="document">
                                                    <div class="">

                                                        <!-- <div class="modal-header d-flex justify-content-between">
                                                            <h5 class="modal-title" id="exampleModalLabel">Performa Invoice Entry</h5>
                                                            <div class="">
                                                            Date- <?php //echo date('d-m-Y h:i: A', strtotime($hsn_date['date'])); ?>

                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="pl-3" aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        </div>-->
                                                        
                                                        <div class="">
                                                            <div class="d-flex justify-content-between m-0">
                                                          
                                                               
                                                            </div> 
                                                            <div  class="row-1 mb-3" id="row-1 " style="border-bottom: 1px solid #80808038;">
                                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                                                    <div class="form-group">
                                                                        <label for="">Invoice No <span class="required" aria-required="true">*</span></label>
                                                                        <input type="text" placeholder="Invoice No"  class="form-control empty_all_data hsn-code"  name="invoice_no" value="<?php if(isset($_GET['id']) && isset($invoice_entry['invoice_no'])){ echo $invoice_entry['invoice_no'];} ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-lg-424 col-md-2 col-sm-2 col-2">
                                                                    <div class="form-group">
                                                                        <label for=""> Date <span class="required" aria-required="true">*</span></label>
                                                                      
                                                                            
                                                                        <input 
                                                                            type="date" 
                                                                            placeholder="Date" 
                                                                            class="form-control pull-right validate[required]" 
                                                                            name="date" 
                                                                            value="<?php 
                                                                                if (isset($_GET['id']) && isset($invoice_entry['date'])) { 
                                                                                    echo date('Y-m-d', strtotime($invoice_entry['date'])); 
                                                                                } else { 
                                                                                    echo date('Y-m-d'); 
                                                                                } 
                                                                            ?>">


                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                                                    <div class="form-group">
                                                                        <label for="">Exporter Ref.</label>
                                                                        <input type="text" placeholder="Exporter Ref"  class="form-control empty_all_data hsn-code" id="hsn-code0" name="exporter_ref" value="<?php if(isset($_GET['id']) && isset($invoice_entry['exporter_ref'])){ echo $invoice_entry['exporter_ref'];} ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                                                        <div class="form-group">
                                                                        <label for="sampling_purprose">For Sampling Purprose Only</label>
                                                                        <input type="text" placeholder="For Sampling Purprose Only"  class="form-control empty_all_data hsn-code sampling_purprose" id="hsn-code0" name="sampling_purprose" value="<?php if(isset($_GET['id']) && isset($invoice_entry['sampling_purprose'])){ echo $invoice_entry['sampling_purprose'];} ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                                                        <div class="form-group">
                                                                            <label for="">Port Of Loading</label>
                                                                            <input type="text" placeholder="Port Of Loading" class="form-control empty_all_data rate_hsn" data-id ="0"  name="port_of_loading" value="<?php if(isset($_GET['id']) && isset($invoice_entry['port_of_loading'])){ echo $invoice_entry['port_of_loading'];} ?>" id="rate_hsn0">
                                                                        </div>
                                                                    </div>
                                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                                                    <div class="form-group">
                                                                        <label for="">Final Destination</label>
                                                                        <input type="text" placeholder="Final Destination" class="form-control empty_all_data quantity_hsn" data-id ="0"  name="final_destination" value="<?php if(isset($_GET['id']) && isset($invoice_entry['final_destination'])){ echo $invoice_entry['final_destination'];} ?>" >
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                                                
                                                           
                                                                        
                                                           
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


  </div> 
</div>


                       

                        <div class="col-xl-12 col-lg-12 p-0">
                        <div class="box box-primary">
                            <div class="box-body addBillEntry-box-1" id="box-body">
                                <div class="row" style="align-items: center;">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary  valid w-100 mb-1" value="Calculate Rate  " aria-invalid="false">
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary  valid w-100 mb-1" value="Manual Calculate   " aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary  valid w-100 mb-1" value="Submit" aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>

                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-success  valid w-100 mb-1" value="Edit" aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-success  valid w-100 mb-1" value="ADD AWB KYC " aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary  valid w-100 mb-1" value="Colone Order(Duplicate Create)" aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3 ">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-success  valid w-100 mb-1" value="Print AWB Copy(Full)" aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3 MT-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-success  valid w-100 mb-1" value="Print KYC" aria-invalid="false">
                                            <select class="form-control empty_all_data" name="" id="" aria-required="true">
                                                    <option value="">Select </option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary  valid w-100 mb-1" value="PRINT PROFORMA INVOCE " aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>


                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-3 ">
                                        <div class="form-group">
                                        <label for="">Print AWB Copy(Not Required Selection) <span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3 MT-3">
                                        
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        <div class="form-group">
                                            <input type="button" class="btn btn-primary  valid w-100 mb-1" value="Clear All" aria-invalid="false">
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>


                                    
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-3 ">
                                        <div class="form-group">
                                        <label for="">No Amount( Total Or Any ) <span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3 MT-3">
                                        
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>


                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-3 ">
                                        <div class="form-group">
                                        <label for="">Vendor Name<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3 MT-3">
                                    <div class="form-group">
                                        <label for="">Vendor AWB No.<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>

                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-3 ">
                                        <div class="form-group">
                                        <label for="">Web Agent Name<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3 MT-3">
                                    <div class="form-group">
                                        <label for="">Web Agent AWB No.<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>


                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-3 ">
                                        <div class="form-group">
                                        <label for="">Additional Agent Name<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3 MT-3">
                                    <div class="form-group">
                                        <label for="">Additional Agent AWB No<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3">
                                        
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>


                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-3 ">
                                        <div class="form-group">
                                        <label for="">eComm Agent<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3 MT-3">
                                    <div class="form-group">
                                        <label for="">Tracking #<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>


                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-3 ">
                                        <div class="form-group">
                                        <label for="">Customer (Account Holder)/ Shipper Details<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3 MT-3">
                                   
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>


                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ml-3 ">
                                        <div class="form-group">
                                        <label for="">Show Only Total :  Billing Weight (Manifest)<span class="required" aria-required="true">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3 MT-3">
                                   
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ml-3">
                                        
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 ml-3"></div>
                                    

                                    
                                </div>
                            </div>
                        </div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 p-0">
                            <div class="box box-primary">
                                <div class="box-header ">
                                     <h3 class="box-title">Manifest  ( Airport ) ( Out scan ) </h3>
                                    <!-- <input type="button" class="btn btn-primary  valid w-100 mb-1" value="Clear All"  -->
                                </div>  
                        <div class="row" style="align-items: center;">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group ml-2">
                                        <label for="">Currency <span class="required" aria-required="true">*</span></label>
                                        <select class="form-control" name="" id="" aria-required="true">
                                            <option value="">Select </option>
                                        </select>
                                    </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-2">
                                    <div class="form-group ">
                                        <label for="">invoce value<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control pull-right validate[required]" id="datepicker" value="" name="invoice_value">
                                    </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-10 col-sm-8">
                                <div class="form-group ml-2">
                                    <label for="">Manifest Weight (Kg) (Agent/Set Weight)<span class="required" aria-required="true">*</span>
                                         <input type="button" class="btn btn-success  valid" style="border-radius: 50%;" value="+" aria-invalid="false">
                                        <!-- <button type="button" class="btn btn-danger btn-hide-manifest_weight" id="2" style="display:none;">Hide</button> -->
                                    </label>
                                    <input class="form-control" type="text" placeholder="0" name="manifest_weight" id="manifest_weight" style="display:none;" value="0">
                                </div>
                             </div>
                             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12"></div>
                               
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <div class="form-group ml-2">
                                                <label>Total : Vol.Weight Kg.</label>
                                                <div class="input-group date">
                                                    <div class=""></div>
                                                    <input type="text" class="form-control pull-right validate[required]" id="datepicker" value="" name="total_weight_vol">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12" style="">
                                            <div class="form-group">
                                                <label>Total : Acutal wt.</label>
                                                <div class="input-group date">
                                                    <input class="form-control" type="text" name="" id="booking_id"  value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <div class="form-group">
                                                <label for="">Total:Billing Weight(Manifest)</label>
                                                <div class="input-group">
                                                    <input type="text" name="total_billing_weight"  class="form-control datepicker" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-12 ">
                                            <div class="form-group">
                                                <label for="">Total : Vol.Weight Kg.</label>
                                                <div class="input-group">
                                                <input type="text" name="total_vol_weight_kg" class="form-control " value="">
                                            </div>
                                        </div>
                            </div>
                    </div>
                    </div>
                </div>


                <?php if(isset($_GET['id'])){ ?>
                                <div class="col-xl-12 col-lg-12 p-0">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                        <button type="submit" class="btn btn-primary">Submit And update</button>
                                        </div>  
                                    </div>
                                </div>
                                <?php }else{ ?> 

                                    <div class="col-xl-12 col-lg-12 p-0">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>  
                                    </div>
                                </div>
                                    <?php } ?> 
              


</div>

</section>
</form>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title text-center"> <button type="button" class="float-left able_all btn btn-primary" id="able_all">Active</button> Boxs Details</h4>

         <table class="text-center">
            <thead>
                <!-- <tr>
                    <th colspan="6" class="text-right">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="packageDeleteClear()">Clear</a> 
                    </th>
                </tr> -->
                <tr>
                  
                    <th style="">Claue <span class="claue_number"></span> (Result1)</td>
                    <th style="">Claue <span class="claue_number"></span> (Result2)</td>
                    <th style="">Claue <span class="claue_number"></span> (Result3)</td>
                    <th style="">Claue <span class="claue_number"></span> (Result4)</td>
                    <th style="">Claue <span class="claue_number"></span> (Result5)</td>
                    
                   
                    
                </tr>
                                <tr>
                
                     <td><input type="text" class="form-control box-c text-success final_result1" id="final_result1" name="final_result" placeholder="Result" value="0" ></td>
                     <td><input type="text" class="form-control box-c text-success final_result2" id="final_result2" name="final_result" placeholder="Result" value="0" ></td>
                      <td><input type="text" class="form-control box-c text-success final_result3" id="final_result3" name="final_result" placeholder="Result" value="0" ></td>
                   <td><input type="text" class="form-control box-c text-success final_result4" id="final_result4" name="final_result" placeholder="Result" value="0" ></td>
                   <td><input type="text" class="form-control box-c text-success final_result5" id="final_result5" name="final_result" placeholder="Result" value="0" ></td>
               
                </tr>
            </thead> 
            <tbody id = "">
                                </tbody>  
                                </table> 


      </div>
      <div class="modal-body">
        <form action="" id="package_form" method="post">
         <table class="text-center">
            <thead>
                <!-- <tr>
                    <th colspan="6" class="text-right">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="packageDeleteClear()">Clear</a> 
                    </th>
                </tr> -->
                <tr>
                    <th style="width: 80px;">Box</th>
                    <th style="width: 100px;">Weight Kg </th>
                    <th style="width: 100px;">Weight Kg (Round Off) </th>
                    <th colspan="5" style="padding-right: 78px;">Dimension <span class="w_dimension">CM</span></th>
                    <th style="width: 134px;">Vol. Weight kg</th>
                    <th style="width: 134px;">Vol. Weight kg (Round Off)</th>
                    <th style="">Higer Weight(Actual or Volume)</td>
                    <!-- <th style="">Claue <span class="claue_number"></span> (Result)</td> -->
                    <th style="">Final <span class="claue_number"></span> (Result)</td>
                    <th style=" line-height: 14px; ">Sum In CMS<br> <span style="font-size:12px;">(L + 2girth + 2 wirth=sum cms)</span><span class="claue_number"></span></td>
                   
                    
                    <th>Action</th>
                </tr>
                <tr>
                    <td>Add</td>
                    <td ><input type="text" class="form-control box-c" id="weightkg_d" name="weightkg" placeholder="weight kg" style="width: 105px;" value="0" required=""></td>
                    <td ><input type="text" readonly class="form-control box-c" id="weightkg_d_round" name="weightkg_d_round" placeholder="weight kg round" style="width: 105px;" value="0"></td>
                    <td>L<input type="text"  class="form-control box-c" id="length_d" name="length" placeholder="Length"  required style="width: 105px;" value="0"></td>
                    <td>X</td>
                    <td>W<input type="text" class="form-control box-c" id="width_d" name="width" placeholder="Width"  required style="width: 120px;" value="0"></td>
                    <td>X</td>
                    <td>H<input type="text" class="form-control box-c" id="height_d" name="height" placeholder="height"  required style="width: 120px;" value="0"> </td>
                   
                    <td><input type="text" class="form-control box-c" id="volumetric_w_d" name="volumetric_w" placeholder="Vol.Weight Kg" value="0"></td>

                    <td ><input type="text" class="form-control box-c" readonly id="volumetric_w_round" name="volumetric_w_round" placeholder="Vol.Weight Kg round" style="width: 105px;" value="0"></td>

                    <td><input type="text" class="form-control box-c text-success" id="heigher_weight_actual_volume_d" name="heigher_weight_actual_volume" placeholder="higer Weight" value="0" ></td>
                    <!-- <td><input type="text" class="form-control box-c text-success final_result" id="final_result" name="final_result" placeholder="Result" value="0" ></td> -->
                     <td><input type="text" class="form-control text-success final_result6" id="final_result6" name="final_result" placeholder="Result" value="0" ></td>
                     <td><input type="text" class="form-control text-success final_result7" id="final_result7" name="sum_in_cms" placeholder="Result" value="0" ></td>

                    <td> 
                        <input type="hidden" name="modaltype" id="modaltype">
                        <!-- <input type="hidden" name="booking_id" id="p_booking_id"> -->
                        <input type="hidden" name="p_booking_id" id="p_booking_id">
                        <input type="hidden" name="unit" id="p_unit">
                        <input type="hidden" name="divisor" id="p_divisor">
                        <input type="hidden" name="pro_divisor" id="pro_divisor">
                        <button class="btn btn-success disable_all" style="width: 183px;" type="submit"  ><i class="fa fa-plus" aria-hidden="true"></i> Save</button> 
                    </td>
                </tr>
            </thead>
            <tbody id = "show_package">

            <?php
            $i = 1;
            $t_a_weight = 0;
            $t_a_weightkg_round = 0;
            $t_package_length = 0;
            $t_package_width = 0;
            $t_package_height = 0;
            $t_volumetric_w = 0;
            $t_volumetric_w_round = 0;
            $t_higher = 0;
            $result = 0;

            if (!empty($weight_calculate)) {
                foreach ($weight_calculate as $value) {  
                    $higher = max($value['weightkg_d_round'], $value['volumetric_w_round']);

                    $t_a_weight += $value['weightkg'];
                    $t_a_weightkg_round += $value['weightkg_d_round'];
                    $t_package_length += $value['length'];
                    $t_package_width += $value['width'];
                    $t_package_height += $value['height'];
                    $t_volumetric_w += $value['volumetric_w'];
                    $t_volumetric_w_round += $value['volumetric_w_round'];
                    $t_higher += $higher;
                    $result += $value['final_result'];
                    ?>
                    <tr>
                        <td>Box <?= $i ?></td>
                        <td><?= $value['weightkg'] ?></td>
                        <td><?= $value['weightkg_d_round'] ?></td>
                        <td><?= $value['length'] ?></td>
                        <td>X</td>
                        <td><?= $value['width'] ?></td>
                        <td>X</td>
                        <td><?= $value['height'] ?></td>
                        <td><?= $value['volumetric_w'] ?></td>
                        <td><?= $value['volumetric_w_round'] ?></td>
                        <td class="text-success"><?= $higher ?></td>
                        <td><?= $value['final_result'] ?></td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-success" onclick="packageCopy(<?= $value['id'] ?>, 'wc')">Copy</a>
                            <a href="javascript:void(0);" id="<?= $value['id'] ?>" class="btn btn-success update-package">Edit</a>
                            <a href="javascript:void(0);" class="btn btn-danger" onclick="packageDelete(<?= $value['id'] ?>, <?= $value['booking_id'] ?>, 'wc' )">Delete</a>
                        </td>
                    </tr>
                    <tr style="display:none" id="showpack<?= $value['id'] ?>">
                        <td></td>
                        <td><input type="text" class="form-control update-cal" box-id="<?= $value['id'] ?>" id="weightkg_d-<?= $value['id'] ?>" value="<?= $value['weightkg'] ?>"></td>
                        <td><input type="text" readonly class="form-control update-cal" box-id="<?= $value['id'] ?>" id="weightkg_round-<?= $value['id'] ?>" value="<?= $value['weightkg_d_round'] ?>"></td>
                        <td><input type="text" class="form-control update-cal" box-id="<?= $value['id'] ?>" id="length-<?= $value['id'] ?>" value="<?= $value['length'] ?>"></td>
                        <td>X</td>
                        <td><input type="text" class="form-control update-cal" box-id="<?= $value['id'] ?>" id="width-<?= $value['id'] ?>" value="<?= $value['width'] ?>"></td>
                        <td>X</td>
                        <td><input type="text" class="form-control update-cal" box-id="<?= $value['id'] ?>" id="hength-<?= $value['id'] ?>" value="<?= $value['height'] ?>"></td>
                        <td><input type="text" class="form-control update-cal" box-id="<?= $value['id'] ?>" id="volumetric_w-<?= $value['id'] ?>" value="<?= $value['volumetric_w'] ?>">
                            <input type="hidden" class="form-control update-cal" box-id="<?= $value['id'] ?>" id="volumetric_type-<?= $value['id'] ?>" value="<?= $value['type'] ?>">
                        </td>
                        <td><input type="text" class="form-control update-cal" box-id="<?= $value['id'] ?>" readonly id="volumetric_round-<?= $value['id'] ?>" value="<?= $value['volumetric_w_round'] ?>"></td>
                        <td><input type="text" class="form-control readonly update-cal" box-id="<?= $value['id'] ?>" id="heigher_weight_actual_volume_d-<?= $value['id'] ?>" value="<?= $higher ?>"></td>
                        <td><input type="text" class="form-control readonly update-cal" box-id="<?= $value['id'] ?>" id="volumetric_result-<?= $value['id'] ?>" value="<?= $value['final_result'] ?>"></td>
                        <td>
                            <button type="button" onclick="packageUpdate(<?= $value['id'] ?> ,'wc')" class="btn btn-success">Update</button>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                <tr style="border-top: solid 1px;">
                    <td>Total</td>
                    <td><?= $t_a_weight ?></td>
                    <td><?= $t_a_weightkg_round ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?= $t_volumetric_w ?></td>
                    <td><?= $t_volumetric_w_round ?></td>
                    <td class="text-success"><?= $t_higher ?></td>
                    <td><?= $result ?></td>
                </tr>
            <?php }  ?>
                
            </tbody>
         </table>
         </form>  
      </div>
      <div class="modal-footer" style="justify-content: center!important;">
        <button type="button" id="box_data_submit" class="btn btn-success" <?php if(!isset($_GET['id'])){ ?> style="display: none;" <?php } ?> >Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div class="modal fade" id="girthModal" role="dialog">
  <div class="modal-dialog modal-xl">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">
          Girth Details
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form id="girth_form">
          <table class="table table-bordered text-center align-middle">

            <thead>
              <tr>
                <th style="width:80px;">#</th>
                <th style="width:120px;">Length</th>
                <th style="width:120px;">Width</th>
                <th style="width:40px;"></th>
                <th style="width:120px;">Height</th>
                <th style="width:120px;">Total</th>
                <th style="width:150px;">Girth Result</th>
                <th style="width:150px;">Action</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>1</td>
                               <td>
   <div class="input-group">
   
    <input type="number"  class="form-control box-c" name="g_length" id="g_length" placeholder="Length">
  </div>
</td>


                <!-- Width -->
               <td>
   <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">2 ×</span>
    </div>
    <input type="number"  class="form-control box-c" name="g_width" id="g_width" placeholder="Width">
  </div>
</td>

<td class="fw-bold">+</td>

<!-- Height -->
<td>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">2 ×</span>
    </div>
    <input type="number" class="form-control box-c" name="g_height" id="g_height" placeholder="Height">
  </div>
</td>
                <!-- Result -->
                <td>
                  <input type="text"class="form-control box-c text-success" id="girth_total"
                 readonly  placeholder="Total">
                </td>

                <!-- Result -->
                <td>
                  <input type="text"class="form-control box-c text-success" id="girth_result"
                 readonly>
                </td>

                <!-- Action -->
                <td>
                <button class="btn btn-success disable_all" style="width: 183px;" type="submit"  ><i class="fa fa-plus" aria-hidden="true"></i> Save</button> 
                </td>
              </tr>
            </tbody>

          </table>
         
        </form>
             <div class="text-center mt-3">
           <button type="button" class="btn btn-danger" data-dismiss="modal">
          Close
       </button>
     </div> 
      </div>

    </div>
  </div>
</div>



<div class="modal fade" id="weight_calculator2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Example Weight Calculator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="vw_box1 vw_box border border-warning" id="1" style="padding: 5px;">
            <h6> Calculate volumetric weight for Box </h6>
            <div class="row">
                <div class="col-xl-3 form-group">
                <select id="unit_wid" name="c_unit[]" class="form-control  conv ">
                    <option value="cm" selected="selected"> CM </option>
                    <option value="mm"> MM </option>
                    <option value="cft"> CFT </option>
                    <option value="in"> IN </option>
                    <option value="ft"> FT </option>
                </select>
                </div>
                <div class="col-xl-4 form-group">
                <select class="form-control from_con divisor" id="divisor" name="divisor[]">
                    <option value=""> Select Divisor </option>
                    <option value="6">4000</option>
                    <option value="7">5000</option>
                    <option value="9">6000</option>
                    <option value="11">27000</option>
                </select>
                </div>
                <div class="col-xl-3 form-group cftC" style="display:none;">
                <select class="form-control cftV" name="cft">
                    <option value=""> Select cft </option>
                    <option value="1">7</option>
                    <option value="2">8</option>
                    <option value="3">9</option>
                    <option value="4">10</option>
                </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 form-group">
                <input type="text" class="form-control from_con flen" name="package_length[]" placeholder="Package Length" value="10.00">
                </div>
                <div class="col-xl-4 form-group">
                <input type="text" class="form-control from_con fwid" name="package_width[]" placeholder="Package Width" value="10.00">
                </div>
                <div class="col-xl-4 form-group">
                <input type="text" class="form-control from_con fhei" name="package_height[]" placeholder="Package Height" value="10.00">
                </div>
            </div>
            <h6> Dimensions in Centimeter </h6>
            <div class="row">
                <div class="col-xl-4 form-group">
                <input type="text" class="form-control to_con tlen" name="length_cm[]" placeholder="Length in cm" value="0">
                </div>
                <div class="col-xl-4 form-group">
                <input type="text" class="form-control to_con twid" name="width_cm[]" placeholder="Width in cm" value="0">
                </div>
                <div class="col-xl-4 form-group">
                <input type="text" class="form-control to_con thei" non_stackable_charge="" name="height_cm[]" placeholder="Height in cm" value="0">
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 form-group">
                <h6> Volumetric Weight of Box </h6>
                <input type="text" class="form-control vm_weight vm1" readonly="" id="1" name="volumetric_w[]" placeholder="volumetric weight" value="0.25">
                </div>
                <!-- <div class="col-xl-6 form-group">
                <h6>Actual Weight (Kg) of Box 1 </h6>
                <input type="text" class="form-control from_con  ac_weight ac1" id="1" value="9.00" name="a_weight[]" placeholder="Actual Weigh">
                </div>
                <p style="margin: 20px;">Total final weight of Box 1 = <span class="total_t_vw1">NaN Kg</span>
                <input type="hidden" value="NaN" class="total_t_vwtt total_t_vwt1">
                </p> -->
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    
    $(document).ready(function() {
        // Initialize datepicker
        $('#datepicker').datepicker();

        // Attach event listener to show current date on input click
        $('#datepicker').on('click', function() {
            $('#datepicker').datepicker('setDate', new Date());
        });
    });
  

  $(document).ready(function() {
        $('#valid').datepicker();
        $('#valid').datepicker('setDate', new Date()); // Set default date to today
    });

    $(document).ready(function() {
        // Get current time
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();

        // Format the time
        var formattedTime = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes;

        // Set the value of the input field
        $('#end_date').val(formattedTime);

        // Change the value when the time changes
        $('#end_date').on('input', function() {
            var selectedTime = $(this).val();
            // Do something with the selected time if needed
        });
    });

    $(document).ready(function() {
        $('#booking_type').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue === 'Offline') {
                $('.showawsst').css('display', 'none'); // Hide elements with class 'showawsst'
            } else {
                $('.showawsst').css('display', 'block'); // Show elements with class 'showawsst'
            }
        });
        if ($('#booking_type').val() === 'Offline') {
            $('.showawsst').css('display', 'none');
        }
    });
    $(document).ready(function() {
  var maxAgents = 3;
  var agentCount = 0;

  $('.btn.').click(function() {
    if (agentCount < maxAgents) {
      var $hiddenElement = $('.col-xl-3:hidden:first').clone();
      $hiddenElement.appendTo('.col-xl-9').slideDown();
      agentCount++;
    }
  });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.customer_name').select2();
    $('#consignee_receiver').select2();
    $('#product_list').select2();
    $('.select_hsn').select2();
    $('.hsn_codemj').select2();
    $('.manifest_currency').select2();
});
</script>

<script type="text/javascript">


    $('#add_more_kyc').click(function() {
        var html = '<div class="row customer_records"> <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12"> <div class="form-group"> <label for="">Select Doucment Type</label> <select name="kyc_files_type[]" class="form-control"> <option value=""> Select Document Type</option> <option value="Account form"> Account form </option> <option value="Authorization"> Authorization</option> <option value="Pan card"> Pan card</option> <option value="Aadhar Card"> Aadhar Card</option> <option value="Cancle cheque"> Photo Parsal</option> <option value="GST Copy"> GST Copy</option> <option value="IEC Code"> IEC Code</option> <option value="Cancle cheque"> Cancle cheque</option> </select> </div> </div> <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 pl-0 col-12"> <div class="form-group"> <label for="">Document No</label> <input type="text" name="kyc_doc_no[]" class="form-control" placeholder="Document Number" /> </div> </div> <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12"> <div class="form-group"> <input type="file" name="kyc_files[]" class="form-control" /> </div> </div> </div>';
        $('.kyc_types').append(html);
        $('.kyc_types .customer_records').addClass('single remove');
        $('.single #add_more_kyc').remove();
        $('.single').append('<div class="remove-field col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12"><a href="javascript:void(0);" class="btn btn-danger row align-items-center" title="Active/Inactive" style="font-size: 14px">Delete</a></div>');
        $('.kyc_types > .single').attr("class", "remove row");


        });

        $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.remove').remove();
        e.preventDefault();
        });



$(document).ready(function() {
 $('#customer_name').change(function() {
    $('#weight_required').val('0');
        var name = $(this).find(':selected').data('com_name');
        var gstno = $(this).find(':selected').data('gstno');
        var datatype = $(this).find(':selected').data('type_name');
        var account_no = $(this).find(':selected').data('account_no');
        var customer_address = $(this).find(':selected').data('account_no');
        var state = $(this).find(':selected').data('state');
        var product_id = $(this).find(':selected').data('product_id');
        // alert(customer_address);

        $('#customer_account_name').val(name);
        $('#customer_account_code').val(account_no);
        $('#customer_address').val(customer_address);
        $('#customer_type').val(datatype);
        $('#customer_state').val(state);
        $('#product_id').val(product_id);
        if (gstno != '') {
            $('#gst_no').val(gstno);
        } else {
            $('#gst_no').val('unregistered');
        }

         $(".dimScreen").fadeIn();
        var customer_id = $(this).val();
        var booking_type = $('#booking_type').val();
        if (booking_type == 'predefined') {
            $.ajax({
                type: 'POST',
                data: {
                    'category': '<?= $_GET['location']; ?>'
                },
                url: '<?php echo site_url('company/getAWBNo'); ?>',
                success: function(res) {
                    if (res == 'expired') {
                        alert('Predefine AWS Numbers is Expired. Please Renew Predefine AWB No..');
                    }else{
                        var obj = JSON.parse(res);
                        $('#awb_no').val(obj['awb_no']);
                        $('#st_awb_no').val(obj['start_date']);
                        $('#end_awb_no').val(obj['end_date']);
                        $('#').val(obj['id']);                       
                    }
                }
            });
        }
        //                    var price_per_kg = $(this).attr('price_per_kg');
        var price_per_kg = $('option:selected', this).attr('price_per_kg');
        console.log(customer_id);
        console.log('123');
        if (customer_id != '') {
            $('#product_name').val(price_per_kg);
            $.ajax({
                type: 'POST',
                data: {
                    'customer_id': customer_id
                },
                 url: '<?php echo site_url('company/getConsignee?type=')?><?= $_GET['location']; ?>',
                success: function(res) {
                    $(".dimScreen").fadeOut();
                    if (res != '[]') {
                        var resp = JSON.parse(res);
                        var html = '<option value="">Select consignee</option>';
                        Object.keys(resp).forEach(function(key) {
                            var o_coustomer =
                               '<?php echo (!empty($_GET['id']) && isset($booking_c['customer_name'])) ? $booking_c['customer_name'] : ""; ?>';

                            if (o_coustomer == resp[key].customer_name) {
                                html += '<option  selected value="' + resp[key].id + '">' +
                                    resp[key].name + '</option>';

                            } else {
                                html += '<option  value="' + resp[key].id + '">' + resp[key]
                                    .name + '</option>';

                            }
                        });
                        $("#consignee_receiver").html(html);
                    } else {
                        $("#consignee_receiver").html('<option value="">Select consignee</option>');
                    }
                }
            });
            $.ajax({
                type: 'POST',
                data: {
                    'customer_id': customer_id
                },
                url: '<?php echo site_url('company/getShipperDetails'); ?>',
                success: function(res) {
                    $(".dimScreen").fadeOut();
                    if (res != '[]' && res != 'null') {
                        var resp = JSON.parse(res);
                        // $('#customer_account_code').val(resp.account_no);
                        // $('#customer_address').val(resp.address);
                        $('#customer_send_reference').val(resp.send_reference);
                        $('#customer_other_detail').val(resp.other_detail);
                    } else {
                        // $('#customer_account_code').val('');
                        // $('#customer_address').val('');
                        $('#customer_send_reference').val('');
                        $('#customer_other_detail').val('');
                    }
                }
            });

            $.ajax({
                type: 'POST',
                data: {
                    'customer_id': customer_id
                },
                url: '<?php echo site_url('company/getSalesgroup'); ?>',
                success: function(res) {
                    $(".dimScreen").fadeOut();
                    // console.log(res);
                    $('#sales_group').html(res);
                }
            });

            $.ajax({
                type: 'POST',
                data: {
                    'customer_id': customer_id
                },
                url: '<?php echo site_url('company/getActualShipper'); ?>',
                success: function(res) {
                    $(".dimScreen").fadeOut();
                    if (res != '[]') {
                        var resp = JSON.parse(res);
                        var html = '<option value="">Select shiper</option>';
                        Object.keys(resp).forEach(function(key) {

                            html += '<option value="' + resp[key].id + '">' + resp[key].name +
                                '</option>';
                        });
                        $("#actual_shiper").html(html);
                    } else {
                        $("#actual_shiper").html('<option value="">Select shiper</option>');
                    }
                }
            });
        }

    });

 $(".shiper-dropdown").change(function() {
    $(".dimScreen").fadeIn();
    var shiper_id = $(this).val();
    if (shiper_id != '') {

        $.ajax({
            type: 'POST',
            data: {
                'shiper_id': shiper_id
            },
            url: '<?php echo site_url('company/getActualShipperDetails'); ?>',
            success: function(res) {
                $(".dimScreen").fadeOut();
                if (res != '[]') {
                    var resp = JSON.parse(res);
                    $('#actual_shiper_person_name').val(resp.name);
                    $('#actual_shiper_company').val(resp.company);
                    $('#actual_shiper_email_id').val(resp.email_id);
                    $('#actual_shiper_mobile').val(resp.mobile);
                    $('#actual_shiper_phone').val(resp.telephone);
                    $('#actual_shiper_address').val(resp.address);
                    $('#actual_shiper_address2').val(resp.address2);
                    $('#actual_shiper_address3').val(resp.address3);
                    $('#actual_shiper_pincode').val(resp.pincode);
                    $('#actual_shiper_city').val(resp.city);
                    $('#actual_shiper_state').val(resp.state);
                    $('#actual_shiper_country').val(resp.country);
                }else{
                    $('#actual_shiper_person_name').val('');
                    $('#actual_shiper_company').val('');
                    $('#actual_shiper_email_id').val('');
                    $('#actual_shiper_mobile').val('');
                    $('#actual_shiper_phone').val('');
                    $('#actual_shiper_address').val('');
                    $('#actual_shiper_address2').val('');
                    $('#actual_shiper_address3').val('');
                    $('#actual_shiper_pincode').val('');
                    $('#actual_shiper_city').val('');
                    $('#actual_shiper_state').val('');
                    $('#actual_shiper_country').val('');
                }
            }
        });
    }else{
        $('#actual_shiper_person_name').val('');
        $('#actual_shiper_company').val('');
        $('#actual_shiper_email_id').val('');
        $('#actual_shiper_mobile').val('');
        $('#actual_shiper_phone').val('');
        $('#actual_shiper_address').val('');
        $('#actual_shiper_address2').val('');
        $('#actual_shiper_address3').val('');
        $('#actual_shiper_pincode').val('');
        $('#actual_shiper_city').val('');
        $('#actual_shiper_state').val('');
        $('#actual_shiper_country').val('');
    }
});

   $('#deleteshipper').click(function(e) {
        e.preventDefault();
        if (confirm("Are you sure you want to delete this?")) {
            var id = $('#actual_shiper').val();
            $.ajax({
                url: '<?php echo site_url('deleteshipper'); ?>',
                type: 'post',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res != '') {
                        $('#actual_shiper_person_name').val('');
                        $('#actual_shiper_company').val('');
                        $('#actual_shiper_email_id').val('');
                        $('#actual_shiper_mobile').val('');
                        $('#actual_shiper_phone').val('');
                        $('#actual_shiper_address').val('');
                        $('#actual_shiper_address2').val('');
                        $('#actual_shiper_address3').val('');
                        $('#actual_shiper_pincode').val('');
                        $('#actual_shiper_city').val('');
                        $('#actual_shiper_state').val('');
                    }
                }
            })
        } else {
            return false;
        }

    });


    $(".consignee-dropdown").change(function() {
    $(".dimScreen").fadeIn();
    var consignee_id = $(this).val();
    if (consignee_id != '') {
        var country = '';
        $.ajax({
            type: 'POST',
            data: {
                'consignee_id': consignee_id
            },
            url: '<?php echo site_url('company/getConsigneeDetails'); ?>',
            success: function(res) {
                $(".dimScreen").fadeOut();
                if (res != '[]') {
                    var resp = JSON.parse(res);
                        $('#consignee_person_name').val(resp.name);
                        $('#consignee_company').val(resp.company);
                        $('#consignee_email_id').val(resp.email_id);
                        $('#consignee_mobile').val(resp.mobile);
                        $('#consignee_telephone').val(resp.telephone);
                        $('#consignee_address').val(resp.address);
                        $('#consignee_address2').val(resp.address2);
                        $('#consignee_address3').val(resp.address3);
                        $('#dest_pincode').val(resp.pincode);
                        $('#consignee_city').val(resp.city);
                        $('#consignee_state').val(resp.state);
                        $('#consignee_country').val(resp.country);
                        var consignee_country  = resp.country;
               
            

                        var vendor_id = $('#vendors_list').val();        
                        var sub_vendor_id = $('#sub_vendors_list').val();        
                        $('#web_agent_name').val(vendor_id);
                        if (vendor_id != '') {
                            var rate_class = "<?= $_GET['location'] ?>";
                            // var consignee_country = $("#consignee_country").val();            
                            // var consignee_country = country;            
                            var ship_type = $('.ship_type:checked').val();
                            $.ajax({
                                type: 'POST',
                                data: {
                                    'rate_class': rate_class,
                                    'consignee_country': consignee_country,
                                    'vendor_id': vendor_id,
                                    'sub_vendor_id':sub_vendor_id,
                                    'ship_type':ship_type
                                },
                                url: '<?php echo site_url('company/getVendorRates'); ?>',
                                success: function(res) {
                                    if (res != '[]') {
                                        var resp = JSON.parse(res);
                                        console.log(resp);
                                        zone = resp.zone;
                                        if(zone != ''){
                                            $("#zone_lbl").val(zone);
                                    
                                        }else{

                                            $("#zone_lbl").val('');
                                        }

                                        $("#divisor").val(resp.divisor);
                                        $('#vendor_states').val(resp.state);
                                        rates = resp.rates;
                                        othercharge();
                                        getBlulchange();  
                                    }
                                }
                                
                            });
                        }
                    }else{
                        $('#consignee_person_name').val('');
                        $('#consignee_company').val('');
                        $('#consignee_email_id').val('');
                        $('#consignee_mobile').val('');
                        $('#consignee_telephone').val('');
                        $('#consignee_address').val('');
                        $('#consignee_address2').val('');
                        $('#consignee_address3').val('');
                        $('#dest_pincode').val('');
                        $('#consignee_city').val('');
                        $('#consignee_state').val('');
                        $('#consignee_country').val('');
                    }
                }
            });
        }else{
            $('#consignee_person_name').val('');
            $('#consignee_company').val('');
            $('#consignee_email_id').val('');
            $('#consignee_mobile').val('');
            $('#consignee_telephone').val('');
            $('#consignee_address').val('');
            $('#consignee_address2').val('');
            $('#consignee_address3').val('');
            $('#dest_pincode').val('');
            $('#consignee_city').val('');
            $('#consignee_state').val('');
            $('#consignee_country').val('');
        }
});

$('#deleteconsigee').click(function(e) {
    e.preventDefault();
    if (confirm("Are you sure you want to delete this?")) {
        var id = $('#consignee_receiver').val();
        $.ajax({
            url: '<?php echo site_url('deleteconsignee'); ?>',
            type: 'post',
            data: {
                id: id
            },
            success: function(res) {
                if (res != '') {
                    $('#consignee_person_name').val('');
                    $('#consignee_company').val('');
                    $('#consignee_email_id').val('');
                    $('#consignee_mobile').val('');
                    $('#consignee_telephone').val('');
                    $('#consignee_address').val('');
                    $('#consignee_address2').val('');
                    $('#consignee_address3').val('');
                    $('#dest_pincode').val('');
                    $('#consignee_city').val('');
                    $('#consignee_state').val('');
                    $('#consignee_country').val('');
                }
                // alert(res);
            }
        })
    } else {
        return false;
    }

});
$(".add-additional-agent").click(function() {
        $('.partner-div').css('display', 'block');
        let add_additional_agent_count = parseFloat($(".partner-div div.row").length) + 1;
        let add_additional_agent_html = "";
        add_additional_agent_html +=
            '<div class="col-xl-12" style="margin-bottom:10px;"><div class="row" id="add_additional_agent_row_' +
            add_additional_agent_count + '">';
        add_additional_agent_html += '<div class="col-xl-6 col-lg-5 col-md-6 col-sm-6 col-5">';
        add_additional_agent_html += '<div class="form-group">';
        add_additional_agent_html += '<label for="">Additional Agent Name</label>';
        add_additional_agent_html +=
            '<select class="form-control partner-list" name="additional_agent_name[]">';
        add_additional_agent_html += '<option value="">Please select agent</option>';
        add_additional_agent_html += "<?php echo $vendor_list; ?>";
        add_additional_agent_html += '</select>';
        add_additional_agent_html += '</div>';
        add_additional_agent_html += '</div>';
        add_additional_agent_html += '<div class="col-xl-5 col-lg-6 col-md-5 col-sm-5 col-6">';
        add_additional_agent_html += '<div class="form-group">';
        add_additional_agent_html += '<label for="">Additional Agent AWB No.</label>';
        add_additional_agent_html +=
            '<input type="text" class="form-control agent-awb-no" name="additional_agent_awb_no[]">';
        add_additional_agent_html += '</div>';
        add_additional_agent_html += '</div>';
        add_additional_agent_html += '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">';
        add_additional_agent_html += '<div class="form-group">';
        add_additional_agent_html += '<label for=""></label>';
        add_additional_agent_html +=
            '<input type="button" class="btn btn-danger agent-awb-no-rm" value="X"/ id="' +
            add_additional_agent_count + '"">';
        add_additional_agent_html += '</div>';
        add_additional_agent_html += '</div>';
        add_additional_agent_html += '</div></div>';
        if (add_additional_agent_count < 4) {

            $(".partner-div").append(add_additional_agent_html);
        }
    });
    
    $(document).on("change", "#divisor", function() {          
            priceCalculationfirst()
    });

    $("#weight_calculator2").on("keyup", ".from_con, .to_con", function() {
        var tet =$(this).closest('.vw_box').attr('id');
        var unit = $('#unit_wid').val();
        var divisor =$('#divisor').val();
        var length = $(this).closest('.vw_box'+tet).find('.flen');
        var width = $(this).closest('.vw_box'+tet).find('.fwid');
        var height = $(this).closest('.vw_box'+tet).find('.fwid');
        var cftV = $(this).closest('.vw_box'+tet).find('.cftV').find(":selected").text();;
        var from_field = $(this);
        var to_field = undefined;
        if ($(from_field).hasClass("flen")) {
            to_field = $(from_field).closest('.vw_box'+tet).find('.tlen');
        } else if ($(from_field).hasClass("fwid")) {
            to_field = $(from_field).closest('.vw_box'+tet).find('.twid');
        } else if ($(from_field).hasClass("fhei")) {
            to_field = $(from_field).closest('.vw_box'+tet).find('.thei');
        }

        var from_con = $(from_field).val();
        
        var to_con = from_con;
        if (unit == 'mm') {
            to_con = 0.1 * from_con;
        } else if (unit == 'in') {
            to_con = 2.54 * from_con;
        } else if (unit == 'ft') {
            to_con = 30.48 * from_con;
        } else if (unit == 'cm') {
            to_con = 1 * from_con;
        }
 
        if (unit == 'cft') {
            to_con = to_con;
        } else {
            to_con = to_con.toFixed(2);
        }
        $(to_field).val(to_con);

        var no_of_box = $('#total_pieces').val();
          
        if (divisor != '') {
            if (unit == 'cft') {
                var vm_weight = ($(length).val() * $(width).val() * $(height).val()) / parseInt(divisor);
                var vm_weight1 = vm_weight.toFixed(2);
                var vm_weight2 = cftV * (vm_weight1)


                $('.vm'+tet).val(vm_weight2);
            } else {
                var vm_weight = ( parseFloat($(length).val()) *  parseFloat($(width).val()) *  parseFloat($(height).val())) /  parseFloat(divisor);
                vm_weight = vm_weight.toFixed(2);
                $('.vm'+tet).val(vm_weight);
            }
        }else{
                var vm_weight = ( parseFloat($(length).val()) *  parseFloat($(width).val()) *  parseFloat($(height).val())) /  4000;
                vm_weight = vm_weight.toFixed(2);
                $('.vm'+tet).val(vm_weight);
            
        }
      
        var vm_weight_total = 0;
        var am_weight_total = 0;
        var fm_weight_total = 0;
       
        // $(".vm_weight").each(function() {
        //     vm_weight_total += parseFloat($(this).val());
        // });

         $(".vm_weight").each(function() {
            var idd = $(this).attr('id');
            var vm_w = $('.vm'+idd).val();
            var am_w = $('.ac'+idd).val();

            // if (no_of_box != 1) {
            //      if (vm_w%1 != 0) {
            //         vm_w =parseInt(vm_w)+1;
            //     }
            //     if (am_w%1 != 0) {
            //         am_w =parseInt(am_w)+1;
            //     }
            // }  
            vm_weight_total += parseFloat(vm_w)
            am_weight_total += parseFloat(am_w)

            if (vm_w > am_w) {              
                var tt = parseFloat(vm_w);

            fm_weight_total += parseFloat(vm_w)
            // $('.total_t_vw'+idd).html(tt+' Kg');
            $('.total_t_vw'+idd).val(tt);
            }else{             

                var tt = parseFloat(am_w);
                
            fm_weight_total += parseFloat(am_w)
            // $('.total_t_vw'+idd).html(tt+' Kg');
            $('.total_t_vw'+idd).val(tt);

            }

        });
        vm_weight_total.toFixed(2);        
        am_weight_total.toFixed(2);        
        fm_weight_total.toFixed(2);
        //vm_weight_total = vm_weight_total.toFixed(2);
        // $("#billing_weight").val(fm_weight_total);
        // $("#billing_weight1").val(fm_weight_total);
        // $("#vendor_purchase_weight1").val(fm_weight_total);
        // $("input[name='volumetric_weight']").val(vm_weight_total);
        // let voluW = $("input[name='extra_dimensional_charge']").val();
        // $("#actual_weight").val(am_weight_total);
        // if (voluW > vm_weight_total) {

        //     let extra_dimensional_charge = $("#extra_dimensional_charge").val();
        //     $("input[name='extra_dimensional_charge']").val(parseFloat(extra_dimensional_charge));
        // }
                
        // priceCalculationfirst();

    });
    

    $('#product_id,#customer_name').change(function() {
        $('#weight_required').val('0');
        var product_id = $('#product_id').val();
        if (product_id != '') {
            $("#zone_lbl").val('');
            $(".empty_all_data").val('');
        }
        
        var company_id = $('#customer_name').val();
        var shipment_type = $('#ship_type').val();
        // var shipment_type = $('#vendors_list').val();
        // alert(country_code);
        // var shiptype = $(this).find(':selected').attr('data');
        var ddu =$("input[name='ddu']:checked").val() ;
        var stacakable =$("input[name='stacakable']:checked").val();
        $.ajax({
            type: 'POST',
            data: {
                'product_id': product_id,'company_id': company_id,'shipment_type':shipment_type
            },
            url: '<?php echo site_url('company/getProduct'); ?>',
            success: function(res) {

                var resp = JSON.parse(res);               
                console.log(resp);
                $('#shipment_type').val(resp.shipment_type);
                $('#vendor_states').val(resp.state);
                $('#product_divisor').val(resp.divisor);
                $('#divisor_name').html(resp.type);

                $('.customer-list').val(resp.vendor_code);
                $('#vendors_list').trigger('change');
                $('.partner-lists').val(resp.vendor_code);
                $('#web_agent_name').trigger('change');
                if (product_id == '') {
                    $('.product_idss').val(resp.id);
                    $('#product_id').trigger('change');
                }
            }
        });
        $('#base_amount').val(0);
        $('#fuel_surcharge').val(0);

    });

    $('#product_id,#vendors_list,#customer_name').change(function() {
        $('#weight_required').val('0');
        var vendor_id = $('#vendors_list').val();
        var ship_type = $('.ship_type:checked').val();
        $.ajax({
            type: 'POST',
            data: {
                'ship_type':ship_type,'vendor_id':vendor_id
            },
            url: '<?php echo site_url('getcountry_list'); ?>',
            success: function(resp) { 
                $('#actual_shiper_country').html(resp);
                $('#consignee_country').html(resp);
            }
        });
        $('#base_amount').val(0);
        $('#fuel_surcharge').val(0);

    });

    $('#vendors_list').change(function () {
            var selectedValue = $(this).val();
            $('#web_agent_name').val(selectedValue); 
        });

    var zone = "";
    var rates = [];
     $("#consignee_country,#sub_vendors_list").change(function() {
    //$("#consignee_country").change(function() {
        var vendor_id = $('#vendors_list').val();        
        var sub_vendor_id = $('#sub_vendors_list').val();        
        $('#web_agent_name').val(vendor_id);
        if (vendor_id != '') {
            var rate_class = "<?= $_GET['location'] ?>";
            var consignee_country = $("#consignee_country").val();            
            var ship_type = $('.ship_type:checked').val();
            $.ajax({
                type: 'POST',
                data: {
                    'rate_class': rate_class,
                    'consignee_country': consignee_country,
                    'vendor_id': vendor_id,
                    'sub_vendor_id':sub_vendor_id,
                    'ship_type':ship_type
                },
                url: '<?php echo site_url('company/getVendorRates'); ?>',
                success: function(res) {
                    if (res != '[]') {
                        var resp = JSON.parse(res);
                        console.log(resp);
                        zone = resp.zone;
                        if(zone != ''){
                            $("#zone_lbl").val(zone);
                 
                        }else{

                            $("#zone_lbl").val('');
                        }

                        $("#divisor").val(resp.divisor);
                        $('#vendor_states').val(resp.state);
                        rates = resp.rates;
                        othercharge();
                        getBlulchange();  
                    }
                }
            });
        }
    });



    $(document).on('click','#box_data_submit',function(){
   // e.preventDefault();
    var weightkg = $('#weightkg_d').val()
    var weightkg_d_round = $('#weightkg_d_round').val()
    var length = $('#length_d').val()
    var height = $('#height_d').val()
    var width = $('#width_d').val()
    var volumetric_w = $('#volumetric_w_d').val()
    var volumetric_w_round = $('#volumetric_w_round').val()
    var heigher_weight_actual_volume = $('#heigher_weight_actual_volume_d').val()
    var modaltype = $('#modaltype').val()
    var booking_id = $('#p_booking_id').val()
    var unit = $('#p_unit').val()
    var total_pieces = parseInt($("#total_pieces").val());
    var divisor = $('#p_divisor').val()
    var pro_divisor = $('#pro_divisor').val()
    
    var subvendor_id = $('#sub_vendors_list').val() || ''; 
    var active_status = $('#active_status').val();

if (weightkg == 0 && length == 0 && height == 0 && width == 0 && volumetric_w == 0) {
   
    $('#myModal').modal('hide');
    $('#package_form').trigger('reset');
    return false;
}

    $.ajax({
        url: '<?= base_url('company/add_new_Pieces'); ?>',
        type:'post',
        data: {
                    'weightkg': weightkg,
                    'weightkg_d_round': weightkg_d_round,
                    'length': length,
                    'height':height,
                    'width':width,
                    'volumetric_w':volumetric_w,
                    'volumetric_w_round':volumetric_w_round,
                    'heigher_weight_actual_volume':heigher_weight_actual_volume,
                    'modaltype':modaltype,
                    'booking_id':booking_id,
                    'unit':unit,
                    'divisor':divisor,
                    'pro_divisor':pro_divisor,
                    'total_pieces':total_pieces,
                    'active_status':active_status,
                    'subvendor_id':subvendor_id

                },
        success:function(res){
           $('#show_package').html(res);
           sactual_weight_ = $('#sactual_weight').val();
            if (sactual_weight_ == "0" || sactual_weight_.trim() == "") {
                $('#weight_required').val('0');
            }else{
                $('#weight_required').val('1');
            }
        }
    });

    if ($('.dgrcargo:checked').val() == "dgrcargo") { 
        
            let fields = [
                '#base_amount', '#covid_charge', '#res_charge', '#com_charge',
                '#non_stnd_weight_oversize_amount_cl', '#ddp_charge', '#extra_dimensional_charge',
                '#other_charge', '#other_charge_without', '#service_charge',
                '#service_charge3', '#p_total', '#base_amount2' , '#covid_charge2' , '#res_charge2', '#com_charge2', '#vendor_non_stnd_weight_oversize_amount_new', '#ddp_charge2', '#extra_dimensional_charge2', '#other_charge2', '#other_charge_without','#service_charge2', '#service_charge4', '#p_total3' 
            ];
            
            $('#manually_fuel_get').val(1);
            $('#manually_fuel_get2').val(1);
            // Set value to 0, change background color, and disable pointer events
            $(fields.join(', ')).val(0).css({
                'background': '#FFF',
                'pointer-events': 'unset'
            });
        }
   
})

    $(document).on('click','#box_data_submit',function(){
    var booking_id = $('#booking_id').val();
    // console.log(booking_id);
    
    $.ajax({
        url: '<?= base_url('company/calculate_weight'); ?>',
        type:'post',
        data:{booking_id:booking_id},
        success:function(res){
            var resp = JSON.parse(res);
            $('#volumetric_weight').val(resp['volumetric_w']);
            $('#actual_weight').val(resp['a_weight']);
            $('#billing_weight').val(resp['higher']);
            $('#non_stnd_weight_oversize_amount_cl').val(resp['sresult']);
            
            $('#svolumetric_weight').val(resp['svolumetric_w']);
            $('#sactual_weight').val(resp['sa_weight']);
            
            $('#sbilling_weight').val(resp['shigher']);
            $('#vendor_non_stnd_weight_oversize_amount_new').val(resp['result']);
            
            $('#myModal').modal('hide');

            priceCalculationfirst();
            setTimeout(function () {
                priceCalculationfirst();
    }, 1000); // 2000ms = 2 seconds

           $('#package_form').trigger('reset');

           sactual_weight_ = $('#sactual_weight').val();
            if (sactual_weight_ == "0" || sactual_weight_.trim() == "") {
                $('#weight_required').val('0');
            }else{
                $('#weight_required').val('1');
            }
            
        }
    })

    if ($('.dgrcargo:checked').val() == "dgrcargo") {
        
        let fields = [
            '#base_amount', '#covid_charge', '#res_charge', '#com_charge',
            '#non_stnd_weight_oversize_amount_cl', '#ddp_charge', '#extra_dimensional_charge',
            '#other_charge', '#other_charge_without', '#service_charge',
            '#service_charge3', '#p_total', '#base_amount2' , '#covid_charge2' , '#res_charge2', '#com_charge2', '#vendor_non_stnd_weight_oversize_amount_new', '#ddp_charge2', '#extra_dimensional_charge2', '#other_charge2', '#other_charge_without','#service_charge2', '#service_charge4', '#p_total3' 
        ];
        
        $('#manually_fuel_get').val(1);
        $('#manually_fuel_get2').val(1);
        // Set value to 0, change background color, and disable pointer events
        $(fields.join(', ')).val(0).css({
            'background-color': '#FFF',
            'pointer-events': 'unset'
        });
    }
})   


 function priceCalculationfirst(){
      
    var weight = $('#billing_weight').val();
    var weight_v = $('#sbilling_weight').val();
    var vendor_id = $("#vendors_list").val();
    var sub_vendor_id = $("#sub_vendors_list").val();
    var rate_class ="<?= $_GET['location'] ?>";
    var zone = $("#zone_lbl").val();
    var customer_type = $('#customer_type').val();            
    var ship_type = $('.ship_type:checked').val();
    var shipment_type = $("#shipment_type").val();
    var company = $("#customer_name").val();
    var divisor = $('#divisor').val();
    var p_divisor = $('#product_divisor').val();
    var product_id = $('#product_id').val();
    var customer_id = $('#customer_name').val();
    $.ajax({
        type: 'post',
        data: {
            'rate_class': rate_class,
            'zone': zone,
            'vendor_id': vendor_id,
            'sub_vendor_id':sub_vendor_id,
            'weight': weight,
            'weight_v':weight_v,
            'shipment_type': shipment_type,
            'ship_type':ship_type,
            'company': company,
            'divisor':divisor,
            'customer_type':customer_type,
            'product_id':product_id,
            'p_divisor':p_divisor,
            'customer_id':customer_id
        },
        url: '<?php echo site_url('company/getVendorWeightRate'); ?>',
        success: function(res) {
            console.log(res);
            
            if (res != '[]') {
                var resp = JSON.parse(res);
                var rate = resp.rate;
                var type = resp.type;
                var v_type = resp.v_type;
                var s_rate = resp.s_rate;
                var rate_type = $.trim(resp.rate_type);
                var rate_type2 = $.trim(resp.rate_type2);
                var upper_weight = resp.upper_weight;
                var hsn_code_amount = resp.hsn_code;
                var hsn_details = resp.hsn_details;
                // var rate = parseFloat(resp.rate.replace(/,/g, '')); 

                if (rate != '') {
                   
                  $(".base_amount2").val(rate);

                // } else if (rate_type == 'bulk') {
                //     $(".base_amount2").val(rate * weight);
                } else {
                    $(".base_amount2").val(0);
                }
                    $("#hsn_code_amount").val(hsn_code_amount);
                    $("#hsn_details").val(hsn_details);

                    $("#vendor_hsn_code_amount").val(hsn_code_amount);
                    $("#vendor_hsn_heading_amount").val(hsn_details);

                if (s_rate != '') {
                    $(".base_amount").val(s_rate.toFixed(2));
                // } else if (rate_type2 == 'bulk') {
                //     $(".base_amount").val(s_rate * weight);
                }else {
                    $(".base_amount").val(0);
                }
                $('#show_type').html(type);
                $('#show_type2').html(v_type);
                $('#amount_calculation_type').val(v_type);

                $('.fuel_charge_amount').val(0);
                $('.sub_total_amount').val(0);
                $('.cgst_amount').val(0);
                $('.sgst_amount').val(0);
                $('.igst_amount').val(0);
                $('.grand_total_amount').val(0);
                $('.fuel_charge_amount2').val(0);
                $('.sub_total_amount2').val(0);
                $('.cgst_amount2').val(0);
                $('.sgst_amount2').val(0);
                $('.igst_amount2').val(0);
                $('.grand_total_amount2').val(0);
                priceCalculation(); 

            }


        }
    });

    othercharge();
    getBlulchange();  
};


$(document).on('change input','#base_amount,#covid_charge,#res_charge,#com_charge,#ext_weight_charge,#non_stackable_charge,#ddp_charge,#non_stnd_weight_oversize_amount_cl,#extra_dimensional_charge,#other_charge,#other_charge_without,#gst_amount,.service_charge,.service_charge2,.service_charge3,.service_charge4,#fuel_surcharge,.fuel_charge_covid,.fuel_charge_res_charge,.fuel_charge_com_charge,.fuel_charge_ext_weight_charge_cl,.fuel_charge_ddp_charge,.fuel_charge_extra_dimensional_charge,.fuel_charge_other_charge,.fuel_charge_other_charge_without,.fuel_charge_service_charge,fuel_charge_service_charge3,#service_charge3S,.fuel_charge_res_charge2,.fuel_charge_amount,.fuel_charge_ddp_charge2,#fuel_surcharge1',function(){
    var manually_fuel_get = $('#manually_fuel_get').val();
    if (manually_fuel_get == 1) {
        priceCalculation();
    }
})

// $(document).on('change input','#fuel_surcharge,#fuel_surcharge1,#restrict_country_charge_fuel, #commercial_charge_fuel, #non_stnd_weight_oversize_fuel,#duty_delivery_paid_fuel,#non_stackable_frgle_fuel,#other_charge_with_fuel_chrg_fuel,#other_charge_withouts,#service_charge_non_taxable_fuel,#other_charge_without_fuel_chrg_fuel,#booking_product_fuel',function(){
//     priceCalculation();
// })


 
$(document).on('change input','#base_amount2,#covid_charge2,#vendor_amount,#vendor_purchase_covid1,#vendor_purchase_restricted1,#vendor_purchase_commercial1,#vendor_ext_weight_charge1,#vendor_non_stackable_charge1,#vendor_ddp_charge1,#vendor_extra_dimensional_charge1,#vendor_other_charge1,#vendor_other_charge_without1,#vendor_purchase_service_tax1,#vendor_purchase_service_charge1,#res_charge2,#com_charge2,#vendor_non_stnd_weight_oversize_amount_new,#ddp_charge2,#extra_dimensional_charge2,#other_charge2,.other_charge_without2,.service_charge2,.service_charge4,#p_total3,.fuel_charge_amount2,.fuel_charge_covid2,.fuel_charge_res_charge,.fuel_charge_com_charge,.fuel_charge_com_charge2,.fuel_charge_ext_weight_charge_cl2,.fuel_charge_ddp_charge2,.fuel_charge_extra_dimensional_charge2,.fuel_charge_other_charge2,.fuel_charge_other_charge_without2,.fuel_charge_service_charge2,.fuel_charge_service_charge4,#fuel_surcharge6,#other_charge_withouts,.fuel_charge_covid,.fuel_charge_res_charge2 ',function(){
    var manually_fuel_get = $('#manually_fuel_get2').val();
    if (manually_fuel_get == 1) {
        priceCalculation();
    }
})



function priceCalculation() {
let gross_total=0;
let sub_gross_total=0;
let c_gross_total=0;
let s_gross_total=0;
let i_gross_total=0;
let g_gross_total=0;
var fuel_total =  0 ;

let amount = 0;
var covid_charges = 0;
var restricted_country_charge = 0;
var commercialCharges = 0;
var ext_weight_chargess = 0;
var ext_weight_chargess_new = 0;
var non_stackabless = 0;
var ddp = 0;
var other_chargess = 0;
var other_charge_withoutss = 0;
var fule_amount = 0;
var fule_covid_charge = 0;
var fule_country_charge = 0;
var fule_com_charge = 0;
var fuel_charge_exts_weight = 0;
var fule_ddp_charge = 0;
var fuel_charge_ext_dimensional = 0;
var fuel_charge_others_charge = 0;
var fuel_charge_others_charge_without = 0;
var fuel_charge_services_charge = 0;

amount = $("#base_amount").val();
fuel_charge_amount = $(".fuel_charge_amount").val();
covid_charge = $("#covid_charge").val();
res_charge = $("#res_charge").val();
com_charge = $("#com_charge").val();
ext_weight_charge = $("#ext_weight_charge").val();
ext_weight_charge_cl = $("#non_stnd_weight_oversize_amount_cl").val();
non_stackable_charge = $("#non_stackable_charge").val();
ddp_charge  = $(".ddp_charge").val();
extra_dimensional_charge  = $("#extra_dimensional_charge").val();
other_charge  = $("#other_charge").val();
other_charge_without  = $("#other_charge_without").val();
gst_amount  = $("#gst_amount").val();
service_charge  = $("#service_charge").val();
service_charge3  = $("#service_charge3").val();   
fuel_surcharge = $("#fuel_surchargess").val();
fuel_surcharge_manu = $("#manually_fuel_get").val();

fule_amount = $("#fuel_surcharge").val();
fule_covid_charge = $(".fuel_charge_covid").val();
fule_country_charge  = $(".fuel_charge_res_charge").val();
fule_com_charge  = $(".fuel_charge_com_charge").val();
fuel_charge_exts_weight  = $(".fuel_charge_ext_weight_charge_cl").val();
fule_ddp_charge  = $(".fuel_charge_ddp_charge").val();
fuel_charge_ext_dimensional  = $(".fuel_charge_extra_dimensional_charge").val();
fuel_charge_others_charge  = $(".fuel_charge_other_charge").val();
fuel_charge_others_charge_without  = $(".fuel_charge_other_charge_without").val();
fuel_charge_services_charge  = $(".fuel_charge_service_charge").val();
fuel_charge_services_charge3 = $(".fuel_charge_service_charge3").val();

cgst  = $("#v_cgst").html();
sgst  = $("#v_sgst").html();
igst  = $("#v_igst").html();

fuel_charge_covid = $(".fuel_charge_covid").val();
fuel_charge_res_charge  = $(".fuel_charge_res_charge").val();
fuel_charge_com_charge   = $(".fuel_charge_com_charge").val();
fuel_charge_ext_weight_charge_cl    = $(".fuel_charge_ext_weight_charge_cl").val();
fuel_charge_ddp_charge     = $(".fuel_charge_ddp_charge").val();
fuel_charge_extra_dimensional_charge      = $(".fuel_charge_extra_dimensional_charge").val();
fuel_charge_other_charge       = $(".fuel_charge_other_charge").val();
fuel_charge_other_charge_without     = $(".fuel_charge_other_charge_without").val();
fuel_charge_service_charge    = $(".fuel_charge_service_charge").val();
fuel_charge_service_charge3    = $(".fuel_charge_service_charge3").val();
service_charge    = $(".service_charge").val();



if(fuel_charge_amount == ''){ 
    fuel_charge_amount = 0; 
}
if(fuel_charge_covid == ''){ 
    fuel_charge_covid = 0; 
}
if(fuel_charge_res_charge == ''){ 
    fuel_charge_res_charge = 0; 
}
if(fuel_charge_com_charge == ''){ 
    fuel_charge_com_charge = 0; 
}
if(fuel_charge_ext_weight_charge_cl  == ''){ 
    fuel_charge_ext_weight_charge_cl  = 0; 
}
if(fuel_charge_ddp_charge  == ''){ 
    fuel_charge_ddp_charge  = 0; 
}
if(fuel_charge_extra_dimensional_charge   == ''){ 
    fuel_charge_extra_dimensional_charge   = 0; 
}
if(fuel_charge_other_charge    == ''){ 
    fuel_charge_other_charge    = 0; 
}
if(fuel_charge_other_charge_without  == ''){ 
    fuel_charge_other_charge_without  = 0; 
}
if(fuel_charge_service_charge  == ''){ 
    fuel_charge_service_charge  = 0; 
}
if(fuel_charge_service_charge3  == ''){ 
    fuel_charge_service_charge3  = 0; 
}
if(service_charge  == ''){ 
    service_charge  = 0; 
}

if ('' != amount && 0 != amount ) {
    if (parseFloat(fuel_surcharge) != 0 && parseFloat(amount) >0) {
 
        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_amount = (parseFloat(amount)*parseFloat(fuel_surcharge)/100);
            }else{
            var  fuel_charge_amount = parseFloat(fule_amount);
        }

        f_amount_1 = $('#f_amount').val();
        if(f_amount_1 == 1){
            fuel_charge_amount = fuel_charge_amount
        }else{
            fuel_charge_amount = 0;
        }
        
         
            $(".fuel_charge_amount").val(fuel_charge_amount.toFixed(2));
            fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_amount) ;
            }else{
            // $(".fuel_charge_amount").val(0);
            // fuel_charge_covid = 0;
            fuel_charge_amount =fuel_charge_amount;
            }

           
            var sub_total_amount = parseFloat(amount)+parseFloat(fuel_charge_amount);
            $(".sub_total_amount").val(sub_total_amount.toFixed(2));

            sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_amount);
                    if(parseInt(cgst) >0){
            var v_cgst = sub_total_amount*parseInt(cgst)/100;
            $('.cgst_amount').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_amount').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_amount*parseInt(sgst)/100;
            $('.sgst_amount').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_amount').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_amount*parseInt(igst)/100;
            $('.igst_amount').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_amount').val(v_igst);
        }
        var grand_total_amount = v_cgst+v_sgst+v_igst+sub_total_amount;
        $('.grand_total_amount').val(grand_total_amount.toFixed(2));
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_amount);
        gross_total = parseFloat(gross_total) + parseFloat(amount);
}else{
    // $(".fuel_charge_amount").val(0);
    $('.igst_amount').val(0);
    $('.sgst_amount').val(0);
    $(".sub_total_amount").val(0);
    $('.grand_total_amount').val(0);
    $('.cgst_amount').val(0);
}

if ('' != covid_charge && 0 != covid_charge ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat(covid_charge) >0) {

        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_covid = (parseFloat(covid_charge)*parseFloat(fuel_surcharge)/100);  
            }else{
            var  fuel_charge_covid = parseFloat(fule_covid_charge);
        }

        f_covid_1 = $('#f_covid').val();
        if(f_covid_1 == 1){
            fuel_charge_covid = fuel_charge_covid
        }else{
            fuel_charge_covid = 0;
        }

        $(".fuel_charge_covid").val(fuel_charge_covid);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_covid) ;
       }else{
        // alert(fuel_charge_covid);
        // $(".fuel_charge_covid").val(0);
        fuel_charge_covid = fuel_charge_covid;
       }

        var sub_total_covid = parseFloat(covid_charge)+parseFloat(fuel_charge_covid);
        if (sub_total_covid) {
            $(".sub_total_covid").val(sub_total_covid);     
        }else{
            $(".sub_total_covid").val(0);
        }

        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_covid);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_covid*parseInt(cgst)/100;
            $('.cgst_covid').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_covid').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_covid*parseInt(sgst)/100;
            $('.sgst_covid').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_covid').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_covid*parseInt(igst)/100;
            $('.igst_covid').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_covid').val(v_igst);
        }
        var grand_total_covid = v_cgst+v_sgst+v_igst+sub_total_covid;
        $('.grand_total_covid').val(grand_total_covid.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_covid);
        gross_total = parseFloat(gross_total) + parseFloat(covid_charge);
}else{
    // $(".fuel_charge_covid").val(0);
    $('.igst_covid').val(0);
    $('.sgst_covid').val(0);
    $(".sub_total_covid").val(0);
    $('.grand_total_covid').val(0);
    $('.cgst_covid').val(0);
}





if ('' != res_charge && 0 != res_charge ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_restrictied').val()) >0) {

           if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_res_charge = (parseFloat(res_charge)*parseFloat(fuel_surcharge)/100);
            }else{
            var  fuel_charge_res_charge = parseFloat(fule_country_charge);
        }
        f_restrictied_1 = $('#f_restrictied').val();
        if(f_restrictied_1 == 1){
            fuel_charge_res_charge = fuel_charge_res_charge
        }else{
            fuel_charge_res_charge = 0;
        }
        $(".fuel_charge_res_charge").val(fuel_charge_res_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_res_charge) ;
       }else{
        // $(".fuel_charge_res_charge").val(0);
        fuel_charge_res_charge = fuel_charge_res_charge;
       }
        var sub_total_res_charge = parseFloat(res_charge)+parseFloat(fuel_charge_res_charge);
        $(".sub_total_res_charge").val(sub_total_res_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_res_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_res_charge*parseInt(cgst)/100;
            $('.cgst_res_charge').val(v_cgst.toFixed(2));
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_res_charge').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_res_charge*parseInt(sgst)/100;
            $('.sgst_res_charge').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_res_charge').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_res_charge*parseInt(igst)/100;
            $('.igst_res_charge').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_res_charge').val(v_igst);
        }
        var grand_total_res_charge = v_cgst+v_sgst+v_igst+sub_total_res_charge;
        $('.grand_total_res_charge').val(grand_total_res_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_res_charge);
        gross_total = parseFloat(gross_total) + parseFloat(res_charge);
}else{
    // $(".fuel_charge_res_charge").val(0);
    $('.igst_res_charge').val(0);
    $('.sgst_res_charge').val(0);
    $(".sub_total_res_charge").val(0);
    $('.grand_total_res_charge').val(0);
    $('.cgst_res_charge').val(0);
}


if ('' != com_charge && 0 != com_charge ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_commercial').val()) >0) {

           if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_com_charge = (parseFloat(com_charge)*parseFloat(fuel_surcharge)/100);
            }else{
            var  fuel_charge_com_charge = parseFloat(fule_com_charge);
        }

        f_commercial_1 = $('#f_commercial').val();
        if(f_commercial_1 == 1){
            fuel_charge_com_charge = fuel_charge_com_charge
        }else{
            fuel_charge_com_charge = 0;
        }

        $(".fuel_charge_com_charge").val(fuel_charge_com_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_com_charge) ;
       }else{
        // $(".fuel_charge_com_charge").val(0);
        fuel_charge_com_charge = fuel_charge_com_charge;
       }
        var sub_total_com_charge = parseFloat(com_charge)+parseFloat(fuel_charge_com_charge);
        $(".sub_total_com_charge").val(sub_total_com_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_com_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_com_charge*parseInt(cgst)/100;
            $('.cgst_com_charge').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_com_charge').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_com_charge*parseInt(sgst)/100;
            $('.sgst_com_charge').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_com_charge').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_com_charge*parseInt(igst)/100;
            $('.igst_com_charge').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_com_charge').val(v_igst);
        }
        var grand_total_com_charge = v_cgst+v_sgst+v_igst+sub_total_com_charge;
        
        $('.grand_total_com_charge').val(grand_total_com_charge.toFixed(2));
                
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_com_charge);
        gross_total = parseFloat(gross_total) + parseFloat(com_charge);
}else{
    // $(".fuel_charge_com_charge").val(0);
    $('.igst_com_charge').val(0);
    $('.sgst_com_charge').val(0);
    $(".sub_total_com_charge").val(0);
    $('.grand_total_com_charge').val(0);
    $('.cgst_com_charge').val(0);
}

// if ('' != ext_weight_charge && 0 != ext_weight_charge ) {
//        if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_oversize_w').val()) >0) {
//         var  fuel_charge_ext_weight_charge = (parseFloat(ext_weight_charge)*parseFloat(fuel_surcharge)/100);
//         $(".fuel_charge_ext_weight_charge").val(fuel_charge_ext_weight_charge);
//         fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_ext_weight_charge) ;
//        }else{
//         $(".fuel_charge_ext_weight_charge").val(0);
//         fuel_charge_ext_weight_charge = 0;
//        }
//         var sub_total_ext_weight_charge = parseFloat(ext_weight_charge)+parseFloat(fuel_charge_ext_weight_charge);
//         $(".sub_total_ext_weight_charge").val(sub_total_ext_weight_charge);
        
//         sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_ext_weight_charge);
//         if(parseInt(cgst) >0){
//             var v_cgst = sub_total_ext_weight_charge*parseInt(cgst)/100;
//             $('.cgst_ext_weight_charge').val(v_cgst.toFixed(2));
            
//             c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
//         }else{
//             var v_cgst = 0;
//             $('.cgst_ext_weight_charge').val(v_cgst);
//         }

//         if(parseInt(sgst) >0){
//             var v_sgst = sub_total_ext_weight_charge*parseInt(sgst)/100;
//             $('.sgst_ext_weight_charge').val(v_sgst.toFixed(2));
            
//             s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
//         }else{
//             var v_sgst = 0;
//             $('.sgst_ext_weight_charge').val(v_sgst);
//         }

//         if(parseInt(igst) >0){
//             var v_igst = sub_total_ext_weight_charge*parseInt(igst)/100;
//             $('.igst_ext_weight_charge').val(v_igst.toFixed(2));
            
//             i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
//         }else{
//             var v_igst = 0;
//             $('.igst_ext_weight_charge').val(v_igst);
//         }
//         var grand_total_ext_weight_charge = v_cgst+v_sgst+v_igst+sub_total_ext_weight_charge;
//         $('.grand_total_ext_weight_charge').val(grand_total_ext_weight_charge.toFixed(2));
        
//         g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_ext_weight_charge);
//         gross_total = parseFloat(gross_total) + parseFloat(ext_weight_charge);
// }


if ('' != ext_weight_charge_cl && 0 != ext_weight_charge_cl ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_oversize_w').val()) >0) {

        var  fuel_charge_ext_weight_charge_cl = (parseFloat(ext_weight_charge_cl)*parseFloat(fuel_surcharge)/100);
        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_ext_weight_charge_cl = (parseFloat(com_charge)*parseFloat(fuel_surcharge)/100);
            }else{
            var  fuel_charge_ext_weight_charge_cl = parseFloat(fuel_charge_exts_weight);
        }
            f_oversize_w_1 = $('#f_oversize_w').val();
            if (f_oversize_w_1 > 0) {
                // Assuming fuel_charge_ext_weight_charge_cl already has a value
                fuel_charge_ext_weight_charge_cl = fuel_charge_ext_weight_charge_cl;
            } else {
                fuel_charge_ext_weight_charge_cl = 0;
            }

            


        $(".fuel_charge_ext_weight_charge_cl").val(fuel_charge_ext_weight_charge_cl);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_ext_weight_charge_cl) ;
       }else{
        // $(".fuel_charge_ext_weight_charge_cl").val(0);
        fuel_charge_ext_weight_charge_cl = fuel_charge_ext_weight_charge_cl;
       }
        var sub_total_ext_weight_charge_cl = parseFloat(ext_weight_charge_cl)+parseFloat(fuel_charge_ext_weight_charge_cl);
        $(".sub_total_ext_weight_charge_cl").val(sub_total_ext_weight_charge_cl);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_ext_weight_charge_cl);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_ext_weight_charge_cl*parseInt(cgst)/100;
            $('.cgst_ext_weight_charge_cl').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_ext_weight_charge_cl').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_ext_weight_charge_cl*parseInt(sgst)/100;
            $('.sgst_ext_weight_charge_cl').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_ext_weight_charge_cl').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_ext_weight_charge_cl*parseInt(igst)/100;
            $('.igst_ext_weight_charge_cl').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_ext_weight_charge_cl').val(v_igst);
        }
        var grand_total_ext_weight_charge_cl = v_cgst+v_sgst+v_igst+sub_total_ext_weight_charge_cl;
        $('.grand_total_ext_weight_charge_cl').val(grand_total_ext_weight_charge_cl.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_ext_weight_charge_cl);
        gross_total = parseFloat(gross_total) + parseFloat(ext_weight_charge_cl);
}else{
    // $(".fuel_charge_ext_weight_charge_cl").val(0);
    $('.igst_ext_weight_charge_cl').val(0);
    $('.sgst_ext_weight_charge_cl').val(0);
    $(".sub_total_ext_weight_charge_cl").val(0);
    $('.grand_total_ext_weight_charge_cl').val(0);
    $('.cgst_ext_weight_charge_cl').val(0);
}  





// if ('' != non_stackable_charge && 0 != non_stackable_charge ) {
//        if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_nonstakable').val()) >0) {
//         var  fuel_charge_non_stackable_charge = (parseFloat(non_stackable_charge)*parseFloat(fuel_surcharge)/100);
//         $(".fuel_charge_non_stackable_charge").val(fuel_charge_non_stackable_charge);
//         fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_non_stackable_charge) ;
//        }else{
//         $(".fuel_charge_non_stackable_charge").val(0);
//         fuel_charge_non_stackable_charge = 0;
//        }
//         var sub_total_non_stackable_charge = parseFloat(non_stackable_charge)+parseFloat(fuel_charge_non_stackable_charge);
//         $(".sub_total_non_stackable_charge").val(sub_total_non_stackable_charge);
        
//         sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_non_stackable_charge);
//         if(parseInt(cgst) >0){
//             var v_cgst = sub_total_non_stackable_charge*parseInt(cgst)/100;
//             $('.cgst_non_stackable_charge').val(v_cgst.toFixed(2));
            
//             c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
//         }else{
//             var v_cgst = 0;
//             $('.cgst_non_stackable_charge').val(v_cgst);
//         }

//         if(parseInt(sgst) >0){
//             var v_sgst = sub_total_non_stackable_charge*parseInt(sgst)/100;
//             $('.sgst_non_stackable_charge').val(v_sgst.toFixed(2));
            
//             s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
//         }else{
//             var v_sgst = 0;
//             $('.sgst_non_stackable_charge').val(v_sgst);
//         }

//         if(parseInt(igst) >0){
//             var v_igst = sub_total_non_stackable_charge*parseInt(igst)/100;
//             $('.igst_non_stackable_charge').val(v_igst.toFixed(2));
            
//             i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
//         }else{
//             var v_igst = 0;
//             $('.igst_non_stackable_charge').val(v_igst);
//         }
//         var grand_total_non_stackable_charge = v_cgst+v_sgst+v_igst+sub_total_non_stackable_charge;
//         $('.grand_total_non_stackable_charge').val(grand_total_non_stackable_charge.toFixed(2));
        
//         g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_non_stackable_charge);
//         gross_total = parseFloat(gross_total) + parseFloat(non_stackable_charge);
// }

if ('' != ddp_charge && 0 != ddp_charge ) {
       if (parseFloat(fuel_surcharge) != 0) {

        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0' && parseFloat($('#f_ddp').val()) >0) {
            var  fuel_charge_ddp_charge = (parseFloat(ddp_charge)*parseFloat(fuel_surcharge)/100);
            }else{
            var  fuel_charge_ddp_charge = parseFloat(fule_ddp_charge);
        }
        f_ddp_1 = $('#f_ddp').val();
        if(f_ddp_1 > 0){
            fuel_charge_ddp_charge = fuel_charge_ddp_charge;
        }else{
            fuel_charge_ddp_charge = 0;
        }

        $(".fuel_charge_ddp_charge").val(fuel_charge_ddp_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_ddp_charge) ;
       }else{
        // $(".fuel_charge_ddp_charge").val(0);
        fuel_charge_ddp_charge = fuel_charge_ddp_charge;
       }
        var sub_total_ddp_charge = parseFloat(ddp_charge)+parseFloat(fuel_charge_ddp_charge);
        $(".sub_total_ddp_charge").val(sub_total_ddp_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_ddp_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_ddp_charge*parseInt(cgst)/100;
            $('.cgst_ddp_charge').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_ddp_charge').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_ddp_charge*parseInt(sgst)/100;
            $('.sgst_ddp_charge').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_ddp_charge').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_ddp_charge*parseInt(igst)/100;
            $('.igst_ddp_charge').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_ddp_charge').val(v_igst);
        }
        var grand_total_ddp_charge = v_cgst+v_sgst+v_igst+sub_total_ddp_charge;
        $('.grand_total_ddp_charge').val(grand_total_ddp_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_ddp_charge);
        gross_total = parseFloat(gross_total) + parseFloat(ddp_charge);
}else{
    // $(".fuel_charge_ddp_charge").val(0);
    $('.igst_ddp_charge').val(0);
    $('.sgst_ddp_charge').val(0);
    $(".sub_total_ddp_charge").val(0);
    $('.grand_total_ddp_charge').val(0);
    $('.cgst_ddp_charge').val(0);
} 

if ('' != extra_dimensional_charge && 0 != extra_dimensional_charge ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_oversize_d').val()) >0) {

        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var fuel_charge_extra_dimensional_charge = (parseFloat(extra_dimensional_charge)*parseFloat(fuel_surcharge)/100);
            }else{
            var fuel_charge_extra_dimensional_charge = parseFloat(fuel_charge_ext_dimensional);
        }
        f_nonstakable_1 = $('#f_nonstakable').val();
        if(f_nonstakable_1 > 0){
            fuel_charge_extra_dimensional_charge = fuel_charge_extra_dimensional_charge;
        } else{
            fuel_charge_extra_dimensional_charge = 0;
        }

        console.log(fuel_charge_extra_dimensional_charge);
        
        $(".fuel_charge_extra_dimensional_charge").val(fuel_charge_extra_dimensional_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_extra_dimensional_charge) ;
       }else{
        // $(".fuel_charge_extra_dimensional_charge").val(0);
        fuel_charge_extra_dimensional_charge = fuel_charge_extra_dimensional_charge;
       }
        var sub_total_extra_dimensional_charge = parseFloat(extra_dimensional_charge) + parseFloat(fuel_charge_extra_dimensional_charge);
       
        
        $(".sub_total_extra_dimensional_charge").val(sub_total_extra_dimensional_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_extra_dimensional_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_extra_dimensional_charge*parseInt(cgst)/100;
            $('.cgst_extra_dimensional_charge').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_extra_dimensional_charge').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_extra_dimensional_charge*parseInt(sgst)/100;
            $('.sgst_extra_dimensional_charge').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_extra_dimensional_charge').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_extra_dimensional_charge*parseInt(igst)/100;
            $('.igst_extra_dimensional_charge').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_extra_dimensional_charge').val(v_igst);
        }
        var grand_total_extra_dimensional_charge = v_cgst+v_sgst+v_igst+sub_total_extra_dimensional_charge;
        $('.grand_total_extra_dimensional_charge').val(grand_total_extra_dimensional_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_extra_dimensional_charge);
        gross_total = parseFloat(gross_total) + parseFloat(extra_dimensional_charge);
}else{
    // $(".fuel_charge_extra_dimensional_charge").val(0);
    $('.igst_extra_dimensional_charge').val(0);
    $('.sgst_extra_dimensional_charge').val(0);
    $(".sub_total_extra_dimensional_charge").val(0);
    $('.grand_total_extra_dimensional_charge').val(0);
    $('.cgst_extra_dimensional_charge').val(0);
} 


if ('' != other_charge && 0 != other_charge ) {
       if (parseFloat(fuel_surcharge) != 0) {

        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_other_charge = (parseFloat(other_charge)*parseFloat(fuel_surcharge)/100);
            }else{
            var fuel_charge_other_charge = parseFloat(fuel_charge_others_charge);
        }

        $(".fuel_charge_other_charge").val(fuel_charge_other_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_other_charge) ;
       }else{
        // $(".fuel_charge_other_charge").val(0);
        fuel_charge_other_charge = fuel_charge_other_charge;
       }
        var sub_total_other_charge = parseFloat(other_charge)+parseFloat(fuel_charge_other_charge);
        // $(".sub_total_other_charge").val(sub_total_other_charge);
        
        $(".other_charge_with_fuel_chrg_sub_total").val(sub_total_other_charge);
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_other_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_other_charge*parseInt(cgst)/100;
            $('.cgst_other_charge').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_other_charge').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_other_charge*parseInt(sgst)/100;
            $('.sgst_other_charge').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_other_charge').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_other_charge*parseInt(igst)/100;
            $('.igst_other_charge').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_other_charge').val(v_igst);
        }
        var grand_total_other_charge = v_cgst+v_sgst+v_igst+sub_total_other_charge;
        $('.grand_total_other_charge').val(grand_total_other_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_other_charge);
        gross_total = parseFloat(gross_total) + parseFloat(other_charge);
}else{
    // $(".fuel_charge_other_charge").val(0);
    $('.igst_other_charge').val(0);
    $('.sgst_other_charge').val(0);
    $(".other_charge_with_fuel_chrg_sub_total").val(0);
    $('.grand_total_other_charge').val(0);
    $('.cgst_other_charge').val(0);
    $('#other_charge').val(0);
} 

if ('' != other_charge_without && 0 != other_charge_without ) {
       if (parseFloat(fuel_surcharge) != 0) {

        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_other_charge_without = (parseFloat(other_charge_without)*parseFloat(fuel_surcharge)/100);
            }else{
            var fuel_charge_other_charge_without = parseFloat(fuel_charge_others_charge_without);
        }


        $(".fuel_charge_other_charge_without").val(fuel_charge_other_charge_without);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_other_charge_without) ;
       }else{
        // $(".fuel_charge_other_charge_without").val(0);
        fuel_charge_other_charge_without = fuel_charge_other_charge_without;
       }

        var sub_total_other_charge_without = parseFloat(other_charge_without)+parseFloat(fuel_charge_other_charge_without);
        
        $(".sub_total_other_charge_without").val(sub_total_other_charge_without);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_other_charge_without);

        if(parseInt(cgst) >0){
            var v_cgst = sub_total_other_charge_without*parseInt(cgst)/100;
            $('.cgst_other_charge_without').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_other_charge_without').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_other_charge_without*parseInt(sgst)/100;
            $('.sgst_other_charge_without').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_other_charge_without').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_other_charge_without*parseInt(igst)/100;
            $('.igst_other_charge_without').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_other_charge_without').val(v_igst);
        }
        var grand_total_other_charge_without = v_cgst+v_sgst+v_igst+sub_total_other_charge_without;
        $('.grand_total_other_charge_without').val(grand_total_other_charge_without.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_other_charge_without);
        gross_total = parseFloat(gross_total) + parseFloat(other_charge_without);
}else{
    // $(".fuel_charge_other_charge_without").val(0);
    $('.igst_other_charge_without').val(0);
    $('.sgst_other_charge_without').val(0);
    $(".sub_total_other_charge_without").val(0);
    $('.grand_total_other_charge_without').val(0);
    $('.cgst_other_charge_without').val(0);
    // $('.service_charge').val(0);
} 



if ('' != service_charge && 0 != service_charge ) {
       if (parseFloat(fuel_surcharge) != 0) {
        
        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_service_charge = (parseFloat(service_charge)*parseFloat(fuel_surcharge)/100);
            }else{
            var fuel_charge_service_charge = parseFloat(fuel_charge_services_charge);
        }

        $(".fuel_charge_service_charge").val(fuel_charge_service_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_service_charge) ;
       }else{
        // $(".fuel_charge_service_charge").val(0);
        fuel_charge_service_charge = fuel_charge_service_charge;
       }
        var sub_total_service_charge = parseFloat(service_charge)+parseFloat(fuel_charge_service_charge);
        $(".sub_total_service_charge").val(sub_total_service_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_service_charge);
        if(parseInt(cgst) >0){
            // var v_cgst = sub_total_service_charge*parseInt(cgst)/100;
            var v_cgst = 0;
            $('.cgst_service_charge').val(0);
            // $('.cgst_service_charge').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_service_charge').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            // var v_sgst = sub_total_service_charge*parseInt(sgst)/100;
            var v_sgst = 0;
            // $('.sgst_service_charge').val(v_sgst.toFixed(2));
            $('.sgst_service_charge').val(0);
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_service_charge').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = 0;
            // var v_igst = sub_total_service_charge*parseInt(igst)/100;
            // $('.igst_service_charge').val(v_igst.toFixed(2));
            $('.igst_service_charge').val(0);
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_service_charge').val(v_igst);
        }
        var grand_total_service_charge = v_cgst+v_sgst+v_igst+sub_total_service_charge;
        $('.grand_total_service_charge').val(grand_total_service_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_service_charge);
        gross_total = parseFloat(gross_total) + parseFloat(service_charge);
}else{
    // $(".fuel_charge_service_charge").val(0);
    $('.igst_service_charge').val(0);
    $('.sgst_service_charge').val(0);
    $(".sub_total_service_charge").val(0);
    $('.grand_total_service_charge').val(0);
    $('.cgst_service_charge').val(0);
    // $('.fuel_charge_service_charge').val(0);
} 

if ('' != service_charge3 && 0 != service_charge3 ) {
       if (parseFloat(fuel_surcharge) != 0) {
        
           
           if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_service_charge3 = (parseFloat(service_charge3)*parseFloat(fuel_surcharge)/100);
            }else{
            var fuel_charge_service_charge3 = parseFloat(fuel_charge_services_charge3);
        }

        
        $(".fuel_charge_service_charge3").val(fuel_charge_service_charge3);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_service_charge3) ;
       }else{
        // $(".fuel_charge_service_charge3").val(0);
        fuel_charge_service_charge3 = fuel_charge_service_charge3;
       }
        var sub_total_service_charge3 = parseFloat(service_charge3)+parseFloat(fuel_charge_service_charge3);
        $(".sub_total_service_charge3").val(sub_total_service_charge3);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_service_charge3);
        if(parseInt(cgst) >0){
            
            // var v_cgst = sub_total_service_charge3*parseInt(cgst)/100;
            var v_cgst = 0;
            // $('.cgst_service_charge3').val(v_cgst.toFixed(2));
            $('.cgst_service_charge3').val(0);
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_service_charge3').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            // var v_sgst = sub_total_service_charge3*parseInt(sgst)/100;
            var v_sgst = 0;
            // $('.sgst_service_charge3').val(v_sgst.toFixed(2));
            $('.sgst_service_charge3').val(0);
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_service_charge3').val(v_sgst);
        }

        if(parseInt(igst) >0){
            // var v_igst = sub_total_service_charge3*parseInt(igst)/100;
            var v_igst = 0;
            $('.igst_service_charge3').val(0);
            // $('.igst_service_charge3').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_service_charge3').val(v_igst);
        }
        var grand_total_service_charge3 = v_cgst+v_sgst+v_igst+sub_total_service_charge3;
        $('.grand_total_service_charge3').val(grand_total_service_charge3.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_service_charge3);
        gross_total = parseFloat(gross_total) + parseFloat(service_charge3);
}else{
    // $(".fuel_charge_service_charge3").val(0);
    $('.igst_service_charge3').val(0);
    $('.sgst_service_charge3').val(0);
    $(".sub_total_service_charge3").val(0);
    $('.grand_total_service_charge3').val(0);
    $('.cgst_service_charge3').val(0);
    $('.service_charge3').val(0);
} 


fuel_total = (parseFloat(fuel_charge_covid) || 0) +
             (parseFloat(fuel_charge_amount) || 0) +
             (parseFloat(fuel_charge_res_charge) || 0) +
             (parseFloat(fuel_charge_com_charge) || 0) +
             (parseFloat(fuel_charge_ext_weight_charge_cl) || 0) +
             (parseFloat(fuel_charge_ddp_charge) || 0) +
             (parseFloat(fuel_charge_extra_dimensional_charge) || 0) +
             (parseFloat(fuel_charge_other_charge) || 0) +
             (parseFloat(fuel_charge_other_charge_without) || 0) +
             (parseFloat(fuel_charge_service_charge) || 0) +
             (parseFloat(fuel_charge_service_charge3) || 0);


$("#p_total").val(parseFloat(gross_total.toFixed(2)));
$("#total_fuel").val(fuel_total.toFixed(2));
$("#sub_totals").val(sub_gross_total.toFixed(2));
$("#cgst_total").val(c_gross_total.toFixed(2));
$("#sgst_total").val(s_gross_total.toFixed(2));
$("#igst_total").val(i_gross_total.toFixed(2));
$("#grand_totals").val(g_gross_total.toFixed(2));
$("#grand_totals4").val(g_gross_total.toFixed(2));
$("#grand_totalss4").html(g_gross_total.toFixed(2));

$("#comparison_sale_amount").val(parseFloat(gross_total.toFixed(2)));
$("#comparison_sale_fule").val(fuel_total.toFixed(2));
$("#comparison_sale_sub_total").val(sub_gross_total.toFixed(2));


$("#base_amount1").val(amount);
$("#covid_charge1").val(covid_charge);
$("#res_charge1").val(res_charge);
$("#fuel_surcharge2").val(restricted_country_charge);
$("#com_charge1").val(com_charge);
$("#fuel_surcharge8").val(commercialCharges);
$("#ext_weight_charge1").val(ext_weight_charge);
$("#non_stackable_charge1").val(non_stackable_charge);
$("#fuel_surcharge3").val(non_stackabless);
$("#ddp_charge1").val(ddp_charge);
// $("#ddp_charge").val(ddp);
$("#extra_dimensional_charge1").val(extra_dimensional_charge);
$("#other_charge1").val(other_charge);
// $("#fuel_surcharge6").val(other_chargess);
$("#other_charge_without1").val(other_charge_without);
// $("#other_charge_withouts").val(other_charge_withoutss);

$("#gst_amount1").val(gst_amount);
$("#service_charge1").val(service_charge);

priceCalculation2();


var comparison_sale_amount = parseFloat($("#comparison_sale_amount").val());
var comparison_sale_fule = parseFloat($("#comparison_sale_fule").val());
var comparison_sale_sub_total = parseFloat($("#comparison_sale_sub_total").val());

var comparison_vendor_amount = parseFloat($("#comparison_vendor_amount").val());
var comparison_vendor_fule = parseFloat($("#comparison_vendor_fule").val());
var comparison_vendor_sub_total = parseFloat($("#comparison_vendor_sub_total").val());

var pl_amount = comparison_sale_amount - comparison_vendor_amount;
var pl_fule = comparison_sale_fule - comparison_vendor_fule;
var pl_sub_total = comparison_sale_sub_total - comparison_vendor_sub_total;

$("#comparison_pl_amount").val(pl_amount.toFixed(2));
$("#comparison_pl_fule").val(pl_fule.toFixed(2));
$("#comparison_pl_sub_total").val(pl_sub_total.toFixed(2));

var pl_amount_percentage = (comparison_vendor_amount !== 0) ? ((pl_amount / comparison_vendor_amount) * 100).toFixed(2) : 'N/A';
var pl_fule_percentage = (comparison_vendor_fule !== 0) ? ((pl_fule / comparison_vendor_fule) * 100).toFixed(2) : 'N/A';
var pl_sub_total_percentage = (comparison_vendor_sub_total !== 0) ? ((pl_sub_total / comparison_vendor_sub_total) * 100).toFixed(2) : 'N/A';


// Display the profit/loss percentages capped at 100%
$("#comparison_pl_amount_percentage").val(pl_amount_percentage + '%');
$("#comparison_pl_fule_percentage").val(pl_fule_percentage + '%');
$("#comparison_pl_sub_total_percentage").val(pl_sub_total_percentage + '%');

if (pl_amount < 0) {
    $("#comparison_pl_amount").css("color", "red");
    $("#comparison_pl_amount_percentage").css("color", "red");
} else {
    $("#comparison_pl_amount").css("color", "black");
    $("#comparison_pl_amount_percentage").css("color", "black");
}

if (pl_fule < 0) {
    $("#comparison_pl_fule").css("color", "red");
    $("#comparison_pl_fule_percentage").css("color", "red");
} else {
    $("#comparison_pl_fule").css("color", "black");
    $("#comparison_pl_fule_percentage").css("color", "black");
}

if (pl_sub_total < 0) {
    $("#comparison_pl_sub_total").css("color", "red");
    $("#comparison_pl_sub_total_percentage").css("color", "red");
} else {
    $("#comparison_pl_sub_total").css("color", "black");
    $("#comparison_pl_sub_total_percentage").css("color", "black");
}

var saleStr = $("#grand_totals4").val();
var purchaseStr = $("#grand_totals5").val();
var sale = parseFloat(saleStr);
var purchase = parseFloat(purchaseStr);

var profit = sale - purchase;

   if (profit > 0) {
        $("#profitss12").html((profit).toFixed(2) + ' (profit)');
    } else {
        $("#profitss12").html(profit + ' (loss)');
    }


//     if ($('.dgrcargo:checked').val() == "dgrcargo") { 
        
//         let fields = [
//             '#base_amount', '#covid_charge', '#res_charge', '#com_charge',
//             '#non_stnd_weight_oversize_amount_cl', '#ddp_charge', '#extra_dimensional_charge',
//             '#other_charge', '#other_charge_without', '#service_charge',
//             '#service_charge3', '#p_total', '#base_amount2' , '#covid_charge2' , '#res_charge2', '#com_charge2', '#vendor_non_stnd_weight_oversize_amount_new', '#ddp_charge2', '#extra_dimensional_charge2', '#other_charge2', '#other_charge_without','#service_charge2', '#service_charge4', '#p_total3' 
//         ];
        
      
        
//         fields.forEach(function(field) {
//     $(field).val("0");
// });


//     }
    

}


function priceCalculation2() {
let gross_total=0;
let sub_gross_total=0;
let c_gross_total=0;
let s_gross_total=0;
let i_gross_total=0;
let g_gross_total=0;
var fuel_total =  0 ;

let amount = 0;
var covid_charges = 0;
var restricted_country_charge = 0;
var commercialCharges = 0;
var ext_weight_chargess = 0;
var non_stackabless = 0;
var ddp = 0;
var other_chargess = 0;
var other_charge_withoutss = 0;

amount = $(".base_amount2").val();
covid_charge = $(".covid_charge2").val();
res_charge = $(".res_charge2").val();
com_charge = $(".com_charge2").val();
ext_weight_charge = $(".ext_weight_charge2").val();
ext_weight_charge_cl = $(".ext_weight_charge_cl2").val();
non_stackable_charge = $(".non_stackable_charge2").val();
ddp_charge  = $(".ddp_charge2").val();
extra_dimensional_charge  = $(".extra_dimensional_charge2").val();
other_charge  = $(".other_charge2").val();
other_charge_without  = $(".other_charge_without2").val();
gst_amount  = $(".gst_amount2").val();
service_charge  = $(".service_charge2").val();
service_charge4  = $(".service_charge4").val();    
fuel_surcharge  = $("#fuel_surcharges_ps2").html();
fuel_surcharge_manu = $('#manually_fuel_get2').val();

fule_amount = $(".fuel_charge_amount2").val();
fule_covid_charge = $(".fuel_charge_covid2").val();
fule_country_charge  = $(".fuel_charge_res_charge2").val();
fule_com_charge  = $(".fuel_charge_com_charge2").val();
fuel_charge_exts_weight  = $(".fuel_charge_ext_weight_charge_cl2").val();
fule_ddp_charge  = $(".fuel_charge_ddp_charge2").val();
fuel_charge_ext_dimensional  = $(".fuel_charge_extra_dimensional_charge2").val();
fuel_charge_others_charge  = $(".fuel_charge_other_charge2").val();
fuel_charge_others_charge_without  = $(".fuel_charge_other_charge_without2").val();
fuel_charge_services_charge  = $(".fuel_charge_service_charge2").val();
fuel_charge_services_charge3 = $(".fuel_charge_service_charge4").val();
 

cgst  = $("#v_cgst2").html();
sgst  = $("#v_sgst2").html();
igst  = $("#v_igst2").html();

fuel_charge_amount2 = $(".fuel_charge_amount2").val();
fuel_charge_covid2 = $(".fuel_charge_covid2").val();
fuel_charge_res_charge2  = $(".fuel_charge_res_charge2").val();
fuel_charge_com_charge2   = $(".fuel_charge_com_charge2").val();
fuel_charge_ext_weight_charge_cl2    = $(".fuel_charge_ext_weight_charge_cl2").val();
fuel_charge_ddp_charge2     = $(".fuel_charge_ddp_charge2").val();
fuel_charge_extra_dimensional_charge2      = $(".fuel_charge_extra_dimensional_charge2").val();
fuel_charge_other_charge2       = $(".fuel_charge_other_charge2").val();
fuel_charge_other_charge_without2     = $(".fuel_charge_other_charge_without2").val();
fuel_charge_service_charge2    = $(".fuel_charge_service_charge2").val();
fuel_charge_service_charge4    = $(".fuel_charge_service_charge4").val();



if(fuel_charge_amount2 == ''){ 
    fuel_charge_amount2 = 0; 
}
if(fuel_charge_covid2 == ''){ 
    fuel_charge_covid2 = 0; 
}
if(fuel_charge_res_charge2 == ''){ 
    fuel_charge_res_charge2 = 0; 
}
if(fuel_charge_com_charge2 == ''){ 
    fuel_charge_com_charge2 = 0; 
}
if(fuel_charge_ext_weight_charge_cl2  == ''){ 
    fuel_charge_ext_weight_charge_cl2  = 0; 
}
if(fuel_charge_ddp_charge2  == ''){ 
    fuel_charge_ddp_charge2  = 0; 
}
if(fuel_charge_extra_dimensional_charge2   == ''){ 
    fuel_charge_extra_dimensional_charge2   = 0; 
}
if(fuel_charge_other_charge2    == ''){ 
    fuel_charge_other_charge2    = 0; 
}
if(fuel_charge_other_charge_without2  == ''){ 
    fuel_charge_other_charge_without2  = 0; 
}
if(fuel_charge_service_charge2  == ''){ 
    fuel_charge_service_charge2  = 0; 
}
if(fuel_charge_service_charge4  == ''){ 
    fuel_charge_service_charge4  = 0; 
}




if ('' != amount && 0 != amount ) {
    amount = parseFloat(amount.replace(/,/g, ''));
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_amount_v').val()) >0) {
        

        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_amount = (parseFloat(amount)*parseFloat(fuel_surcharge)/100);
            }else{
            var fuel_charge_amount = parseFloat(fule_amount);
        }


        $(".fuel_charge_amount2").val(fuel_charge_amount.toFixed(2));
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_amount) ;
        }else{
        //    $(".fuel_charge_amount2").val(0);
           fuel_charge_amount =fuel_charge_amount2;
       }
        var sub_total_amount = parseFloat(amount)+parseFloat(fuel_charge_amount);
        if (sub_total_amount) {
            $(".sub_total_amount2").val(sub_total_amount.toFixed(2));
        }else{
            $(".sub_total_amount2").val(0);
        }

        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_amount);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_amount*parseInt(cgst)/100;
            $('.cgst_amount2').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_amount2').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_amount*parseInt(sgst)/100;
            $('.sgst_amount2').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_amount2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_amount*parseInt(igst)/100;
            $('.igst_amount2').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_amount2').val(v_igst);
        }
        var grand_total_amount = v_cgst+v_sgst+v_igst+sub_total_amount;
        $('.grand_total_amount2').val(grand_total_amount.toFixed(2));
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_amount);
        gross_total = parseFloat(gross_total) + parseFloat(amount);
}else{
    // $(".fuel_charge_amount2").val(0);
    $('.igst_amount2').val(0);
    $('.sgst_amount2').val(0);
    $(".sub_total_amount2").val(0);
    $('.grand_total_amount2').val(0);
    $('.cgst_amount2').val(0);
}

if ('' != covid_charge && 0 != covid_charge ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_covid_v').val()) >0) {

           if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_covid = (parseFloat(covid_charge)*parseFloat(fuel_surcharge)/100);
            }else{
            var fuel_charge_covid = parseFloat(fule_covid_charge);
        }

            $(".fuel_charge_covid2").val(fuel_charge_covid);
            fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_covid) ;
       }else{
        //    $(".fuel_charge_covid2").val(0);
           fuel_charge_covid =fuel_charge_covid2;
       }
        var sub_total_covid = parseFloat(covid_charge)+parseFloat(fuel_charge_covid);
        if(sub_total_covid >0){
             $(".sub_total_covid2").val(sub_total_covid);
        }else{
            $(".sub_total_covid2").val(0);
        }

        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_covid);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_covid*parseInt(cgst)/100;
            $('.cgst_covid2').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            $('.cgst_covid2').val(0);
            c_gross_total = 0;
        }

        if(parseInt(sgst) > 0){
            var v_sgst = sub_total_covid*parseInt(sgst)/100;
            $('.sgst_covid2').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_covid2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_covid*parseInt(igst)/100;
            $('.igst_covid2').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_covid2').val(v_igst);
        }
        var grand_total_covid = v_cgst+v_sgst+v_igst+sub_total_covid;
        $('.grand_total_covid2').val(grand_total_covid.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_covid);
        gross_total = parseFloat(gross_total) + parseFloat(covid_charge);
}else{
    // $(".fuel_charge_covid2").val(0);
    $('.igst_covid2').val(0);
    $('.sgst_covid2').val(0);
    $(".sub_total_covid2").val(0);
    $('.grand_total_covid2').val(0);
    $('.cgst_covid2').val(0);
}


if ('' != res_charge && 0 != res_charge ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_restrictied_v').val()) >0) {
        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_res_charge = (parseFloat(res_charge)*parseFloat(fuel_surcharge)/100);
        }else{
            var fuel_charge_res_charge = parseFloat(fule_country_charge);
        }
        $(".fuel_charge_res_charge2").val(fuel_charge_res_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_res_charge) ;
       }else{
        //    $(".fuel_charge_res_charge2").val(0);
           fuel_charge_res_charge =fuel_charge_res_charge2;
       }
        var sub_total_res_charge = parseFloat(res_charge)+parseFloat(fuel_charge_res_charge);
        $(".sub_total_res_charge2").val(sub_total_res_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_res_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_res_charge*parseInt(cgst)/100;
            $('.cgst_res_charge2').val(v_cgst.toFixed(2));
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_res_charge2').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_res_charge*parseInt(sgst)/100;
            $('.sgst_res_charge2').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_res_charge2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_res_charge*parseInt(igst)/100;
            $('.igst_res_charge2').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_res_charge2').val(v_igst);
        }
        var grand_total_res_charge = v_cgst+v_sgst+v_igst+sub_total_res_charge;
        $('.grand_total_res_charge2').val(grand_total_res_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_res_charge);
        gross_total = parseFloat(gross_total) + parseFloat(res_charge);
}else{
    // $(".fuel_charge_res_charge2").val(0);
    $('.igst_res_charge2').val(0);
    $('.sgst_res_charge2').val(0);
    $(".sub_total_res_charge2").val(0);
    $('.grand_total_res_charge2').val(0);
    $('.cgst_res_charge2').val(0);
}


if ('' != com_charge && 0 != com_charge ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_commercial_v').val()) >0) {
           if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_com_charge = (parseFloat(com_charge)*parseFloat(fuel_surcharge)/100);
        }else{
            var fuel_charge_com_charge = parseFloat(fule_com_charge);
        }
        $(".fuel_charge_com_charge2").val(fuel_charge_com_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_com_charge) ;
       }else{
        //    $(".fuel_charge_com_charge2").val(0);
           fuel_charge_com_charge = fuel_charge_com_charge2;
       }

        var sub_total_com_charge = parseFloat(com_charge)+parseFloat(fuel_charge_com_charge);
        $(".sub_total_com_charge2").val(sub_total_com_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_com_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_com_charge*parseInt(cgst)/100;
            $('.cgst_com_charge2').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_com_charge2').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_com_charge*parseInt(sgst)/100;
            $('.sgst_com_charge2').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_com_charge2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_com_charge*parseInt(igst)/100;
            $('.igst_com_charge2').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_com_charge2').val(v_igst);
        }
        var grand_total_com_charge = v_cgst+v_sgst+v_igst+sub_total_com_charge;
        $('.grand_total_com_charge2').val(grand_total_com_charge.toFixed(2));
                
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_com_charge);
        gross_total = parseFloat(gross_total) + parseFloat(com_charge);
}else{
    // $(".fuel_charge_com_charge2").val(0);
    $('.igst_com_charge2').val(0);
    $('.sgst_com_charge2').val(0);
    $(".sub_total_com_charge2").val(0);
    $('.grand_total_com_charge2').val(0);
    $('.cgst_com_charge2').val(0);
}
 

// if ('' != ext_weight_charge && 0 != ext_weight_charge ) {
//        if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_oversize_w_v').val()) >0) {
//         var  fuel_charge_ext_weight_charge = (parseFloat(ext_weight_charge)*parseFloat(fuel_surcharge)/100);
//         $(".fuel_charge_ext_weight_charge2").val(fuel_charge_ext_weight_charge);
//         fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_ext_weight_charge) ;
//        }else{
//            $(".fuel_charge_ext_weight_charge2").val(0);
//            fuel_charge_ext_weight_charge =0;
//        }
//         var sub_total_ext_weight_charge = parseFloat(ext_weight_charge)+parseFloat(fuel_charge_ext_weight_charge);
//         $(".sub_total_ext_weight_charge2").val(sub_total_ext_weight_charge);
        
//         sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_ext_weight_charge);
//         if(parseInt(cgst) >0){
//             var v_cgst = sub_total_ext_weight_charge*parseInt(cgst)/100;
//             $('.cgst_ext_weight_charge2').val(v_cgst.toFixed(2));
            
//             c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
//         }else{
//             var v_cgst = 0;
//             $('.cgst_ext_weight_charge2').val(v_cgst);
//         }

//         if(parseInt(sgst) >0){
//             var v_sgst = sub_total_ext_weight_charge*parseInt(sgst)/100;
//             $('.sgst_ext_weight_charge2').val(v_sgst.toFixed(2));
            
//             s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
//         }else{
//             var v_sgst = 0;
//             $('.sgst_ext_weight_charge2').val(v_sgst);
//         }

//         if(parseInt(igst) >0){
//             var v_igst = sub_total_ext_weight_charge*parseInt(igst)/100;
//             $('.igst_ext_weight_charge2').val(v_igst.toFixed(2));
            
//             i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
//         }else{
//             var v_igst = 0;
//             $('.igst_ext_weight_charge2').val(v_igst);
//         }
//         var grand_total_ext_weight_charge = v_cgst+v_sgst+v_igst+sub_total_ext_weight_charge;
//         $('.grand_total_ext_weight_charge2').val(grand_total_ext_weight_charge.toFixed(2));
        
//         g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_ext_weight_charge);
//         gross_total = parseFloat(gross_total) + parseFloat(ext_weight_charge);
// }


if ('' != ext_weight_charge_cl && 0 != ext_weight_charge_cl ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_oversize_w_v').val()) >0) {
        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_ext_weight_charge_cl = (parseFloat(ext_weight_charge_cl)*parseFloat(fuel_surcharge)/100);
        }else{
            var fuel_charge_ext_weight_charge_cl = parseFloat(fuel_charge_exts_weight);
        }
        $(".fuel_charge_ext_weight_charge_cl2").val(fuel_charge_ext_weight_charge_cl);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_ext_weight_charge_cl) ;
       }else{
        //    $(".fuel_charge_ext_weight_charge_cl2").val(0);
           fuel_charge_ext_weight_charge_cl = fuel_charge_ext_weight_charge_cl2;
       }

        var sub_total_ext_weight_charge_cl = parseFloat(ext_weight_charge_cl)+parseFloat(fuel_charge_ext_weight_charge_cl);
        $(".sub_total_ext_weight_charge_cl2").val(sub_total_ext_weight_charge_cl);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_ext_weight_charge_cl);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_ext_weight_charge_cl*parseInt(cgst)/100;
            $('.cgst_ext_weight_charge_cl2').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_ext_weight_charge_cl2').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_ext_weight_charge_cl*parseInt(sgst)/100;
            $('.sgst_ext_weight_charge_cl2').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_ext_weight_charge_cl2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_ext_weight_charge_cl*parseInt(igst)/100;
            $('.igst_ext_weight_charge_cl2').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_ext_weight_charge_cl2').val(v_igst);
        }
        var grand_total_ext_weight_charge_cl = v_cgst+v_sgst+v_igst+sub_total_ext_weight_charge_cl;
        $('.grand_total_ext_weight_charge_cl2').val(grand_total_ext_weight_charge_cl.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_ext_weight_charge_cl);
        gross_total = parseFloat(gross_total) + parseFloat(ext_weight_charge_cl);
}else{
    // $(".fuel_charge_ext_weight_charge_cl2").val(0);
    $('.igst_ext_weight_charge_cl2').val(0);
    $('.sgst_ext_weight_charge_cl2').val(0);
    $(".sub_total_ext_weight_charge_cl2").val(0);
    $('.grand_total_ext_weight_charge_cl2').val(0);
    $('.cgst_ext_weight_charge_cl2').val(0);
}

// if ('' != non_stackable_charge && 0 != non_stackable_charge ) {
//        if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_nonstakable_v').val()) >0) {
//         var  fuel_charge_non_stackable_charge = (parseFloat(non_stackable_charge)*parseFloat(fuel_surcharge)/100);
//         $(".fuel_charge_non_stackable_charge2").val(fuel_charge_non_stackable_charge);
//         fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_non_stackable_charge) ;
//        }else{
//            $(".fuel_charge_non_stackable_charge2").val(0);
//            fuel_charge_non_stackable_charge =0;
//        }
//         var sub_total_non_stackable_charge = parseFloat(non_stackable_charge)+parseFloat(fuel_charge_non_stackable_charge);
//         $(".sub_total_non_stackable_charge2").val(sub_total_non_stackable_charge);
        
//         sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_non_stackable_charge);
//         if(parseInt(cgst) >0){
//             var v_cgst = sub_total_non_stackable_charge*parseInt(cgst)/100;
//             $('.cgst_non_stackable_charge2').val(v_cgst.toFixed(2));
            
//             c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
//         }else{
//             var v_cgst = 0;
//             $('.cgst_non_stackable_charge2').val(v_cgst);
//         }

//         if(parseInt(sgst) >0){
//             var v_sgst = sub_total_non_stackable_charge*parseInt(sgst)/100;
//             $('.sgst_non_stackable_charge2').val(v_sgst.toFixed(2));
            
//             s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
//         }else{
//             var v_sgst = 0;
//             $('.sgst_non_stackable_charge2').val(v_sgst);
//         }

//         if(parseInt(igst) >0){
//             var v_igst = sub_total_non_stackable_charge*parseInt(igst)/100;
//             $('.igst_non_stackable_charge2').val(v_igst.toFixed(2));
            
//             i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
//         }else{
//             var v_igst = 0;
//             $('.igst_non_stackable_charge2').val(v_igst);
//         }
//         var grand_total_non_stackable_charge = v_cgst+v_sgst+v_igst+sub_total_non_stackable_charge;
//         $('.grand_total_non_stackable_charge2').val(grand_total_non_stackable_charge.toFixed(2));
        
//         g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_non_stackable_charge);
//         gross_total = parseFloat(gross_total) + parseFloat(non_stackable_charge);
// }

if ('' != ddp_charge && 0 != ddp_charge ) {
       if (parseFloat(fuel_surcharge) != 0 ) {
           
           if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0' && parseFloat($('#f_ddp_v').val()) >0) {
            var  fuel_charge_ddp_charge = (parseFloat(ddp_charge)*parseFloat(fuel_surcharge)/100);
        }else{
            var fuel_charge_ddp_charge = parseFloat(fule_ddp_charge);
        }

        f_ddp_v_2 = $('#f_ddp_v').val();
        if(f_ddp_v_2 > 0){
            fuel_charge_ddp_charge = fuel_charge_ddp_charge;
        }else{
            fuel_charge_ddp_charge = 0;
        }

        $(".fuel_charge_ddp_charge2").val(fuel_charge_ddp_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_ddp_charge) ;
       }else{
        //    $(".fuel_charge_ddp_charge2").val(0);
           fuel_charge_ddp_charge = fuel_charge_ddp_charge2;
       }
        var sub_total_ddp_charge = parseFloat(ddp_charge)+parseFloat(fuel_charge_ddp_charge);
        $(".sub_total_ddp_charge2").val(sub_total_ddp_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_ddp_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_ddp_charge*parseInt(cgst)/100;
            $('.cgst_ddp_charge2').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_ddp_charge2').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_ddp_charge*parseInt(sgst)/100;
            $('.sgst_ddp_charge2').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_ddp_charge2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_ddp_charge*parseInt(igst)/100;
            $('.igst_ddp_charge2').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_ddp_charge2').val(v_igst);
        }
        var grand_total_ddp_charge = v_cgst+v_sgst+v_igst+sub_total_ddp_charge;
        $('.grand_total_ddp_charge2').val(grand_total_ddp_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_ddp_charge);
        gross_total = parseFloat(gross_total) + parseFloat(ddp_charge);
}else{
    // $(".fuel_charge_ddp_charge2").val(0);
    $('.igst_ddp_charge2').val(0);
    $('.sgst_ddp_charge2').val(0);
    $(".sub_total_ddp_charge2").val(0);
    $('.grand_total_ddp_charge2').val(0);
    $('.cgst_ddp_charge2').val(0);
}
 

if ('' != extra_dimensional_charge && 0 != extra_dimensional_charge ) {
       if (parseFloat(fuel_surcharge) != 0 && parseFloat($('#f_oversize_d_v').val()) >0) {
           
        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_extra_dimensional_charge = (parseFloat(extra_dimensional_charge)*parseFloat(fuel_surcharge)/100);
        }else{
            var fuel_charge_extra_dimensional_charge = parseFloat(fuel_charge_ext_dimensional);
        }

        $(".fuel_charge_extra_dimensional_charge2").val(fuel_charge_extra_dimensional_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_extra_dimensional_charge) ;
       }else{
        //    $(".fuel_charge_extra_dimensional_charge2").val(0);
           fuel_charge_extra_dimensional_charge = fuel_charge_extra_dimensional_charge2;
       }
        var sub_total_extra_dimensional_charge = parseFloat(extra_dimensional_charge)+parseFloat(fuel_charge_extra_dimensional_charge);
        $(".sub_total_extra_dimensional_charge2").val(sub_total_extra_dimensional_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_extra_dimensional_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_extra_dimensional_charge*parseInt(cgst)/100;
            $('.cgst_extra_dimensional_charge2').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_extra_dimensional_charge2').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_extra_dimensional_charge*parseInt(sgst)/100;
            $('.sgst_extra_dimensional_charge2').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_extra_dimensional_charge2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_extra_dimensional_charge*parseInt(igst)/100;
            $('.igst_extra_dimensional_charge2').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_extra_dimensional_charge2').val(v_igst);
        }
        var grand_total_extra_dimensional_charge = v_cgst+v_sgst+v_igst+sub_total_extra_dimensional_charge;
        $('.grand_total_extra_dimensional_charge2').val(grand_total_extra_dimensional_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_extra_dimensional_charge);
        gross_total = parseFloat(gross_total) + parseFloat(extra_dimensional_charge);
}else{
    // $(".fuel_charge_extra_dimensional_charge2").val(0);
    $('.igst_extra_dimensional_charge2').val(0);
    $('.sgst_extra_dimensional_charge2').val(0);
    $(".sub_total_extra_dimensional_charge2").val(0);
    $('.grand_total_extra_dimensional_charge2').val(0);
    $('.cgst_extra_dimensional_charge2').val(0);
}
 


if ('' != other_charge && 0 != other_charge ) {
    
    if (parseFloat(fuel_surcharge) != 0) {
        fuel_surcharge_manu = $('#manually_fuel_get2').val();
        console.log(fuel_surcharge_manu);
           if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_other_charge = (parseFloat(other_charge)*parseFloat(fuel_surcharge)/100);
        }else{
            var fuel_charge_other_charge = parseFloat(fuel_charge_others_charge);
        }

        $(".fuel_charge_other_charge2").val(fuel_charge_other_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_other_charge) ;
       }else{ 
        //    $(".fuel_charge_other_charge2").val(0);
           fuel_charge_other_charge = fuel_charge_other_charge2;
       }
        var sub_total_other_charge = parseFloat(other_charge)+parseFloat(fuel_charge_other_charge);
        $(".sub_total_other_charge2").val(sub_total_other_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_other_charge);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_other_charge*parseInt(cgst)/100;
            $('.cgst_other_charge2').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_other_charge2').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_other_charge*parseInt(sgst)/100;
            $('.sgst_other_charge2').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_other_charge2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_other_charge*parseInt(igst)/100;
            $('.igst_other_charge2').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_other_charge2').val(v_igst);
        }
        var grand_total_other_charge = v_cgst+v_sgst+v_igst+sub_total_other_charge;
        $('.grand_total_other_charge2').val(grand_total_other_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_other_charge);
        gross_total = parseFloat(gross_total) + parseFloat(other_charge);
}else{
    // $(".fuel_charge_other_charge2").val(0);
    $('.igst_other_charge2').val(0);
    $('.sgst_other_charge2').val(0);
    $(".sub_total_other_charge2").val(0);
    $('.grand_total_other_charge2').val(0);
    $('.cgst_other_charge2').val(0);
}


if ('' != other_charge_without && 0 != other_charge_without ) {
       if (parseFloat(fuel_surcharge) != 0) {
           
        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_other_charge_without = (parseFloat(other_charge_without)*parseFloat(fuel_surcharge)/100);
        }else{
            var fuel_charge_other_charge_without = parseFloat(fuel_charge_others_charge_without);
        }

        $(".fuel_charge_other_charge_without2").val(fuel_charge_other_charge_without);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_other_charge_without) ;
       }else{
        //    $(".fuel_charge_other_charge_without2").val(0);
           fuel_charge_other_charge_without = fuel_charge_other_charge_without2;
       }
        var sub_total_other_charge_without = parseFloat(other_charge_without)+parseFloat(fuel_charge_other_charge_without);
        $(".sub_total_other_charge_without2").val(sub_total_other_charge_without);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_other_charge_without);
        if(parseInt(cgst) >0){
            var v_cgst = sub_total_other_charge_without*parseInt(cgst)/100;
            $('.cgst_other_charge_without2').val(v_cgst.toFixed(2));
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_other_charge_without2').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            var v_sgst = sub_total_other_charge_without*parseInt(sgst)/100;
            $('.sgst_other_charge_without2').val(v_sgst.toFixed(2));
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_other_charge_without2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            var v_igst = sub_total_other_charge_without*parseInt(igst)/100;
            $('.igst_other_charge_without2').val(v_igst.toFixed(2));
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_other_charge_without2').val(v_igst);
        }
        var grand_total_other_charge_without = v_cgst+v_sgst+v_igst+sub_total_other_charge_without;
        $('.grand_total_other_charge_without2').val(grand_total_other_charge_without.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_other_charge_without);
        gross_total = parseFloat(gross_total) + parseFloat(other_charge_without);
}else{
    // $(".fuel_charge_other_charge_without2").val(0);
    $('.igst_other_charge_without2').val(0);
    $('.sgst_other_charge_without2').val(0);
    $(".sub_total_other_charge_without2").val(0);
    $('.grand_total_other_charge_without2').val(0);
    $('.cgst_other_charge_without2').val(0);
}

if ('' != service_charge && 0 != service_charge ) {
       if (parseFloat(fuel_surcharge) != 0) {
           
        if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var  fuel_charge_service_charge = (parseFloat(service_charge)*parseFloat(fuel_surcharge)/100);
        }else{
            var fuel_charge_service_charge = parseFloat(fuel_charge_services_charge);
        }

        $(".fuel_charge_service_charge2").val(fuel_charge_service_charge);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_service_charge) ;
       }else{
        //    $(".fuel_charge_service_charge2").val(0);
           fuel_charge_service_charge = fuel_charge_service_charge2;
       }
        var sub_total_service_charge = parseFloat(service_charge)+parseFloat(fuel_charge_service_charge);
        $(".sub_total_service_charge2").val(sub_total_service_charge);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_service_charge);
        if(parseInt(cgst) >0){
            // var v_cgst = sub_total_service_charge*parseInt(cgst)/100;
            var v_cgst = 0;
            // $('.cgst_service_charge2').val(v_cgst.toFixed(2));
            $('.cgst_service_charge2').val(0);
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_service_charge2').val(0);
            // $('.cgst_service_charge2').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            // var v_sgst = sub_total_service_charge*parseInt(sgst)/100;
            var v_sgst = 0;
            // $('.sgst_service_charge2').val(v_sgst.toFixed(2));
            $('.sgst_service_charge2').val(0);
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_service_charge2').val(v_sgst);
        }

        if(parseInt(igst) >0){
            // var v_igst = sub_total_service_charge*parseInt(igst)/100;
            var v_igst = 0;
            // $('.igst_service_charge2').val(v_igst.toFixed(2));
            $('.igst_service_charge2').val(0);
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_service_charge2').val(v_igst);
        }
        var grand_total_service_charge = v_cgst+v_sgst+v_igst+sub_total_service_charge;
        $('.grand_total_service_charge2').val(grand_total_service_charge.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_service_charge);
        gross_total = parseFloat(gross_total) + parseFloat(service_charge);
}else{
    // $(".fuel_charge_service_charge2").val(0);
    $('.igst_service_charge2').val(0);
    $('.sgst_service_charge2').val(0);
    $(".sub_total_service_charge2").val(0);
    $('.grand_total_service_charge2').val(0);
    $('.cgst_service_charge2').val(0);
}

if ('' != service_charge4 && 0 != service_charge4 ) {
       if (parseFloat(fuel_surcharge) != 0) {
           
           if (fuel_surcharge_manu == 0 || fuel_surcharge_manu == '0') {
            var fuel_charge_service_charge4 = (parseFloat(service_charge4)*parseFloat(fuel_surcharge)/100);
        }else{
            var fuel_charge_service_charge4 = parseFloat(fuel_charge_services_charge3);
        }


        $(".fuel_charge_service_charge4").val(fuel_charge_service_charge4);
        fuel_total =  parseFloat(fuel_total) + parseFloat(fuel_charge_service_charge4) ;
       }else{
        //    $(".fuel_charge_service_charge4").val(0);
           fuel_charge_service_charge4 = fuel_charge_service_charge4;
       }
        var sub_total_service_charge4 = parseFloat(service_charge4)+parseFloat(fuel_charge_service_charge4);
        $(".sub_total_service_charge4").val(sub_total_service_charge4);
        
        sub_gross_total = parseFloat(sub_gross_total)+parseFloat(sub_total_service_charge4);
        if(parseInt(cgst) >0){
            // var v_cgst = sub_total_service_charge4*parseInt(cgst)/100;
            var v_cgst = 0;
            // $('.cgst_service_charge4').val(v_cgst.toFixed(2));
            $('.cgst_service_charge4').val(0);
            
            c_gross_total = parseFloat(c_gross_total)+parseFloat(v_cgst);
        }else{
            var v_cgst = 0;
            $('.cgst_service_charge4').val(v_cgst);
        }

        if(parseInt(sgst) >0){
            // var v_sgst = sub_total_service_charge4*parseInt(sgst)/100;
            var v_sgst = 0;
            // $('.sgst_service_charge4').val(v_sgst.toFixed(2));
            $('.sgst_service_charge4').val(0);
            
            s_gross_total = parseFloat(s_gross_total)+parseFloat(v_sgst);
        }else{
            var v_sgst = 0;
            $('.sgst_service_charge4').val(v_sgst);
        }

        if(parseInt(igst) >0){
            // var v_igst = sub_total_service_charge4*parseInt(igst)/100;
            var v_igst = 0;
            // $('.igst_service_charge4').val(v_igst.toFixed(2));
            $('.igst_service_charge4').val(0);
            
            i_gross_total = parseFloat(i_gross_total)+parseFloat(v_igst);
        }else{
            var v_igst = 0;
            $('.igst_service_charge4').val(v_igst);
        }
        var grand_total_service_charge4 = v_cgst+v_sgst+v_igst+sub_total_service_charge4;
        $('.grand_total_service_charge4').val(grand_total_service_charge4.toFixed(2));
        
        g_gross_total= parseFloat(g_gross_total)+parseFloat(grand_total_service_charge4);
        gross_total = parseFloat(gross_total) + parseFloat(service_charge4);
}else{
    // $(".fuel_charge_service_charge4").val(0);
    $('.igst_service_charge4').val(0);
    $('.sgst_service_charge4').val(0);
    $(".sub_total_service_charge4").val(0);
    $('.grand_total_service_charge4').val(0);
    $('.cgst_service_charge4').val(0);
}

fuel_charge_amount2 = $(".fuel_charge_amount2").val();
fuel_charge_covid2 = $(".fuel_charge_covid2").val();
fuel_charge_res_charge2  = $(".fuel_charge_res_charge2").val();
fuel_charge_com_charge2   = $(".fuel_charge_com_charge2").val();
fuel_charge_ext_weight_charge_cl2    = $(".fuel_charge_ext_weight_charge_cl2").val();
fuel_charge_ddp_charge2     = $(".fuel_charge_ddp_charge2").val();
fuel_charge_extra_dimensional_charge2      = $(".fuel_charge_extra_dimensional_charge2").val();
fuel_charge_other_charge2       = $(".fuel_charge_other_charge2").val();
fuel_charge_other_charge_without2     = $(".fuel_charge_other_charge_without2").val();
fuel_charge_service_charge2    = $(".fuel_charge_service_charge2").val();
fuel_charge_service_charge4    = $(".fuel_charge_service_charge4").val();

fuel_total = (parseFloat(fuel_charge_covid2) || 0) +
             (parseFloat(fuel_charge_amount2) || 0) +
             (parseFloat(fuel_charge_res_charge2) || 0) +
             (parseFloat(fuel_charge_com_charge2) || 0) +
             (parseFloat(fuel_charge_ext_weight_charge_cl2) || 0) +
             (parseFloat(fuel_charge_ddp_charge2) || 0) +
             (parseFloat(fuel_charge_extra_dimensional_charge2) || 0) +
             (parseFloat(fuel_charge_other_charge2) || 0) +
             (parseFloat(fuel_charge_other_charge_without2) || 0) +
             (parseFloat(fuel_charge_service_charge2) || 0) +
             (parseFloat(fuel_charge_service_charge4) || 0);


$("#p_total3").val(gross_total.toFixed(2));
$("#total_fuel3").val(fuel_total.toFixed(2));
$("#sub_totals3").val(sub_gross_total.toFixed(2));
$("#cgst_total3").val(c_gross_total.toFixed(2));
$("#sgst_total3").val(s_gross_total.toFixed(2));
$("#igst_total3").val(i_gross_total.toFixed(2));
$("#grand_totals3").val(g_gross_total.toFixed(2));
$("#grand_totals5").val(g_gross_total.toFixed(2));
$("#grand_totalss5").html(g_gross_total.toFixed(2));

$("#comparison_vendor_amount").val(gross_total.toFixed(2));
$("#comparison_vendor_fule").val(fuel_total.toFixed(2));
$("#comparison_vendor_sub_total").val(sub_gross_total.toFixed(2));

// base_amount2 = $("#base_amount2").val();
// covid_charge2 = $("#covid_charge2").val();
// res_charge2 = $("#res_charge2").val();
// com_charge2 = $("#com_charge2").val();
// vendor_non_stnd_weight_oversize_amount_new = $(".vendor_non_stnd_weight_oversize_amount_new").val();
// ddp_charge2 = $("#ddp_charge2").val();
// extra_dimensional_charge2 = $("#extra_dimensional_charge2").val();
// other_charge_without = $("#other_charge_without").val();
// service_charge2 = $("#service_charge2").val();
// service_charge4 = $("#service_charge4").val();

// total = base_amount2 + covid_charge2 + res_charge2 + com_charge2 + vendor_non_stnd_weight_oversize_amount_new + ddp_charge2 + extra_dimensional_charge2 + other_charge_without + service_charge2 + service_charge4;
// alert(covid_charge2);
// $("#p_total3").val(total);
}
    
 });


 function othercharge() {
    var amount_total = $('#base_amount').val();
    var covidcharge =  $('#vendors_list').val();


    var customer_id = $('#customer_name').val();
    var customer_id_type = $('#customer_type').val();
    var sub_vendor_id = $('#sub_vendors_list').val();
    var vendor_id = $('#vendors_list').val();
    var product_id = $('#product_id').val();


    var ddp = $("input[name='ddu']:checked").val();
    var stacakable = $("input[name='stacakable']:checked").val();
    var commercial = $("input[name='commercial']:checked").val();



    
    if (vendor_id != '') {
        var rate_class = "<?= $_GET['location'] ?>";
        var zone = $("#zone_lbl").val();
        // var state = $("#consignee_state").val();
        var state = $("#customer_state").val();
        var country = $("#consignee_country").find(':selected').data('value');
        var actual_weight = $('#sbilling_weight').val();           
        var ship_type = $('.ship_type:checked').val();
        $.ajax({
            type: 'POST',
            data: {
                'rate_class': rate_class,
                'zone': zone,
                'state':state,
                'vendor_id': vendor_id,
                'sub_vendor_id':sub_vendor_id,
                'actual_weight':actual_weight,
                'country': country,
                'ship_type':ship_type,
                'customer_id':customer_id
            },
            url: '<?php echo site_url('company/getOtherRates'); ?>',
            success: function(res) {
                if (res != '') {
                    var resp = JSON.parse(res);
                    if(resp['covin'] > 0){

                        $(".covid_charge2 ").val(resp['covin']);
                    }else{

                        $(".covid_charge2 ").val(0);
                    }

                    if(resp['res'] > 0){

                        $(".res_charge2").val(resp['res']);
                    }else{

                        $(".res_charge2").val(0);
                    }


                    if(commercial == 'commercial'){
                    if(resp['com'] > 0){

                        $(".com_charge2").val(resp['com']);
                    }}else{

                        $(".com_charge2").val(0);
                    }

                    

                    if(resp['fulechage'] > 0){

                    $("#fuel_surcharges_ps2").html(resp['fulechage']); 
                    $("#fuel_vendor").val(resp['fulechage']);
                    }else{

                    $("#fuel_surcharges_ps2").html(0);
                    $("#fuel_vendor").val(0);
                    }


                    if(resp['f_amount'] == 1){
                      $('#f_amount_v').val(resp['f_amount']);
                    }else{
                      $('#f_amount_v').val(0);  
                    }

                    if(resp['f_commercial'] == 1){
                      $('#f_commercial_v').val(resp['f_commercial']);
                    }else{
                      $('#f_commercial_v').val(0);  
                    }

                    if(resp['f_covid'] ==1){
                      $('#f_covid_v').val(resp['f_covid']);
                    }else{
                      $('#f_covid_v').val(0);  
                    }

                    if(ddp == 'DDP'){
                    if(resp['f_ddp'] ==1){
                      $('#f_ddp_v').val(resp['f_ddp']);
                    }}else{
                      $('#f_ddp_v').val(0);  
                    }


                    if (stacakable == 'nonstacakable') {
                    if(resp['f_nonstakable'] ==1){
                      $('#f_nonstakable_v').val(resp['f_nonstakable']);
                    }}else{
                      $('#f_nonstakable_v').val(0);  
                    }

                    if(resp['f_oversize_d'] ==1){
                      $('#f_oversize_d_v').val(resp['f_oversize_d']);
                    }else{
                      $('#f_oversize_d_v').val(0);  
                    }


                    if(resp['f_oversize_w'] ==1){
                      $('#f_oversize_w_v').val(resp['f_oversize_w']);
                    }else{
                      $('#f_oversize_w_v').val(0);  
                    }

                    if(resp['f_restrictied'] ==1){
                      $('#f_restrictied_v').val(resp['f_restrictied']);
                    }else{
                      $('#f_restrictied_v').val(0);  
                    }

                    // $('#v_cgst').html(resp['cgst']);
                    // $('#v_cgst2').html(resp['cgst']);
                    // $('#v_sgst').html(resp['sgst']);
                    // $('#v_sgst2').html(resp['sgst']);
                    // $('#v_igst').html(resp['igst']);
                    // $('#v_igst2').html(resp['igst']);

                    // $('#v_cgst2').html(resp['cgst']);
                    // $('#v_sgst2').html(resp['sgst']);
                    // $('#v_igst2').html(resp['igst']);
                    $('#v_cgst').html(resp['cgst']);
                    $('#cgst_sale').val(resp['cgst']);
                    $('#v_sgst').html(resp['sgst']);
                    $('#sgst_sale').val(resp['sgst']);
                    $('#v_igst').html(resp['igst']);
                    $('#igst_sale').val(resp['igst']);
                   
                    $('#hsn_code_covid').val(resp['hsn_covid']);
                    $('#hsn_heading_covid_charge').val(resp['hsn_covid_details']);

                    $('#hsn_code_res_charge').val(resp['hsn_r']);
                    $('#hsn_heading_res_charge').val(resp['hsn_r_details']);

                    $('#hsn_code_commercial_charge').val(resp['hsn_c']);
                    $('#hsn_heading_commercial_charge').val(resp['hsn_cc_details']);

                    $('#hsn_code_non_standard').val(resp['hsn_nc']);
                    $('#hsn_heading_non_standard').val(resp['hsn_nc_details']);

                    $('#hsn_code_non_stackable').val(resp['hsn_nsp']);
                    $('#hsn_heading_non_stackable').val(resp['hsn_nsp_details']);

                    $('#hsn_code_other_charges').val(resp['hsn_fc']);
                    $('#hsn_heading_other_charges').val(resp['hsn_fc_details']);
                    

                }
                
            }
        });
        
    }

    if (product_id != '') {
        var rate_class = "<?= $_GET['location'] ?>";
        var zone = $("#zone_lbl").val();
        var country = $("#consignee_country").find(':selected').data('value');  
        var actual_weight = $('#billing_weight').val();         
        var vendor_states = $('#vendor_states').val();         
        var sub_vendor_state = $('#sub_vendor_state').val();         
        $.ajax({
            type: 'POST',
            data: {
                'rate_class': rate_class,
                'zone': zone,
                'product_id': product_id,
                'customer_id': customer_id,
                'customer_id_type': customer_id_type,
                'actual_weight':actual_weight,
                'country': country,                
                'ship_type':ship_type,
                'vendor_states':vendor_states,
                'sub_vendor_state':sub_vendor_state
            },
            url: '<?php echo site_url('company/getOtherRatesProduct'); ?>',
            success: function(res) {
                if (res != '') {
                    var resp = JSON.parse(res);
                    if(resp['covin'] > 0){

                        $("#covid_charge").val(resp['covin']);
                    }else{

                        $("#covid_charge").val(0);
                    }

                    if(resp['res'] > 0){

                        $("#res_charge").val(resp['res']);
                    }else{

                        $("#res_charge").val(0);
                    }

                    if(commercial == 'commercial'){
                    if(resp['com'] > 0){

                        $("#com_charge").val(resp['com']);
                    }}else{

                        $("#com_charge").val(0);
                    }

                    if(resp['fulechage'] > 0) {
                         $("#fuel_surchargess").val(resp['fulechage']);
                         $("#fuel_surcharges_ps").html(resp['fulechage']);
                         $("#fuel_sale").val(resp['fulechage']);
                         $("#fuel_charge_amount_per").val(resp['fulechage']);
                    }else{

                         $("#fuel_surchargess").val(0);
                         $("#fuel_surcharges_ps").html(0);
                         $("#fuel_sale").val(0);
                         $("#fuel_charge_amount_per").val(0);
                    }

                    
                    if(resp['f_amount'] ==1){
                      $('#f_amount').val(resp['f_amount']);
                    }else{
                      $('#f_amount').val(0);  
                    }


                    if(resp['f_commercial'] ==1){
                      $('#f_commercial').val(resp['f_commercial']);
                    }else{
                      $('#f_commercial').val(0);  
                    }

                    if(resp['f_covid'] ==1){
                      $('#f_covid').val(resp['f_covid']);
                    }else{
                      $('#f_covid').val(0);  
                    }

                    if(ddp == 'DDP'){
                    if(resp['f_ddp'] == 1){
                      $('#f_ddp').val(resp['f_ddp']);
                    }}else{
                      $('#f_ddp').val(0);  
                    }

                     
                    if (stacakable == 'Non Stacakable') { 
                    if(resp['f_nonstakable'] ==1){
                      $('#f_nonstakable').val(resp['f_nonstakable']);
                    }}else{
                      $('#f_nonstakable').val(0);  
                    }

                    if(resp['f_oversize_d'] ==1){
                      $('#f_oversize_d').val(resp['f_oversize_d']);
                    }else{
                      $('#f_oversize_d').val(0);  
                    }


                    if(resp['f_oversize_w'] ==1){
                      $('#f_oversize_w').val(resp['f_oversize_w']);
                    }else{
                      $('#f_oversize_w').val(0);  
                    }

                    if(resp['f_restrictied'] == 1){
                      $('#f_restrictied').val(resp['f_restrictied']);
                    }else{
                      $('#f_restrictied').val(0);  
                    }
                 
                    $('#v_cgst2').html(resp['cgst']);
                    $('#cgst_vendor').val(resp['cgst']);
                    $('#v_sgst2').html(resp['sgst']);
                    $('#sgst_vendor').val(resp['sgst']);
                    $('#v_igst2').html(resp['igst']);
                    $('#igst_vendor').val(resp['igst']);
                    
                    $('#vendor_hsn_code_covid_charge').val(resp['hsn_covid']);
                    $('#vendor_hsn_heading_covid_charge').val(resp['hsn_covid_details']);
                    $('#vendor_hsn_code_res_charge').val(resp['hsn_r']);
                    $('#vendor_hsn_heading_res_charge').val(resp['hsn_r_details']);
                    $('#vendor_hsn_code_Commercial_Charge').val(resp['hsn_c']);
                    $('#vendor_hsn_heading_Commercial_Charge').val(resp['hsn_cc_details']);
                    $('#vendor_hsn_code_non_standard_Result').val(resp['hsn_nc']);
                    $('#vendor_hsn_heading_non_standard_Result').val(resp['hsn_nc_details']);
                    $('#vendor_hsn_code_non-stackable').val(resp['hsn_nsp']);
                    $('#vendor_hsn_heading_non-stackable').val(resp['hsn_nsp_details']);
                    $('#vendor_hsn_code_other_charges').val(resp['hsn_fc']);
                    $('#vendor_hsn_heading_other_charges').val(resp['hsn_fc_details']);

                   
                }
            }
        });
        
    }
}


function getBlulchange(){
        var product_id = $('#product_id').val();
        var customer_id = $('#customer_name').val();
        var vendor_id = $('#vendors_list').val();
        var customer_type = $('#customer_type').val();
        var sub_vendor_id = $('#sub_vendors_list').val();
        // var shiptype = $(this).find(':selected').attr('data');
        var ddu =$("input[name='ddu']:checked").val() ;
        var stacakable =$("input[name='stacakable']:checked").val();
              
        var ship_type = $('.ship_type:checked').val();
        var allvalue_W=[];
        $('.total_t_vwtt').each(function(){
            allvalue_W.push(this.value); 
        });
        // console.log(ddu);
        
        $.ajax({
            type: 'POST',
            data: {
                'product_id': product_id,
                'customer_id': customer_id,
                'allvalue_W':allvalue_W,
                'sub_vendor_id':sub_vendor_id,
                'vendor_id':vendor_id,
                'ship_type':ship_type,
                'customer_type':customer_type
            },
            url: '<?php echo site_url('company/getBlukCharge'); ?>',
            success: function(res) {
                
                $(".dimScreen").fadeOut();
                
                var resp = JSON.parse(res);

                
                $('.ext_weight_charge').val(resp.ext_weight_charge);
                $('.non_stackable_charge').val(resp.extra_dimensional_charge);
                $('.extra_dimensional').val(resp.extra_dimensional);
                
                
            $('.ddp_charge').val(resp.ddp_charge);
                if(ddu == 'DDP'){
                    console.log(resp.ddp_charge);
                }else{
                $('.ddp_charge').val('0');
                }

                if(stacakable === 'Non Stacakable'){
                $('.extra_dimensional_charge').val(resp.extra_dimensional_charge);
                }else{
                $('.extra_dimensional_charge').val('0');
                }
                
                
                
                
            }
        });

        $.ajax({
            type: 'POST',
            data: {
                'vendor_id': vendor_id,
                'sub_vendor_id':sub_vendor_id,
                'allvalue_W':allvalue_W,
                'ship_type':ship_type,
                'customer_type':customer_type
            },
            url: '<?php echo site_url('company/getBlukChargeVendor'); ?>',
            success: function(res) {
                $(".dimScreen").fadeOut();

                var resp = JSON.parse(res);
                
                $('.ext_weight_charge2').val(resp.ext_weight_charge);
                $('.extra_dimensional2').val(resp.extra_dimensional);
                $('.non_stackable_charge2').val(resp.extra_dimensional_charge);

                if(ddu == 'DDP'){
                $('.ddp_charge2').val(resp.ddp_charge);
                }else{
                $('.ddp_charge2').val('0');
                }

                if(stacakable === 'Non Stacakable'){
             
                $('.extra_dimensional_charge2').val(resp.extra_dimensional_charge);
                }else{
                $('.extra_dimensional_charge2').val('0');
                }

                sactual_weight_ = $('#sactual_weight').val();
            if (sactual_weight_ == "0" || sactual_weight_.trim() == "") {
                $('#weight_required').val('0');
            }else{
                $('#weight_required').val('1');
            }
                
            }
        });
    }

 $('body').on('change', '#unit_wid', function() {
        var unitVal = $(this).val();
        if (unitVal == 'cft') {
            $('.cftC').css('display', 'block');
        } else {
            $('.cftC').css('display', 'none');
        }
});
$(window).on('load',function(){
    var n = parseInt($("#total_pieces").val());
    var id = $('#booking_id').val();
    var unit_wid = $('#unit_wid').val();
    var divisor = $('#divisor').val();
    $.ajax({
        url: '<?= base_url('company/new_Pieces'); ?>',
        type:'post',
        data:{n:n,id:id,unit_wid:unit_wid,divisor:divisor},
        success:function(res){
            $('#vbooking_id').val(id);
            $("#weight_calculator").html(res);
            // $('.from_con').trigger('keyup');
        }
    })
})
$(document).on('input','#total_pieces',function(){    
        var n = parseInt($("#total_pieces").val());
        var id = $('#booking_id').val();
        var unit_wid = $('#unit_wid').val();        
        var divisor = $('#divisor').val();
        $.ajax({
            url: '<?= base_url('company/new_Pieces'); ?>',
            type:'post',
            data:{n:n,id:id},
            success:function(res){
                $('#vbooking_id').val(id);
                $("#weight_calculator").html(res);
                // $('.from_con').trigger('keyup');
            }
        })
    });

    $('#ddu,#stacakable').change(function() {
    getBlulchange();  
    othercharge();  
    
    priceCalculation();
    })


$(document).on('click','.copy-data',function(){ 
    var id = $(this).attr('id');
    var package_length = $('.package_length'+id).val();
    var package_width = $('.package_width'+id).val();
    var package_height = $('.package_height'+id).val();
    var vm =$('.vm'+id).val();
    var ac =$('.ac'+id).val();
    var total_t_vw =$('.total_t_vw'+id).val();
    $('.package_length'+(parseInt(id)+1)).val(package_length);
    $('.package_width'+(parseInt(id)+1)).val(package_width);
    $('.package_height'+(parseInt(id)+1)).val(package_height);
    $('.vm'+(parseInt(id)+1)).val(vm);
    $('.ac'+(parseInt(id)+1)).val(ac);
    $('.total_t_vw'+(parseInt(id)+1)).val(total_t_vw);
    $('.from_con').trigger('keyup');
})

$(document).on('keyup','.vendor_awb',function(){
    var data = $(this).val();
    $('.web_agent_awb_no').val(data);
})
$(document).on('click','.add_package',function(e){
e.preventDefault();
    var modaltype =  $(this).attr('modaltype'); 
    
        var unit_wid = $('#unit_wid').val();    
        var divisor = $('#divisor').val();
        var product_divisor = $('#product_divisor').val();
        var p_booking_id = $('#booking_id').val();
        
    var subvendor_id = $('#sub_vendors_list').val() || ''; 
    
        $.ajax({
        url: '<?= base_url('company/add_new_Pieces'); ?>',
        type:'post',
        data:{fetch:'f',booking_id:p_booking_id,modaltype:modaltype},
        success:function(res){
           $('#show_package').html(res);
            $('#modaltype').val(modaltype);
            $('#p_unit').val(unit_wid);

                // if (modaltype = 'vender') {
                //     $('#p_divisor').val(divisor);
                // }else{
                //     $('#p_divisor').val(product_divisor);
                // }

            $('#p_divisor').val(divisor);
            $('#pro_divisor').val(product_divisor);
            $('#p_booking_id').val(p_booking_id);
            $('.w_dimension').html(unit_wid);
            $('#myModal').modal('show');

            if(divisor != product_divisor){
                $('#package_form').trigger('reset');
            }

            if((divisor == product_divisor) && modaltype == 'vender'){
                $('#able_all').css('display','block');
                $('.disable_all').css('pointer-events','none');
            }else{
                $('#able_all').css('display','none');
                $('.disable_all').css('pointer-events','unset');
            }
        }
    })
    
    // alert(modaltype);
})

$('#able_all').click(function(e) {
        e.preventDefault();
        if (confirm("Are you sure you want to active this?")) {
            $('.disable_all').css('pointer-events','unset');
            $('#active_status').val('1');
        }else{
            $('.disable_all').css('pointer-events','none');

        }
    })


$(document).on('submit','#package_form',function(e){

    
    var a_weight = $('#weightkg_d').val();
    var heigher_weight_actual_volume_d = $('#heigher_weight_actual_volume_d').val();
    
if (a_weight != 0 && a_weight != '') { 
    $('#box_data_submit').show();
} 


    var length = $('#length_d').val();
    var width = $('#width_d').val();
    var height = $('#height_d').val();
    var volumetric_w = $('#volumetric_w_d').val();
    var active_status = $('#active_status').val();

    var ship_type = $('.ship_type:checked').val();
    var customer_id = $('#customer_name').val();
    var vendor_id = $('#vendors_list').val();
    var product_id = $('#product_id').val();
    
    var subvendor_id = $('#sub_vendors_list').val() || ''; 
    var customer_type = $('#customer_type').val(); 

    if (a_weight == 0 && length == 0 && height == 0 && width == 0 && volumetric_w == 0) {
        // $('#myModal').modal('hide');
        $('#package_form').trigger('reset');
        return false;
    }

    var total_pieces = parseInt($("#total_pieces").val());
    e.preventDefault();
    $.ajax({
        url: '<?= base_url('company/add_new_Pieces'); ?>',
        type:'post',
        data:$(this).serialize() + '&total_pieces=' + total_pieces + '&active_status=' + active_status + '&ship_type=' + ship_type + '&customer_id=' + customer_id  + '&vendor_id=' + vendor_id + '&product_id=' + product_id + '&customer_type=' + customer_type + '&subvendor_id=' + subvendor_id,

        success:function(res){
           $('#show_package').html(res);
           $('#package_form').trigger('reset');
           $('#weight_required').val('1');
        }
    })
}
)

function packageDelete(id, booking_id, type){ 
    var booking_id = $('#booking_id').val();
    var modaltype = $('#modaltype').val();
    var active_status = $('#active_status').val();


    $.ajax({
        url: '<?= base_url('company/add_new_Pieces'); ?>',
        type:'post',
        data:{delete:id,booking_id:booking_id,modaltype:modaltype,active_status:active_status,type:type},
        success:function(res){
           $('#show_package').html(res);
           
           var html = $('#show_package').html().trim();

if ($('#show_package').find('tr').length <= 1) {
    $('#box_data_submit').hide();
}



        }
    })
}

window.onload = function() {
        packageDeleteClear();
    };

function packageDeleteClear(){
    $.ajax({
        url: '<?= base_url('company/add_new_Pieces'); ?>',
        type:'post',
        data:{clear:'yes'},
        success:function(res){
           $('#show_package').html(res);
        }
    })
}

function packageCopy(id,type){
    var booking_id = $('#booking_id').val();
    var modaltype = $('#modaltype').val();
    var divisor = $('#divisor').val();
    var product_divisor = $('#product_divisor').val();
    var active_status = $('#active_status').val();

    var total_pieces = parseInt($("#total_pieces").val());
    $.ajax({
        url: '<?= base_url('company/add_new_Pieces'); ?>',
        type:'post',
        data:{copy:id,booking_id:booking_id,modaltype:modaltype,total_pieces:total_pieces,divisor:divisor,product_divisor:product_divisor,active_status:active_status,type:type},
        success:function(res){
            console.log(res);
           $('#show_package').html(res);
        }
    })
}

$(document).on('click','.update-package',function(){
    var id = $(this).attr('id');
    $('#showpack'+id).toggle().css('display','contents');
    $('#box_data_submit').css('display','none');
})


function packageUpdate(id,type){

    var a_weight   = $('#weightkg_d-'+id).val();
    var length = $('#length-'+id).val();
    var width = $('#width-'+id).val();
    var height = $('#hength-'+id).val();
    var booking_id = $('#booking_id').val();
    var unit_wid = $('#unit_wid').val();    
    var divisor = $('#divisor').val();
    var pro_divisor = $('#product_divisor').val();
    var modaltype = $('#modaltype').val();
    var weightkg_round = $('#weightkg_round-'+id).val();
    var volumetric_round = $('#volumetric_round-'+id).val();
    var result = $('#volumetric_result-'+id).val();
    var result1 = $('#weight_result-'+id).val();
    var active_status = $('#active_status').val();

    var ship_type = $('.ship_type:checked').val();
    var customer_id = $('#customer_name').val();
    var vendor_id = $('#vendors_list').val();
    var product_id = $('#product_id').val();
    var customer_type = $('#customer_type').val(); 
    var subvendor_id = $('#sub_vendors_list').val() || ''; 

    $.ajax({
        url: '<?= base_url('company/add_new_Pieces'); ?>',
        type:'post',
        data:{length:length,width:width,height:height,update:id,booking_id:booking_id,unit:unit_wid,divisor:divisor,a_weight:a_weight,modaltype:modaltype,volumetric_round:volumetric_round,weightkg_round:weightkg_round,active_status:active_status,result,result1,ship_type:ship_type,customer_id:customer_id,vendor_id:vendor_id,product_id:product_id,customer_type:customer_type,pro_divisor:pro_divisor,type:type,subvendor_id:subvendor_id},
        success:function(res){

           $('#show_package').html(res);
           $('#box_data_submit').css('display','block');
           
        }
    })
}

$(document).on('keyup','#weightkg_d',function(){

    var weightkg_d = $(this).val();
         weightkg_d = parseFloat(weightkg_d);

         weightkg_ds = weightkg_d.toFixed(2);
          if(parseFloat(weightkg_ds) >= parseFloat(parseInt(weightkg_ds)+'.1') && parseFloat(weightkg_ds) <= parseFloat(parseInt(weightkg_ds)+'.5')){
                var roundsss = parseFloat(parseInt(weightkg_ds)+'.5');
            } else {
                var roundsss = Math.round(weightkg_ds);
            }

     $('#weightkg_d_round').val(roundsss);
})

$(document).on('keyup','.update-click',function(){
    var box_id = $(this).attr('box-id');

     var weightkg_d = $('#weightkg_d-'+box_id).val();

         weightkg_d = parseFloat(weightkg_d);

         weightkg_ds = weightkg_d.toFixed(2);
          if(parseFloat(weightkg_ds) >= parseFloat(parseInt(weightkg_ds)+'.1') && parseFloat(weightkg_ds) <= parseFloat(parseInt(weightkg_ds)+'.5')){
                var roundsss = parseFloat(parseInt(weightkg_ds)+'.5');
            } else {
                var roundsss = Math.round(weightkg_ds);
            }

     $('#weightkg_round-'+box_id).val(roundsss);
})



$(document).on('keyup','.box-c',function(){
    var unit = $('#unit_wid').val();
   
    var weightkg_d = $('#weightkg_d').val();
    var modaltype = $('#modaltype').val();
    var weightkg_d_round = $('#weightkg_d_round').val();
    var length_d = $('#length_d').val();
    var width_d = $('#width_d').val();
    var height_d = $('#height_d').val();
    var volumetric_w_d = $('#volumetric_w_d').val();
    var heigher_weight_actual_volume_d = $('#heigher_weight_actual_volume_d').val();

    var ship_type = $('.ship_type:checked').val();
    var customer_id = $('#customer_name').val();
    var vendor_id = $('#vendors_list').val();
    var subvendor_id = $('#sub_vendors_list').val() || ''; 
    var product_id = $('#product_id').val();
    var customer_type = $('#customer_type').val(); 

    if (modaltype == 'vender') {
        var divisor = $('#divisor').val();
    }
    if(modaltype == 'saleweight'){
        var divisor = $('#product_divisor').val();
    }

    var weight =parseFloat(length_d)*parseFloat(width_d)*parseFloat(height_d)/parseFloat(divisor);
    if (unit == 'mm') {
        to_con = 0.1 * weight;
    } else if (unit == 'in') {
        to_con = 2.54 * weight;
    } else if (unit == 'ft') {
        to_con = 30.48 * weight;
    } else if (unit == 'cm') {
        to_con = 1 * weight;
    }

         to_con = parseFloat(to_con);
            var to_cons = to_con.toFixed(2);

          if(parseFloat(to_cons) >= parseFloat(parseInt(to_cons)+'.1') && parseFloat(to_cons) <= parseFloat(parseInt(to_cons)+'.5')){
                var roundsss = parseFloat(parseInt(to_cons)+'.5');
            } else {
                var roundsss = Math.round(to_cons);
            }

        if(to_con){
            $('#volumetric_w_d').val(to_con);
        }else{
            $('#volumetric_w_d').val('0');
        }

        if(roundsss){
             $('#volumetric_w_round').val(roundsss);
        }else{
            $('#volumetric_w_round').val('0');
        }
   
     // $('#volumetric_w_round').val(roundsss);

      if(parseFloat(weightkg_d_round) > parseFloat(roundsss)){
        $('#heigher_weight_actual_volume_d').val(weightkg_d_round);
    }else{
        $('#heigher_weight_actual_volume_d').val(roundsss);
    }

    $.ajax({
        url: '<?= base_url('company/CompanyDuplicate/result_show'); ?>',
        type:'post',
        data:{volumetric_w_round:roundsss,modaltype:modaltype,divisor:divisor,ship_type:ship_type,customer_id:customer_id,subvendor_id:subvendor_id,vendor_id:vendor_id,product_id:product_id,customer_type:customer_type,weightkg_w_round:weightkg_d_round,length:length_d,width:width_d,height:height_d},
        success:function(resp){
            var res = JSON.parse(resp);

            $('.final_result1').val(res.result1);
            $('.final_result2').val(res.result2);
            var maxValue = Math.max(
            parseFloat(res.result1) || 0,
            parseFloat(res.result2) || 0
        );
            $('.final_result6').val(maxValue);
           $('#final_result3').val(res.result3);
           $('#final_result4').val(res.result4);
           $('#final_result5').val(res.result5);
           $('#final_result7').val(res.final_result);

        }
    })


})

$(document).on('keyup', '#g_length, #g_width, #g_height', function () {

    let length  = parseFloat($('#g_length').val()) || 0;
    let width  = parseFloat($('#g_width').val()) || 0;
    let height = parseFloat($('#g_height').val()) || 0;

    let total = length + (2*width) + (2*height);
    $('#girth_total').val(total);



    $.ajax({
        url: '<?= base_url("company/CompanyDuplicate/result_show_girth"); ?>',
        type: 'POST',
        data: {
            total: total,
        },
        success: function (resp) {
            let res = JSON.parse(resp);

            // 🔥 DB ka result directly show karo
            $('#girth_result').val(res.result4);
        }
    });
});




$(document).on('keyup','.update-cal',function(){
    var box_id = $(this).attr('box-id');
    var weightkg_d = $('#weightkg_d-'+box_id).val();

    weightkg_d = parseFloat(weightkg_d);

weightkg_ds = weightkg_d.toFixed(2);
 if(parseFloat(weightkg_ds) >= parseFloat(parseInt(weightkg_ds)+'.1') && parseFloat(weightkg_ds) <= parseFloat(parseInt(weightkg_ds)+'.5')){
       var roundsss = parseFloat(parseInt(weightkg_ds)+'.5');
   } else {
       var roundsss = Math.round(weightkg_ds);
   }

$('#weightkg_round-'+box_id).val(roundsss);
});

$(document).on('keyup','.update-cal',function(){
    
    var unit = $('#unit_wid').val();

    var box_id = $(this).attr('box-id');
    var weightkg_d = $('#weightkg_d-'+box_id).val();
    var length_d = $('#length-'+box_id).val();
    var width_d = $('#width-'+box_id).val();
    var height_d = $('#hength-'+box_id).val();
    var volumetric_w_d = $('#volumetric_w'+box_id).val();
    var heigher_weight_actual_volume_d = $('#heigher_weight_actual_volume_d'+box_id).val();
    var volumetric_type = $('#volumetric_type-'+box_id).val();
    var divisor = $('#divisor').val();
    var weight =parseFloat(length_d)*parseFloat(width_d)*parseFloat(height_d)/parseFloat(divisor);
    $('#volumetric_w-'+box_id).val(weight);
    var weightkg_d_round = $('#weightkg_round-'+box_id).val();

    var ship_type = $('.ship_type:checked').val();
    var customer_id = $('#customer_name').val();
    var vendor_id = $('#vendors_list').val();
    var subvendor_id = $('#sub_vendors_list').val() || ''; 
    var product_id = $('#product_id').val();
    var customer_type = $('#customer_type').val(); 


    if (unit == 'mm') {
        to_con = 0.1 * weight;
    } else if (unit == 'in') {
        to_con = 2.54 * weight;
    } else if (unit == 'ft') {
        to_con = 30.48 * weight;
    } else if (unit == 'cm') {
        to_con = 1 * weight;
    }
        to_con = parseFloat(to_con);
        var to_cons = to_con.toFixed(2);

        if(parseFloat(to_cons) >= parseFloat(parseInt(to_cons)+'.1') && parseFloat(to_cons) <= parseFloat(parseInt(to_cons)+'.5')){
            var roundsss = parseFloat(parseInt(to_cons)+'.5');
        } else {
            var roundsss = Math.round(to_cons);
        }

        if(to_con){
            $('#volumetric_w-'+box_id).val(to_con);
        }else{
            $('#volumetric_w-'+box_id).val('0');
        }

        if(roundsss){
             $('#volumetric_round-'+box_id).val(roundsss);
        }else{
            $('#volumetric_round-'+box_id).val('0');
        }

        if(parseFloat(weightkg_d_round) > parseFloat(roundsss)){
            $('#heigher_weight_actual_volume_d-'+box_id).val(weightkg_d_round);
        }else{
            $('#heigher_weight_actual_volume_d-'+box_id).val(roundsss);
        }

   
        
        $.ajax({
        url: '<?= base_url('company/result_show'); ?>',
        type:'post',
        data:{volumetric_w_round:roundsss,modaltype:volumetric_type,divisor:divisor,ship_type:ship_type,customer_id:customer_id,subvendor_id:subvendor_id,vendor_id:vendor_id,product_id:product_id,weightkg_w_round:weightkg_d_round,customer_type:customer_type,length:length_d,width:width_d,height:height_d},
        success:function(resp){
            var res = JSON.parse(resp);
            $('#volumetric_result-'+box_id).val(res.result);
            $('.claue_number').html(res.type);
           
        },
    })

})



// $(document).on('keyup','.update-cal',function(){
    
//     var unit = $('#unit_wid').val();
    
//     var box_id = $(this).attr('box-id');
//    var weightkg_d = $('#weightkg_d-'+box_id).val();
//    var modaltype = $('#modaltype').val();
//    var weightkg_d_round = $('#weightkg_round-'+box_id).val();
//    var length_d = $('#length_d-'+box_id).val();
//    var width_d = $('#width_d-'+box_id).val();
//    var height_d = $('#height_d-'+box_id).val();
//    var volumetric_w_d = $('#volumetric_w_d-'+box_id).val();
//    var volumetric_w_round = $('#volumetric_w_round-'+box_id).val();
//    var heigher_weight_actual_volume_d = $('#heigher_weight_actual_volume_d-'+box_id).val();

//    if (modaltype == 'vender') {
//        var divisor = $('#divisor').val();
//    }
//    if(modaltype == 'saleweight'){
//        var divisor = $('#product_divisor').val();
//    }

//    var weight = parseFloat(length_d)*parseFloat(width_d)*parseFloat(height_d)/parseFloat(divisor);
//    if (unit == 'mm') {
//        to_con = 0.1 * weight;
//    } else if (unit == 'in') {
//        to_con = 2.54 * weight;
//    } else if (unit == 'ft') {
//        to_con = 30.48 * weight;
//    } else if (unit == 'cm') {
//        to_con = 1 * weight;
//    }

//         to_con = parseFloat(to_con);
//     var to_cons = to_con.toFixed(2);

//          if(parseFloat(to_cons) >= parseFloat(parseInt(to_cons)+'.1') && parseFloat(to_cons) <= parseFloat(parseInt(to_cons)+'.5')){
//                var roundsss = parseFloat(parseInt(to_cons)+'.5');
//            } else {
//                var roundsss = Math.round(to_cons);
//            }

//        if(to_con){
//            $('#volumetric_w_d-'+box_id).val(to_con);
//        }else{
//            $('#volumetric_w_d-'+box_id).val('0');
//        }

//        if(roundsss){
//             $('#volumetric_w_round-'+box_id).val(roundsss);
//        }else{
//            $('#volumetric_w_round-'+box_id).val('0');
//        }
  
//     // $('#volumetric_w_round').val(roundsss);

//      if(parseFloat(weightkg_d_round) > parseFloat(roundsss)){
//        $('#heigher_weight_actual_volume_d-'+box_id).val(weightkg_d_round);
//    }else{
//        $('#heigher_weight_actual_volume_d-'+box_id).val(roundsss);
//    }
// })


</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// $(document).on('change', '.image-input', function (event) {
//     const file = event.target.files[0]; // Get the selected file
//     const index = $(this).data('index'); // Get the index from the data attribute
//     const preview = $(`.preview_image_${index}`); // Get the corresponding preview image element

//     if (file) {
//         const reader = new FileReader();

//         reader.onload = function (e) {
//             preview.attr('href', e.target.result); // Set the preview image source
//             preview.show(); // Show the preview image
//         };

//         reader.readAsDataURL(file); // Read the file as a data URL
//     } else {
//         preview.attr('href', ''); // Clear the src if no file is selected
//         preview.hide(); // Hide the preview image
//     }
// });

$(document).on('change', '.image-input', function (event) {
    const file = event.target.files[0]; // Get the selected file
    const index = $(this).data('index'); // Get the index from the data attribute
    const preview = $(`.preview_image_${index}`); // Get the corresponding preview anchor tag

    if (file) {
        // Check if the selected file is an image

            const blobUrl = URL.createObjectURL(file); // Create a Blob URL for the file

            preview.attr('href', blobUrl); // Set the href to the Blob URL
            preview.show(); // Show the anchor tag with the preview

    } else {
        preview.attr('href', ''); // Clear the href if no file is selected
        preview.hide(); // Hide the anchor tag
    }
});


$(document).ready(function() {
    
    $('#hsn-cat').trigger('change');
    // Function to add a new row


        $(document).on('change', '.hsn-cat', function() {
        var hsnCatId = $(this).data('id');
        var Id = $('#hsn-cat'+hsnCatId).val();
        
        if (Id) {
            $.ajax({
                url: '<?= base_url("company/fetchHsnCodes"); ?>', 
                type: 'POST',
                data: { Id: Id },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#hsn-details' + hsnCatId).html(response.details);
                    $('#hsn-code' + hsnCatId).val(response.code);
                    $('#hsn-details'+hsnCatId).trigger('change');
                }
            });
    } else {
        $('#hsn-details' + hsnCatId).html('<option value="">Select</option>');
        $('#hsn-code' + hsnCatId).val('');
    }
});


        
    $(document).on('change', '.hsn-details', function() {
        
        var hsnCatId = $(this).data('id');
        var Id = $('#hsn-details'+hsnCatId).val();
        
        if (Id) {
            $.ajax({
                url: '<?= base_url("company/fetchHsnCodeshsn"); ?>', 
                type: 'POST',
                data: { Id: Id },
                success: function(response) {
                    console.log(response);
                    $('#hsn-code' + hsnCatId).val(response);
                }
            });
    } else {
        $('#hsn-code' + hsnCatId).val('');
    }
});

$(document).on('click', '#save_changes_all', function() {
    $.ajax({
        url: '<?= base_url("company/savedate"); ?>', 
        type: 'POST',
        success: function(response) {
            console.log('success');
            location.reload();
        }
    });
});


$(document).on('click keyup', '.rate_hsn, .quantity_hsn', function() {
    var hsnCatId = $(this).data('id');
    
    var rateElement = $('#rate_hsn' + hsnCatId);
    var quantityElement = $('#quantity_hsn' + hsnCatId);
    var amountElement = $('#amount_hsn' + hsnCatId);
    console.log(hsnCatId);
    

    amountElement.val('0');
    var rate = rateElement.val();
    var quantity = quantityElement.val();

    var total = rate * quantity;
    amountElement.val(total);
});


    $(document).on('click', '.add-row1', function() {
        // Find the highest current box number
        var maxBoxNumber = 1;
        $('.box-number').each(function() {
            var currentBoxNumber = parseInt($(this).val()) || 1;
            if (currentBoxNumber > maxBoxNumber) {
                maxBoxNumber = currentBoxNumber;
            }
        });
        maxBoxNumber++;
        // Increment the highest box number
        var nextBoxValue = maxBoxNumber ;

        var newRowHtml = '<div class="added-row m-0" id="' + nextBoxValue + '">'+
                            '<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">' +
                                '<div class="form-group d-flex align-items-center">' +
                                    '<label class="w-100 text-center" for="">Box No.</label>' +
                                    '<input type="number" class="form-control box-number" readonly name="box[' + nextBoxValue + '][box_no][]" value="' + nextBoxValue + '">' +
                                '</div>' +
                            '</div>' +
                            '<div class="row-1 m-0">' +
                            '<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">' +
                                '<div class="form-group">' +
                                    '<label for=""> Category <span class="required" aria-required="true">*</span></label>' +
                                    '<select class="form-control hsn-cat" id="hsn-cat' + nextBoxValue + '" data-id="' + nextBoxValue + '"  name="box[' + nextBoxValue + '][hsncat][]">' +
                                        '<option value="">Select</option><?= $hsncatss?></select>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">' +
                                '<div class="form-group">' +
                                    '<label for="">Sub Category<span class="required" aria-required="true">*</span></label>' +
                                    '<select class="form-control empty_all_data shipment-type hsn-details" data-id="' + nextBoxValue + '" id="hsn-details' + nextBoxValue + '" name="box[' + nextBoxValue + '][sub_category][]">' +
                                        '<option value="">Select</option>' +
                                        '<!-- Your options here -->' +
                                    '</select>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                                '<div class="form-group">' +
                                    '<label for="">HSN Code</label>' +
                                    '<input readonly type="text" class="form-control empty_all_data hsn-code" id="hsn-code' + nextBoxValue + '" name="box[' + nextBoxValue + '][hsn_code][]" >'+
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                                '<div class="form-group">' +
                                    '<label for="">Type</label>' +
                                    '<select class="form-control validate[required] type" name="box[' + nextBoxValue + '][type][]" id="type">'+
                                        '<?= $type_hsn?>'+
                                    '</select>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                                '<div class="form-group">' +
                                    '<label for="">Rate</label>' +
                                    '<input type="text" class="form-control empty_all_data rate_hsn" name="box[' + nextBoxValue + '][rate][]" value="0" id="rate_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" > ' +
                                '</div>' +
                            '</div>' +
                        
                            '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                                '<div class="form-group">' +
                                    '<label for="">Quantity</label>' +
                                    '<input type="text" class="form-control quantity_hsn" name="box[' + nextBoxValue + '][quantity][]" value="0" id="quantity_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">' +
                                '<div class="form-group">' +
                                    '<label for="">Amount<span class="required" aria-required="true">*</span></label>' +
                                    '<input type="text" readonly class="form-control amount_hsn" name="box[' + nextBoxValue + '][amount][]" value="0" id="amount_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">' +
                                '<div class="form-group">' +
                                    '<input type="text" class="form-control cat_main" name="box[' + nextBoxValue + '][hsncat_manually][]" placeholder ="add Category" value="" id="amount_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">' +
                                '<div class="form-group">' +
                                    '<input type="text" placeholder ="add SubCategory" class="form-control hsn_main" name="box[' + nextBoxValue + '][sub_category_manually][]" value="" id="amount_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" >' +
                                '</div>' +
                            '</div>' +
                                '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">'+
                                    '<div class="form-group">'+
                                    '<input type="text" class="form-control empty_all_data hsn-code" id="hsn-codea' + nextBoxValue + '" name="box[' + nextBoxValue + '][hsn_code_manually][]">'+
                                '</div>'+
                            '</div>'+
                           '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                            '<div class="form-group">' +
                               '<input type="text" class="form-control empty_all_data hsn-code" id="type_manually' + nextBoxValue + '" name="box[' + nextBoxValue + '][type_manually][]">'+
                            '</div>' +
                        '</div>' +
                            '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">'+
                               ' <div class="form-group">'+
                                   ' <input type="text" class="form-control empty_all_data rate_hsn" data-id ="a' + nextBoxValue + '"  name="box[' + nextBoxValue + '][rate_manually][]" value="0" id="rate_hsna' + nextBoxValue + '">'+
                               ' </div>'+
                            '</div>'+
                       ' <div class="col-xl-1 col-lg-1 col-md-2 col-sm-1">'+
                           ' <div class="form-group">'+
                              '  <input type="text" class="form-control empty_all_data quantity_hsn" data-id ="a' + nextBoxValue + '"  name="box[' + nextBoxValue + '][quantity_manually][]" value="0" id="quantity_hsna' + nextBoxValue + '">'+
                            '</div>'+
                        '</div>'+
                       ' <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">'+
                            '<div class="form-group">'+
                                '<input type="text" readonly class="form-control empty_all_data amount_hsn" data-id ="a' + nextBoxValue + '"  id="amount_hsna' + nextBoxValue + '" name="box[' + nextBoxValue + '][amount_manually][]" value="0">'+
                            '</div>'+
                        '</div>'+
                            '<div class="mb-3">' +
                                '<div class="form-group">' +
                                    '<button type="button" id="incrementBtn" class="btn btn-primary add-row"  data-box="' + nextBoxValue + '">Add Row</button>' +
                                    '<button type="button" class="btn btn-danger delete-row" data-id="' + nextBoxValue + '" >Delete All</button>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<hr>';
                        '</div>' +

                        $('#dynamic-rows-container').append(newRowHtml);

$('#dynamic-rows-container').find('.box-number').on('input', function() {
    var boxValue = $(this).val();
    $(this).closest('.added-row').find('.amount_hsn').val(boxValue);
});
    });

    $(document).on('click', '.delete-row', function() {
    var id = $(this).data('id');
    var amount = parseFloat($('#amount_hsn' + id).val()) ;

    var currentTotal = parseFloat($('#total_amount').text()) ;
    var newTotal = currentTotal - amount;

$('#total_amount').text(newTotal.toFixed(2));
    $('.added-row').each(function() {
        if ($(this).find('.delete-row').data('id') === id) {
            $(this).remove();
        }
    });
});
    
});


    

</script>

<script>



$(document).ready(function() {
    var maxBoxNumber = 1;
    var boxCounter = 1;
    var existingBoxNumbers = [];
    $(document).on('click', '.add-row', function() {
    $('.box-number').each(function() {
            var currentBoxNumber = parseInt($(this).val()) || 1;
            if (currentBoxNumber > maxBoxNumber) {
                maxBoxNumber  = currentBoxNumber;
            }
        });
        var boxNumber = $(this).data('box'); 

        maxBoxNumber++;
        var nextBoxValue = ('00' + boxNumber + maxBoxNumber).slice(-3); 



// alert(nextBoxValue);
    var newRowHtml = '<div class="row-1 added-row m-0" id="added-row'+ nextBoxValue +'">' +
                        '<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">' +
                            '<input type="hidden" class="form-control" name="box[' + nextBoxValue + '][box_no][]" value="' + boxNumber + '">' +
                            '<div class="form-group">' +
                                '<label for=""> Category <span class="required" aria-required="true">*</span></label>' +
                                '<select class="form-control hsn-cat" id="hsn-cat' + nextBoxValue + '" data-id="' + nextBoxValue + '" name="box[' + nextBoxValue + '][hsncat][]">' +
                                    '<option value="">Select</option><?= $hsncatss?></select>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">' +
                            '<div class="form-group">' +
                                '<label for="">Sub Category <span class="required" aria-required="true">*</span></label>' +
                                '<select class="form-control empty_all_data hsn-details" data-id="' + nextBoxValue + '"  id="hsn-details' + nextBoxValue + '" name="box[' + nextBoxValue + '][sub_category][]">' +
                                    '<option value="">Select</option>' +
                                    '<!-- Your options here -->' +
                                '</select>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                            '<div class="form-group">' +
                                '<label for="">HSN Code</label>' +
                                '<input type="text" readonly class="form-control empty_all_data hsn-code" id="hsn-code' + nextBoxValue + '" name="box[' + nextBoxValue + '][hsn_code][]">'+
                            '</div>' +
                        '</div>' +
                        '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                            '<div class="form-group">' +
                                '<label for="">Type</label>' +
                               '<select class="form-control validate[required] type" name="box[' + nextBoxValue + '][type][]" id="type">'+
                                    '<?= $type_hsn?>'+
                                '</select>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                            '<div class="form-group">' +
                                '<label for="">Rate</label>' +
                                '<input type="text" class="form-control empty_all_data rate_hsn" name="box[' + nextBoxValue + '][rate][]" value="0" id="rate_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" > ' +
                            '</div>' +
                        '</div>' +
                        
                            '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                                '<div class="form-group">' +
                                    '<label for="">Quantity</label>' +
                                    '<input type="text" class="form-control quantity_hsn" name="box[' + nextBoxValue + '][quantity][]" value="0" id="quantity_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">' +
                                '<div class="form-group">' +
                                    '<label for="">Amount<span class="required" aria-required="true">*</span></label>' +
                                    '<input type="text" readonly class="form-control amount_hsn" name="box[' + nextBoxValue + '][amount][]" value="0" id="amount_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">' +
                                '<div class="form-group">' +
                                    '<input type="text" class="form-control cat_main" name="box[' + nextBoxValue + '][hsncat_manually][]" placeholder ="add Category" value="" id="amount_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">' +
                                '<div class="form-group">' +
                                    '<input type="text" placeholder ="add SubCategory" class="form-control hsn_main" name="box[' + nextBoxValue + '][sub_category_manually][]" value="" id="amount_hsn' + nextBoxValue + '" data-id="' + nextBoxValue + '" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">'+
                                    '<div class="form-group">'+
                                    '<input type="text" class="form-control empty_all_data hsn-code" id="hsn-codea' + nextBoxValue + '" name="box[' + nextBoxValue + '][hsn_code_manually][]">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">' +
                            '<div class="form-group">' +
                               '<input type="text" class="form-control empty_all_data hsn-code" id="type_manually' + nextBoxValue + '" name="box[' + nextBoxValue + '][type_manually][]">'+
                            '</div>' +
                        '</div>' +
                            '<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">'+
                               ' <div class="form-group">'+
                                   ' <input type="text" class="form-control empty_all_data rate_hsn" data-id ="a' + nextBoxValue + '"  name="box[' + nextBoxValue + '][rate_manually][]" value="0" id="rate_hsna' + nextBoxValue + '">'+
                               ' </div>'+
                            '</div>'+
                       ' <div class="col-xl-1 col-lg-1 col-md-2 col-sm-1">'+
                           ' <div class="form-group">'+
                              '  <input type="text" class="form-control empty_all_data quantity_hsn" data-id ="a' + nextBoxValue + '"  name="box[' + nextBoxValue + '][quantity_manually][]" value="0" id="quantity_hsna' + nextBoxValue + '">'+
                            '</div>'+
                        '</div>'+
                       ' <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">'+
                            '<div class="form-group">'+
                                '<input type="text" readonly class="form-control empty_all_data amount_hsn" data-id ="a' + nextBoxValue + '"  id="amount_hsna' + nextBoxValue + '" name="box[' + nextBoxValue + '][amount_manually][]" value="0">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 mb-3">' +
                            '<div class="form-group">' +
                                '<button type="button" class="btn btn-danger delete-row"  id ="added-row' + nextBoxValue + '" data-id="' + nextBoxValue + '" >Delete</button>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

    $(this).closest('.form-group').parent().prepend(newRowHtml);


});


$(document).ready(function () {
    // Add new document row
    $(document).on('click', '.add-document-row', function () {
        var rowIndex = $('.document-row').length;
        // alert(rowIndex);
        var newRowHtml = `
        <div class="document-row">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="form-group">
                      <label for="">Select Document Type</label>
                        <select name="kyc_files_type[]" class="form-control">
                            <option value="">Select Document Type</option>
                            <?php 
                            if (!empty($kycs)) {
                                foreach ($kycs as $key => $kyc) {
                            ?>
                            <option value="<?= $kyc['id'] ?>"><?= $kyc['name'] ?></option>
                            <?php
                                } 
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 pl-0 col-12">
                    <div class="form-group">
                        <label for="">Document No</label>
                        <input type="text" name="kyc_doc_no[]" class="form-control mt-4" placeholder="Document Number" />
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="form-group">
                     <label for="">File</label>
                        <input type="file" name="kyc_files[]" class="form-control image-input mt-4" data-index="${rowIndex}" />
                    </div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12 mt-5">
               
                 <a class="preview_image preview_image_${rowIndex}" href="" target="_blank" style="display: none; font-size: 20px;">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-left mb-3">
                    <button type="button" class="btn btn-danger remove-document-row">Remove</button>
                </div>
            </div>
        </div>`;

        $('.document-container').append(newRowHtml);
    });

    // Remove document row
    $(document).on('click', '.remove-document-row', function () {
        $(this).closest('.document-row').remove();
    });
});




$(document).on('click keyup', '.delete-row', function() {
    var id = $(this).data('id');
    var sum = 0;

    $('.added-row').each(function() {
        if ($(this).find('.delete-row').data('id') === id) {
            $(this).remove(); 
        }
    });

    $('.amount_hsn').each(function() {
        let value = parseFloat($(this).val()) || 0; 
        sum += value; 
    });

    $('#total_amount').text(sum.toFixed(2)); 
});





});

$(document).ready(function() {
    $(document).on('click keyup', '.rate_hsn, .quantity_hsn', function() {
        let sum = 0;

        $('.amount_hsn').each(function() {
            let value = parseFloat($(this).val()) || 0; 
            sum += value;
        });

        $('#total_amount').text(sum.toFixed(2));
    });
});





</script>
<script>
    document.querySelectorAll('.content_All_location').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('location', this.value);
                window.location.href = newUrl.toString();
            }
        });
    });
</script>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- <script>
 function fetchHsnCodes() {
                $.ajax({
                    url: '<?= base_url("company/fetchHsnCodes"); ?>',
                    type: 'GET',
                    dataType: 'json', 
                    success: function(response) {
                       
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status, error);
                    }
                });
            }
</script> -->


<script>
           
           //SET VALUE
    $(document).ready(function () {
     setTimeout(function () {
        let customer_id = $('#customer_name').val();
        let type = $('#customer_type').val();

        if (customer_id) {
            <?php if(empty($_GET['id'])){ ?>
            $.ajax({
                url: 'company/matchAwsData',
                type: 'POST',
                data: { customer_id: customer_id, type: type },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        console.log(response);
                        $('#awb_no').val(response.new_aws); 
                        if (response.new_aws == null) {
                            $('#aws_msg').html(`No AWB number found. Please enter an AWB number on the AWB screen or type it manually.`);
                        }
                    } else {
                        console.log(response);
                        alert(response.message);
                    }
                },
            });
            <?php } ?>
        }
    }, 8000);

});

     //SET VALUE



        $(document).on('change', '#customer_name,#customer_type', function () {
            $('#aws_msg').html(''); 
            $('#weight_required').val('0');
            $('#product_id').val('');
            let customer_id = $('#customer_name').val();
            let type = $('#customer_type').val();
            <?php if(empty($_GET['id'])){ ?>
            $.ajax({
                url: 'company/matchAwsData',
                type: 'POST',
                data: { customer_id: customer_id,type:type },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                     console.log(response);
                        $('#awb_no').val(response.new_aws); 
                        if (response.new_aws == null) {
                            $('#aws_msg').html(`No AWB number found. Please enter an AWB number on the AWB screen or type it manually.`);
                        }

                    } else {
                        console.log(response);
                        
                        alert(response.message);
                    }
                },
            });
         <?php } ?>
        }); 

        // $(document).on('click', '#awb_no', function () {
        //     let awb_no = $(this).val();
        //     $.ajax({
        //         url: 'company/matchAwsmanually',
        //         type: 'POST',
        //         data: { awb_no: awb_no },
        //         dataType: 'json',
        //         success: function (response) {
        //             if (response.status === 'success') {
        //                 $('#awb_no').val(response.new_aws); 
        //             } else {
        //                 alert(response.message);
        //             }
        //         },
        //     });
        // }); 

        $(document).on('blur keyup', '#awb_no', function () { 
            let awb_no = $(this).val().trim();
            if (awb_no === '') {
                $('#aws_msg').html('Please enter a valid AWB number.'); 
                return;
            }

            $.ajax({
                url: 'company/matchAwsmanually',
                type: 'POST',
                data: { awb_no: awb_no },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        $('#aws_msg').html(''); 
                    } else if (response.status === 'error') {
                        console.log(response);

                        if (response.company_name == '' && response.type == '') {
                        $('#aws_msg')
                            .html(`Duplicate AWB number found, but no further details are available.`);
                    } else {
                        $('#aws_msg')
                            .html(`Duplicate AWB number. Used by:- ${response.company_name} And Type:- ${response.type}`);
                    }

                        // $('#aws_msg').html(`Duplicate AWB number. Used by:- ${response.company_name} And Type:- ${response.type}`);
                    }
                }
            });
        });


        $(document).on('click keyup', '#manually_calculate', function () {
            if (confirm('Are you sure you want to proceed?')) {
                $('#manually_fuel_get').val(1);
                $('.manually_sale').css({
                        'pointer-events': 'unset',
                        'background': '#fff'
                    });
                $('.manually_calculate_box').after('<button type="button" class="btn btn-danger  float-right mr-2" id="manually_cancel" >Cancel</button>');
                $('#fuel_sale').val(0);
                $('#f_amount').val(0);
                $('#f_covid').val(0);
                $('#f_restrictied').val(0);
                $('#f_ddp').val(0);
                $('#f_oversize_w').val(0);
                $('#f_oversize_d').val(0);
                $('#f_nonstakable').val(0);
                $('#f_commercial').val(0);
                $('#active_status').val(0);

                $(this).prop('disabled', true);
            }
        });

        $(document).on('click keyup', '#manually_cancel', function () {
            if (confirm('Are you sure you want to proceed?')) {
                $('#manually_fuel_get').val(0);
                $('.manually_sale').css({
                        'pointer-events': 'none',
                        'background': '#c7c9cb'
                    });
                $('#manually_cancel').remove();
                $('#manually_calculate').prop('disabled', false);
            }
        });

        $(document).on('click keyup', '#manually_calculate2', function () {
            if (confirm('Are you sure you want to proceed?')) {
                $('#manually_fuel_get2').val(1);
                $('.manually_vendor').css({
                        'pointer-events': 'unset',
                        'background': '#fff'
                    });
                $('#manually_calculate_box2').after('<button type="button" class="btn btn-danger  float-right mr-2" id="manually_cancel2" >Cancel</button>');

                $('#f_amount_v').val(0);
                $('#f_covid_v').val(0);
                $('#f_covid_v').val(0);
                $('#f_restrictied_v').val(0);
                $('#f_ddp_v').val(0);
                $('#f_oversize_w_v').val(0);
                $('#f_oversize_d_v').val(0);
                $('#f_nonstakable_v').val(0);
                $('#f_commercial_v').val(0);

                $(this).prop('disabled', true);
            }
        });
        
        $(document).on('click keyup', '#manually_cancel2', function () {
            if (confirm('Are you sure you want to proceed?')) {
                $('#manually_fuel_get2').val(0);
                $('.manually_vendor').css({
                    'pointer-events': 'none',
                    'background': '#c7c9cb'
                });
                $('#manually_cancel2').remove();
                $('#manually_calculate2').prop('disabled', false);
            }
        });
        
        // $(document).on('click', '.hsn_code_button', function () {
        //     var booking_id = $('#booking_id').val();
        //      $('#booking_id_hsn').val(booking_id);
        //      $(this).prop('disabled', true);
            
        // });
           

        $('#customer_name, #product_id').on('change', function () {
            let selectedValue = $('#customer_name').val(); // Get the value of the selected option

    $.ajax({
        url: 'company/getCompanyPaymentMode', // Update URL if necessary
        type: 'POST',
        data: { customer_id: selectedValue },
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                let paymentMode = response.data; // Get the payment mode from the response
                $('select[name="payment_mode"]').val(paymentMode); // Set the value dynamically
            } else {
                alert('Failed to fetch payment mode.');
                console.log(response);
            }
        },
        error: function (xhr, status, error) {
            alert('An error occurred: ' + error);
            console.log(xhr, status, error);
        }
    });
    $('#base_amount').val(0);
    $('#fuel_surcharge').val(0);
});


$(document).ready(function() {
    $("#newMaster").on("submit", function(e) {
        let sactualWeight = $("#weight_required").val();
        
        if (sactualWeight == "0" || sactualWeight.trim() == "") {
            e.preventDefault(); // Form submit hone se rokna
            alert("Please add Weight"); // Alert dikhana
            
            // Smooth scrolling to input field
            $("html, body").animate({
                scrollTop: $("#total_pieces").offset().top - 50
            }, 1000);
        }
    });
});



</script>



<?php if (isset($_GET['id'])) { ?>
<script>
$(document).ready(function() {
    // Fetch values from elements with given IDs
    let fuel_sale = $('#fuel_sale').val();
    let cgst_sale = $('#cgst_sale').val();
    let sgst_sale = $('#sgst_sale').val();
    let igst_sale = $('#igst_sale').val();
    let fuel_vendor = $('#fuel_vendor').val();
    let cgst_vendor = $('#cgst_vendor').val();
    let sgst_vendor = $('#sgst_vendor').val();
    let igst_vendor = $('#igst_vendor').val();

    // Set values to respective elements
    $('#fuel_surcharges_ps').text(fuel_sale);
    $('#v_cgst').text(cgst_sale);
    $('#v_sgst').text(sgst_sale);
    $('#v_igst').text(igst_sale);
    $('#fuel_surcharges_ps2').text(fuel_vendor);
    $('#v_cgst2').text(cgst_vendor);
    $('#v_sgst2').text(sgst_vendor);
    $('#v_igst2').text(igst_vendor);



    var selectedCountry = "<?php echo isset($booking_c['country']) ? $booking_c['country'] : ''; ?>";

    var booking_id = $('#booking_id').val();

    var vendor_id = $('#vendors_list').val();
        var ship_type = $('.ship_type:checked').val();
        $.ajax({
            type: 'POST',
            data: {
                'ship_type':ship_type,'vendor_id':vendor_id,'booking_id':booking_id
            },
            url: '<?php echo site_url('company/get_consignee_country'); ?>',
            success: function(resp) { 
               
                $('#consignee_country').html(resp);
               
            }
        });

        $.ajax({
            type: 'POST',
            data: {
                'ship_type':ship_type,'vendor_id':vendor_id,'booking_id':booking_id
            },
            url: '<?php echo site_url('company/get_actual_shiper_country'); ?>',
            success: function(resp) { 
                $('#actual_shiper_country').html(resp);
               
               
            }
        });
});
</script>
<?php } ?>

<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success')): ?>
            toastr.success("<?= $this->session->flashdata('success'); ?>");
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            toastr.error("<?= $this->session->flashdata('error'); ?>");
        <?php endif; ?>
    });

    $(document).ready(function(){
    $('.dgrcargo').change(function(){
        if ($(this).is(':checked')) {
            // let fields = [
            //     '#base_amount', '#covid_charge', '#res_charge', '#com_charge',
            //     '#non_stnd_weight_oversize_amount_cl', '#ddp_charge', '#extra_dimensional_charge',
            //     '#other_charge', '#other_charge_without', '#service_charge',
            //     '#service_charge3', '#p_total', '#base_amount2' , '#covid_charge2' , '#res_charge2', '#com_charge2', '#vendor_non_stnd_weight_oversize_amount_new', '#ddp_charge2', '#extra_dimensional_charge2', '#other_charge2', '#other_charge_without','#service_charge2', '#service_charge4', '#p_total3' 
            // ];
            
            // $('#manually_fuel_get').val(1);
            // $('#manually_fuel_get2').val(1);
            
            // $(fields.join(', ')).val(0).css({
            //     'background-color': '#FFF',
            //     'pointer-events': 'unset'
            // });

            $('#manually_fuel_get').val(1);
                $('.manually_sale').css({
                        'pointer-events': 'unset',
                        'background': '#fff'
                    });
                // $('.manually_calculate_box').after('<button type="button" class="btn btn-danger  float-right mr-2" id="manually_cancel" >Cancel</button>');
                // $(this).prop('disabled', true);



              
                    $('#manually_fuel_get2').val(1);
                    $('.manually_vendor').css({
                            'pointer-events': 'unset',
                            'background': '#fff'
                        });
                    // $('#manually_calculate_box2').after('<button type="button" class="btn btn-danger  float-right mr-2" id="manually_cancel2" >Cancel</button>');
                    // $(this).prop('disabled', true);
                
        }
    });


});

// $(document).ready(function() {
//     $('.import_shipment','.ddp_shipment','.non_stacakable_shipment', '.commercial_shipment','.dgrcargo_shipment','.export_shipment','.ddu_shipment','.stacakable_shipment','.non_commercial_shipment','.gernalcargo_shipment').on('change', function() {
//         if ($(this).is(':checked')) {
//             alert('Please add weight');
//             let consigneeCountry = $('#consignee_country').val();
//         let productId = $('#product_id').val();
//         let customerName = $('#customer_name').val();

//         if (consigneeCountry !== '' && consigneeCountry !== '0' &&
//             productId !== '' && productId !== '0' &&
//             customerName !== '' && customerName !== '0') {
               
//                 $("html, body").animate({
//                 scrollTop: $(".addBillEntry-box-1").offset().top - 50
//             }, 1000);
//         }
            
//         }
//     });
// });

$(document).ready(function() {
    $('.import_shipment, .ddp_shipment, .non_stacakable_shipment, .commercial_shipment, .dgrcargo_shipment, .export_shipment, .ddu_shipment, .stacakable_shipment, .non_commercial_shipment, .gernalcargo_shipment').on('change', function() {
        if ($(this).is(':checked')) {
            alert('Please add weight');

            let consigneeCountry = $('#consignee_country').val();
            let productId = $('#product_id').val();
            let customerName = $('#customer_name').val();

            if (consigneeCountry && consigneeCountry !== '0' &&
                productId && productId !== '0' &&
                customerName && customerName !== '0') {
                
                $("html, body").animate({
                    scrollTop: $("#total_pieces").offset().top - 50
                }, 1000);
            }
        }
    });
});

$(document).on('keyup', '.sampling_purprose', function() {
    if ($(this).val().trim().length > 0) {
        $('label[for="sampling_purprose"]').text(''); // Hide only the text
    } else {
        $('label[for="sampling_purprose"]').text('For Sampling Purpose Only'); // Show the text again
    }
});

$(document).ready(function() {
    $('#sub_vendors_list').on('change', function() {
        let selectedValue = $(this).val();

        $('#change_name').text('sub vendor');
        if (!selectedValue || selectedValue === '') {
            $('#change_name').text('vendor');
        }
        $.ajax({
            url: '<?= base_url("company/get_subvendor_state"); ?>', 
            type: 'POST', 
            data: { sub_vendor_id: selectedValue }, 
            success: function(response) {
                $('#sub_vendor_state').val(response.state || ''); 
            }
        });
    });
});


</script>



<?php include viewPath('includes/newjs');?>
<?php include viewPath('includes/footer');?>