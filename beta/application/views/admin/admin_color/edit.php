<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard');?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Lead</li> 
           </ol>
         </nav>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 px-0 form-main">
            <div class="card form-card">
                <div id="success_message"></div>
                <span class="text-center text-info mb-2" id="susid"><?php echo $this->session->flashdata('success'); ?></span>
                <span class="text-center text-danger mb-2" id="errid"><?php echo $this->session->flashdata('error'); ?></span>
                
                <?php echo form_open_multipart('admin/admin-color-update'); ?>
                
                <input type="hidden" name="id" id="uid" class="form-control" value="<?= (isset($adminColor['id'])) ? $adminColor['id'] : '' ; ?>">

                <div class="row">
                    <?php 
                    $colors = [
                        'header_background_color' => 'Header Background Color',
                        'header_text_color' => 'Header Text Color',
                        'footer_background_color' => 'Footer Background Color',
                        'footer_text_color' => 'Footer Text Color',
                        'sidebar_color' => 'Sidebar Color',
                        'sidebar_text_color' => 'Sidebar Text Color',
                        'sidebar_hover_color' => 'Sidebar Hover Color',
                        'dropdown_background_color' => 'Dropdown Background Color',
                        'background_color' => 'Background Color',
                        'header_logo_color' => 'Header Logo Color',
                        'page_header_color' => 'Page Header Color',
                        'page_header_first_text_color' => 'Page Header First Text Color',
                        'page_header_second_text_color' => 'Page Header Second Text Color',
                    ];
     
                        $selected_domain_id = isset($_GET['domain_id']) ? (int)$_GET['domain_id'] : null;
                        
                        if ($selected_domain_id) {
                            $website_id = $selected_domain_id;
                        } else {
                            $website_id = domain_id_get();
                        }

                        if ($this->session->userdata('type') == 'admin') { ?>
                            <div class="col-12 mb-3">
                                <div class="col-4 mb-3">
                                    <label for="domain_id_main" class="col-form-label">Domain</label>
                                    <select class="form-control" id="domain_id_main" required name="domain_id" onchange="window.location.href = window.location.pathname + '?domain_id=' + this.value;">
                                        <?php foreach ($domains as $domain) { ?>
                                            <option <?= ($website_id == $domain['id']) ? 'selected' : ''; ?> value="<?= $domain['id'] ?>"> <?= $domain['url'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                    <?php }else{?>
                        <input type="hidden" name="domain_id"  class="form-control" value="<?= $website_id ?>" >
                    <?php } 


                    foreach ($colors as $name => $label) { ?>
                        <div class="col-md-6">
                            <label for="<?php echo $name; ?>" class="form-label"><?php echo $label; ?><span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>_text" class="form-control" required value="<?= (isset($adminColor[$name])) ? $adminColor[$name] : '' ; ?>">
                                <input type="color" id="<?php echo $name; ?>_picker" class="form-control form-control-color" value="<?= isset($adminColor[$name]) ? trim($adminColor[$name]) : '' ?>">
                            </div>
                        </div>
                    <?php } ?>
                </div>
                
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2"> 
                        <div class="form-group">
                            <button type="submit" id="create" value="create" class="btn btn-info mt-4">Update</button>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let colorFields = [
            "header_background_color",
            "header_text_color",
            "footer_background_color",
            "footer_text_color",
            "sidebar_color",
            "sidebar_text_color",
            "sidebar_hover_color",
            "dropdown_background_color",
            "background_color",
            "header_logo_color",
            "page_header_color"
            "page_header_first_text_color"
            "page_header_second_text_color"
        ];

        colorFields.forEach(field => {
            let textInput = document.getElementById(field + "_text");
            let colorPicker = document.getElementById(field + "_picker");

            // Update color picker when text input changes
            textInput.addEventListener("input", function() {
                colorPicker.value = textInput.value;
            });

            // Update text input when color picker changes
            colorPicker.addEventListener("input", function() {
                textInput.value = colorPicker.value;
            });
        });
    });
</script>
