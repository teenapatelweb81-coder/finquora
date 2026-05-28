<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Branch Agreement</li> 
            </ol>
         </nav>
</div>
<div class="container-fluid px-0">
        <div class="row m-0 bg-white">
            <div class="col-md-12 px-0 form-main">
                <div class="card  form-card">
                    <div id="success_message"></div>
                    <span class="text-center text-info mb-2" id="susid"></span>  <?php //echo $this->session->flashdata('success');?>
                    <span class="text-center text-white bg-danger mb-2" id="errid"> </span> <?php // echo $this->session->flashdata('error');?>
                    <?php echo form_open_multipart('admin/agreement-update');?>
                    <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error'); ?></span>
                    
                    <div class="row">
                        <input type="hidden" name="id" id="uid" class="form-control" value="<?= (isset($datas['id'])) ? $datas['id'] : '' ; ?>" >
                    
                    </div>

                    
                    <div class="row">
                         <?php
                            $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
                            
                            if ($selected_domain_id) {
                                $website_id = $selected_domain_id;
                            } else {
                                $website_id = domain_id_get();
                            }

                            if ($this->session->userdata('type') == 'admin') { ?>
                                <div class="col-md-6 mb-2">
                                    <label for="domain_id_main" class="form-label">Domain</label>
                                    <select class="form-control" id="domain_id_main" required name="domain_id" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                                        <?php foreach ($domains as $domain) { ?>
                                            <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                        <?php }else{?>
                            <input type="hidden" name="domain_id"  class="form-control" value="<?= $website_id ?>" >
                        <?php }?>

                        <div class="col-md-6 mb-2">
                            <label for="heading" class="form-label">Branch Agreement heading</label>
                            <input type="text" name="heading" id="heading" class="form-control" value="<?= (isset($datas['heading'])) ? $datas['heading'] : '' ; ?>">
                            <input type="hidden" name="type" id="type" class="form-control" value="branch_agreement">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="heading" class="form-label">Branch Agreement content</label>
                            <textarea name="content" id="content" class="form-control" required><?= (isset($datas['content'])) ? $datas['content'] : '' ; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="row">   
                        <div class="col-md-2"> 
                            <div class="form-group">
                            <button type="submit"  id="create" value="create" class="btn btn-info mt-4">update </button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    <!-- </form> -->
</div>
<script>
CKEDITOR.replace('content');
</script>
