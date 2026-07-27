<?php

 $domain_id = domain_id_get();
$adminColor = $this->db->where( array('domain_id' => $domain_id))->get('admin_color')->row_array();
$contectUs = $this->db->where( array('domain_id' => $domain_id))->get('contect_us')->row_array();
 ?>

</div><!--- col-md-8 end ---->

</div><!--Container end-->

  </div> <!--Container end-->

 </div><!--page end-->


         </div>

      </div>

   </div>


   <style>
  .footer{
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        /* background: #f2b23e; */
        background: <?php echo isset($adminColor['footer_background_color']) ? $adminColor['footer_background_color'] : '#f2b23e'; ?>;
        padding-top: 2px;
 }
 .whatsapp-float{
        position: fixed;
        right: 20px;
        bottom: 20px;
        background: #25D366;
        color: #fff;
        border-radius: 50%;
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0,0,0,.3);
        z-index: 9999;
 }
 .whatsapp-float .whatsapp-icon{
        font-size: 28px;
        color: #fff;
        line-height: 1;
 }
    </style>
   <!-- JavaScript files-->
   <footer id="footer" class="inverted footer">
      <div class="footer-content">



        <div class="copyright-content background-bright-grey"style="text-align: center;">
          <div class="container-fluid">
            <div class="row align-items-end">
              <div class="col-lg-12" >
                  <h5 style="font-weight:bold;color: <?= isset($adminColor['footer_text_color']) ? $adminColor['footer_text_color'] : ''; ?>"><?= isset($contectUs['copyright']) ? $contectUs['copyright'] : ''; ?> </h5>
              </div>
              <div class="col-lg-4 text-right">
                </div>
            </div>
          </div>
        </div>
      </footer>

<?php 
$waNumber = isset($contectUs['whatsapp_no']) ? preg_replace('/\D+/', '', $contectUs['whatsapp_no']) : '';
$waLink = !empty($waNumber) ? 'https://wa.me/'.$waNumber : '';
$showWhatsapp = true;  
$user_rm = [];

$userId = $this->session->userdata('user_id');
$userRole = $this->session->userdata('role');
if ($userId) {
    $user = $this->db->get_where('user_master', ['id' => $userId ,'role' => $userRole])->row();
    $rmuser = $this->db->get_where('user_master', ['id' => $userId ,'role' => $userRole])->row();
    if(empty($rmuser)){
        $rmuser = $this->db->get_where('branch_franchise', ['id' => $userId ,'role' => $userRole])->row();
    }
    $user_rm = $this->db->get_where('user_master', ['id' => $rmuser->assigned_rm,'role' => $rmuser->assigned_rm_role])->row();
    // print_r($user_rm);
    // print_r($this->db->last_query());die;
   
    $waNumberrm = isset($user_rm->mobile_no) ? preg_replace('/\D+/', '', $user_rm->mobile_no) : '';
    $waLinkrm = !empty($waNumberrm) ? 'https://wa.me/'.$waNumberrm : '';
    
    // Check user exists
    if (!empty($user) && !empty($user->parent_id)) {

        $parent = null;

        if ($user->parent_id_role == 2) {
            $parent = $this->db->get_where('user_master', ['id' => $user->parent_id])->row();
        }

        if ($user->parent_id_role == 3) {
            $parent = $this->db->get_where('branch_franchise', ['id' => $user->parent_id])->row();
        }

        // Now check parent safely
        if (!empty($parent) && isset($parent->role) && $parent->role != 1) {
            $showWhatsapp = false;
        }
    }
}
?>


<?php if ($showWhatsapp) { ?>
<?php if ($user_rm) { ?>
    <a href="#" class="whatsapp-float agent-contact-trigger" style="right: 80px; font-size: 24px; background: #5f9ea0; ">
        <i class="fa fa-headphones text-white" aria-hidden="true"></i>
    </a>
<?php } ?>
<?php if (!empty($waLink)) { ?>
    <a href="<?php echo $waLink; ?>" class="whatsapp-float" target="_blank" rel="noopener">
        <i class="fab fa-whatsapp whatsapp-icon text-white" aria-hidden="true"></i>
    </a>
<?php } ?>

    <!-- Agent Contact Modal -->
    <div class="agent-contact-modal" style="display: none;">
        <div class="agent-contact-modal-content">
            <div class="agent-contact-header">
                <h3><i class="fa fa-headphones"></i> Contact Support</h3>
                <span class="agent-contact-close">&times;</span>
            </div>
            <div class="agent-contact-body">
                <div class="agent-info">
                    <div class="agent-avatar">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <div class="agent-details">
                        <h4>Support Agent - <?php echo isset($user_rm->name) ? $user_rm->name : 'Not Available'; ?></h4>
                        <p><i class="fa fa-phone"></i> <?php echo isset($user_rm->mobile_no) ? $user_rm->mobile_no : 'Not Available'; ?></p>
                        <p><i class="fa fa-envelope"></i> <?php echo isset($user_rm->email) ? $user_rm->email : 'support@example.com'; ?></p>
                    </div>
                </div>
            </div>
            <div class="agent-contact-footer">
                <a href="tel:<?php echo isset($user_rm->mobile_no) ? $user_rm->mobile_no : ''; ?>" class="agent-call-btn">
                    <i class="fa fa-phone"></i> Call Now
                </a>
                <a href="<?php echo $waLinkrm; ?>" target="_blank" class="agent-whatsapp-btn">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
                <a href="mailto:<?php echo isset($user_rm->email) ? $user_rm->email : ''; ?>" class="agent-call-btn">
                    <i class="fa fa-envelope"></i> Email
                </a>
            </div>
        </div>
    </div>

    <style>
        /* Agent Contact Modal Styles */
        .agent-contact-modal {
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .agent-contact-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .agent-contact-modal-content {
            background: #fff;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }

        .agent-contact-modal.active .agent-contact-modal-content {
            transform: translateY(0);
        }

        .agent-contact-header {
            background: #5f9ea0;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .agent-contact-header h3 {
            margin: 0;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .agent-contact-close {
            font-size: 28px;
            cursor: pointer;
            transition: 0.3s;
        }

        .agent-contact-close:hover {
            color: #f1f1f1;
        }

        .agent-contact-body {
            padding: 20px;
        }

        .agent-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .agent-avatar i {
            font-size: 50px;
            color: #5f9ea0;
        }

        .agent-details h4 {
            margin: 0 0 5px 0;
            color: #333;
        }

        .agent-details p {
            margin: 5px 0;
            color: #666;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .agent-working-hours {
            background: #f9f9f9;
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            color: #555;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .agent-contact-footer {
            display: flex;
            border-top: 1px solid #eee;
        }

        .agent-call-btn,
        .agent-whatsapp-btn {
            flex: 1;
            text-align: center;
            padding: 12px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .agent-call-btn {
            background: #5f9ea0;
        }

        .agent-whatsapp-btn {
            background: #25D366;
        }

        .agent-call-btn:hover {
            background: #4d8c8e;
        }

        .agent-whatsapp-btn:hover {
            background: #1da851;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get modal elements
            const modal = document.querySelector('.agent-contact-modal');
            const trigger = document.querySelector('.agent-contact-trigger');
            const closeBtn = document.querySelector('.agent-contact-close');

            // Show modal when clicking the trigger
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'flex';
                // Trigger reflow
                void modal.offsetWidth;
                // Add active class
                setTimeout(() => {
                    modal.classList.add('active');
                }, 10);
            });

            // Close modal when clicking the close button
            closeBtn.addEventListener('click', function() {
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            });

            // Close modal when clicking outside the modal content
            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('active');
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 300);
                }
            });
        });
    </script>
<?php } ?>



   <script src="<?php echo base_url(); ?>upload/admin/vendor/jquery/jquery.min.js"></script>

   <script src="<?php echo base_url(); ?>upload/admin/vendor/popper.js/umd/popper.min.js"> </script>

   <script src="<?php echo base_url(); ?>upload/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

   <script src="<?php echo base_url(); ?>upload/admin/vendor/jquery-validation/jquery.validate.min.js"></script>


   <script src="<?php echo base_url(); ?>upload/admin/js/our.js"></script>
   <!-- Main File-->

   <script src="<?php echo base_url(); ?>upload/admin/js/front.js"></script>
   <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

   <script>
    //CKEDITOR.replace( 'editor1' );


$(document).ready(function () {
      $(".table").DataTable({
        paging: true,
        autoWidth: true,
         
      });
  });



  // $(".tables").DataTable({
  //       paging: true,
  //       autoWidth: true,
  //         dom: 'Bfrtip',
  //           buttons: [
  //               'excelHtml5',
  //           ]
  //     });

</script>





<script>
    function copyLink_share_pl(url) {
        var input = document.createElement('input');
        input.value = url;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        alert('Link copied to clipboard : ' + url);
    }

    function copyLink_share_pl(url) {
        var input = document.createElement('input');
        input.value = url;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        alert('Link copied to clipboard : ' + url);
    }

</script>


</body>

</html>