
<style>
.bg-secondary {
    background: #6B5B95!important; 
}
.text-right {
    text-align: left!important;
}
</style>


<div class="container-fluid p-0">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">My Business</li>
           </ol>
         </nav>
</div>
<div class="container">
    <div class="row" style="margin-bottom: -90px;">
        <div class="col-md-12">
        	 <section class="content">
        	  <div class="container-fluid">
                
                <div class="row">
                    <div class="col-md-4">
                        <div _ngcontent-wsc-c195="" 
                            class="form-group">
                            <select _ngcontent-wsc-c195="" name="myBusiness" id="myBusiness" onchange="mybusinessData()" class="form-control form-control-alternative">
                                <option _ngcontent-wsc-c195="" value="all" selected="">All</option>
                                <option _ngcontent-wsc-c195="" value="today">Today</option>
                                <option _ngcontent-wsc-c195="" value="lastweek">Last Week</option>
                                <option _ngcontent-wsc-c195="" value="currentmonth" >Current Month</option>
                                <option _ngcontent-wsc-c195="" value="lastmonth">Last Month</option>
                                <option _ngcontent-wsc-c195="" value="lastthreemonth">Last Three Month</option>
                                <option _ngcontent-wsc-c195="" value="qtd">Quarter to Date</option>
                                <option _ngcontent-wsc-c195="" value="ytd">Year to Date</option>
                                <!--<option _ngcontent-wsc-c195="" value="custom">Custom</option>-->
                            </select>
                        </div>
                        
                    </div>
                    <!--<div class="col-md-4 ">-->
                    <!--    <div _ngcontent-wsc-c195="" class="form-group">-->
                    <!--        <input _ngcontent-wsc-c195="" type="date" required="" placeholder="from" name="from_date" class="form-control form-control-alternative ng-pristine ng-invalid ng-touched" min="1923-01-01" max="2023-01-16">-->
                    <!--    </div>-->
                        
                    <!--</div>-->
                    
                </div>
              </div>
              
    
            </section>
       </div>
    </div>
    
    <div class="row">
    <div class="col-md-12">
	 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="leads"><?php echo $leads; ?></h3>

                <p>My Leads</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-bar"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="applications"><?php echo $leads; ?></h3>

                <p>My Applications </p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="disbursements">₹<?php echo $disbursements; ?></h3>

                <p>DISBURSEMENTS</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="payouts">₹<?php echo $payouts; ?></h3>

                <p>PAYOUTS</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
        </div>
        
        
      </div>
    </section>
    </div>
    </div>
    
    
    <div class="row">
        <div _ngcontent-xve-c195="" class="container-fluid mt--7 ng-star-inserted">
   <div _ngcontent-xve-c195="" class="row mt-8">
      <div _ngcontent-xve-c195="" class="col-xl-12 col-lg-12">
         <div _ngcontent-xve-c195="" class="card bg-secondary shadow">
            <div _ngcontent-xve-c195="" class="card-header bg-white border-0" style="padding: 5px;">
               <div _ngcontent-xve-c195="" class="row align-items-center">
                  <div _ngcontent-xve-c195="" class="col-12 text-center">
                     <h3 _ngcontent-xve-c195="" class="mb-0 text-danger font-weight-bold mb-0">Paper Process</h3>
                  </div>
               </div>
            </div>
            <div _ngcontent-xve-c195="" class="card-body">
               <div _ngcontent-xve-c195="" class="row mt-3">
                   <div class="col-lg-3 col-6">

            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                       <span _ngcontent-xve-c195="" class="h6 text-white font-weight-bold mb-0">Bank Login Done</span> <br>
                        <h6 _ngcontent-xve-c195="" class="card-title text-white text-muted mb-0"> Count : 0 </h6> <br>
                        <h6 _ngcontent-xve-c195="" class="card-title text-white text-muted mb-0"> Amount : 0 </h6>
                <!--<h3>150</h3>-->

                <!--<p>My Leads</p>-->
              </div>
              <div class="icon">
                <i class="fas fa-chart-bar"></i>
              </div>
              <a href="#" class="small-box-footer">  More info <i class="fas fa-arrow-circle-right"> </i>
                  </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                 <span _ngcontent-xve-c195="" class="h6 text-white font-weight-bold mb-0">Bank Login Done</span> <br>
                        <h6 _ngcontent-xve-c195="" class="card-title text-white text-muted mb-0"> Count : 0 </h6> <br>
                        <h6 _ngcontent-xve-c195="" class="card-title text-white text-muted mb-0"> Amount : 0 </h6>
                <!--<h3>53<sup style="font-size: 20px">%</sup></h3>-->

                <!--<p>My Applications </p>-->
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <!--<h3>44</h3>-->
        
                        <!--<p>DISBURSEMENTS</p>-->
                        <span _ngcontent-xve-c195="" class="h6 text-white font-weight-bold mb-0">Bank Login Done</span> <br>
                        <h6 _ngcontent-xve-c195="" class="card-title text-white text-muted mb-0"> Count : 0 </h6> <br>
                        <h6 _ngcontent-xve-c195="" class="card-title text-white text-muted mb-0"> Amount : 0 </h6>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <span _ngcontent-xve-c195="" class="h6 text-white font-weight-bold mb-0">Bank Login Done</span> <br>
                        <h6 _ngcontent-xve-c195="" class="card-title text-white text-muted mb-0"> Count : 0 </h6> <br>
                        <h6 _ngcontent-xve-c195="" class="card-title text-white text-muted mb-0"> Amount : 0 </h6>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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


<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

</script>


<script>

    function mybusinessData() {
        var businessData = $('#myBusiness').find(":selected").val();
        $('#leads').text("");
        $('#applications').text("");
        $('#disbursements').text("");
        $('#payouts').text("");
        
        if(businessData) {
            $.ajax({
                type: 'POST',
                url: 'get-business-data',
                data: { 
                    'date': businessData, 
                },
                success: function(result){
                    var obj = JSON.parse(result);
                    $('#leads').text(obj.leads);
                    $('#applications').text(obj.applications);
                    $('#disbursements').text(obj.disbursements);
                    $('#payouts').text(obj.payouts);
                    
                },
                error: function (error) {
                    alert("server error");
                }
            });
            
        }
        
    }
   
</script>
