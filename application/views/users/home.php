<!-- Masthead -->
    <header class="masthead text-white text-center" style="">
      <div class="overlay"></div>
      <div class="container" style="">
        <div class="row">
          <div class="col-xl-9 text-left mx-auto">
            <h1 style="color: azure">Pasti Bersih, Rapi, dan Wangi.</h1>
              <p class="mb-5" style="margin-top:-10px; font-size: 13px ">Jasa laundry kiloan dan satuan, Kami sudah melayani ratusan pelanggan dari Setia Budi</p>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-9 mx-auto">
            <form method="GET" action="<?=base_url('cari')?>">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <input type="text" name="idOrder" class="form-control form-control-lg" placeholder="Masukkan ID Order Kamu..." onkeypress="return inputAngka(event)" autocomplete="OFF">
                  
                </div>
                <div class="col-12 col-md-3">
                  <button type="submit" class="btn btn-block btn-lg tombol-cari">Cari!</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </header>


<!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
  function inputAngka(evt){
      var charCode = (evt.charCode);
      if(charCode>31 && (charCode<48 || charCode>57) && charCode!=45) { return false; } else { return true; }
  }
</script>