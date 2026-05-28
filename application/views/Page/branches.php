<section class="branches-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Our Branch Network</h2>
        <div class="row">
            <?php if(!empty($branches)): ?>
                <?php foreach($branches as $branch): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 branch-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= html_escape($branch['branch_name']) ?></h5>
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt"></i> 
                                <?= html_escape($branch['address']) ?><br>
                                <?= html_escape($branch['city']) ?>, 
                                <?= html_escape($branch['state']) ?> - 
                                <?= html_escape($branch['pincode']) ?><br>
                                <?php if(!empty($branch['mobile'])): ?>
                                    <i class="fas fa-phone"></i> 
                                    <a href="tel:<?= $branch['mobile'] ?>"><?= $branch['mobile'] ?></a><br>
                                <?php endif; ?>
                                <?php if(!empty($branch['email'])): ?>
                                    <i class="fas fa-envelope"></i> 
                                    <a href="mailto:<?= $branch['email'] ?>"><?= $branch['email'] ?></a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">No branches found. Please check back later.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.branch-card {
    transition: transform 0.3s ease;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
.branch-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.card-title {
    color: #2c3e50;
    font-weight: 600;
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 10px;
    margin-bottom: 15px;
}
.card-text {
    color: #555;
}
.card-text i {
    width: 20px;
    color: #3498db;
    margin-right: 8px;
}
</style>
