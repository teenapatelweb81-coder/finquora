
<section class="p-t-130 p-b-100" id="page-title" data-bg-parallax="<?= base_url('beta/assets/images/contect-us/' . ($this->db->where('domain_id', domain_id_get())->get('contect_us')->row('background_img') ?? '')) ?>
"><div class="parallax-container img-loaded" data-velocity="-.140" style="background: url(&quot;<?= base_url('beta/assets/images/contect-us/' . ($this->db->where('domain_id', domain_id_get())->get('contect_us')->row('background_img') ?? '')) ?>
&quot;) -39.9px;"></div>
	<div class="container">
		<div class="page-title">
			<h1><?php echo !empty($disclaimer['title']) ? $disclaimer['title'] : 'Not yet any policy'; ?></h1>
		</div>
		<div class="breadcrumb">
			<ul itemscope="" itemtype="https://schema.org/BreadcrumbList">
			  <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
			    <a itemprop="item" href="<?php echo base_url();?>">
			    <span itemprop="name">Home</span></a>
			    <meta itemprop="position" content="1">
			  </li>
			  <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
			    <a itemprop="item" href="#">
			    <span itemprop="name">Disclaimer</span></a>
			    <meta itemprop="position" content="2"> 
			  </li>
			</ul>
		</div>
	</div>
</section>



<section id="section-privacy">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<div class="card">
	                <div class="card-body">
						<?php echo !empty($disclaimer['description']) ? $disclaimer['description'] : 'Not yet any disclaimer'; ?> 
                    </div>
				</div>

			</div>
		</div>
	</div>
</section>

