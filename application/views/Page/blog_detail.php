<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=base_url('blog')?>">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="javascript:void(0)">Blog Details </a>
        </li>

      </ul>

    </div>
  </div>
</nav>
<br/><br/>
  <div class="container">
  <!-- Stack the columns on mobile by making one full-width and the other half-width -->
  <div class="row">
    <div class="col-md-8">



      <div class="card mb-3">
          <img src="<?=base_url('beta/')?><?=$data->blogImage;?>" class="card-img-top" alt="..." height="400px">
          <div class="card-body">
            <h5 class="card-title"><?=$data->blogTitle;?></h5>
            <div class="d-flex justify-content-between"><p class="">Author - <?=$data->author;?></p>
            <p class="card-text"><small class="text-muted">Publish Date- <?=$data->publishDate;?></small></p></div>
          </div>
        </div>

    </div>
    <div class="col-12 col-md-4">

      <div class="card">
        <div class="card-body">
          <h5><?=$data->blogTitle;?></h5>
          <hr/>
          <p><?=$data->longData;?></p>

        </div>
      </div>
       <br/>
      <!-- <div class="card">
        <div class="card-body">
          <h5>Les formations</h5>
          <hr/>
          <button type="button" class="btn btn-light">Payantes</button>
          <button type="button" class="btn btn-dark">Gratuites</button>
        </div>
      </div> -->

        </div>
      </div>




    </div>
  </div>
</body>
</html>
