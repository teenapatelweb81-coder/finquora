
<section class="p-t-130 p-b-100" id="page-title" data-bg-parallax="<?= base_url('beta/assets/images/contect-us/' . ($this->db->where('domain_id', domain_id_get())->get('contect_us')->row('background_img') ?? '')) ?>
"><div class="parallax-container img-loaded" data-velocity="-.140" style="background: url(&quot;<?= base_url('beta/assets/images/contect-us/' . ($this->db->where('domain_id', domain_id_get())->get('contect_us')->row('background_img') ?? '')) ?>
&quot;) 0px;"></div>
	<div class="container">
		<div class="page-title">
			<h1><?= isset($important_update['title']) && !empty($important_update['title']) ? $important_update['title'] :'' ?></h1>
		</div>
		<div class="breadcrumb">
			<ul itemscope="" itemtype="https://schema.org/BreadcrumbList">
			  <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
			    <a itemprop="item" href="https://nowofloan.com/">
			    <span itemprop="name">Home</span></a>
			    <meta itemprop="position" content="1">
			  </li>
			  <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
			    <a itemprop="item" href="https://nowofloan.com/important-update">
			    <span itemprop="name"><?= isset($important_update['title']) && !empty($important_update['title']) ? $important_update['title'] :'' ?></span></a>
			    <meta itemprop="position" content="2">
			  </li>
			</ul>
		</div>
	</div>
</section>
<section id="update">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<div class="card">
					<div class="card-body">
						<p class="text-bold text-primary"><span class="badge badge-primary text-uppercase m-r-10"><?= isset($important_update['title']) && !empty($important_update['title']) ? $important_update['title'] :'' ?></span><?= isset($important_update['date']) && !empty($important_update['date']) ? date('d/m/Y', strtotime($important_update['date'])) :'' ?></p>
						
						<?= isset($important_update['description']) && !empty($important_update['description']) ? $important_update['description'] :'' ?>
						</div>
				</div>
					
			</div>
		</div>
	</div>
</section>