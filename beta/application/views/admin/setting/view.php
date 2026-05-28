<style>
    table tbody th {
        background:#33b35a;color:white;
        margin-left: 20px!important;
        width:200px;
    }
</style>

<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Website Setting Details</li>
           </ol>
         </nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 px-0">
		    <div id="message" class="text-primary text-center"></div>
			<div class="table-responsive shadow-lg">
			<table class="table table-bordered text-center table-hover">
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>				
		          <tbody>
		              <?php if(!empty($datas)) { ?>
		                 <tr><td colspan="2" class="text-right"> <a href="<?= base_url('admin/edit-site-setting/').$datas[0]->id ?>" class="btn btn-sm btn-primary">Edit</a> </td></tr>
                        <tr>
                        <th>Logo</th>
                        <td><img src="<?= base_url('upload/assets/images/').$datas[0]->logo ?>" style=" width:50px; height:50px; "></td>
                        </tr>
                        
                        <tr>
                        <th>Short Description</th>
                        <td><?= $datas[0]->short_details ?></td>
                        </tr>
                        
                        <tr>
                        <th>Address</th>
                        <td><?= $datas[0]->address ?></td>
                        </tr>
                        
                        <tr>
                        <th>Email</th>
                        <td><?= $datas[0]->email ?></td>
                        </tr>
                        
                        <tr>
                        <th>Mobile</th>
                        <td><?= $datas[0]->mobile ?></td>
                        </tr>
                        
                        <tr>
                        <th>Linkedin Link</th>
                        <td><?= $datas[0]->linkedin ?></td>
                        </tr>
                        
                        <tr>
                        <th>Facebook Link</th>
                        <td><?= $datas[0]->facebook ?></td>
                        </tr>
                        
                        <tr>
                        <th>Twitter Link</th>
                        <td><?= $datas[0]->twitter ?></td>
                        </tr>
                        
                        <!--<tr>-->
                        <!--<th>Instagram Link</th>-->
                        <!--<td><?= $datas[0]->instagram ?></td>-->
                        <!--</tr>-->
                        
                        <?php } else { ?>
                         <td> Data Not found </td>
                        <?php }?>
		          </tbody>
			</table>

			</div>
		</div>
	</div>
</div>
