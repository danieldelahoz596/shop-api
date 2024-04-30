<footer style="background-image: url({{ asset('assets/img/snakeBgBeige.png') }});">
  <div class="container-fluid p-0 m-0 footer">
    <div class=" row footerWrapper">
      <div class="footerDescription col-12">
        <div class="row">
          <div class="col-xxl-5 col-4" style="padding: 1rem 0 0 2rem;">
            <div class="footerTitle">
              <div class="display-1 fw-bold tertiary-color">buudl</div>
              <h3 class="fs-xmd w-75 w-xl-100 fw-bold d-none d-md-block" >Discover your style. Share your story.</h3>
            </div>
            <ul class="m-0 p-0 d-md-none footer-mobile-links">
                <li><a href="">Ios App</a></li>
                <li><a href="">Sell</a></li>
                <li><a href="">Help</a></li>
                <li><a href="">Blog</a></li>
                <li><a href="{{ url('terms-conditions') }}">Terms and Service</a></li>
                <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                <li><a href="">Discover</a></li>
            </ul>
          </div>
          <div class="col-2 d-none d-md-inline">
            <div class="footerInfos">
              <h1 class="fw-bolder">Category</h1>
              <ul>
                <li><a href="" class="footerLinks">Womenswear</a></li>
                <li><a href="" class="footerLinks">Menswear</a></li>
                <li><a href="" class="footerLinks">Kids</a></li>
                <li><a href="" class="footerLinks">Everything</a></li>
                <li><a href="" class="footerLinks">Steal</a></li>
              </ul>
            </div>
          </div>
          <div class="col-2 d-none d-md-inline">
            <div class="footerInfos">
              <h1 class="fw-bolder">Sell</h1>
              <ul>
                <li><a href="" class="footerLinks">Sell on Buudl</a></li>
                <li><a href="{{ url('privacy-policy') }}" class="footerLinks">Privacy Policy</a></li>
                <li><a href="{{ url('terms-conditions') }}" class="footerLinks">Terms & Conditions</a></li>
              </ul>
            </div>
          </div>
          <div class="col-2 d-none d-md-inline">
            <div class="footerInfos">
              <h1 class="fw-bolder">About Buudl</h1>
              <ul>
                <li><a href="" class="footerLinks">About us</a></li>
                <li><a href="" class="footerLinks">Blogs</a></li>
                <li><a href="{{ url('contact') }}" class="footerLinks">Contact</a></li>
                <li><a href="" class="footerLinks">FAQ</a></li>
                <li><a href="{{ url('facebook-data') }}" class="footerLinks">Facebook Privacy Policy</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footerSocial d-flex justify-content-end position-absolute">
      <div class="social"><a href=""><i class="fa-brands fa-facebook-f display-4"></i></a></div>
      <div class="social ps-5"><a href=""><i class="fa-brands fa-twitter display-4"></i></a></div>
      <div class="social px-5"><a href=""><i class="fa-brands fa-instagram display-4"></i></a></div>
    </div>
  </div>
</footer>